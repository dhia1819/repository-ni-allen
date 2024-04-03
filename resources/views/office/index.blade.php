@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_script')
    <script type="text/javascript" src="/js/offices.js"></script>
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
                <i class="fa fa-plus"></i> Add Office
            </a>
            @include('layouts.message')
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Office Table</h6>
                </div>
                <div class="card-body">
                    <table class="table align-items-center mb-0" id="tbl-offices" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Code</th>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Office</th>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Type</th>
                                <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder" width="11%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($office as $off)
                                <tr>
                                    <td data-label="Name" class="align-middle header with-label">
                                        <span class="text-xs">{{ $off->code }}</span>
                                    </td>
                                    <td data-label="Location" class="align-middle text-center action">
                                        {{ $off->office }}
                                    </td>
                                    <td data-label="Location" class="align-middle text-center action">
                                        {{ $off->type }}
                                    </td>
                                    <td class="align-middle text-center action">
                                        <a href="#" data-rowid="{{$off->id}}" class="editIcon icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-info text-center align-items-center justify-content-center btn-edit-off" data-toggle="modal" data-target="#edit_modal">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    @include('office.edit')
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('office.create')
@endsection
