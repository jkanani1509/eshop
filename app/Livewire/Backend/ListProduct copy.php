<?php

namespace App\Livewire\Backend;
use Livewire\Attributes\Rule;


use Livewire\Component;
use App\Models\product;

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
class ListProduct extends Component
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
    

    #[Rule('required|min:6')] 
    
    public $id, $photo, $oldphoto, $size;
    
    #[Rule('required|min:6')] 
    public $title;

    #[Rule('required|min:6')] 
    public $slug;
    #[Rule('required')] 
    public $cat_id;

    #[Rule('required')] 
    public $brand_id;

    #[Rule('required')] 
    public $price;

    #[Rule('required|numeric|min:0|lt:30')] 
    public $discount;

    #[Rule('required|numeric|gt:0')] 
    public $stock;
   
    #[Rule('required')] 
    public $status;
    
   

    // protected function rules(){
    //     return
    //         [ 
    //             'title' => 'required|min:6',
    //             'slug' => 'required| min:6',
    //             'status'=> 'required',
    //             'cat_id'=> 'required',
    //             'brand_id'=> 'required',
    //             'price'=> 'required|numeric|gt:0',
    //             'discount'=> 'numeric|gt:0|lt:30',
    //             'stock'=> 'required|numeric|gt:0'

    //         ];
    // }    

    public function updated($field)    
    {
        $this->validateOnly($field, [
            'title' => 'required|min:6',
            'slug' => 'required| min:6',
            'cat_id'=> 'required',
            'brand_id'=> 'required',
            'price'=> 'required|numeric|gt:0',
            'discount'=> 'numeric|gt:0|lt:30',
            'size'=> 'required',
            'stock'=> 'required|numeric|gt:0',
            'status'=> 'required'
        ]);
    }
    public function resetInputs(){
        $this->id  = '';
        $this->title  = '';
        $this->slug  = '';
        $this->status  = '';
        $this->photo="";
        $this->oldphoto="";
        $this->cat_id="";
        $this->brand_id="";
        $this->price="";   
        $this->stock=0;
    }
    public function render()
    {
        // $records=Banner::orderBy('id','DESC')->paginate(5);
        return view('livewire.backend.list-product', [
            'records' => product::paginate(5),
        ]) ->layout('components.backend.master');
    }
   
     public function create()
    {
        $this->resetInputs();
        $this->editModel = false;
        $this->addEditModal = true;
    }

    public function edit(Product $product, $initEdit, $pid=null)
    {
       
        if($initEdit == 'Y'){
            $this->deleteImage($this->oldphoto);
            $this->oldphoto  = null;
        }else {
            $this->oldphoto  = $product->photo;
            $this->id  = $product->id;
            $this->title  = $product->title;
            $this->slug  = $product->slug;
            $this->cat_id  = $product->cat_id;
            $this->brand_id  = $product->brand_id;
            $this->status  = $product->status;
            $this->description = $product->description;
            $this->editModel = true;
            $this->addEditModal = true;
        }
        // $this->oldphoto  = $banner->photo;
       
    }
    public function delete(Product $product)
    {
        $this->id  = $product->id;
        $this->title  = $product->title;
        $this->slug  = $product->slug;
        $this->cat_id  = $product->cat_id;
        $this->photo  = $product->photo;
        $this->status  = $product->status;
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
            $img ->toJpeg(80)->save(base_path('public/upload/products/'.$name_gen));

            $imgthumb = $manager->read($image);
            $imgthumb = $imgthumb->resize(130,130);
            $imgthumb ->toJpeg(80)->save(base_path('public/upload/products/thumbnails/'.$name_gen));
            
            $save_url = 'upload/products/'.$name_gen;
            
            return $name_gen;
        }  
    }
    public function store(Request $request) {

        
        $image = $this->StoreImage();
        dump("SFSFSFS"); 
        dump($this->title);
        dump($this->slug);
        dump($this->cat_id);
        dump($this->brand_id);
        dump($this->price);
        dump($this->discount);
        dump($this->size);
        dump($this->stock);
        dump($this->status);
        $validated = $this->validate();
        dump("ZXZXZXZXX");
        $validatedData['photo'] = $image;
        
        // remove multiple space and replace space with - in slug
        $str=strtolower($this->slug);
        $str = preg_replace('!\s+!', ' ', $str);
        $str = str_replace(' ', '-', $str);
        $validatedData['slug'] = $str;

        dump("ABABAB");
        product::create($validatedData);

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

        product::where('id', $this->id)->update([
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
        product::where('id', $this->id)->delete();
     
        $this->deleteImage($this->photo);

            
        session()->flash('message', 'Record  Deleted Successfully....');
        $this->deleteModal = false;
        
    }
    public function deleteImage($file){
        $filePath = base_path('public/upload/products/'.$file);
        $img=File::delete($filePath);

        $filePathThumb = base_path('public/upload/products/thumbnails/'.$file);
        $imgthumb=File::delete($filePathThumb);

        // $this->oldphoto="";
        // $this->editModel = true;
        // $this->addEditModal = true;
        // return back();
    }

}
