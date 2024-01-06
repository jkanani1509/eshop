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

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $bid, $title, $slug, $status, $brand_id;

    public $brand, $data;
    public $addBrandModel = false;
    public $editModel = false;

    public function render()
    {
        $brand=Brand::orderBy('id','DESC')->paginate(5);
        return view('livewire.backend.list-brand', [
            'brands' => Brand::paginate(5),
        ]) ->layout('components.backend.master');
    }
    public function addNewBrand(){
        // dd("ABABABAB");
        $this->editModel = false;
        $this->title = '';
        $this->slug = '';
        $this->addBrandModel = true;
        dump("AHAHAHA");
     }
     public function create()
    {
        $this->isOpen = true;
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }
}
