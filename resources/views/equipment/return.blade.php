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
            #tbl-borrowed th {
                display: none;
            }

            /* Show table data as block elements */
            #tbl-borrowed td {
                display: block;
            }

            /* Center-align table data */
            #tbl-borrowed td {
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
            @include('layouts.message')
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <button id="reset_filters" class="btn bg-gradient-danger" style="display:none;">
                <i class="fa fa-undo"></i> Clear Filters
            </button>
        </div>
        <div class="col-md-6">

            
            <form action="{{ route('download.equipment') }}" method="GET">
                @csrf
                <button type="submit" class="btn bg-gradient-success float-end">
                    <i class="fa fa-download mx-1"></i> 
                </button>
            </form>
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
                    <label for="borrowed_filter">Filter by Date Borrowed</label>
                    <input type="date" class="form-control" id="borrowed_filter" name="borrowed_filter">
                </div>
               
                <div class="form-group col-md-3">
                    <label for="returned_filter">Filter by Expected Return Date</label>
                    <input type="date" class="form-control" id="returned_filter" name="returned_filter">
                </div>

                <div class="form-group col-md-3">
                    <label for="employee_filter">Filter by Employee:</label>
                    <select class="form-control select2 select2-filter" id="employee_filter" name="employee_filter">
                        <option value="">All Employees</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->fullName }}">{{ $employee->fullName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-0">
                    <h6>Transaction Table</h6>
                </div>
                <div class="card-body">
                    <table class="table align-items-center mb-0" id="tbl-borrowed" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Borrower</th> 
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Office</th>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Date Borrowed</th> 
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Expected Return Date</th>
                                <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Released by:</th> 
                                <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder" width="11%">Status</th>
                                <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder" width="11%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="equipment_table_body">
                            @foreach ($borrowedData as $transaction)
                                <tr>
                                    <td>{{ $transaction->borrowed_by }}</td>
                                    <td>{{ $transaction->office_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->date_borrowed)->format('F d, Y | h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->date_returned)->format('F d, Y | h:i A') }}</td>
                                    <td>{{ $transaction->release_by }}</td>
                                    <td class="align-middle text-center action" role="group" aria-label="Status">
                                        @if ($transaction->status === 'Late')
                                            <span class="badge badge-sm bg-gradient-danger text-white">{{ $transaction->status }}</span>
                                        @elseif ($transaction->status === 'Borrowed')
                                            <span class="badge badge-sm bg-gradient-success text-white">{{ $transaction->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="align-middle text-center action" role="group" aria-label="Actions">
                                            <a href="{{ route('borrow.return', ['id' => $transaction->transaction_id]) }}" class="icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-warning text-center align-items-center justify-content-center">
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
@endsection
