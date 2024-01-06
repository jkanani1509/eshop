<div>
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
   {{-- <a href="{{  route('wishlist') }}"  wire:navigate  class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">{{ $wishlistCount }}</span></a> --}}
   <a href="#"   class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">{{ $wishlistCount }}</span></a>
</div>
    <!-- wishlist Item -->
<div class="sinlge-bar shopping">
    @auth
        <div class="shopping-item">
            <div class="dropdown-cart-header">
                <span>9 Items</span>
                <a href="#">View Wishlist</a>
            </div>
            
            <div class="bottom">
                <div class="total">
                    <span>Total</span>
                    <span class="total-amount">$4</span>
                </div>
                <a href="" class="btn animate">Cart</a>
            </div>
        </div>
    @endauth
<div>
</div>