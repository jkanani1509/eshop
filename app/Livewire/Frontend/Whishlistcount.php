<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Livewire\Attributes\On; 
use App\Models\Product;
use DB;
use Illuminate\Support\Facades\Auth;



class Whishlistcount extends Component
{
    public $wishlistCount;

    #[on('add-wishlist')]
    public function addToWishlist($pid){

        // check if wishlist is available or not
        $isAvailable =DB::table('wishlists')->where('user_id',auth()->user()->id)->where('product_id',$pid)->count();
        // dump($isAvailable);
        
        if($isAvailable == '0' ){
            $product=DB::table('products')->where('id',$pid)->where('status','active')->orderBy('id','DESC')->get();
            $aa=$product->toArray();
        
            // dd($product[0]->title);
            $Wishlist = new Wishlist;

            $Wishlist->product_id = $product[0]->id;
            $Wishlist->user_id = auth()->user()->id;
            $Wishlist->price = $product[0]->price;
            $Wishlist->quantity = '1';
            $Wishlist->amount = $product[0]->price;
        
            $Wishlist->save();
            // dd(' Not Wishlist Exists.....');
        } 
        else {
            // dd(' Wishlist Exists.....');
           
            
        }
        // $products=Product::where('status','active')->orderBy('id','DESC')->limit(8)->get();
        // $this->dispatch('refresh-wishlist', $product); 
    }

    #[on('remove-wishlist')]
    public function removeWishlist($pid)
    {
    
       $isAvailable =DB::table('wishlists')->where('user_id',auth()->user()->id)->where('product_id',$pid)->count();

       $isAvailable =DB::table('wishlists')->where('user_id',auth()->user()->id)->where('product_id',$pid)->count();
        // dump($isAvailable);
        
        if($isAvailable != '0' ){
            $wishlistid=DB::table('wishlists')->where('user_id',auth()->user()->id)->where('product_id',$pid)->get('id')->toArray();
            // dump($wishlistid[0]->id);
            $status=Wishlist::find($wishlistid[0]->id)->delete();
          
        } 
         
    }
    
    public function showWishListDetail(){


        // $this->redirect(WishListDetail::class);

    }
     public function render()
    {
        $this->wishlistCount = Wishlist::all()->count();

        return view('livewire.frontend.whishlistcount');
    }
    
 
}
