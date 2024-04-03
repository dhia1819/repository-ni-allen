@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_css')
    <style type="text/css">
        td { font-size: 0.75rem !important }
        .image-preview-container {
            display: flex;
            justify-content: center;
        }
        #image-preview {
            width: 100px;
            height: 100px;
        }
    </style>
@endsection
@section('content')

<div class="row mt-2">
    <div class="col-md-12">
        <a href="{{ route('equipment.back') }}" class="btn bg-gradient-danger trigger-modal btn-md">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        <a href="{{ route('equipment.edit', ['id' => $equipment->id]) }}" class="btn bg-gradient-success trigger-modal btn-md">
            <i class="fa fa-pen"></i> Update Equipment
        </a>
        @include('layouts.message')
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-info">Equipment Details </h5>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        @if ($equipment->image)
                        {{-- <label class="form-label" for="image">Image<span class="text-danger">&#x2022;</span></label> --}}
                        <div class="image-preview-container text-center mt-2">
                            <img id="image-preview" src="{{ asset('uploads/' . $equipment->image) }}" alt="Image Preview" class="img-fluid" style="width: 300px; height: 300px;">
                        </div>
                    @endif
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="date_acquired">Date Acquired</label>
                                <input type="text" class="form-control" id="date_acquired" name="date_acquired" value="{{ $equipment->date_acquired }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="equipment_name">Equipment Name</label>
                                <input type="text" class="form-control" id="equipment_name" name="equipment_name" value="{{ $equipment->equipment_name }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="category">Category</label>
                                <input type="text" class="form-control" id="category" name="category" value="{{ $equipment->category_name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="category">Condition</label>
                                <input type="text" class="form-control" id="category" name="category" value="{{ $equipment->conditions }}" readonly>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label" for="serial_no">Serial Number</label>
                                <input type="text" class="form-control" id="serial_no" name="serial_no" value="{{ $equipment->serial_no }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="property_no">Property Number</label>
                                <input type="text" class="form-control" id="property_no" name="property_no" value="{{ $equipment->property_no }}" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label" for="quantity">Quantity per Property Card</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $equipment->quantity }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="value">Value</label>
                                <input type="text" class="form-control" id="value" name="value" value="{{ $equipment->value }}" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label" for="remarks">Unit of Measure</label>
                                <input type="text" class="form-control" id="unit_of_measure" name="unit_of_measure" value="{{ $equipment->unit_of_measure }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="remarks">Remarks</label>
                                <input type="text" class="form-control" id="remarks" name="remarks" value="{{ $equipment->remarks }}" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label" for="description">Description</label>
                                <textarea class="form-control" id="Description" name="Description" readonly>{{ $equipment->Description }}</textarea>

                                {{-- <input type="text" class="form-control" id="description" name="description" value="{{ $equipment->Description }}" readonly> --}}
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
