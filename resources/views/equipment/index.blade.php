@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_script')
    <script type="text/javascript" src="/js/equipment.js"></script>
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
                    <a href="{{ route('equipment.create') }}" class="btn bg-gradient-info trigger-modal btn-md">
                        <i class="fa fa-plus"></i> Add Equipment
                    </a>
                    <button id="reset_filters" class="btn bg-gradient-danger" style="display:none;">
                        <i class="fa fa-undo"></i> Clear Filters
                    </button>
                </div>
                
                <div class="col-md-8 ">
                    <form action="{{route('download.equipment')}}" method="GET">
                        @csrf
                        <button type="submit" class="btn bg-gradient-success float-end">
                            <i class="fa fa-download mx-1"> </i>
                        </button>
                </div>
                
                
            </div>
            {{-- <a href="{{route('download.equipment')}}" class="btn bg-gradient-success float-end">
                <i class="fas fa-download mx-1"></i> 
            </a> --}}
            
            
            @include('layouts.message')
        </div>
        <div class="col-12">
            
            <div class="col-12" id="filters">
                <div class="row col-12">
                    <!-- Category Filter -->
                    <div class="form-group col-md-4">
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
                    <!-- Condition Filter -->
                    <div class="form-group col-md-4">
                        <label for="condition_filter">Filter by Condition</label>
                        <select class="form-control select select2-filter" id="condition_filter" name="condition_filter">
                            <option value="">All Conditions</option>
                            <option value="Good" >Good</option>
                            <option value="Fair">Fair</option>
                            <option value="Poor">Poor</option>
                            <option value="Damaged">Damaged</option>
                            <option value="Obsolete">Obsolete</option>
                            <option value="Unusable">Unusable</option>
                            <option value="Under Maintenance">Under Maintenance</option>                                            
                        </select>
                    </div>
                    <!-- Status Filter -->
                    <div class="form-group col-md-4">
                        <label for="status_filter">Filter by Status</label>
                        <select class="form-control select select2-filter" id="status_filter" name="status_filter">
                            <option value="">All Items</option>
                            <option value="available" >Available</option>
                            <option value="unavailable" >Unavailable</option>
                            <option value="borrowed" >Borrowed</option>                                                 
                        </select>
                    </div>
                </div>
            </div>
        </form>
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header pb-0">
                        <h6>Equipment Table</h6>
                    </div>
                    <div class="card-body">
                        <table class="table align-items-center mb-0 " id="tbl-equipment" style="width: 100%; overflow-x:auto">
                            <thead>
                                <tr>
                                    
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Article Name</th>

                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Category</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Property Number</th> 
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Serial Number</th> 
                                    {{-- <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Value</th> 
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Quantity</th> 
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Remarks</th> 
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Date Acquired</th> --}}
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
                                        <div class ="text-center">                                                              
                                            <a href="{{ route('equipment.show', ['id' => $item->id]) }}" type="button" class="icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-success text-center align-items-center justify-content-center">
                                                <i class="fa fa-eye 2x" aria-hidden="true"></i>
                                            </a>
                                            @if($item->status !== 'Borrowed' && !in_array($item->conditions, ['Damaged', 'Obsolete', 'Unusable', 'Under Maintenance']))                                            <a href="{{ route('equipment.borrow', ['id' => $item->id]) }}" type="button" class="icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-warning text-center align-items-center justify-content-center">
                                                <i class="fas fa-hand-holding"></i> <!-- Replace with the appropriate borrow icon -->
                                            </a>
                                        @else
                                            <a href="#" type="button" class="icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-secondary text-center align-items-center justify-content-center">
                                                <i class="fas fa-hand-holding"></i> <!-- Replace with the appropriate borrow icon -->
                                            </a>
                                        @endif

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
