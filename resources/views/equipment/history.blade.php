@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_script')
    <script type="text/javascript" src="/js/history.js"></script>
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
            <form action="{{ route('download.history') }}" method="GET">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <label for="category_filter">Category filter</label>
                    </div>
                    <div class="col-md-3">
                        <label for="start_date">Transactions since</label>
                    </div>
                    <div class="col-md-3">
                        <label for="end_date">Transactions until</label>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-5 form-group" id="filter">
                        <select class="form-control select select2-filter" id="category_filter" name="category">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            @if($category->status == 0)
                                @continue
                            @endif
                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">

                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="date" class="form-control" id="end_date" name="end_date">

                    </div>
                    <div class="col-md-1 align-items-end">
                        <button type="submit" class="btn bg-gradient-success">
                            <i class="fa fa-download mx-1"> </i>
                        </button>
                    </div>
                    
                </form>
                </div>
                <div class="row mt-2 justify-content-start" id="reset-button">
                    <div class="col-md-2">
                        <button id="reset_filter" class="btn bg-gradient-danger " style="display:none;" >
                            <i class="fa fa-undo mx-1"></i>Clear filters
                        </button>
                    </div>
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
                            <table class="table align-items-center mb-0" id="tbl-history" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Borrower</th> 
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Office</th>
                                      
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Category</th> 
                                        {{-- <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Property No#</th> 
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Serial No#</th>  --}}
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Date Borrowed</th> 
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Date Returned</th>
                                        {{-- <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Release by:</th>  --}}
                                        {{-- <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Status</th>  --}}
                                        <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder" width="11%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="equipment_table_body">
                                    @foreach ($borrowedData as $transaction)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $transaction->borrowed_by }}</td>
                                            <td style="vertical-align: middle;">{{ $transaction->office_name }}</td>
                                           
                                            <td style="vertical-align: middle;">{{ $transaction->category_name }}</td>
                                            {{-- <td style="vertical-align: middle;">{{ $transaction->property_no }}</td>
                                            <td style="vertical-align: middle;">{{ $transaction->serial_no }}</td> --}}
                                            <td style="vertical-align: middle;">
                                                {{ \Carbon\Carbon::parse($transaction->date_borrowed)->format('F d, Y | h:i A') }}
                                            </td>
                                            <td style="vertical-align: middle;">
                                                {{ \Carbon\Carbon::parse($transaction->returned_date)->format('F d, Y | h:i A') }}
                                            </td>
                                            {{-- <td style="vertical-align: middle;">{{ $transaction->release_by }}</td>
    
    
                                            <td style="vertical-align: middle;">{{ ucfirst($transaction->tstatus) }}</td> --}}
                                            <td>
                                                <div class="align-middle text-center action" role="group" aria-label="Actions">
                                                <a href="{{ route('show.history', ['id' => $transaction->
                                                transaction_id]) }}" class="icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-success text-center align-items-center justify-content-center">
                                                    <i class="fa fa-eye"></i>
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
