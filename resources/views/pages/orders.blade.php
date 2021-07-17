@extends('layouts.main')

@section('title') TVIP - Products Supplies @endsection

@section('modal')
@canany(['create order', 'verify order'])
<div class="modal fade" id="UploadModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bb-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center py-0">
                <h4 class="modal-title mb-2"><strong>Upload Bukti Transfer</strong></h4>
            </div>
            <div class="modal-body py-0">
                <div class="text-center">
                    <img class="img-fluid mb-2 attach" id="imageResult" src="" alt="photo">
                </div>
                <form method="POST" action="#" enctype="multipart/form-data" id="UploadForm">
                @csrf @method('put')
                <div class="input-group input-group-sm mb-2">
                    <div class="custom-file" id="customFile">
                        <input type="file" class="custom-file-input upload" id="upload" aria-describedby="photoAddon" name="photo">
                        <label class="custom-file-label" id="upload-label">Upload Photo</label>
                    </div>
                </div>
                @error('photo')
                <span class="text-danger text-sm">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="form-group">
                    <label for="bank">Bank</label>
                    <input id="bank" type="text" class="form-control form-control-sm @error('bank') is-invalid @enderror bank" name="bank">
                    @error('bank')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="account">No. Rekening</label>
                    <input id="account" type="number" class="form-control form-control-sm @error('account') is-invalid @enderror account" name="account">
                    @error('account')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Nama Pengirim</label>
                    <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror name" name="name">
                    @error('name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="modal-body text-center">
                <button class="btn btn-sm btn-light mx-1 px-4" data-dismiss="modal" aria-label="Close">Cancel</button>
                @can('create order')
                <button type="submit" class="btn btn-sm btn-success mx-1 px-4"><i class="fas fa-file-upload mr-2"></i>Upload</button>
                @endcan
            </div>
            </form>
        </div>
    </div>
</div>
@endcanany
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pesanan</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content pb-50">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Riwayat Pesanan</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
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
                                            <th width="15%">No. Invoice</th>
                                            <th width="15%" class="text-center">Payment</th>
                                            <th width="15%" class="text-right">Total</th>
                                            <th width="20%" class="text-center">Date</th>
                                            <th width="15%" class="text-center">Status</th>
                                            <th width="15%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            @if(count($invoices) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm m-0">
                                    <tbody>
                                        @foreach ($invoices as $no =>  $invoice)
                                        <tr>
                                            <th width="5%" class="align-middle text-center">{{ $no+1+(($invoices->currentPage()-1)*10) }}</th>
                                            <td width="15%" class="align-middle"><a href="{{ route('orders.show',$invoice->id) }}"><strong>{{ $invoice->code }}</strong></a></td>
                                            <td width="15%" class="align-middle text-center">@if($invoice->payment == 'Bank') Bank Transfer @else Cash on Delivery @endif</td>
                                            <td width="15%" class="align-middle text-right"><strong>Rp {{ number_format($invoice->total,0,"",".") }},-</strong></td>
                                            <td width="20%" class="align-middle text-center">{{ $invoice->updated_at->format('d M Y - h:i A ') }}</td>
                                            <td width="15%" class="align-middle text-center"><span class="badge @if($invoice->status == 'Menunggu Pembayaran' || $invoice->status == 'Menunggu Verifikasi') badge-info @elseif($invoice->status == 'Selesai') badge-dark @else badge-success @endif"><i class="fas @if($invoice->status == 'Menunggu Pembayaran' || $invoice->status == 'Menunggu Verifikasi') fa-clock @elseif($invoice->status == 'Sedang di Proses') fa-truck-loading @elseif($invoice->status == 'Sedang di Kirim') fa-truck @else fa-check @endif mr-2"></i>{{ $invoice->status }}</span></td>
                                            <td width="15%" class="align-middle text-center">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    @if($invoice->status == 'Menunggu Pembayaran' || $invoice->status == 'Menunggu Verifikasi')
                                                        @can('create order')
                                                            <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#UploadModal" data-uri="{{ route('orders.update', $invoice->id) }}" data-bank="{{ $invoice->bank_name }}" data-name="{{ $invoice->bank_account_name }}" data-account="{{ $invoice->bank_account }}" data-attachment="@if( $invoice->attachment == NULL ) {{ asset('img/products/placeholder.jpg') }} @else {{ asset('img/uploads/'.$invoice->attachment) }} @endif"><i class="fas @if($invoice->attachment == NULL) fa-file-upload @else fa-check @endif mr-2"></i>Bukti Transfer</button>
                                                        @endcan
                                                        @can('verify order')
                                                            <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#UploadModal" data-uri="{{ route('orders.update', $invoice->id) }}" data-bank="{{ $invoice->bank_name }}" data-name="{{ $invoice->bank_account_name }}" data-account="{{ $invoice->bank_account }}" data-attachment="@if( $invoice->attachment == NULL ) {{ asset('img/products/placeholder.jpg') }} @else {{ asset('img/uploads/'.$invoice->attachment) }} @endif" @if($invoice->attachment == NULL) disabled @endif><i class="fas fa-receipt mr-2"></i></button>
                                                            <a href="{{ route('orders.process',['verify',$invoice->id]) }}" class="btn btn-sm btn-light" @if($invoice->attachment == NULL) disabled @endif>Verifikasi</a>
                                                        @endcan
                                                    @elseif($invoice->status == 'Sedang di Proses')
                                                        @canany(['create order', 'verify order'])
                                                            @if($invoice->payment == 'Bank')
                                                                <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#UploadModal" data-uri="{{ route('orders.update', $invoice->id) }}" data-bank="{{ $invoice->bank_name }}" data-name="{{ $invoice->bank_account_name }}" data-account="{{ $invoice->bank_account }}" data-attachment="@if( $invoice->attachment == NULL ) {{ asset('img/products/placeholder.jpg') }} @else {{ asset('img/uploads/'.$invoice->attachment) }} @endif"><i class="fas @if($invoice->attachment == NULL) fa-file-upload @else fa-check @endif mr-2"></i>Bukti Transfer</button>
                                                            @else
                                                                <button type="button" class="btn btn-sm btn-light" Disabled><i class="fas fa-wallet mr-2"></i>COD</button>
                                                            @endif
                                                        @endcanany
                                                        @can('process order')
                                                            <a href="{{ route('orders.process',['process',$invoice->id]) }}" class="btn btn-sm btn-light"><i class="fas fa-truck mr-2"></i>Kirim Barang</a>
                                                        @endcan
                                                    @elseif($invoice->status == 'Sedang di Kirim')
                                                        @can('create order')
                                                            <a href="{{ route('orders.process',['complete',$invoice->id]) }}" class="btn btn-sm btn-success"><i class="fas fa-check mr-2"></i>Selesai</a>
                                                        @endcan
                                                        @can('verify order')
                                                            @if($invoice->payment == 'Bank')
                                                                <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#UploadModal" data-uri="{{ route('orders.update', $invoice->id) }}" data-bank="{{ $invoice->bank_name }}" data-name="{{ $invoice->bank_account_name }}" data-account="{{ $invoice->bank_account }}" data-attachment="@if( $invoice->attachment == NULL ) {{ asset('img/products/placeholder.jpg') }} @else {{ asset('img/uploads/'.$invoice->attachment) }} @endif"><i class="fas @if($invoice->attachment == NULL) fa-file-upload @else fa-check @endif mr-2"></i>Bukti Transfer</button>
                                                            @else
                                                                <button type="button" class="btn btn-sm btn-light" Disabled><i class="fas fa-wallet mr-2"></i>COD</button>
                                                            @endif
                                                        @endcan
                                                        @can('process order')
                                                            <button class="btn btn-sm btn-light" disabled><i class="fas fa-truck mr-2"></i>Kirim Barang</button>
                                                        @endcan
                                                    @else
                                                        <button class="btn btn-sm btn-light" disabled><i class="fas fa-check mr-2"></i>Selesai</a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="alert alert-light alert-dismissible fade show" role="alert">
                                @canany(['verify order', 'process order'])
                                Belum ada Pesanan Masuk !
                                @endcanany
                                @can('create order')
                                Kamu belum memesan apapun !
                                @endcan
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            @endif
                        </div>
                        @if(count($invoices) > 0)
                        <div class="card-body">
                            {{ $invoices->links('layouts.pagination') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection