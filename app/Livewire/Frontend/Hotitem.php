<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use DB;
use App\Models\Product;
use Illuminate\Http\Request;

class Hotitem extends Component
{
       public function render()
    {
        $products=Product::where('status','active')->orderBy('id','DESC')->limit(8)->get();
        return view('livewire.frontend.hotitem')
        ->with('product_lists',$products);
    }
}
