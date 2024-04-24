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
        <a href="{{ route('return') }}" class="btn bg-gradient-danger trigger-modal btn-md">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        @include('layouts.message')
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                @forelse ($transactions as $transaction)
                    <div class="row">
                        <label class="text-info"><h>Transaction Information<span class="text-danger">&#x2022;</span></h4></label> 

                        <div class="col-md-5">
                            <label class="form-label" for="equipment_name">Equipment Name <span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="equipment_name" name="equipment_name" value="{{ $transaction->equipment_name }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="serial_no">Serial no# <span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="serial_no" name="serial_no" value="{{ $transaction->serial_no }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="property_no">Property no#<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="property_no" name="property_no" value="{{ $transaction->property_no }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label" for="borrowed_by">Borrower<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="borrowed_by" name="borrowed_by" value="{{ $transaction->borrowed_by }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="office">Office<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="office_name" name="office_name" value="{{ $transaction->office_name }}" readonly>                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label" for="date_borrowed">Date<span class="text-danger">&#x2022;</span></label>
                            <input type="datetime-local" class="form-control" id="date_borrowed" name="date_borrowed" value="{{ $transaction->date_borrowed }}" readonly>

                            {{-- <p>{{ \Carbon\Carbon::parse($transaction->date_borrowed)->format('F j, Y') }}</p> --}}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="date_returned">Expected Return Date</label>
                            <input type="datetime-local" class="form-control" id="date_returned" name="date_returned" value="{{ $transaction->date_returned }}" readonly>

                            {{-- <p>{{ \Carbon\Carbon::parse($transaction->date_returned)->format('F j, Y') }}</p> --}}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="form-label" for="release_by">Released by:<span class="text-danger">&#x2022;</span></label>
                            <input type="text" class="form-control" id="release_by" name="release_by" value="{{ $transaction->release_by }}" readonly>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('borrow.phase', ['id' => $transaction->transaction_id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-3">
                            <h5>Return Form</h5>
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" id="equipment_id" name="equipment_id" value="{{ $transaction->transaction_id }}" readonly>
                                <label class="form-label" for="date_borrowed">Return Date<span class="text-danger">&#x2022;</span></label>
                                <input type="datetime-local" class="form-control" id="returned_date" name="returned_date" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="date_returned">Returned By<span class="text-danger">&#x2022;</span></label>
                                <input type="text" class="form-control" id="returned_by" name="returned_by">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label" for="recieved_by">Recieved By<span class="text-danger">&#x2022;</span></label>
                                <select class="form-control select2 select2-return" id="received_by" name="received_by">
                                    <option disabled selected>Select Employee</option> <!-- Disabled and selected placeholder option -->
                                    @foreach($employees as $employee)
                                        @if($employee->status == 1)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->fullName }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn bg-gradient-success btn-submit float-end">
                                    <i class="fa fa-paper-plane"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                @empty
                    <p>No transaction found.</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12 mt-3">
                    <label class="text-info">Uploaded File Preview</label>
                    @foreach ($transactions as $transaction)
                        @if ($transaction->upload_file)
                            @if (Str::endsWith($transaction->upload_file, ['.jpg', '.jpeg', '.png', '.gif']))
                                <img src="{{ asset('uploads/' . $transaction->upload_file) }}" alt="Image Preview" style="max-width: 100%">
                            @elseif (Str::endsWith($transaction->upload_file, '.pdf'))
                                <embed src="{{ asset('uploads/' . $transaction->upload_file) }}" type="application/pdf" width="100%" height="600px">
                            @endif
                        @else
                            <p>No file uploaded.</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
