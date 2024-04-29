@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_script')
    <script type="text/javascript" src="/js/archive.js"></script>
@endsection
@section('page_css')
    <style type="text/css">
        td { font-size: 0.75rem !important }

        /* Media query for small screens */
        @media (max-width: 768px) {
            /* Hide table headers */
            #tbl-equipment th {
                display: none;
            }

            /* Show table data as block elements */
            #tbl-equipment td {
                display: block;
            }

            /* Center-align table data */
            #tbl-equipment td {
                text-align: center;
            }

            /* Hide button text */
            .edit-button-text {
                display: none;
            }
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <button id="reset_filters" class="btn bg-gradient-danger" style="display:none;">
                        <i class="fa fa-undo"></i> Clear Filters
                    </button>
                </div>
                
                <div class="col-md-8 ">
                    <form action="{{route('dl.archive')}}" method="GET">
                        @csrf
                        <button type="submit" class="btn bg-gradient-success float-end">
                            <i class="fa fa-download mx-1"> </i>
                        </button>
                </div>
            </div>
            @include('layouts.message')
        </div>
        <div class="col-12">
            <div class="col-12" id="filters">
                <div class="row col-12">
                    <!-- Category Filter -->
                    <div class="form-group">
                        <label for="category_filter">Filter by Category:</label>
                        <select class="form-control select select2-filter" id="category_filter" name="category_filter">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                    @if($category->status == 0)
                                        @continue
                                    @endif
                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                </div>
            </div>
        
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header pb-0">
                        <h6>Equipment Table</h6>
                    </div>
                    <div class="card-body">
                        <table class="table align-items-center mb-0 " id="tbl-archive" style="width: 100%; overflow-x:auto">
                            <thead>
                                <tr>
                                    
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Article Name</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Category</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Property Number</th> 
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Serial Number</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Conditions</th>  
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Status</th> 
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder" width="11%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="equipment_table_body">
                                @foreach ($equipment as $item)
                                <tr>
                                    {{-- @if($item->image)
                                        <td><img src="{{ asset('uploads/' . $item->image) }}" alt="Equipment Image" class="rounded-circle" style="width: 50px; height: 50px;"></td>
                                    @else
                                        <td>No Image</td>
                                    @endif --}}
                                    <td style="vertical-align: middle; white-space: normal;">{{ $item->equipment_name }}</td>

                                    <td style="vertical-align: middle;">{{ $item->category_name }}</td>
                                    <td style="vertical-align: middle;">{{ $item->property_no }}</td>
                                    <td style="vertical-align: middle; white-space: normal;">{{ $item->serial_no }}</td>
                                    {{-- <td style="vertical-align: middle;">Php.{{ $item->value }}</td>
                                    <td style="vertical-align: middle;">{{ $item->quantity }}</td>
                                    <td style="vertical-align: middle;">{{ $item->remarks }}</td>
                                    <td style="vertical-align: middle;">{{ \Carbon\Carbon::parse($item->date_acquired)->format('F d, Y') }}</td> --}}
                                    <td style="vertical-align: middle;">{{ $item->conditions }}</td>
                                    <td style="vertical-align: middle;">{{ ucfirst($item->status) }}</td>
                                    <td>
                                        <div class="text-center row justify-content-center gx-4">
                                            <div class="col-3">
                                                <a href="{{ route('archive.view', ['id' => $item->id]) }}" type="button" class="icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-success text-center align-items-center justify-content-center">
                                                    <i class="fa fa-eye 2x" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="col-3">
                                                <form action="{{ route('restore', ['id' => $item->id]) }}" method="post">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="border-0 icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-warning text-center align-items-center justify-content-center">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    



                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
