<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Category;

// for Image Management
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use Auth;
use Request;
use File;
use Illuminate\Support\Facades\session;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
class ListCategory extends Component
{
    
    public $isOpen = 0;

    public $addEditModal = 0;
    public $deleteModal = 0;
    public $initEdit = false;
    // public $addBrandModel = false;
    public $editModel = false;

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    
    public $id, $title, $slug, $photo,  $oldphoto, $status;
    

    protected function rules(){
        return
            [ 
                'title' => 'required|min:6',
                'slug' => 'required| min:6',
                'status'=> 'required',
            ];
    }    

    public function updated($field)    
    {
        $this->validateOnly($field, [
            'title' => 'required|min:6',
            'slug' => 'required| min:6',
            'status'=> 'required',
        ]);
    }
    public function resetInputs(){
        $this->id  = '';
        $this->title  = '';
        $this->slug  = '';
        $this->status  = '';
        $this->photo="";
        $this->oldphoto="";
    }
    public function render()
    {
        // $records=Banner::orderBy('id','DESC')->paginate(5);
        return view('livewire.backend.list-category', [
            'records' => Category::paginate(5),
        ]) ->layout('components.backend.master');
    }
   
     public function create()
    {
        $this->resetInputs();
        $this->editModel = false;
        $this->addEditModal = true;
    }

    public function edit(Category $category, $initEdit, $pid=null)
    {
       
        if($initEdit == 'Y'){
            $this->deleteImage($this->oldphoto);
            $this->oldphoto  = null;
        }else {
            $this->oldphoto  = $category->photo;
            $this->id  = $category->id;
            $this->title  = $category->title;
            $this->slug  = $category->slug;
            $this->status  = $category->status;
            $this->description = $category->description;
            $this->editModel = true;
            $this->addEditModal = true;
        }
        // $this->oldphoto  = $banner->photo;
       
    }
    public function delete(Category $category)
    {
        $this->id  = $category->id;
        $this->title  = $category->title;
        $this->slug  = $category->slug;
        $this->photo  = $category->photo;
        $this->status  = $category->status;
        $this->editModel = false;
        $this->addEditModal = false;
        $this->deleteModal = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->addEditModal = false;
        $this->deleteModal = false;
    }
    public function storeImage(){
        if($this->photo){

            $image=$this->photo;
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getclientOriginalExtension();

            $img = $manager->read($image);
            $img = $img->resize(370,246);
            $img ->toJpeg(80)->save(base_path('public/upload/category/'.$name_gen));

            $imgthumb = $manager->read($image);
            $imgthumb = $imgthumb->resize(130,130);
            $imgthumb ->toJpeg(80)->save(base_path('public/upload/category/thumbnails/'.$name_gen));
            
            $save_url = 'upload/category/'.$name_gen;
            
            return $name_gen;
        }  
    }
    public function store(Request $request) {

        $image = $this->StoreImage();
               
        $validatedData = $this->validate();
        $validatedData['photo'] = $image;
        
        // remove multiple space and replace space with - in slug
        $str=strtolower($this->slug);
        $str = preg_replace('!\s+!', ' ', $str);
        $str = str_replace(' ', '-', $str);
        $validatedData['slug'] = $str;

        
        Category::create($validatedData);

        session()->flash('message', 'Record Added Successfully....');
        $this->resetInputs();
        $this->addEditModal = false;
        // $this->dispatchBrowserEvent("HideModelAddNewBrands");  
    }
    public function update(){
        if($this->photo){
            $image = $this->StoreImage();
        } else {
            if($this->oldphoto){
                $image = $this->oldphoto;
            } else {
                $image = null;
            }
        }

        $validatedData = $this->validate();
        $validatedData['photo'] = $image;

        Category::where('id', $this->id)->update([
            'title'=> $validatedData['title'],
            'slug'=> $validatedData['slug'],
            'status'=> $validatedData['status'],
            'photo'=> $validatedData['photo']
        ]);
     
        session()->flash('message', 'Record Edited Successfully....');
        $this->resetInputs();
        $this->addEditModal = false;
    }
   
    public function destroy(){
        // dd($this->photo);
        Category::where('id', $this->id)->delete();
     
        $this->deleteImage($this->photo);

            
        session()->flash('message', 'Record  Deleted Successfully....');
        $this->deleteModal = false;
        
    }
    public function deleteImage($file){
        $filePath = base_path('public/upload/category/'.$file);
        $img=File::delete($filePath);

        $filePathThumb = base_path('public/upload/category/thumbnails/'.$file);
        $imgthumb=File::delete($filePathThumb);

        // $this->oldphoto="";
        // $this->editModel = true;
        // $this->addEditModal = true;
        // return back();
    }

}
