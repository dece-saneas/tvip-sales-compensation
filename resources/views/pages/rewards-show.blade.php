@extends('layouts.main')

@section('title') TVIP - Leaderboards @endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Rewards</li>
            <li class="breadcrumb-item active">{{ $reward->title }}</li>
            <li class="breadcrumb-item active">Leaderboards</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content pb-50">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Leaderboards</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    <img src="{{ asset('img/rewards/'.$reward->photo) }}" class="card-img-top" alt="Reward Image">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-sm m-0">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">#</th>
                                            <th width="80%">Nama</th>
                                            <th width="15%" class="text-center">Point</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            @if(count($leaderboards) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm m-0">
                                    <tbody>
                                        @foreach ($leaderboards as $no =>  $user)
                                        <tr>
                                            <th width="5%" class="align-middle text-center">{{ $no+1+(($leaderboards->currentPage()-1)*10) }}</th>
                                            <td width="80%">{{ $user->user->name }}</td>
                                            <td width="15%" class="text-center">{{ $user->point }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="alert alert-light alert-dismissible fade show" role="alert">
                                Leaderboards is empty.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            @endif
                        </div>
                        @if(count($leaderboards) > 0)
                        <div class="card-body">
                            {{ $leaderboards->links('layouts.pagination') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection