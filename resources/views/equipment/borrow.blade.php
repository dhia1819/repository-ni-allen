@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_css')
    <style type="text/css">
        td { font-size: 0.75rem !important }
    </style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="{{ route('equipment.back') }}" class="btn bg-gradient-danger trigger-modal btn-md">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        @include('layouts.message')
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-info">Borrow Form</h5>
                <form method="POST" action="{{ route('equipment.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" id="equipment_id" name="equipment_id" value="{{ $equipment->id }}">
                            <label class="form-label" for="equipment_name">Equipment Name <span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="equipment_name" name="equipment_name" value="{{ $equipment->equipment_name }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="serial_no">Serial Number <span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="serial_no" name="serial_no" value="{{ $equipment->serial_no}}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="property_no">Property Number<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="property_no" name="property_no" value="{{ $equipment->property_no }}" readonly>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label" for="borrowed_by">Borrowed By<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="borrowed_by" name="borrowed_by" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="office">Office<span class="text-danger">&#x2022;</span></label>
                            <select class="form-control select2 select2-create" id="office" name="office">
                                <option value="">Select Office</option>
                                @foreach($office as $offices)
                                    <option value="{{ $offices->id }}">{{ $offices->office }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label" for="date_borrowed">Date<span class="text-danger">&#x2022;</span></label>
                            <input type="datetime-local" class="form-control" id="date_borrowed" name="date_borrowed" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="date_returned">Expected Return Date</label>
                            <input type="datetime-local" class="form-control" id="date_returned" name="date_returned">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="form-label" for="release_by">Released by<span class="text-danger">&#x2022;</span></label>
                            <select class="form-control select2 select2-create"  id="release_by" name="release_by">
                                        <option value=""></option>
                                        @foreach($employees as $employee)
                                        @if($employee->status==0)
                                            @continue
                                            @endif
                                            <option value="{{ $employee->id }}" {{ $employee->id == $equipment->employee ? 'selected' : '' }}>{{ $employee->fullName }}</option>
                                        @endforeach
                                    </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary bg-gradient-success float-end">
                                <i class="fa fa-paper-plane">  </i>Submit</button>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="text-info">File Upload</h5> 
                <div class="col-md-12">
                    <label class="form-label" for="upload_file">ID and/or Request Letter<span class="text-danger">&#x2022;</span></label>
                    <input type="file" class="form-control" id="upload_file" name="upload_file" accept="image/jpeg, image/png, application/pdf">
                    <p style="font-size: 0.75rem" class="text-muted">Note: Upload only <strong>ONE (1)</strong> file</p>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".select2-create").select2({ dropdownParent: $('#office').parent() });
    });
</script>

@endsection
