<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Banner;

use Auth;
use Illuminate\Support\Facades\session;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
class ListBanner extends Component
{
    
    public $isOpen = 0;

    public $addEditModal = 0;

    public $deleteModal = 0;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $id, $title, $slug, $status;

    public $brand;
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
        $this->id  = '';
        $this->title  = '';
        $this->slug  = '';
        $this->status  = '';
    }
    public function render()
    {
        $banners=Banner::orderBy('id','DESC')->paginate(5);
        return view('livewire.backend.list-banner', [
            'banners' => Banner::paginate(5),
        ]) ->layout('components.backend.master');
    }
   
     public function create()
    {
        $this->resetInputs();

        $this->editModel = false;
        // $this->isOpen = true;
        $this->addEditModal = true;
    }

    public function edit(Banner $banner)
    {
        $this->id  = $banner->id;
        $this->title  = $banner->title;
        $this->slug  = $banner->slug;
        $this->status  = $banner->status;
        $this->editModel = true;
        // $this->isOpen = true;
        $this->addEditModal = true;
    }
    public function delete(Banner $banner)
    {
        $this->id  = $banner->id;
        $this->title  = $banner->title;
        $this->slug  = $banner->slug;
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

    public function store() {

        $validated = $this->validate([ 
            'title'=> 'required',
            'slug'=> 'required',
            'status'=> 'required'
        ]);
        
        Banner::create($validated);
        session()->flash('message', 'Banner Added Successfully....');
        $this->resetInputs();
        $this->addEditModal = false;
        // $this->dispatchBrowserEvent("HideModelAddNewBrands");  
    }
    public function update(){
        $validated = $this->validate([ 
            'title'=> 'required',
            'slug'=> 'required',
            'status'=> 'required'
        ]);
               
        $validatedData = $this->validate();
        Banner::where('id', $this->id)->update([
            'title'=> $validatedData['title'],
            'slug'=> $validatedData['slug']
        ]);
     
        session()->flash('message', 'Banner Edited Successfully....');
        $this->resetInputs();
        $this->addEditModal = false;
        // $this->dispatchBrowserEvent("HideModelAddNewBrands");  
        
    }
   
    public function destroy(){
        Banner::where('id', $this->id)->delete();
     
        session()->flash('message', 'Banner Deleted Successfully....');
        // $this->dispatchBrowserEvent("HideModelDeleteBrands");  
        $this->deleteModal = false;
        
    }

}
