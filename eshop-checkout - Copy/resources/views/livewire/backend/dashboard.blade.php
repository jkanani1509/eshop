<div>
    <x-slot name="title">
        ESHOP || ADMIN-DASHBOARD
    </x-slot>

    <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-12">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                      {{-- <li class="breadcrumb-item active">Starter Page</li> --}}
                  </ol>
              </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
  
    <div class="row">

        <!-- Category -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Category</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Category::countActiveCategory()}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Products -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Products</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Product::countActiveProduct()}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-cubes fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Order -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Order</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\Models\Order::countActiveOrder()}}</div>
                    </div>
                    
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!--Posts-->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Post</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Post::countActivePost()}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-folder fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
