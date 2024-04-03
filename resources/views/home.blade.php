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
            <a href="{{route('users')}}">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Users</p>
                                <h5 class="font-weight-bolder mb-0 text-success">{{ $users }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
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
                        'rgba(255, 99, 132, 0.6)', // This is fallback color if gradients aren't supported
                        createLinearGradient('rgba(218, 112, 214, 0.6)', 'rgba(128, 0, 128, 1)'),
                        createLinearGradient('rgba(173, 216, 230, 0.6)', 'rgba(30, 144, 255, 1)'),
                        createLinearGradient('rgba(144, 238, 144, 0.6)', 'rgba(34, 139, 34, 1)'),
                        createLinearGradient('rgba(255, 255, 102, 0.6)', 'rgba(255, 215, 0, 1)'),
                        createLinearGradient('rgba(255, 204, 153, 0.6)', 'rgba(255, 165, 0, 1)'),
                        createLinearGradient('rgba(255, 153, 153, 0.6)', 'rgba(255, 51, 51, 1)'),
                        createLinearGradient('rgba(192, 192, 192, 0.6)', 'rgba(105, 105, 105, 1)'),                    
                    ],
                    borderColor: [
                        'rgba(0, 0, 0, 0)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Equipment Conditions'
                }
            }
        });
        function createLinearGradient(color1, color2) {
            var ctx = pieCtx;
            var gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, color1);
            gradient.addColorStop(1, color2);
            return gradient;
        }

        // Bar Graph
        var barCtx = document.getElementById('barGraph').getContext('2d');
        var barGraph = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Borrowed', 'Available', 'Unavailable'],
                datasets: [{
                    label: 'Equipments',
                    data: [10, 15, 8],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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
