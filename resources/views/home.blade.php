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
                <h5 class="card-title">Completed Transactons Per Office</h5>
                <div class="row">
                        <div class="col-12" id="filter">
                            <div class="row col-12">
                               
                  

                               
    
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
    // Assuming $officeCounts is passed from your controller to the view
    var officeCounts = {!! json_encode($officeCounts) !!};

    // Sort officeCounts by office_count in descending order
    officeCounts.sort(function(a, b) {
        return b.office_count - a.office_count;
    });

    var labels = [];
    var data = [];
    var backgroundColors = [];
    var otherCount = 0;
    var maxSlices = 5; // Number of top slices to display prominently

    // Process data to display only top N values and aggregate the rest as "Others"
    for (var i = 0; i < officeCounts.length; i++) {
        if (i < maxSlices) {
            labels.push(officeCounts[i].office_code); // Use office_code as label
            data.push(officeCounts[i].office_count); // Use office_count as data
            backgroundColors.push(generateShade('rgba(54, 162, 235, 0.7)', i, maxSlices));
        } else {
            otherCount += officeCounts[i].office_count; // Aggregate counts for "Others"
        }
    }

    // Add "Others" category if there are more than maxSlices categories
    if (officeCounts.length > maxSlices) {
        labels.push('Others');
        data.push(otherCount);
        backgroundColors.push(generateShade('rgba(54, 162, 235, 0.7)', maxSlices, maxSlices + 1));
    }

    // Pie Chart
    var pieCtx = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Transactions by Office',
                data: data,
                backgroundColor: backgroundColors,
                borderColor: 'rgba(0,0,0,0)',
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Total Transactions by Office'
            }
        }
    });

    // Function to generate shades of a base color
    function generateShade(baseColor, index, count) {
        var rgbValues = baseColor.match(/\d+/g); // Extract RGB values from baseColor
        var alpha = parseFloat(baseColor.match(/[^,]+(?=\))/)[0]); // Extract alpha value
        var factor = (index + 1) / count; // Factor to adjust color

        // Generate shade by adjusting RGB values
        var shade = 'rgba(' +
            Math.floor(rgbValues[0] * factor) + ',' +
            Math.floor(rgbValues[1] * factor) + ',' +
            Math.floor(rgbValues[2] * factor) + ',' +
            alpha +
            ')';

        return shade;
    }

    // Function to generate shades of a base color
    function generateShade(baseColor, index, count) {
        var rgbValues = baseColor.match(/\d+/g); // Extract RGB values from baseColor
        var alpha = parseFloat(baseColor.match(/[^,]+(?=\))/)[0]); // Extract alpha value
        var factor = (index + 1) / count; // Factor to adjust color

        // Generate shade by adjusting RGB values
        var shade = 'rgba(' +
            Math.floor(rgbValues[0] * factor) + ',' +
            Math.floor(rgbValues[1] * factor) + ',' +
            Math.floor(rgbValues[2] * factor) + ',' +
            alpha +
            ')';

        return shade;
    }
    
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
