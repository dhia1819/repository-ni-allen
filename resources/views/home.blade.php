@extends('layouts.master')

@section('page_name', $page['name'])

@section('page_css')
    <style type="text/css">
        .font-22 {
            font-size: 22pt !important;
        }
    </style>
@endsection
@section('content')
@include('layouts.message')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Users</p>
                            <h5 class="font-weight-bolder mb-0 text-success">{{ $users }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection