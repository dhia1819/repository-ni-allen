@extends('layouts.master')
@section('page_name', $page['name'])
@section('page_css')
    <style type="text/css">
        td { font-size: 0.75rem !important }
    </style>
@endsection
@section('page_script')
    <script type="text/javascript" src="/js/equipment.js"></script>
    <script>
    document.getElementById('upload_file').addEventListener('change', function() {
        var fileInput = document.getElementById('upload_file');
        var submitButtonWrapper = document.getElementById('submitButtonWrapper');

        if (fileInput.files.length > 0) {
            submitButtonWrapper.style.display = 'block';
        } else {
            submitButtonWrapper.style.display = 'none';
        }
    });
</script>
@endsection
@section('content')

<div class="row mt-2">
    <div class="col-md-12">
        <a href="{{ route('history') }}" class="btn bg-gradient-danger trigger-modal btn-md">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        @include('layouts.message')
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                @if($transaction)
    <div class="row">
                        <div class="row">
                            <div class="col">
                                <h5 class="text-info text-sm">Transaction Information</h5>
                            </div>
                            <div class="col-auto position-relative" style="width: 40px; height: 40px;">
                                <a href="{{ route('equipment.show', $transaction->equipment_id) }}" type="button" class="icon icon-shape pt-1 icon-sm shadow border-radius-md bg-gradient-success text-center position-absolute top-50 start-50 translate-middle" style="width: 100%; height: 100%;">
                                  <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
                              </a>
                            </div>
                          </div>
                        <div class="col-md-5">
                            <label class="form-label" for="equipment_name">Equipment Name <span class="text-danger">&#x2022;</span></label>
                            <label type="text" class="form-control" id="equipment_name" name="equipment_name"  readonly> {{ $transaction->equipment->equipment_name }}</label>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label" for="serial_no">Serial Number<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="serial_no" name="serial_no" value="{{ $transaction->equipment->serial_no }}" readonly>
                        </div>

                        
                        <div class="col-md-4">
                            <label class="form-label" for="property_no">Property Number<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="property_no" name="property_no" value="{{ $transaction->equipment->property_no }}" readonly>
                        </div>
                    </div>
                   
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label" for="borrowed_by">Borrower<span class="text-danger">&#x2022;</span></label>
                            <label type="text" class="form-control" id="borrowed_by" name="borrowed_by"  readonly> {{ $transaction->borrowed_by }} </label>
                            {{-- <p> {{ $transaction->borrowed_by }}</p> --}}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="office">Office<span class="text-danger">&#x2022;</span></label>
                            <label type="text" class="form-control" id="office_name" name="office_name"  readonly> {{ $transaction->office->office }} </label>
                            {{-- <p>{{ $transaction->office_name }}</p> --}}
                        </div>
                    </div>
                   
                    <div class="row mt-3">
                        @php
                $formattedDate = \Carbon\Carbon::parse($transaction->date_borrowed)->format('Y-m-d h:i A');
            @endphp
            
            <div class="col-md-6">
                <label class="form-label" for="date_borrowed">Borrow Date<span class="text-danger">&#x2022;</span></label>
                <label class="form-control" id="date_borrowed" name="date_borrowed" readonly>
                    {{ $formattedDate }}
                </label>
            </div>
            
                        {{-- <div class="col-md-6">
                            <label class="form-label" for="date_returned">Expected Return Date</label>
                            <input type="datetime-local" class="form-control" id="date_returned" name="date_returned" value="{{ $transaction->date_returned }}" readonly>
                        </div> --}}
            
                        @php
                        $formattedReturn = \Carbon\Carbon::parse($transaction->date_returned)->format('Y-m-d h:i A');
                    @endphp
                    
                    <div class="col-md-6">
                        <label class="form-label" for="date_returned">Expected Return Date<span class="text-danger">&#x2022;</span></label>
                        <label class="form-control" id="date_returned" name="date_returned" readonly>
                            {{ $formattedReturn }}
                        </label>
                    </div>

                        <div class="col-md-12">
                            <label class="form-label" for="release_by">Released by<span class="text-danger">&#x2022;</span></label>
                            <label type="text" class="form-control" id="release_by" name="release_by"  readonly>
                                {{ $transaction->releaseBy->fullName}} 
                            </label>

                            {{-- <p>{{ $transaction->release_by }}</p> --}}
                        </div>
                    </div>
                
                    
                        <div class="row mt-3">
                            <h5 class="text-info text-sm">Return Details</h5>
                            @php
            $formattedActual = \Carbon\Carbon::parse($transaction->returned_date)->format('Y-m-d h:i A');
        @endphp
        
        <div class="col-md-6">
            <label class="form-label" for="returned_date">Date Returned <span class="text-danger">&#x2022;</span></label>
            <label class="form-control" id="returned_date" name="returned_date" readonly>
                {{ $formattedActual }}
            </label>
        

                                {{-- <p>{{ \Carbon\Carbon::parse($transaction->returned_date)->format('F j, Y') }}</p> --}}
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="date_returned">Returned By<span class="text-danger">&#x2022;</span></label>
                                <label type="text" class="form-control" id="returned_by" name="returned_by"  readonly> {{ $transaction->returned_by }} </label>

                                {{-- <p>{{ $transaction->returned_by }}</p> --}}
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label" for="date_returned">Received by<span class="text-danger">&#x2022;</span></label>
                                <label type="text" class="form-control" id="received_by" name="received_by"  readonly> {{ $transaction->receivedBy->fullName }} </label>

                                {{-- <p>{{ $transaction->received_by }}</p> --}}
                            </div>
                        </div>
                        @else
                            <p>No transaction found.</p>
                        @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12 mt-3">
                    {{-- <label class="text-info"></label> --}}
                    
                    @if($transaction)

                        @if ($transaction->upload_file)
                        @if (Str::endsWith($transaction->upload_file, ['.jpg', '.jpeg', '.png', '.gif', 'jfif', '.JPG', '.JPEG', '.PNG', '.GIF', '.JFIF']))
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="text-info text-sm">Uploaded File Preview</h4>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ asset('uploads/' . $transaction->upload_file) }}" download="image.jpg" class="btn btn-sm bg-gradient-success btn-submit mt-2 float-end" role="button"><i class="fa fa-download"></i></a>    
                                </div>
                            </div>    
                            <img src="{{ asset('uploads/' . $transaction->upload_file) }}" alt="Image Preview" style="max-width: 100%">
                            @elseif (Str::endsWith($transaction->upload_file, '.pdf'))
                                <h4 class="text-info text-sm">Uploaded File Preview</h4>
                                <embed src="{{ asset('uploads/' . $transaction->upload_file) }}" type="application/pdf" width="100%" height="600px">
                             
                            @endif
                        @else
                            <h4 class="text-info text-sm">Uploaded File Preview</h4>
                            <p>No file uploaded.</p>
                        @endif
                    
                </div>
                <div class="row mt-2">
                <form method="POST" action="{{route('ud.file', ['id' => $transaction->id])}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-10">
                <label class="form-label" for="upload_file">Update file</label>
                <input type="file" class="form-control" id="upload_file" name="upload_file" accept="image/jpeg, image/png, application/pdf">
                <p style="font-size: 0.75rem" class="text-muted">Note: Upload only <strong class="text-info">ONE (1)</strong> file | <strong class="text-info">(max: 40MB)</strong></p>
            </div>
            <div class="col-md-1 float-end mx-0 px-0 mr-2" id="submitButtonWrapper" style="display: none;">
                <br>
                <button type="submit" class="btn bg-gradient-success btn-submit mt-1">
                    <i class="fa fa-upload"></i>
                </button>
            </div>
        </div>
    </form>
</div>
@endif
            </div>
        </div>
    </div>
</div>

@endsection