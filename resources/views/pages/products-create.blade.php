@extends('layouts.main')

@section('title') TVIP - Create Product @endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/select.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/select.min.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Create Product</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="img-fluid product-photo" id="imageResult" src="{{ asset('img/products/'.Auth::user()->photo) }}" alt="photo" onerror="this.onerror=null;this.src='{{ asset('img/products/placeholder.jpg') }}';">
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-2">
                                <div class="custom-file" id="customFile">
                                    <input type="file" class="custom-file-input" id="upload" aria-describedby="photoAddon" name="photo">
                                    <label class="custom-file-label" id="upload-label">Change Photo</label>
                                </div>
                            </div>
                            @error('photo')
                            <span class="text-danger text-sm">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <select id="brand" class="form-control form-control-sm select @error('brand') is-invalid @enderror" name="brand">
                                        <option></option>
                                        <option value="Aqua">Aqua</option>
                                        <option value="Vit">Vit</option>
                                        <option value="Mizone">Mizone</option>
                                        <option value="Levite">Levite</option>
                                    </select>
                                    @error('brand')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="variant">Variant</label>
                                    <input id="variant" type="text" class="form-control form-control-sm @error('variant') is-invalid @enderror" placeholder="150ml" name="variant">
                                    @error('variant')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group text-right mb-0">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Create</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
