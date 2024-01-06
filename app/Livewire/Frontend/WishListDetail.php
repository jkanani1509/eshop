<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use DB;
use Illuminate\Http\Request;
use App\Models\Product;

class WishListDetail extends Component
{
    public function deleteWishlist(Request $request, $uid, $pid){
   
        $this->dispatch('remove-wishlist', $uid, $pid); 
        // $this->dispatch('removeWishlist')->to(Whishlistcount::class);
     
        
    }
    public function render()
    {
        
        return view('livewire.frontend.wishlist-detail')
        ->layout('components.master');
    }
   
}
