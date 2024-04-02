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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var conditionsData = {!! json_encode($conditions) !!};
</script>
<script type="text/javascript" src="/js/home.js"></script>
@endsection

@section('content')
@include('layouts.message')

<div class="row">
    <div class="col-md-3">
        <div class="card">
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
    </div>
    <div class="col-md-3">
        <div class="card">
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
        </div>
    </div>
</div>

{{-- <div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <canvas id="equipmentPieChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div> --}}
@endsection
