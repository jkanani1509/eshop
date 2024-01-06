<div class="right-bar">
    <div class="sinlge-bar shopping">
        <a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::getCartCount()}}</span></a>
        <!-- Shopping Item -->
        @auth
            <div class="shopping-item">
                <div class="dropdown-cart-header">
                    <span>CART Items</span>
                    <a href="{{  route('cartlist') }}" wire:navigate>View Cart</a>
                </div>
                <ul class="shopping-list">
                    @foreach(Helper::getAllProductFromCart() as $data)
                    @php
                        $photo=explode(',',$data->product['photo']);
                    @endphp
                    <li>
                        {{-- <a wire:click="removeWishlist('3', {{$data->product['id'] }}) " href="" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a> --}}
                        <a wire:click="removeCart({{$data->product['id']}})" title="Remove From Wishlist"  class="buy"><i class="fa fa-remove " ></i></a>

                        <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                        <h4><a href="#" target="_blank">{{$data->product['title']}}</a></h4>
                        <p class="quantity">{{$data->quantity}} x - <span class="amount">${{number_format($data->price,2)}}</span></p>
                    </li>
            @endforeach
                </ul>
                <div class="bottom">
                    <div class="total">
                        <span>Total</span>
                        <span class="total-amount">{{number_format(Helper::totalCartPrice(),2)}}</span>
                    </div>
                    <a href="{{  route('checkout') }}" wire:navigate  class="btn animate">CHECK OUT</a>
                </div>
            </div>
        @endauth
        <!--/ End Shopping Item -->
    </div>
</div>