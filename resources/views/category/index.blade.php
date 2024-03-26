@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_script')
    <script type="text/javascript" src="/js/category.js"></script>
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
                <i class="fa fa-plus"></i> Add Category
            </a>
            @include('layouts.message')
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Categories Table</h6>
                </div>
                <div class="card-body">
                    <table class="table align-items-center mb-0" id="tbl-cat" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Category</th>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2"><center>Status</center></th> 
                                <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder" width="11%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category as $cat)
                                <tr>
                                    <td data-label="Category" class="align-middle header with-label">
                                        <span class="text-xs">{{ $cat->category }}</span>
                                    </td>
                                    


                                    <td data-label="Status" class="align-middle with-label" align="center">
                                        <span class="text-xs">
                                            @if($cat->status == '1')
                                                <span class="badge badge-sm bg-gradient-success">active</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">inactive</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="align-middle text-center action">
                                        <a href="#" data-rowid="{{$cat->id}}" class=" icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-info text-center align-items-center justify-content-center btn-edit-cat" data-toggle="modal" data-target="#edit_modal">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    @include('category.edit')

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  

@endsection


@include('category.create')
