<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Banner;

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
class ListBanner extends Component
{
    
    public $isOpen = 0;

    public $addEditModal = 0;

    public $deleteModal = 0;

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    
    public $id, $title, $slug, $photo,  $oldphoto, $status;

    public $initEdit = false;
    // public $addBrandModel = false;
    public $editModel = false;


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
        return view('livewire.backend.list-banner', [
            'records' => Banner::paginate(5),
        ]) ->layout('components.backend.master');
    }
   
     public function create()
    {
        $this->resetInputs();

        $this->editModel = false;
        // $this->isOpen = true;
        $this->addEditModal = true;
    }

    public function edit(Banner $banner, $initEdit, $pid=null)
    {
       
        if($initEdit == 'Y'){
            // $banners=Banner::where('id', $pid)->first();
            $this->oldphoto  = null;
            // $this->id  = $banners->id;
            // $this->title  = $banners->title;
            // $this->slug  = $banners->slug;
            // $this->status  = $banners->status;
            // $this->description = $banners->description;
            // $this->editModel = true;
            // $this->addEditModal = true;
        }else {
            $this->oldphoto  = $banner->photo;
            $this->id  = $banner->id;
            $this->title  = $banner->title;
            $this->slug  = $banner->slug;
            $this->status  = $banner->status;
            $this->description = $banner->description;
            $this->editModel = true;
            $this->addEditModal = true;
        }
        // $this->oldphoto  = $banner->photo;
       
    }
    public function delete(Banner $banner)
    {
        $this->id  = $banner->id;
        $this->title  = $banner->title;
        $this->slug  = $banner->slug;
        $this->photo  = $banner->photo;
        $this->status  = $banner->status;
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
            $img ->toJpeg(80)->save(base_path('public/upload/banners/'.$name_gen));

            $imgthumb = $manager->read($image);
            $imgthumb = $imgthumb->resize(130,130);
            $imgthumb ->toJpeg(80)->save(base_path('public/upload/banners/thumbnails/'.$name_gen));
            
            $save_url = 'upload/banners/'.$name_gen;
            
            return $name_gen;
        }  
    }
    public function store(Request $request) {

        $image = $this->StoreImage();
               
        $validatedData = $this->validate();
        $validatedData['photo'] = $image;

        //remoce multiple space to - in slug
        $str=strtolower($this->slug);
        $str = preg_replace('!\s+!', ' ', $str);
        $str = str_replace(' ', '-', $str);
        $validatedData['slug'] = $str;

        
        Banner::create($validatedData);

        session()->flash('message', 'Banner Added Successfully....');
        $this->resetInputs();
        $this->addEditModal = false;
    }
    public function update(){
        if($this->photo){
            // dump('Photo ....');
            $image = $this->StoreImage();
        } else {
            if($this->oldphoto){
                // dump('Old Photo ....');
                // dump($this->oldphoto);
                $image = $this->oldphoto;
            } else {
                // dump('Not Old Photo ....');
                $image = null;
            }
        }

        // dump($image);
        $validatedData = $this->validate();
        $validatedData['photo'] = $image;
        
        //remoce multiple space to - in slug
        $str=strtolower($this->slug);
        $str = preg_replace('!\s+!', ' ', $str);
        $str = str_replace(' ', '-', $str);
        $validatedData['slug'] = $str;


        Banner::where('id', $this->id)->update([
            'title'=> $validatedData['title'],
            'slug'=> $validatedData['slug'],
            'status'=> $validatedData['status'],
            'photo'=> $validatedData['photo']
        ]);
     
        session()->flash('message', 'Banner Edited Successfully....');
        $this->resetInputs();
        $this->addEditModal = false;
    }
   
    public function destroy(){
        Banner::where('id', $this->id)->delete();
     
        $filePath = base_path('public/upload/banners/'.$this->photo);
        $img=File::delete($filePath);

        $filePathThumb = base_path('public/upload/banners/thumbnails'.$this->photo);
        $imgthumb=File::delete($filePathThumb);

            
        session()->flash('message', 'Banner Deleted Successfully....');
        // $this->dispatchBrowserEvent("HideModelDeleteBrands");  
        $this->deleteModal = false;
        
    }
    public function deleteImage(){
        // dd($this->oldphoto);

        $filePath = base_path('public/upload/banners/'.$this->oldphoto);
        $img=File::delete($filePath);

        $filePathThumb = base_path('public/upload/banners/thumbnails/'.$this->oldphoto);
        $imgthumb=File::delete($filePathThumb);

        $this->oldphoto="";
        $this->editModel = true;
        $this->addEditModal = true;
        return back();
    }

}
