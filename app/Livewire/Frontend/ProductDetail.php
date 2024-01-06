<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;

class ProductDetail extends Component
{
    public function render($slug)
    {
        $product_detail= Product::where('slug',$slug)->first();
        // dd($product_detail);
        return view('livewire.frontend.product-detail')
        ->with('product_detail',$product_detail)
        ->layout('components.master');
    }
    public function productDetail($slug){
        $product_detail= Product::where('slug',$slug)->first();
        // dd($product_detail);
        return view('livewire.frontend.product-detail')
        ->with('product_detail',$product_detail)
        ->layout('components.master');
    }
}
