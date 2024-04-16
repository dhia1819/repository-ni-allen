@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_script')
    <script type="text/javascript" src="/js/supplies.js"></script>
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
                    <ahref="#" class="btn bg-gradient-info trigger-modal btn-md" data-toggle="modal" data-target="#create_modal">
                        <i class="fa fa-plus"></i> Add Supply
                    </a>
                </div> 
            </div>
            {{-- <a href="{{route('download.equipment')}}" class="btn bg-gradient-success float-end">
                <i class="fas fa-download mx-1"></i> 
            </a> --}}
            
            
            @include('layouts.message')
        </div>
      
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header pb-0">
                        <h6>Supplies Table</h6>
                    </div>
                    <div class="card-body">
                        <table class="table align-items-center mb-0" id="tbl-supplies" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Date</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Item</th>                                     
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2"><center>Remarks</center></th> 
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="equipment_table_body">
                                @foreach ($supplies as $supply)
                                <tr>                                   
                                    <td style="vertical-align: middle;">{{ $supply->date_acquired }}</td>
                                    <td style="vertical-align: middle;">{{ $supply->supply_name }}</td>
                                   
                                    <td class="text-center" style="vertical-align: middle;">
                                        @if($supply->remarks=='1')
                                            <span class="badge badge-sm bg-gradient-success">Good</span>
                                        @elseif($supply->remarks=='2')
                                            <span class="badge badge-sm bg-gradient-warning">Used</span>
                                        @elseif($supply->remarks=='3')
                                            <span class="badge badge-sm bg-gradient-secondary">Dispose</span>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <div class ="text-center">                                                              
                                            <a href="#" type="button" class="icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-success text-center align-supplys-center justify-content-center">
                                                <i class="fa fa-eye 2x" aria-hidden="true"></i>
                                            </a>
                                            @if($supply->remarks !== 'Dispose')                                            
                                            <a href="#" type="button" class="icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-warning text-center align-items-center justify-content-center">
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
    @include('supplies.add')
@endsection
