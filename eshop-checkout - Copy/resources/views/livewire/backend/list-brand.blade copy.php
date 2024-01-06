<div>
    <x-slot name="title">
        ECOM || BRANDS
    </x-slot>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ 'dashboard' }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Brands</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="d-flex">
        <button wire:click.prevent="addNewBrand" class="btn btn-primary ml-auto mr-2"><i
                class="fa fa-plus-circle mr-1"></i> Add New Brand
        </button>
    </div>
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    
@endif
@if(Session::has('fail'))
    <div class="alert alert-danger"> {{ Session::get('fail')}}</div>
@endif
    @if (count($brands) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slig</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        
                        <td>    {{ $brand->id }}</td>
                        <td>{{ $brand->title }}</td>
                        <td>{{ $brand->slug }}</td>
                        <td>
                            @if($brand->status == 'active' )
                                <i class="fa fa-check-circle"> </i>
                            @else
                                <i class="fa fa-times fa-red"> </i>
                            @endif
                        </td>
                        <td> 
                            <a href="" wire:click.prevent="editBrands({{ $brand }})">
                                <i class="fa fa-edit text-success mr-2"></i>
                            </a> 
                            <a href="" wire:click.prevent="deleteBrands({{ $brand }})">
                                <i class="fa fa-trash text-danger"></i>
                            </a> 
                    </tr>
                @endforeach


            </tbody>
        </table>
        <div class="d-flex mt-2 mr-5" style="float: right;">
            {{ $brands->links() }}
        </div>
    @endif

       <!-- Delet Brand Modal -->
    <div class="modal fade" id="ModelAddNewBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-800" id="exampleModalLabel">
                        @if($editModel)
                            <span>Edit Brand</span> 
                        @else
                            <span>Add New Brand</span> 
                        @endif
                    
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $editModel ? 'updateBrands()' : 'createBrands()' }}">
                            {{-- @csrf --}}
                        
                        {{-- <div class="form-group">
                            <input type="txt" class="form-control" id="id"  aria-describedby="nameHelp" placeholder="Enter Brand Name">
                        </div>     --}}
                        <div class="form-group"> 
                            <label for="exampleInputEmail1">Name1</label>
                            <input type="text" wire:model.lazy="title" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter Brand Name" autofocus>
                            @error('title') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" wire:model.lazy="slug" class="form-control" id="slug" aria-describedby="slugHelp" placeholder="Enter Brand Slug">
                            @error('slug') <span class="error text-red">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select wire:model.defer="status" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="active" selected="selected">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <span class="text-danger">@error('status') {{$message}} @enderror</span>
                        </div>

                        <div class="d-felx ml-auto ">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> 
                                <i class="fa fa-times mr-1"></i> Close</button>
                               
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> 
                                @if($editModel)
                                    <span>Save Change</span> 
                                @else
                                    <span>Save</span> 
                                @endif
                            </button>
                        </div>
                      </form>
                    
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModelDeleteBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-800" id="exampleModalLabel">
                        <span>Delete Brand : </span> 
                    </h5>
                    <button type="button" class="close" wire:click="closeModel()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               
                <div class="modal-body">
                    <form wire:submit.prevent="destroyBrands()">
                            {{-- @csrf --}}
                        
                        {{-- <div class="form-group">
                            <input type="txt" class="form-control" id="id"  aria-describedby="nameHelp" placeholder="Enter Brand Name">
                        </div>     --}}
                        <h5>Are you Sure, You want to delete Brand : {{ $title }}  ? </h5>
                            {{-- <div class="form-group"> 
                                <h4>Title : </h4> {{ $title }}
                            </div> --}}
                        

                        <div class="d-felx ml-auto ">
                            <button type="button" wire:click="closeModel()" class="btn btn-secondary" data-dismiss="modal"> 
                                <i class="fa fa-times mr-1"></i> Close</button>
                               
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> 
                                <span>Yes! Delete</span> 
                            </button>
                        </div>
                      </form>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
