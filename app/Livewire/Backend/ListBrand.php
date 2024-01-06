<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Brand;

use Auth;
use Illuminate\Support\Facades\session;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class ListBrand extends Component
{

    public $isOpen = 0;

    public $addEditModal = 0;

    public $deleteModal = 0;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $bid, $title, $slug, $status, $brand_id;

    public $brand, $data;
    public $addBrandModel = false;
    public $editModel = false;

    protected function rules(){
        return
            [ 
                'title' => 'required|min:6',
                'slug' => 'required| min:6',
            ];
    }    

    public function updated($field)    
    {
        $this->validateOnly($field, [
            'title' => 'required|min:6',
            'slug' => 'required| min:6',
        ]);
    }
    public function resetInputs(){
        $this->brand_id  = '';
        $this->title  = '';
        $this->slug  = '';
        $this->status  = '';
    }
    public function render()
    {
        $brand=Brand::orderBy('id','DESC')->paginate(5);
        return view('livewire.backend.list-brand', [
            'brands' => Brand::paginate(5),
        ]) ->layout('components.backend.master');
    }
   
     public function addNewBrand()
    {
        $this->resetInputs();

        $this->editModel = false;
        // $this->isOpen = true;
        $this->addEditModal = true;
    }

    public function editBrand(Brand $brand)
    {
        $this->brand_id  = $brand->id;
        $this->title  = $brand->title;
        $this->slug  = $brand->slug;
        $this->status  = $brand->status;
        $this->editModel = true;
        // $this->isOpen = true;
        $this->addEditModal = true;
    }
    public function deleteBrand(Brand $brand)
    {
        $this->brand_id  = $brand->id;
        $this->title  = $brand->title;
        $this->slug  = $brand->slug;
        $this->status  = $brand->status;
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

    public function createBrands() {

        $validated = $this->validate([ 
            'title'=> 'required',
            'slug'=> 'required',
            'status'=> 'required'
        ]);
        
        Brand::create($validated);
        session()->flash('message', 'Brand Added Successfully....');
        $this->resetInputs();
        $this->addEditModal = false;
        // $this->dispatchBrowserEvent("HideModelAddNewBrands");  
    }
    public function updateBrands(){
        $validated = $this->validate([ 
            'title'=> 'required',
            'slug'=> 'required',
            'status'=> 'required'
        ]);
               
        $validatedData = $this->validate();
        Brand::where('id', $this->brand_id)->update([
            'title'=> $validatedData['title'],
            'slug'=> $validatedData['slug']
        ]);
     
        session()->flash('message', 'Brand Edited Successfully....');
        $this->resetInputs();
        $this->addEditModal = false;
        // $this->dispatchBrowserEvent("HideModelAddNewBrands");  
        
    }
   
    public function destroyBrands(){
        Brand::where('id', $this->brand_id)->delete();
     
        session()->flash('message', 'Brand Deleted Successfully....');
        // $this->dispatchBrowserEvent("HideModelDeleteBrands");  
        $this->deleteModal = false;
        
    }
}
