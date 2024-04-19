@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_script')
    <script type="text/javascript" src="/js/home.js"></script>
@endsection
@section('content')
@include('layouts.message')

<div class="row mt-3">
    @php
    $colClass = $lateReturn == 0 ? 'col-md-4' : 'col-md-3'; // Define column class based on $lateReturn value
    @endphp
    <div class="{{ $colClass }}">
            <div class="card">
                <a href="{{ route('equipment') }}">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Equipments</p>
                                <h5 class="font-weight-bolder mb-0 text-success">{{ $equipment }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                <i class="fa fa-toolbox"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

   
    <div class="{{ $colClass }}">
        <div class="card">
            <a href="{{route('employee')}}">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Employees</p>
                                <h5 class="font-weight-bolder mb-0 text-success">{{ $employee }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                <i class="fa fa-id-badge"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="{{ $colClass }}">
        <div class="card">
            <a href="{{route('history')}}">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Closed Transactions</p>
                                <h5 class="font-weight-bolder mb-0 text-success">{{ $history }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                <i class="fa fa-scroll"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @if($lateReturn>0)
    <div class="col-md-3">
        <div class="card">
            <a href="{{route('late')}}">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Missing Items</p>
                                <h5 class="font-weight-bolder mb-0 text-success">{{ $lateReturn }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                               <!-- Late icon using Font Awesome (Exclamation Circle) -->
                                <i class="fas fa-exclamation-circle "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endif
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Transactions</h5>
                <div class="row">
                        <div class="col-12" id="filter">
                            <div class="row col-12">
                                <div class="form-group col-md-6">
                                    <label for="office_filter">Filter by Office:</label>
                                    <select class="form-control select2 select2-filter" id="office_filter" name="office_filter">
                                        <option value="">All Offices</option>
                                        @foreach($offices as $office)
                                            <option value="{{ $office->code }}">{{ $office->code }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="category_filter">Filter by Category:</label>
                                    <select class="form-control select2 select2-filter" id="category_filter" name="category_filter">
                                        <option value="">All Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->category }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
    
                        </div>      
            </div>
            </div>

                <canvas id="pieChart" style="width: 100%; height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Equipment Availability</h5>
                <canvas id="barGraph" style="width: 100%; height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var historyCount = {{ $history }}; // Total transactions count
    
        // Pie Chart
        var pieCtx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Total Transactions'],
                datasets: [{
                    label: 'Total Transactions',
                    data: [historyCount],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)'
                    ],
                    borderColor: 'rgba(0,0,0,0)',
                    borderWidth: 1
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Total Transactions'
                }
            }
        });
    
        // Bar Graph
        var statusAvailable = @json($statusAvailable); // Convert PHP array to JavaScript object
        var statusBorrowed = @json($statusBorrowed);
        var statusUnavailable = @json($statusUnavailable);
    
        var barCtx = document.getElementById('barGraph').getContext('2d');
        var barGraph = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Available', 'Borrowed', 'Unavailable'],
                datasets: [{
                    label: 'Equipments',
                    data: [statusAvailable, statusBorrowed, statusUnavailable],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(54, 162, 235, 0.3)'
                    ],
                    borderColor: 'rgba(0,0,0,0)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Borrowed Equipments per Month'
                }
            }
        });
    });
    </script>

<style>
    .card-body canvas {
        width: 100%;
        height: 100%;
    }
</style>
@endsection
