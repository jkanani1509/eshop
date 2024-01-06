
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <hr class="sidebar-divider">
    <li class="breadcrumb-item" ><a class="sidebarMenuLink" href="{{route('admin.dashboard')}}" wire:navigate style="padding-left: 10px"></a></li>
    
    <li class="breadcrumb-item" >
      <i class="fas fa-table" style="color:#FFF; padding-right:10px; padding-top:5px"></i>
      <a href="{{route('admin.dashboard')}}" wire:navigate style="color:#FFF; padding-right:5px; padding-top:3px">DashBoard</a>
    </li>
    <hr class="sidebar-divider">
    <li class="breadcrumb-item" ><a class="sidebarMenuLink" href="{{route('admin.dashboard')}}" wire:navigate style="padding-left: 10px"></a></li>
    

    <li class="breadcrumb-item" >
      <i class="fas fa-table" style="color:#CCC; padding-right:10px; padding-top:5px"></i>
      <a href="{{route('admin.brand')}}" wire:navigate style="color:#CCC; padding-right:5px; padding-top:3px">Brands</a>
    </li>
    <hr class="sidebar-divider">
    <li class="breadcrumb-item" ><a class="sidebarMenuLink" href="{{route('admin.dashboard')}}" wire:navigate style="padding-left: 10px"></a></li>
    

    <li class="breadcrumb-item" >
      <i class="fas fa-table" style="color:#FFF; padding-right:10px; padding-top:5px"></i>
      <a href="{{route('admin.banners')}}" wire:navigate style="color:#FFF; padding-right:5px; padding-top:3px">Banners</a>
    </li>
    <hr class="sidebar-divider">
    <li class="breadcrumb-item" ><a class="sidebarMenuLink" href="{{route('admin.dashboard')}}" wire:navigate style="padding-left: 10px"></a></li>
    

    <li class="breadcrumb-item" >
      <i class="fas fa-table" style="color:#FFF; padding-right:10px; padding-top:5px"></i>
      <a href="{{route('admin.category')}}" wire:navigate style="color:#FFF; padding-right:5px; padding-top:3px">Category</a>
    </li>
    <hr class="sidebar-divider">
    <li class="breadcrumb-item" ><a class="sidebarMenuLink" href="{{route('admin.dashboard')}}" wire:navigate style="padding-left: 10px"></a></li>
    

    
    <li class="breadcrumb-item" >
      <i class="fas fa-table" style="color:#FFF; padding-right:10px; padding-top:5px"></i>
      <a href="{{route('admin.product')}}" wire:navigate style="color:#FFF; padding-right:5px; padding-top:3px">Products</a>
    </li>
    <hr class="sidebar-divider">
    <li class="breadcrumb-item" ><a class="sidebarMenuLink" href="{{route('admin.dashboard')}}" wire:navigate style="padding-left: 10px"></a></li>
    

    
    <li class="breadcrumb-item" >
      <i class="fas fa-table" style="color:#FFF; padding-right:10px; padding-top:5px"></i>
      <a href="{{route('admin.brand')}}" wire:navigate style="color:#FFF; padding-right:5px; padding-top:3px">Orders</a>
    </li>
    <hr class="sidebar-divider">
    <li class="breadcrumb-item" ><a class="sidebarMenuLink" href="{{route('admin.dashboard')}}" wire:navigate style="padding-left: 10px"></a></li>
    

    

    <li class="nav-item {{ request()->is('brands') ? 'active' : ''}}">
      <a href="{{  route('admin.brand') }}" wire.navigate >
        <i class="fas fa-table"></i>
        Brands</a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    
    <!-- Divider -->
    <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Shop
        </div>

    <!-- Categories -->
    <li class="nav-item">
          <i class="fas fa-sitemap"></i>
          <span><a class="nav-link collapsed" href="{{  route('admin.brand') }}" wire.navigate>Category00</span>
        </a>
        
    </li>
    {{-- Products --}}
    

    {{-- Brands --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brandCollapse" aria-expanded="true" aria-controls="brandCollapse">
          <i class="fas fa-table"></i>
          <span>Brands</span>
        </a>
        <div id="brandCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Brand Options:</h6>
            <a class="collapse-item" href="{{  route('admin.brand') }}" wire.navigate>Brands</a>
            <a class="collapse-item" href="">Add Brand</a>
          </div>
        </div>
    </li>

    {{-- Shipping --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shippingCollapse" aria-expanded="true" aria-controls="shippingCollapse">
          <i class="fas fa-truck"></i>
          <span>Shipping</span>
        </a>
        <div id="shippingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Shipping Options:</h6>
            <a class="collapse-item" href="">Shipping</a>
            <a class="collapse-item" href="">Add Shipping</a>
          </div>
        </div>
    </li>

    <!--Orders -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>Orders</span>
        </a>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-comments"></i>
            <span>Reviews</span></a>
    </li>
    

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Posts
    </div>

    <!-- Posts -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse" aria-expanded="true" aria-controls="postCollapse">
        <i class="fas fa-fw fa-folder"></i>
        <span>Posts</span>
      </a>
      <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Post Options:</h6>
          <a class="collapse-item" href="">Posts</a>
          <a class="collapse-item" href="">Add Post</a>
        </div>
      </div>
    </li>

     <!-- Category -->
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" >
          <i class="fas fa-sitemap fa-folder"></i>
          <span>Category11</span>
        </a>
        
      </li>

      <!-- Tags -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tagCollapse" aria-expanded="true" aria-controls="tagCollapse">
            <i class="fas fa-tags fa-folder"></i>
            <span>Tags</span>
        </a>
        <div id="tagCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tag Options:</h6>
            <a class="collapse-item" href="">Tag</a>
            <a class="collapse-item" href="">Add Tag</a>
            </div>
        </div>
    </li>

      <!-- Comments -->
      <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-comments fa-chart-area"></i>
            <span>Comments</span>
        </a>
      </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
     <!-- Heading -->
    <div class="sidebar-heading">
        General Settings
    </div>
    <li class="nav-item">
      <a class="nav-link" href="">
          <i class="fas fa-table"></i>
          <span>Coupon</span></a>
    </li>
     <!-- Users -->
     <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-users"></i>
            <span>Users</span></a>
    </li>
     <!-- General settings -->
     <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-cog"></i>
            <span>Settings</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>