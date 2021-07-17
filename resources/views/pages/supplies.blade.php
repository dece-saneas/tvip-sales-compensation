@extends('layouts.main')

@section('title') TVIP - Products Supplies @endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/bootstrap-icheck.min.css') }}">
@endsection

@section('modal')
@can('delete supply')
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
                <form action="javascript:void(0);" method="POST" id="DeleteForm"> 
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
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active">Riwayat</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content pb-50">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Riwayat Stok</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    @can('create supply')
                    <a href="{{ route('supplies.create') }}" class="btn btn-sm btn-outline-dark mx-1"><i class="fas fa-plus mr-2"></i>Tambah Stok</a>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-sm m-0">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">#</th>
                                            <th width="50%">Product</th>
                                            <th width="10%" class="text-center">Stock</th>
                                            <th width="20%" class="text-center">Date</th>
                                            @canany(['edit supply', 'delete supply'])
                                            <th width="15%" class="text-center">Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            @if(count($supplies) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm m-0">
                                    <tbody>
                                        @foreach ($supplies as $no =>  $supply)
                                        <tr>
                                            <th width="5%" class="align-middle text-center">{{ $no+1+(($supplies->currentPage()-1)*10) }}</th>
                                            <td width="50%"><h6 class="m-0"><strong>{{ $supply->product->brand }} - {{ $supply->product->variant }}</strong></h6><small>"{{ $supply->notes }}"</small></td>
                                            <td width="10%" class="align-middle text-center"><span class="badge badge-success">+ {{ $supply->stock }}</span></td>
                                            <td width="20%" class="align-middle text-center"><small>{{ $supply->user->name }}</small><br><span class="badge badge-light">{{ $supply->updated_at->format('d M Y - h:i A ') }}</span></td>
                                            @canany(['edit supply', 'delete supply'])
                                            <td width="15%" class="align-middle text-center">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    @can('edit supply')
                                                    <a href="{{ route('supplies.edit',$supply->id) }}" class="btn btn-light">Edit</a>
                                                    @endcan
                                                    @can('delete supply')
                                                    <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#DeleteModal" data-uri="{{ route('supplies.destroy', $supply->id) }}"><i class="fas fa-trash"></i></button>
                                                    @endcan
                                                </div>
                                            </td>
                                            @endcanany
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="alert alert-light alert-dismissible fade show" role="alert">
                                Supplies History is empty.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            @endif
                        </div>
                        @if(count($supplies) > 0)
                        <div class="card-body">
                            {{ $supplies->links('layouts.pagination') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection