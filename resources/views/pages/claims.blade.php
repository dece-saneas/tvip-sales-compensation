@extends('layouts.main')

@section('title') TVIP - Products Supplies @endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">@can('create order') My Reward @endcan @can('create reward') Claim @endcan</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content pb-50">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">@can('create order') My Reward @endcan @can('create reward') Claim List @endcan</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-sm m-0">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">#</th>
                                            <th width="10%" class="text-center">Reward</th>
                                            <th width="25%"></th>
                                            <th width="15%" class="text-center">Quantity</th>
                                            <th width="15%" class="text-center">Tanggal</th>
                                            <th width="15%" class="text-center">Status</th>
                                            @role('Manager')
                                            <th width="15%" class="text-center">Action</th>
                                            @endrole
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            @if(count($claims) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm m-0">
                                    <tbody>
                                        @foreach ($claims as $no =>  $claim)
                                        <tr>
                                            <th width="5%" class="align-middle text-center">{{ $no+1+(($claims->currentPage()-1)*10) }}</th>
                                            <td width="10%" class="align-middle"><img src="{{ asset('img/rewards/'.$claim->reward->photo) }}" class="img-fluid"></td>
                                            <td width="25%" class="align-middle"><h6 class="m-0">{{ $claim->reward->title }}</h6></td>
                                            <td width="15%" class="align-middle text-center">{{ $claim->quantity }}</td>
                                            <td width="15%" class="align-middle text-center"><span class="badge badge-light">{{ $claim->created_at->format('d M Y - h:i A ') }}</span></td>
                                            <td width="15%" class="align-middle text-center"><span class="badge badge-success">{{ $claim->status }}</span></td>
                                            @role('Manager')
                                            <td width="15%" class="align-middle text-center">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <form method="POST" action="{{ route('claims.update', $claim->id) }}">
                                                    @csrf @method('put')
                                                    <button type="submit" class="btn @if($claim->status == 'Selesai') btn-light @else btn-success @endif btn-sm" @if($claim->status == 'Selesai') disabled @endif><i class="fas fa-check mr-2"></i>Selesai</button>
                                                    </form>
                                                </div>
                                            </td>
                                            @endrole
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="alert alert-light alert-dismissible fade show" role="alert">
                                Belum ada Claim Masuk !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            @endif
                        </div>
                        @if(count($claims) > 0)
                        <div class="card-body">
                            {{ $claims->links('layouts.pagination') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection