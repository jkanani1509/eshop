<div class="right-bar">
    <div class="sinlge-bar shopping">
        @php 
            $total_prod=0;
            $total_amount=0;
        @endphp
       @if(session('wishlist'))
            @foreach(session('wishlist') as $wishlist_items)
                @php
                    $total_prod+=$wishlist_items['quantity'];
                    $total_amount+=$wishlist_items['amount'];
                @endphp
            @endforeach
       @endif
       
        <a href="#" class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">{{Helper::getwishlistCount()}}</span></a>
        <!-- Shopping Item -->
        @auth
            <div class="shopping-item">
                <div class="dropdown-cart-header">
                    <span> Items</span>
                    <a href="#">View Wishlist</a>
                </div>
                <ul class="shopping-list">
                    @foreach(Helper::getAllProductFromWishlist() as $data)
                    @php
                        $photo=explode(',',$data->product['photo']);
                    @endphp
                    <li>
                        {{-- <a wire:click="removeWishlist('3', {{$data->product['id'] }}) " href="" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a> --}}
                        <a wire:click="removeWishlist({{$data->product['id']}})" title="Remove From Wishlist"  class="buy"><i class="fa fa-remove " ></i></a>

                        <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                        <h4><a href="#" target="_blank">{{$data->product['title']}}</a></h4>
                        <p class="quantity">{{$data->quantity}} x - <span class="amount">${{number_format($data->price,2)}}</span></p>
                    </li>
            @endforeach
                </ul>
                <div class="bottom">
                    <div class="total">
                        <span>Total</span>
                        <span class="total-amount">${{number_format(Helper::totalWishlistPrice(),2)}}</span>
                    </div>
                    <a href="{{  route('wishlist') }}" wire:navigate class="btn animate">VIEW WISHLIST</a>
                </div>
            </div>
            @endauth
   
        <!--/ End Shopping Item -->
    </div>
</div>