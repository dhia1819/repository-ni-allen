@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_css')
    <style type="text/css">
        td { font-size: 0.75rem !important }
    </style>
@endsection
@section('page_script')
    <script type="text/javascript" src="/js/equipment.js"></script>
@endsection
@section('content')

<div class="row mt-2">
    <div class="col-md-12">
<a href="{{ route('equipment.back') }}" class="btn bg-gradient-danger trigger-modal btn-md">
    <i class="fa fa-arrow-left"></i> Back
</a>
        @include('layouts.message')
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-info">Add Equipment </h5>
        <br>
                <form method="POST" action="{{ route('equipment.store') }}" enctype="multipart/form-data" id="addEquipment">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="date_acquired">Date Acquired<span class="text-danger">&#x2022;</span></label>
                            <input type="date" class="form-control" id="date_acquired" name="date_acquired">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="property_no">Property Number<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="property_no" name="property_no">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="serial_no">Serial Number<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="serial_no" name="serial_no">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="form-label" for="equipment_name">Equipment Name <span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="equipment_name" name="equipment_name">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="category">Category<span class="text-danger">&#x2022;</span></label>
                            <select class="form-control select select2-create" id="category" name="category">
                                <option selected disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="conditions">Conditions<span class="text-danger">&#x2022;</span></label>
                            <select class="form-control select select2-create" id="conditions" name="conditions">
                                <option selected disabled>Select Condition</option>
                                <option value="Good" >Good</option>
                                <option value="Fair">Fair</option>
                                <option value="Poor">Poor</option>
                                <option value="Damaged">Damaged</option>
                                <option value="Obsolete">Obsolete</option>
                                <option value="Unusable">Unusable</option>
                                <option value="Under Maintenance">Under Maintenance</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="form-label" for="unit_of_measure">Unit of Measure<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="unit_of_measure" name="unit_of_measure">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="quantity">Quantity per Property Card<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="quantity" name="quantity">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="value">Value<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="value" name="value">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="form-label" for="description">Description<span class="text-danger">&#x2022;</span></label>
                            <textarea class="form-control" id="Description" name="Description"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label" for="remarks">Remarks<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="remarks" name="remarks">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="image">Image <span class="text-info">(Optional | max: 40MB)</span></label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn bg-gradient-success btn-submit float-end">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
