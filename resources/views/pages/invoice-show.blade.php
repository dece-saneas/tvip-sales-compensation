@extends('layouts.main')

@section('title') TVIP - Invoice @endsection

@section('script')
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/moment-timezone-with-data.js') }}"></script>
<script>
    var end = moment($("#created_at").val()).add(1, 'day');
    var now = moment().tz('Asia/Jakarta');
    var diff = end.diff(now, 'seconds');
    var minutes = Math.floor(diff/60);
    var hours = Math.floor(minutes/60)

    var duration = moment.duration({
      'hours': hours,
      'minutes': minutes%60,
      'seconds': diff%60

    });

    var timestamp = new Date();
    var interval = 1;
    var timer = setInterval(function() {
        timestamp = new Date(timestamp.getTime() + interval * 1000);

        duration = moment.duration(duration.asSeconds() - interval, 'seconds');
        var hou = duration.hours();
        var min = duration.minutes();
        var sec = duration.seconds();

        sec - 1;
        
        if (sec < 0) {
            min - 1;
            sec = 59;
        }    
        if (min < 0) {
            hou - 1;
            min = 59;
        }

        if (hou == 0 && min == 0 && sec == 0) clearInterval(timer);

        $('#countdown').text(hou + ' Jam ' + min + ' Menit ' + sec + ' Detik');

    }, 1000);

</script>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orders.index') }}">Pesanan</a></li>
            <li class="breadcrumb-item active">{{ $invoice->code }}</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Invoice</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-light card-outline">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-1 text-center">
                                    <img src="{{ asset('logo.png') }}" alt="Logo" class="brand-image rounded img-fluid mb-2">
                                    <h6><strong>TVIP</strong></h6>
                                </div>
                                <div class="col-11 text-right">
                                    <h4 class="m-0">{{ $invoice->code }}</h4>
                                    <h6 class="m-0 py-auto">{{ $invoice->updated_at->format('d M Y - h:i A ') }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="m-0"><strong>Penerima</strong></h6>
                                    <p class="m-0">{{ $invoice->user->name }}</p>
                                    <p>{{ $invoice->telp }}</p>
                                </div>
                                <div class="col-6 text-right">
                                    <h6 class="m-0"><strong>Alamat</strong></h6>
                                    <p>{{ $invoice->address }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-sm m-0">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">#</th>
                                            <th width="10%">Product</th>
                                            <th width="35%"></th>
                                            <th width="5%" class="text-center">Quantity</th>
                                            <th width="20%" class=" text-right">Price</th>
                                            <th width="20%" class="text-right">Total</th>
                                            <th width="5%"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            <div class="table-responsive">
                                <table class="table table-sm m-0">
                                    <tbody>
                                        @foreach ($products as $no =>  $product)
                                        
                                        @php $total[] = $product->product->price*$product->quantity @endphp
                                        <tr>
                                            <th width="5%" class="align-middle text-center">{{ $no+1 }}</th>
                                            <td width="10%"><img src="{{ asset('img/products/'.$product->product->photo) }}" alt="" class="img-fluid"></td>
                                            <td width="35%" class="align-middle"><b>{{ $product->product->brand }}</b><br><small>{{ $product->product->variant }}</small></td>
                                            <td width="5%" class="align-middle text-center">{{ $product->quantity }}</td>
                                            <td width="20%" class="align-middle text-right">Rp {{ number_format($product->product->price,0,"",".") }}</td>
                                            <td width="20%" class="align-middle text-right">Rp {{ number_format($product->product->price*$product->quantity,0,"",".") }}</td>
                                            <td width="5%"></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mb-4">
                                <table class="table table-borderless table-sm m-0">
                                    <thead>
                                        <tr>
                                            <th width="5%"></th>
                                            <th width="10%"></th>
                                            <th width="35%"></th>
                                            <th width="5%"></th>
                                            <th width="20%" class="align-middle text-right">Total</th>
                                            <th width="20%" class="align-middle text-right">Rp {{ number_format(array_sum($total),0,"",".") }}</th>
                                            <th width="5%"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            @if($invoice->status == "Menunggu Pembayaran")
                            <div>
                                <h6><strong>Petunjuk Pembayaran</strong></h6>
                                <small>Silahkan transfer pembayaran ke rekening di bawah ini :</small>
                                <p class="m-0"><strong>Bank BCA - 0678163867</strong></p>
                                <p>a/n Denny Cahyono</p>
                                <p class="m-0">Batas Pembayaran :</p>
                                <input class="d-none" type="text" id="created_at" value="{{ $invoice->created_at }}">
                                <p><strong><span id="countdown">0 Jam 0 Menit 0 Detik</span></strong></p>
                            </div>
                            @endif
                            <div class="d-flex justify-content-between">
                                @if($invoice->status == 'Menunggu Pembayaran')
                                <p class="text-muted my-auto"><i class="fas fa-receipt mr-2"></i>Menunggu Pembayaran</p>
                                @else
                                <p class="text-muted my-auto"><i class="fas fa-receipt mr-2"></i>Pembayaran Berhasil</p>
                                @endif
                                <a href="javascript:void(0)" class="btn btn-light"><i class="fas fa-print mr-2"></i>Print</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
