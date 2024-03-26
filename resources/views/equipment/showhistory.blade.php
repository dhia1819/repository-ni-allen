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

                @forelse ($transactions as $transaction)
                    <div class="row">
                        <label class="text-muted"><h>Transaction Information<span class="text-danger">&#x2022;</span></h4></label> 

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
                            <label class="form-label" for="borrowed_by">Borrowed Person<span class="text-danger">&#x2022;</span></label>
                           <p> {{ $transaction->borrowed_by }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="office">Office<span class="text-danger">&#x2022;</span></label>
                            <p>{{ $transaction->office_name }}</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label" for="date_borrowed">Date<span class="text-danger">&#x2022;</span></label>
                            <p>{{ \Carbon\Carbon::parse($transaction->date_borrowed)->format('F j, Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="date_returned">Return Date</label>
                            <p>{{ \Carbon\Carbon::parse($transaction->date_returned)->format('F j, Y') }}</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="form-label" for="release_by">Release by:<span class="text-danger">&#x2022;</span></label>
                            <p>{{ $transaction->release_by }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('borrow.phase', ['id' => $transaction->transaction_id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-3">
                            <h5>Return Form</h5>
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" id="equipment_id" name="equipment_id" value="{{ $transaction->transaction_id }}" readonly>
                                <label class="form-label" for="date_borrowed">Returned Date<span class="text-danger">&#x2022;</span></label>
                                <p>{{ \Carbon\Carbon::parse($transaction->returned_date)->format('F j, Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="date_returned">Returned By<span class="text-danger">&#x2022;</span></label>
                                <p>{{ $transaction->returned_by }}</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label" for="date_returned">Receive By<span class="text-danger">&#x2022;</span></label>
                                <p>{{ $transaction->received_by }}</p>
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
