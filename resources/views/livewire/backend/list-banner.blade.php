<div>
    <x-slot name="title">
        ECOM || BANNERS
    </x-slot>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" wire:navigate>Dashboard</a></li>
                        <li class="breadcrumb-item active">Banners</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="d-flex">
        <button wire:click="create" class="btn btn-primary ml-auto mr-2"><i class="fa fa-plus-circle mr-1"></i> Add New
            Brand</button>
        {{-- <button wire:click="addNewBrand" class="btn btn-primary ml-auto mr-2"><i class="fa fa-plus-circle mr-1"></i> Add New Brand --}}
        </button>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Session::has('fail'))
        <div class="alert alert-danger"> {{ Session::get('fail') }}</div>
    @endif
    @if (count($records) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slig</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>

                        <td> {{ $record->id }}</td>
                        <td>{{ $record->title }}</td>
                        <td>{{ $record->slug }}</td>
                        <td>
                            @if ($record->photo)
                                {{-- <img src="{{$category->photo}}" class="img-fluid" style="max-width:80px" alt="{{$category->photo}}"> --}}
                                <img src="{{ asset('upload/banners/' . $record->photo) }}" class="img-fluid"  style="max-width:80px" alt="avatar.png">
                            @else
                                <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                    style="max-width:80px" alt="avatar.png">
                            @endif
                        </td>
                        <td>
                            @if ($record->status == 'active')
                                <i class="fa fa-check-circle"> </i>
                            @else
                                <i class="fa fa-times fa-red"> </i>
                            @endif
                        </td>
                        <td>
                            
                            <a href="" wire:click.prevent="edit({{ $record }}, 'N')">
                                <i class="fa fa-edit text-success mr-2"></i>
                            </a>
                            <a href="" wire:click.prevent="delete({{ $record }})">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                    </tr>
                @endforeach


            </tbody>
        </table>
        <div class="d-flex mt-2 mr-5" style="float: right;">
            {{ $records->links() }}
        </div>
    @endif

    @if ($addEditModal)
        <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-bg-dark">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            @if ($editModel)
                                <span>Edit Banner</span>
                            @else
                                <span>Add New Banner</span>
                            @endif
                        </h5>
                        <svg wire:click="closeModal" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $editModel ? 'update()' : 'store()' }}"
                            enctype="multipart/form-data" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                {{ $id }}
                                <input type="text" wire:model.lazy="title" class="form-control" id="name"
                                    aria-describedby="nameHelp" placeholder="Enter Brand Name" autofocus>
                                @error('title')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" wire:model.lazy="slug" class="form-control" id="slug"
                                    aria-describedby="slugHelp" placeholder="Enter Brand Slug">
                                @error('slug')
                                    <span class="error text-red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="photo">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="photo"
                                            wire:model.lazy="photo">
                                        <label class="custom-file-label" for="photo">Choose file</label>
                                    </div>
                                    {{-- <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                @if ($editModel)
                                <div class="div row">
                                    <div class="col-md-6">
                                        OLD IMAGE
                                    </div>
                                    <div class="col-md-6">
                                        NEW IMAGE
                                    </div>
                                </div>
                                <div class="div row">
                                    <div class="col-md-6">
                                        
                                        @if ($editModel && $oldphoto)
                                        <img src="{{ asset('upload/banners/' . $oldphoto) }}" class="img-fluid"  style="max-width:80px" alt="avatar.png">
                                            {{-- <img src="{{ asset('upload/banners/' . $oldphoto) }}" alt="" width="100"> --}}
                                        @else
                                            No Image
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if ($photo)
                                            <img src="{{ $photo->temporaryUrl() }}" alt="" class="img-fluid"  style="max-width:80px" >
                                        @endif
                                    </div>
                                </div>
                                <div class="div row">
                                    <div class="col-md-6">
                                        @if ($oldphoto)
                                            <a href="" wire:click.prevent="edit({{ $record }}, 'Y', {{ $id }})"> Delete Image </a>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        
                                    </div>
                                </div>
                                
                                @else

                                <div class="form-group">
                                    @if ($photo)
                                        <img src="{{ $photo->temporaryUrl() }}" alt="" class="img-fluid"  style="max-width:80px" >
                                    @endif
                                </div>
                                @endif
                            </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    <select wire:model.defer="status"
                                        class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                        tabindex="-1" aria-hidden="true">
                                        <option value="active" selected="selected">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="d-felx ml-auto ">
                                    <button wire:click="closeModal" type="button" class="btn btn-secondary"
                                        data-dismiss="modal">
                                        <i class="fa fa-times mr-1"></i> Close</button>

                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                                        @if ($editModel)
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
        <div class="modal-backdrop fade show"></div>
    @endif
    <!-- Add Brand Modal -->

    @if ($deleteModal)
        <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-800" id="exampleModalLabel">
                            <span>Delete Banner : </span>
                        </h5>
                        <button type="button" class="close" wire:click="closeModal" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="destroy()">
                            <h5>Are you Sure, You want to delete Banner : {{ $title }} ? </h5>
                            <div class="d-felx ml-auto ">
                                <button wire:click="closeModal" type="button" class="btn btn-secondary"
                                    data-dismiss="modal">
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
    @endif
</div>
