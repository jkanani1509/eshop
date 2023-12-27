<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings=DB::table('settings')->get();
                                
                            @endphp
                            <li><i class="ti-headphone-alt"></i>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
                            <li><i class="ti-email"></i> @foreach($settings as $data) {{$data->email}} @endforeach</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                        <li><i class="ti-location-pin"></i> <a href="#">Track Order</a></li>
                            {{-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> --}}
                            @auth 
                                @if(Auth::user()->role=='admin')
                                    <li><i class="ti-user"></i> <a href="#"  target="_blank">Dashboard</a></li>
                                @else 
                                    <li><i class="ti-user"></i> <a href="#"  target="_blank">Dashboard</a></li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{ route('logout') }}" wire:navigate>Logout</a></li>

                            @else
                                <li><i class="ti-power-off"></i><a href="{{ route('login') }}" wire:navigate>Login /</a> <a href="{{ route('register') }} " wire:navigate>Register</a></li>
                            @endauth
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        @php
                            $setting=DB::table('settings')->get();
                        @endphp                    
                        <a href="{{  route('Home') }}" wire:navigate><img src="@foreach($setting as $data) {{$data->logo}} @endforeach" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-7 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option >All Category</option>
                                @foreach(Helper::getAllCategory() as $cat)
                                    <option>{{$cat->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-12">
                        @livewire('frontend.whishlistcount')
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    @livewire('frontend.cartcount')
                </div>
            
            </div>
        </div>
    </div>
   <!-- Header Inner -->
   <div class="header-inner">
    <div class="container">
        <div class="cat-nav-head">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="menu-area">
                        <!-- Main Menu -->
                        <nav class="navbar navbar-expand-lg">
                            <div class="navbar-collapse">	
                                <div class="nav-inner">	
                                    <ul class="nav main-menu menu navbar-nav">
                                        <li class="#"><a href="{{route('Home')}}" wire:navigate>Home</a></li>
                                        <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{  route('aboutus') }}"  wire:navigate>About Us</a></li>
                                        <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="#">Products</a><span class="new">New</span></li>												
                                            {{Helper::getHeaderCategory()}}
                                        <li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('blog')}}" wire:navigate>Blog</a></li>									
                                           
                                        <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contactus')}}" wire:navigate>Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <!--/ End Main Menu -->	
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Header Inner -->
</header>