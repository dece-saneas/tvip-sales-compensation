@extends('layouts.main')

@section('title') TVIP - Products @endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/bootstrap-icheck.min.css') }}">
@endsection

@section('modal')
@can('delete product')
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bb-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center py-0">
                <h4 class="modal-title mb-2"><strong>Are you sure?</strong></h4>
                <h6 class="modal-messages m-0">Are you really want to delete these records? This process cannot be undone.</h6>
            </div>
            <div class="modal-body text-center">
                <form method="POST" id="DeleteForm"> 
                    <button class="btn btn-sm btn-light mx-1 px-4" data-dismiss="modal" aria-label="Close">Cancel</button> 
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-sm btn-danger mx-1 px-4">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endcan
@can('create order')
<div class="modal fade" id="OrderModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <img class="card-img-top modal-photo">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"></h5>
                        <p class="card-text"></p>
                    </div>
                </div>
                <form method="POST" id="OrderForm">
                @csrf
                    <div class="input-group input-group-sm">
                        <input type="number" class="form-control quantity" value="1" min="1" name="qty">
                        <input name="product" type="text" class="form-input product d-none">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="submit"><i class="fas fa-cart-plus mr-2"></i>Add to Cart</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Produk</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content pb-50">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Daftar Produk</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    @can('create product')
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-dark mx-1"><i class="fas fa-plus mr-2"></i>Tambah Produk</a>
                    @endcan
                    @can('create supply')
                    <a href="{{ route('supplies.create') }}" class="btn btn-sm btn-outline-dark mx-1"><i class="fas fa-plus mr-2"></i>Tampah Stok</a>
                    @endcan
                    @can('view supply')
                    <a href="{{ route('supplies.index') }}" class="btn btn-sm btn-outline-dark mx-1"><i class="fas fa-history mr-2"></i>Riwayat</a>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body text-center text-muted pb-0">
                            <h6><i class="fas fa-filter mr-2"></i>FILTER</h6>
                        </div>
                        <form method="GET" action="{{ route('products.index') }}">
                        <div class="card-body py-0">
                            <span class="filter-title">Brand</span>
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="brand[]" id="brand-aqua" value="Aqua" @if(Request::all()) @if (in_array("Aqua",Request::get('brand'))) checked @endif @endif @if(count($products) == 0) disabled @endif>
                                <label for="brand-aqua" class="filter-label">Aqua</label>
                            </div>
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="brand[]" id="brand-vit" value="Vit" @if(Request::all()) @if (in_array("Vit",Request::get('brand'))) checked @endif @endif @if(count($products) == 0) disabled @endif>
                                <label for="brand-vit" class="filter-label">Vit</label>
                            </div>
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="brand[]" id="brand-mizone" value="Mizone" @if(Request::all()) @if (in_array("Mizone",Request::get('brand'))) checked @endif @endif @if(count($products) == 0) disabled @endif>
                                <label for="brand-mizone" class="filter-label">Mizone</label>
                            </div>
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="brand[]" id="brand-levite" value="Levite" @if(Request::all()) @if (in_array("Levite",Request::get('brand'))) checked @endif @endif @if(count($products) == 0) disabled @endif>
                                <label for="brand-levite" class="filter-label">Levite</label>
                            </div>                     
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-sm btn-block btn-primary" @if(count($products) == 0) disabled @endif>Apply Filter</button>
                            @if(Request::all())
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
                        @if(Auth::user()->can('create order'))
                        @if($product->stock !== '0')
                        <div class="col-md-3">
                            <a class="product" data-toggle="modal" data-target="#OrderModal" data-img="{{ asset('img/products/'.$product->photo) }}" data-uri="{{ route('carts.store') }}" data-brand="{{ $product->brand }}" data-variant="{{ $product->variant }}" data-stock="{{$product->stock}}" data-product="{{ $product->id }}">
                            <div class="card card-reward">
                                <img src="{{ asset('img/products/'.$product->photo) }}" class="card-img-top" alt="photo-{{$product->brand}}-{{$product->variant}}">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $product->brand }}</h5>
                                    <p class="card-text mb-1">{{ $product->variant }}</p>
                                    <p class="product-price mb-2">Rp {{ number_format($product->price,0,"",".") }}</p>
                                </div>
                            </div>
                            </a>
                        </div>
                        @endif
                        @else
                        <div class="col-md-3">
                            <div class="card card-reward">
                                <img src="{{ asset('img/products/'.$product->photo) }}" class="card-img-top" alt="photo-{{$product->brand}}-{{$product->variant}}">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $product->brand }}</h5>
                                    <p class="card-text mb-1">{{ $product->variant }}</p>
                                    <p class="product-price mb-2">Rp {{ number_format($product->price,0,"",".") }}</p>
									<div class="d-flex justify-content-between">
                                        @can('view supply')
										<a href="{{ route('supplies.create') }}" class="btn btn-sm btn-light @cannot('create supply') disabled @endcannot">Stok<span class="badge @if($product->stock == 0) badge-danger @else badge-primary @endif ml-2 px-1">{{$product->stock}}</span></a>
                                        @endcan
                                        <div class="btn-group" role="group">
                                            @can('edit product')
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-light">Edit</a>
                                            @endcan
                                            @can('delete product')
                                            <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#DeleteModal" data-uri="{{ route('products.destroy', $product->id) }}"><i class="fas fa-trash"></i></button>
                                            @endcan
                                        </div>
									</div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
					@else
					<div class="alert alert-light alert-dismissible fade show" role="alert">
						@if(Request::all()) Sorry we didn't find what you were looking for.
						@else Stok Produk Habis !
						@endif
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection