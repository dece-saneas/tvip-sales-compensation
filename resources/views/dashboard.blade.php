@extends('layouts.main')

@section('title') TVIP - Dashboard @endsection

@section('modal')
@can('delete reward')
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
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content pb-50">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Dashboard</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    @can('create reward')
                    <a href="{{ route('rewards.create') }}" class="btn btn-sm btn-outline-dark mx-1"><i class="fas fa-plus mr-2"></i>Tambah Reward</a>
                    @endcan
                </div>
            </div>
            @can('view reward')
            @if(count($rewards) > 0)
            <div class="row">  
                @foreach($rewards as $reward)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 card-reward">
                        <img src="{{ asset('img/rewards/'.$reward->photo) }}" class="card-img-top" alt="Reward Image">
                        <div class="card-body pb-0">
                            <h6 class="mb-3"><strong>{{ $reward->title }}</strong></h6>
                            <div class="row reward-content mb-2">
                                <div class="col-1 m-auto d-flex justify-content-center">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <div class="col-11">
                                    <span class="badge badge-dark px-2">{{ $reward->product->brand }}</span> <span class="badge badge-dark px-2">{{ $reward->product->variant }}</span>
                                </div>
                            </div>
                            @cannot('order product')
                            <div class="row reward-content mb-2">
                                <div class="col-1 m-auto d-flex justify-content-center">
                                    <i class="fas fa-dot-circle"></i>
                                </div>
                                <div class="col-11">
                                    <h5 class="m-0"><span class="badge badge-success px-2 py-2">{{ number_format($reward->target,0,"",".")  }}</span></h5>
                                </div>
                            </div>
                            @endcannot
                            <div class="row reward-content mt-4">
                                <div class="col-1 m-auto d-flex justify-content-center">
                                    <i class="fas fa-dot-circle"></i>
                                </div>
                                <div class="col-11">
                                    <h6 class="m-0">Periode Reward</h6>
                                    <small>{{ $reward->period_start->format('d M Y') }} - {{ $reward->period_end->format('d M Y') }}</small>
                                </div>
                            </div>
                        </div>
                        @canany(['edit reward', 'delete reward'])
                        <div class="card-footer reward-footer b-0">
                            <div class="d-flex justify-content-end">
                                <div class="btn-group" role="group">
                                    @can('edit reward')
                                    <a href="{{ route('rewards.edit', $reward->id) }}" class="btn btn-sm btn-light">Edit</a>
                                    @endcan
                                    @can('delete reward')
                                    <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#DeleteModal" data-uri="{{ route('rewards.destroy', $reward->id) }}"><i class="fas fa-trash"></i></button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        @endcanany
                        @can('order product')
                        <div class="card-footer p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="progress-group">
                                        <span>0%</span>
                                        <span class="float-right"><b>0</b>/{{ number_format($reward->target,0,"",".") }}</span>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-primary progress-bar-striped" style="width: 0%"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer reward-footer">
                            <button class="btn  btn-sm btn-success btn-block m-0">Claim Reward</button>
                        </div>
                        @endcan
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-light alert-dismissible fade show" role="alert">
                Belum ada Reward yang tersedia !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif
            @endcan
        </div>
    </div>
</div>
@endsection
