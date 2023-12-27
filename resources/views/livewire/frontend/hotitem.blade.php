<div>
    <!-- Start Most Popular -->
<div class="product-area most-popular section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Hot Item</h2>
                </div>
                <div class="owl-carousel popular-slider">
                    
                    @foreach($product_lists as $product)
                        @if($product->condition=='hot')
                            <!-- Start Single Product -->
                        <div class="single-product">
                            <div class="product-img">     
                               
                                {{-- <a href="<?php// echo  route('product-detail', $product->slug) ?>" class="btn btn-info delete-header m-1 btn-sm"  title="Show User"><i class="fas fa-eye" small></i>AAA</a> --}}
                                <a wire:click="showProdyctDetail({{ $product }})">
                                    @php
                                        $photo=explode(',',$product->photo);
                                    // dd($photo);
                                    @endphp
                                    <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                    <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                    <span class="out-of-stock">Hot</span>
                                </a>
                                <div class="button-head">
                                    <div class="product-action">
                                       

                                        <a data-toggle="modal" data-target="{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                        
                                        {{-- <a wire:click="dispatchTo( 'Whishlistcount', 'testWishList')" title="Wishlist"><i class=" ti-heart "></i><span>Add to WishlistAAA</span></a> --}}
                                        {{-- <button wire:click="$dispatchTo('Whishlistcount', 'show_detail', { id: {{ $product->id }} })">WishList</button>  --}}
                                    </div>
                                    <div class="product-action-2">
                                        <a href="">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="">{{$product->title}}</a></h3>
                                <div class="product-price">
                                    <span class="old">${{number_format($product->price,2)}}</span>
                                    @php
                                    $after_discount=($product->price-($product->price*$product->discount)/100)
                                    @endphp
                                    <span>${{number_format($after_discount,2)}}</span>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product -->
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        AAAAA

               

        BBBBB
    </div>
</div>
<!-- End Most Popular Area -->
</div>
