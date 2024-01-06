<?php

namespace App\Livewire\Frontend;


use Livewire\Component;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Livewire\Attributes\On; 
use App\Models\Product;
use DB;
use Illuminate\Support\Facades\Auth;

class Cartcount extends Component
{


    #[on('add-cart')]
    public function addToCart($pid){

        // check if item is available or not in Cart
        $isAvailable =DB::table('Carts')->where('user_id',auth()->user()->id)->where('product_id',$pid)->where('order_id',null)->count();
        // dump($isAvailable);
        
        if($isAvailable == '0' ){
            $product=DB::table('products')->where('id',$pid)->where('status','active')->orderBy('id','DESC')->get();
            $aa=$product->toArray();
        
            // dd($product[0]->title);
            $Cart = new Cart();

            $Cart->product_id = $product[0]->id;
            $Cart->user_id = auth()->user()->id;
            $Cart->price = $product[0]->price;
            $Cart->quantity = '1';
            $Cart->amount = $product[0]->price;
        
            $Cart->save();
            // dd(' Not Wishlist Exists.....');
        } 
        else {
            // dd(' Wishlist Exists.....');
           
            
        }
        // $products=Product::where('status','active')->orderBy('id','DESC')->limit(8)->get();
        // $this->dispatch('refresh-wishlist', $product); 
    }

    #[on('remove-cart')]
    public function removeCart($pid)
    {
        $isAvailable =DB::table('Carts')->where('user_id',auth()->user()->id)->where('product_id',$pid)->where('order_id',null)->count();

        if($isAvailable != '0' ){
            $Cart=DB::table('Carts')->where('user_id',auth()->user()->id)->where('product_id',$pid)->where('order_id',null)->get('id')->toArray();
            // dump($wishlistid[0]->id);
            $status=Cart::find($Cart[0]->id)->delete();
        } 
         
    }
    public function render()
    {
        return view('livewire.frontend.cartcount');
    }
}
