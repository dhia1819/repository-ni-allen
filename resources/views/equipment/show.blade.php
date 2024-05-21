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
    <div class="row g-0">
        <div class="col-md-8">
            <a href="{{ route('equipment.back') }}" class="btn bg-gradient-danger btn-md">
                <i class="fa fa-arrow-left"> </i>&nbsp;&nbsp;Back
            </a>
            <a href="{{ route('equipment.edit', ['id' => $equipment->id]) }}" class="btn bg-gradient-success btn-md">
                <i class="fa fa-pen"> </i> &nbsp;&nbsp;Update
            </a>
        </div>
        <div class="col-md-4">
            <form action="{{ route('archive', ['id' => $equipment->id]) }}" method="post">
                @csrf
                @method('POST')
                @if($equipment->status === 'Borrowed')
                <button type="button" class="btn bg-gradient-secondary btn-md float-right" disabled>
                    <i class="fas fa-archive"> </i>&nbsp;&nbsp;Archive
                </button>                                                    
                @else
                <button type="submit" class="btn bg-gradient-warning btn-md float-right">
                    <i class="fas fa-archive"> </i>&nbsp;&nbsp;Archive
                </button>
                @endif
            </form>
        </div>  
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
                                <label type="text" class="form-control" id="date_acquired" name="date_acquired" readonly>{{ $equipment->date_acquired }}</label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="equipment_name">Equipment Name</label>
                                <label type="text" class="form-control" id="equipment_name" name="equipment_name"  readonly> 
                                {{$equipment->equipment_name }}
                                </label>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label" for="category">Category</label>
                                <label type="text" class="form-control" id="category" name="category"  readonly> 
                                {{ $equipment->category->name }}</label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="category">Condition</label>
                                <label type="text" class="form-control" id="category" name="category"  readonly> 
                                {{ $equipment->conditions }}
                            </label>
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label" for="serial_no">Serial Number</label>
                                <label type="text" class="form-control" id="serial_no" name="serial_no"  readonly>
                                    {{ $equipment->serial_no }}
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="property_no">Property Number</label>
                                <label type="text" class="form-control" id="property_no" name="property_no"readonly>
                                {{ $equipment->property_no }}
                                </label>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label" for="quantity">Quantity per Property Card</label>
                                <label type="text" class="form-control" id="quantity" name="quantity"  readonly>
                                {{ $equipment->quantity }}
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="value">Value</label>
                                <label type="text" class="form-control" id="value" name="value"  readonly>
                                ₱ {{ number_format($equipment->value, 2, '.', ',') }}
                                </label>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label" for="remarks">Unit of Measure</label>
                                <label type="text" class="form-control" id="unit_of_measure" name="unit_of_measure"  readonly>
                                {{ $equipment->unit_of_measure }}
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="remarks">Remarks</label>
                                <label type="text" class="form-control" id="remarks" name="remarks"  readonly>
                                {{ $equipment->remarks }}
                                </label>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="form-label" for="description">Description</label>
                                <label class="form-control" id="Description" name="Description" readonly>{{ $equipment->Description }}</label>
                                
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
