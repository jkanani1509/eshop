<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use DB;
use Illuminate\Http\Request;
use App\Models\Product;

class Latestitem extends Component
{
    public function wishlist(Request $request, $pid){

        $this->dispatch('add-wishlist',$pid); 
        // return view('livewire.frontend.home')
        // ->layout('components.master');

    }
    public function deleteCartlist(Request $request, $pid){
    
        $this->dispatch('remove-cart', $pid); 
 
    }
    public function cartlist(Request $request, $pid){

        $this->dispatch('add-cart',$pid); 
        // return view('livewire.frontend.home')
        // ->layout('components.master');

    }
    public function deleteWishlist(Request $request, $pid){

        $this->dispatch('remove-wishlist', $pid); 
    }
    public function render()
    {
        $product_lists=DB::table('products')->where('status','active')->orderBy('id','DESC')->limit(6)->get();
                    
        return view('livewire.frontend.latestitem')
        ->with('product_lists',$product_lists );
    }
}
