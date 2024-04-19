@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_script')
    <script type="text/javascript" src="/js/late.js"></script>
    
@endsection
@section('page_css')
    <style type="text/css">
        td { font-size: 0.75rem !important }

        /* Media query for small screens */
        @media (max-width: 768px) {
            /* Hide table headers */
            #tbl-history th {
                display: none;
            }

            /* Show table data as block elements */
            #tbl-history td {
                display: block;
            }

            /* Center-align table data */
            #tbl-history td {
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
            <form action="{{ route('download.late') }}" method="GET">
                @csrf
                <div class="row">
                <div class="col-md-12">
                   
                        <a id="reset_filter" class="btn bg-gradient-danger " style="display:none;" >
                            <i class="fa fa-undo mx-1"></i>Clear filters
                        </a>
                 
                    <button type="submit" class="btn bg-gradient-success float-end">
                        <i class="fa fa-download mx-1"></i> 
                    </button>  
                </div>
                </div>
                <div class="row">
                    <div class="col-12" id="filter">
                        <div class="row col-12">
                            <div class="form-group col-md-3">
                                <label for="office_filter">Filter by Office:</label>
                                <select class="form-control select2 select2-filter" id="office_filter" name="office_filter">
                                    <option value="">All Offices</option>
                                    @foreach($offices as $office)
                                        <option value="{{ $office->code }}">{{ $office->code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="category_filter">Filter by Employee:</label>
                                <select class="form-control select2 select2-filter" id="category_filter" name="category_filter">
                                    <option value="">All Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                           
                            <div class="date-range-container col-md-3">
                                <label for="start_date_borrowed" id="start_date_label">Date Borrowed | Start Date</label>
                                <label for="end_date_borrowed" id="end_date_label" style="display: none;">Date Borrowed | End Date</label>
                                <div class="date-inputs">
                                    <input type="date" class="form-control" id="start_date_borrowed" name="start_date_borrowed" onchange="handleStartDateChange('borrowed')">
                                    <input type="date" class="form-control" id="end_date_borrowed" name="end_date_borrowed" style="display: none;">
                                </div>
                            </div>
                            
                            <div class="date-range-container col-md-3">
                                <label for="start_date_return" id="start_date_return_label">Date Return | Start Date</label>
                                <label for="end_date_return" id="end_date_return_label" style="display: none;">Date Return | End Date</label>
                                <div class="date-inputs">
                                    <input type="date" class="form-control" id="start_date_return" name="start_date_return" onchange="handleStartDateChange('returned')">
                                    <input type="date" class="form-control" id="end_date_return" name="end_date_return" style="display: none;">
                                </div>
                            </div>
            
                            
                        </div>
                    </div>
                </div>
                    
                    
                </form>
                </div>
            
        </div>
        <div class="col-md-12">
            @include('layouts.message')
        </div>
        <div class="col-12">
            </div>
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header pb-0">                        
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="text-info">Transaction Table</h6>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="tbl-late" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Borrower</th> 
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Office</th>
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Category</th> 
    
                                        {{-- <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Equipment</th> 
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Property No#</th> 
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Serial No#</th>  --}}
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Date Borrowed</th> 
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Expected Return Date</th>
                                        
                                        {{-- <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Status</th>  --}}
                                        <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder" width="11%">Status</th>
                                        <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder" width="11%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="late_table_body">
                                    @foreach ($lateTransaction as $transaction)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $transaction->borrowed_by }}</td>
                                            <td style="vertical-align: middle;">{{ $transaction->office_name }}</td>
                                            <td style="vertical-align: middle;">{{ $transaction->category_name }}</td>
                                            {{-- <td style="vertical-align: middle;">{{ $transaction->equipment_name }}</td>
                                            <td style="vertical-align: middle;">{{ $transaction->property_no }}</td>
                                            <td style="vertical-align: middle;">{{ $transaction->serial_no }}</td> --}}
                                            <td style="vertical-align: middle;">
                                                {{ \Carbon\Carbon::parse($transaction->date_borrowed)->format('F d, Y | h:i A') }}
                                            </td>
                                            <td style="vertical-align: middle;">
                                                {{ \Carbon\Carbon::parse($transaction->date_returned)->format('F d, Y | h:i A') }}
                                            </td>
                                            
    
    
                                            {{-- <td style="vertical-align: middle;">{{ ucfirst($transaction->status) }}</td> --}}
    
                                            <td class="align-middle text-center action" role="group" aria-label="Status">
                                                @if ($transaction->status === 'Late')
                                                    <span class="badge badge-sm bg-gradient-danger text-white">{{ $transaction->status }}</span>
                                                @elseif ($transaction->status === 'Borrowed')
                                                    <span class="badge badge-sm bg-gradient-success text-white">{{ $transaction->status }}</span>
                                                @endif
                                            </td>
                                            
    
                                            <td>
                                                <div class="align-middle text-center action" role="group" aria-label="Actions">
                                                <a href="{{ route('borrow.return', ['id' => $transaction->
                                                transaction_id]) }}" class="icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-warning text-center align-items-center justify-content-center">
                                                    <i class="fas fa-reply"></i>
                                                </a>
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
    </div>
@endsection
