<?php
use App\Models\Message;
use App\Models\Category;
use App\Models\Product;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Shipping;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


// use Auth;
class Helper{
   
    public static function getAllCategory(){
        $category=new Category();
        $menu=$category->getAllParentWithChild();
        return $menu;
    } 
    
    public static function getHeaderCategory(){
        $category = new Category();
        // dd($category);
        $menu=$category->getAllParentWithChild();

        if($menu){
            ?>
            
            <li>
            <a href="javascript:void(0);">Category<i class="ti-angle-down"></i></a>
                <ul class="dropdown border-0 shadow">
                <?php
                    foreach($menu as $cat_info){
                        if($cat_info->child_cat->count()>0){
                            ?>
                             <li><a href="#" wire:navigate><?php echo $cat_info->title; ?></a>
                                <ul class="dropdown sub-dropdown border-0 shadow">
                                    <?php
                                    foreach($cat_info->child_cat as $sub_menu){
                                        ?>
                                          <li><a href="#" wire:navigate><font style="color:#555"><?php echo $sub_menu->title; ?> </font></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        else{
                            ?>
                                <li><a href="#" wire:click="productCat({{ $cat_info->slug }})"><?php echo $cat_info->title; ?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </li>
        <?php
        }
    }
    // Wishlist Functions
    public static function getwishlistCount($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            // dump("KKKK");
            // dd(auth()->user()->id);
            return Wishlist::where('user_id',$user_id)->where('cart_id',null)->count();
        }
        else{
            return 0;
        }
    }
    public static function is_whishlist($pid, $user_id=''){
        
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Wishlist::where('user_id',$user_id)->where('product_id',$pid)->first('id');
        }
        else{
            return 0;
        }
    }
    
    public static function getAllProductFromWishlist($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Wishlist::with('product')->where('user_id',$user_id)->where('cart_id',null)->get();
        }
        else{
            return 0;
        }
    }
    
    public static function totalWishlistPrice($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Wishlist::where('user_id',$user_id)->where('cart_id',null)->sum('amount');
        }
        else{
            return 0;
        }
    }
    // Cart Functions
    public static function getCartCount($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            // dump("KKKK");
            // dd(auth()->user()->id);
            return Cart::where('user_id',$user_id)->count();
        }
        else{
            return 0;
        }
    }
   
    public static function getAllProductFromCart($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Cart::with('product')->where('user_id',$user_id)->where('order_id',null)->get();
        }
        else{
            return 0;
        }
    }
    // Total amount cart
    public static function is_cart($pid, $user_id=''){
        
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return cart::where('user_id',$user_id)->where('product_id',$pid)->where('order_id',null)->first('id');
        }
        else{
            return 0;
        }
    }
    public static function totalCartPrice($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Cart::where('user_id',$user_id)->where('order_id',null)->sum('amount');
        }
        else{
            return 0;
        }
    }
    // Order Shipping
    public static function shipping(){
        return Shipping::orderBy('id','DESC')->get();
    }
    // Coupen
    

    
    
}

?>