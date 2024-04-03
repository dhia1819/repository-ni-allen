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

<div class="row">
    <div class="col-md-12">
    
<a href="{{ route('equipment.back') }}" class="btn bg-gradient-danger trigger-modal btn-md mt-2">
    <i class="fa fa-arrow-left"></i> Back
</a>
        @include('layouts.message')

    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-info">Update Equipment </h5>
        <br>
        <form method="POST" action="{{ route('equipment.update', ['id' => $equipment->id]) }}" enctype="multipart/form-data" id="editEquipment">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label" for="image">Image<span class="text-danger">&#x2022;</span></label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="image-preview-container text-center mt-2">
                                        <img id="image-preview" src="{{ $equipment->image ? asset('uploads/' . $equipment->image) : 'https://via.placeholder.com/100x100' }}" alt="Image Preview" class="img-fluid" style="width: 300px; height: 300px;">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="date_acquired">Date Acquired<span class="text-danger">&#x2022;</span></label>
                                    <input type="date" class="form-control" id="date_acquired" name="date_acquired" value="{{ $equipment->date_acquired }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="equipment_name">Equipment Name <span class="text-danger">&#x2022;</span></label>
                                    <input type="text" class="form-control" id="equipment_name" name="equipment_name" value="{{ $equipment->equipment_name }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="category">Category<span class="text-danger">&#x2022;</span></label>
                                    <select class="form-control select select2-update" id="category" name="category">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        @if($category->status==0)
                                            @continue
                                            @endif
                                            @if($category->status ==0)
                                                @continue
                                            @endif
                                            <option value="{{ $category->id }}" {{ $category->id == $equipment->category ? 'selected' : '' }}>{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="conditions">Condition<span class="text-danger">&#x2022;</span></label>
                                    <select class="form-control select select2-update" id="conditions" name="conditions">
                                        <option selected disabled>{{ $equipment->conditions }}</option>
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
                                <div class="col-md-6">
                                    <label class="form-label" for="property_no">Property Number<span class="text-danger">&#x2022;</span></label>
                                    <input type="text" class="form-control" id="property_no" name="property_no" value="{{ $equipment->property_no }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="serial_no">Serial Number<span class="text-danger">&#x2022;</span></label>
                                    <input type="text" class="form-control" id="serial_no" name="serial_no" value="{{ $equipment->serial_no }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="quantity">Quantity per Property Card<span class="text-danger">&#x2022;</span></label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $equipment->quantity }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="value">Value<span class="text-danger">&#x2022;</span></label>
                                    <input type="text" class="form-control" id="value" name="value" value="{{ $equipment->value }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="unit_of_measure">Unit of Measure<span class="text-danger">&#x2022;</span></label>
                                    <input type="text" class="form-control" id="unit_of_measure" name="unit_of_measure" value="{{ $equipment->unit_of_measure }}">
                                </div>                                
                                <div class="col-md-6">
                                    <label class="form-label" for="remarks">Remarks<span class="text-danger">&#x2022;</span></label>
                                    <input type="text" class="form-control" id="remarks" name="remarks" value="{{ $equipment->remarks }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="form-label" for="description">Description<span class="text-danger">&#x2022;</span></label>
                                    <textarea class="form-control" id="Description" name="Description">{{ $equipment->Description }}</textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-gradient-success btn-submit float-end">
                                       <i class="fa fa-paper-plane"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
