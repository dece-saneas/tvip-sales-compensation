@extends('layouts.main')

@section('title') TVIP - Users @endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/bootstrap-icheck.min.css') }}">
@endsection

@section('modal')
@can('delete user')
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
            <li class="breadcrumb-item active">User</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content pb-50">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Daftar User</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    @can('create user')
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-outline-dark mx-1"><i class="fas fa-plus mr-2"></i>Tambah User</a>
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
                                            <th width="30%">Name</th>
                                            <th width="30%">Email</th>
                                            <th width="20%" class="text-center">Role</th>
                                            @canany(['edit user', 'delete user'])
                                            <th width="15%" class="text-center">Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            @if(count($users) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm m-0">
                                    <tbody>
                                        @foreach ($users as $no =>  $user)
                                        @if($user->name !== 'Super Admin')
                                        <tr>
                                            <th width="5%" class="align-middle text-center">{{ $no+1+(($users->currentPage()-1)*10) }}</th>
                                            <td width="30%">{{ $user->name }}</td>
                                            <td width="30%">{{ $user->email }}</td>
                                            <td width="20%" class="text-center">@foreach($user->roles as $role) <span class="badge badge-light">{{ $role->name }}</span> @endforeach</td>
                                            @canany(['edit user', 'delete user'])
                                            <td width="15%" class="align-middle text-center">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    @can('edit user')
                                                    @if($user->id == Auth::user()->id )
                                                    <button type="button" class="btn btn-sm btn-light" disabled>Edit</button>
                                                    @else
                                                    <a href="{{ route('users.edit',$user->id) }}" class="btn btn-light">Edit</a>
                                                    @endif
                                                    @endcan
                                                    @can('delete user')
                                                    @if($user->id == Auth::user()->id )
                                                    <button type="button" class="btn btn-sm btn-light" disabled><i class="fas fa-trash"></i></button>
                                                    @else
                                                    <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#DeleteModal" data-uri="{{ route('users.destroy', $user->id) }}"><i class="fas fa-trash"></i></button>
                                                    @endif
                                                    @endcan
                                                </div>
                                            </td>
                                            @endcanany
                                        </tr>
                                        @endif
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
                        @if(count($users) > 0)
                        <div class="card-body">
                            {{ $users->links('layouts.pagination') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection