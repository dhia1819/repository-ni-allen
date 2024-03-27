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

    <a href="{{ route('equipment.edit', ['id' => $equipment->id]) }}" class="btn bg-gradient-success trigger-modal btn-md">
    <i class="fa fa-pencil"></i> Update Equipment
</a>

<a href="{{ route('equipment.back') }}" class="btn bg-gradient-danger trigger-modal btn-md">
    <i class="fa fa-arrow-left"></i> Back
</a>

            @include('layouts.message')
        
    
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Equipment Details </h5>
                <br>
                <div class="row mt-3">
    <div class="col-md-6">
    @if ($equipment->image)
        <label class="form-label" for="image">Image<span class="text-danger">&#x2022;</span></label>
      
        <div class="image-preview-container text-center mt-2">
            <img id="image-preview" src="{{ asset('uploads/' . $equipment->image) }}" alt="Image Preview" class="img-fluid" style="width: 100px; height: 100px;">
        </div>
        @endif
    </div>
</div>



                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label" for="equipment_name">Equipment Name:</label>
                        <p>{{ $equipment->equipment_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="category">Category:</label>
                        <p>{{ $equipment->category_name }}</p>

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label" for="description">Description:</label>
                        <p>{{ $equipment->Description }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="property_no">Property Number:</label>
                        <p>{{ $equipment->property_no }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label" for="serial_no">Serial Number:</label>
                        <p>{{ $equipment->serial_no }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="value">Value:</label>
                        <p>{{ $equipment->value }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label" for="quantity">Quantity:</label>
                        <p>{{ $equipment->quantity }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="remarks">Remarks:</label>
                        <p>{{ $equipment->remarks }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label" for="date_acquired">Date Acquired:</label>
                        <p>{{ $equipment->date_acquired }}</p>
                    </div>
                    <!-- Add more details fields here -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
