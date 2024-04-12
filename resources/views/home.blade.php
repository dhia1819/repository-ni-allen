@extends('layouts.master')

@section('page_name', $page['name'])

@section('page_css')
    <style type="text/css">
        .font-22 {
            font-size: 22pt !important;
        }
    </style>
@endsection

@section('page_js')
<script type="text/javascript" src="/js/home.js"></script>
@endsection


@section('content')
@include('layouts.message')

<div class="row mt-3">
    <div class="col-md-3">
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

   
    <div class="col-md-3">
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
    <div class="col-md-3">
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
                            <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
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
                <h5 class="card-title">Equipment Conditions</h5>
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
        var conditions = @json($conditions); // Convert PHP array to JavaScript object

        // Get keys (conditions) and values (counts)
        var conditionLabels = Object.keys(conditions);
        var conditionData = Object.values(conditions);
        // Pie Chart
        var pieCtx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: conditionLabels,
                datasets: [{
                    label: 'Equipment Conditions',
                    data: conditionData,
                    backgroundColor: [
                        // createLinearGradient('rgba(67, 131, 255, 1)', 'rgba(9, 183, 202, 1)'),
                        // createLinearGradient('rgba(31, 203, 255, 1)', 'rgba(0, 142, 18, 1)'),
                        // createLinearGradient('rgba(16, 205, 255, 1)', 'rgba(0, 104, 136, 1)'),
                        // createLinearGradient('rgba(0, 217, 255, 1)', 'rgba(0, 92, 123, 1)'),
                        // createLinearGradient('rgba(0, 197, 241, 1)', 'rgba(0, 76, 110, 1)'),
                        // createLinearGradient('rgba(0, 202, 216, 1)', 'rgba(0, 63, 102, 1)'),
                        // createLinearGradient('rgba(0, 168, 129, 1)', 'rgba(0, 57, 97, 1)'),  
                        'rgba(54, 162, 235, 0.1)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.3)',
                        'rgba(54, 162, 235, 0.4)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.7)'
                        
                    ],
                    borderColor: 'rgba(0,0,0,0)',
                    borderWidth: 1,
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Equipment Conditions'
                },
            }
        });
        // function createLinearGradient(color1, color2) {
        //     var ctx = pieCtx;
        //     var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        //     gradient.addColorStop(0, color1);
        //     gradient.addColorStop(1, color2);
        //     return gradient;
        // }

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
                        'rgba(54, 162, 235, 0.3)',
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
