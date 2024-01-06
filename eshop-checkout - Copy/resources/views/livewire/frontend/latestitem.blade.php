<div>
    <!-- Start Shop Home List  -->
<section class="shop-home-list section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>Latest Items</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                   @foreach($product_lists as $product)
                        <div class="col-md-4">
                            <!-- Start Single List  -->
                            <div class="single-list">
                                <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="list-image overlay">
                                        @php
                                            $photo=explode(',',$product->photo);
                                            // dd($photo);
                                        @endphp
                                        <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                         {{-- {{ Helper::is_whishlist('3', $product->id) }}
                                         {{  $product->id }} --}}
                                         <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                @php 
                                                $aa = Helper::is_whishlist($product->id);
                                                @endphp
                                                @if($aa && $aa->id > 0)
                                                {{-- <a wire:click="deleteWishlist() "title="Remove From Wishlist"  class="buy"><i class="fa fa-heart " ></i><span>Remove From Wishlist</span></a> --}}
                                                    <a wire:click="deleteWishlist({{$product->id }})" title="Remove From Wishlist"  class="buy"><i class="fa fa-heart " ></i><span>Remove</span></a>
                                                @else
                                                    <a wire:click="wishlist({{ $product->id }})" title="Add to Wishlist"  class="buy"><i class="fa fa-heart-o "></i><span>Add</span></a>
                                                @endif
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                @php 
                                                $aa = Helper::is_cart($product->id);
                                                @endphp
                                                @if($aa && $aa->id > 0)
                                                {{-- <a wire:click="deleteWishlist() "title="Remove From Wishlist"  class="buy"><i class="fa fa-heart " ></i><span>Remove From Wishlist</span></a> --}}
                                                    <a wire:click="deleteCartlist({{$product->id }})" title="Remove From Wishlist"  class="buy"><i class="fa fa-cart-plus fa-2x" aria-hidden="true"></i><span></span></a>
                                                @else
                                                    <a wire:click="cartlist({{ $product->id }})" title="Add to Wishlist"  class="buy"><i class="fa fa-cart-plus fa-2x" aria-hidden="true"></i><span></span></a>
                                                @endif
                                            </div>
                                         </div>
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 no-padding">
                                    <div class="content">
                                        <h4 class="title"><a href="#">{{$product->title}}</a></h4>
                                        <p class="price with-discount">INR {{number_format($product->price,2)}}</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- End Single List  -->
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Home List  -->
</div>
