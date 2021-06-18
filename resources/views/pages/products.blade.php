@extends('layouts.main')

@section('title') TVIP - Products @endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/bootstrap-icheck.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content pb-50">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Products</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    @can('product-create')
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-dark mx-1"><i class="fas fa-plus mr-2"></i>Create New</a>
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-dark mx-1"><i class="fas fa-plus mr-2"></i>Add Stock</a>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body text-center text-muted">
                            <h6><i class="fas fa-filter mr-2"></i>FILTER</h6>
                        </div>
                        <form method="POST" action="{{ route('products.filter') }}">
                        @csrf
                        <div class="card-body">
                            <span class="filter-title">Brand</span>
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="brand[]" id="brand-aqua" value="Aqua" @if(Route::is('products.filter')) @if (in_array("Aqua",$brand)) checked @endif @endif>
                                <label for="brand-aqua" class="filter-label">Aqua</label>
                            </div>
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="brand[]" id="brand-vit" value="Vit" @if(Route::is('products.filter')) @if (in_array("Vit",$brand)) checked @endif @endif>
                                <label for="brand-vit" class="filter-label">Vit</label>
                            </div>
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="brand[]" id="brand-mizone" value="Mizone" @if(Route::is('products.filter')) @if (in_array("Mizone",$brand)) checked @endif @endif>
                                <label for="brand-mizone" class="filter-label">Mizone</label>
                            </div>
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="brand[]" id="brand-levite" value="Levite" @if(Route::is('products.filter')) @if (in_array("Levite",$brand)) checked @endif @endif>
                                <label for="brand-levite" class="filter-label">Levite</label>
                            </div>                     
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-sm btn-block btn-primary">Apply Filter</button>
                            @if(Route::is('products.filter'))
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-block btn-light">Clear</a>
                            @endif
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-10">
                    @if(count($products) > 0)
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset('img/products/'.$product->photo) }}" class="card-img-top" alt="photo-{{$product->brand}}-{{$product->variant}}">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $product->brand }}</h5>
                                    <p class="card-text">{{ $product->variant }}</p>
                                    <button type="button" class="btn btn-sm btn-light">Stock<span class="badge @if($product->stock == 0) badge-danger @else badge-primary @endif ml-2 px-1">{{ $product->stock }}</span></button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection