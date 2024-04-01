@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_script')
    <script type="text/javascript" src="/js/users.js"></script>
@endsection
@section('page_css')
    <style type="text/css">
        td { font-size: 0.75rem !important }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
        <a href="#" class="btn bg-gradient-info trigger-modal btn-md" data-toggle="modal" data-target="#create_modal">
    <i class="fa fa-plus"></i> Add Users
</a>

            @include('layouts.message')
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Users Table</h6>
                </div>
                <div class="card-body">
                    <table class="table align-items-center mb-0" id="tbl-users" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Username</th>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Full Name</th>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Classification</th> 
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2"><center>Status</center></th> 
                                <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder" width="11%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td data-label="Username" class="align-middle header with-label">
                                        <span class="text-xs">
                                            {{$user->username}}
                                        </span>
                                    </td>
                                    <td data-label="Full Name" class="align-middle header with-label">
                                        <span class="text-xs">
                                            {{$user->name}} 
                                        </span>
                                    </td>
                                    <td data-label="Classification" class="align-middle with-label">
                                        <span class="text-xs" style="color: {{$user->classification_id == 1 ? 'blue' : 'red'}};">
                                            {{$user->classification_id == 1 ? 'Overall Administrator' : 'Administrator'}}
                                        </span>
                                    </td>

                                    <td data-label="Status" class="align-middle with-label" align="center">
                                        <span class="text-xs">
                                            @if($user->status == 1)
                                                <span class="badge badge-sm bg-gradient-success">active</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">inactive</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="align-middle text-center action">
                                    <a href="#" class="icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-info text-center align-items-center justify-content-center btn-edit-user" 
                                        data-toggle="modal" 
                                        data-target="#edit_modal" 
                                        data-name="{{$user->name}}" 
                                        data-username="{{$user->username}}" 
                                        data-rowid="{{$user->id}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    </td>
                                    @include('users.edit')
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('users.create')


    
@endsection