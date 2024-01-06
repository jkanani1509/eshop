<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\coupon;

class Cartdetail extends Component
{

    public $coupencode, $cartqty=1;

    public $DiscountAmount=0;
  
    public function deleteWishlist(Request $request, $uid, $pid){
   
        $this->dispatch('remove-wishlist', $uid, $pid); 
        // $this->dispatch('removeWishlist')->to(Whishlistcount::class);
     
        
    }
    public function render()
    {
        
        return view('livewire.frontend.cartdetail')
        ->layout('components.master');
    }

    public function incrementQty(int $id){
        $cartData = Cart::where('user_id',auth()->user()->id)->where('id',$id)->where('order_id',null)->first();
        if($cartData){

            $cartData->increment('quantity');
            $cartData->amount = $cartData->quantity * $cartData->price;
            $cartData->save();
        }
    }
    public function decrementQty(int $id){
        $cartData = Cart::where('user_id',auth()->user()->id)->where('id',$id)->where('order_id',null)->first();
        // dd($cartData->quantity);
        if($cartData && $cartData->quantity > 1){

            $cartData->decrement('quantity');
            $cartData->amount = $cartData->quantity * $cartData->price;
            $cartData->save();
      
        } else {
            dump("ABABABAB");
        }
    }
    public function coupenDiscount(){
        if($this->coupencode){
            $coupon=Coupon::where('code',$this->coupencode)->where('status', 'active')->first();
            // dump($coupon->type);
            if($coupon->type=="fixed"){
                $this->DiscountAmount = $coupon->value;
                
            }
            elseif($coupon->type=="percent"){
                $this->DiscountAmount = ($coupon->value /100);
            }
            else{
                $this->DiscountAmount = 0;
            }

        } else {
            $this->DiscountAmount = 0;
        }
        session()->put('coupon',[
            'id'=>$coupon->id,
            'code'=>$coupon->code,
            'value'=>$this->DiscountAmount
        ]);
}
   
}
