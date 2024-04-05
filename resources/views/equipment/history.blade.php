@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_script')
    <script type="text/javascript" src="/js/borrow.js"></script>
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
            <a href="{{ route('download.history') }}" class="btn bg-gradient-success">
                <i class="fa fa-download mx-1"> </i>Download Excel
            </a>
        </div>
        <div class="col-md-12">
            @include('layouts.message')
        </div>
        <div class="col-12">
            <!-- Category Filter -->
            <div class="form-group">
                <label for="category_filter">Filter by Category:</label>
                <select class="form-control" id="category_filter">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    @if($category->status == 0)
                        @continue
                    @endif
                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header pb-0">
                        <h6 class="text-info">Transaction Table</h6>
                    </div>
                    <div class="card-body">
                        <table class="table align-items-center mb-0" id="tbl-equipment" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Borrower</th> 
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Office</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Equipment</th> 
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
                                        <td style="vertical-align: middle;">{{ $transaction->equipment_name }}</td>
                                        {{-- <td style="vertical-align: middle;">{{ $transaction->property_no }}</td>
                                        <td style="vertical-align: middle;">{{ $transaction->serial_no }}</td> --}}
                                        <td style="vertical-align: middle;">{{ \Carbon\Carbon::parse($transaction->date_borrowed)->format('F d, Y') }}</td>
                                        <td style="vertical-align: middle;">{{ \Carbon\Carbon::parse($transaction->returned_date)->format('F d, Y') }}</td>
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
@endsection
