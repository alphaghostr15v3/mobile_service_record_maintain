@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold mb-0">Edit Customer Record</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('customers.index')}}">Customers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit #{{$customer->id}}</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="glass-card">
            <form action="{{route('customers.update', $customer->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Customer Name</label>
                        <input type="text" name="name" class="form-control rounded-3 py-2" value="{{$customer->name}}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Aadhar Number</label>
                        <input type="text" name="aadhar_number" class="form-control rounded-3 py-2" value="{{$customer->aadhar_number}}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Mobile Number</label>
                        <input type="text" name="mobile_number" class="form-control rounded-3 py-2" value="{{$customer->mobile_number}}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Mobile Device Name</label>
                        <input type="text" name="mobile_name" class="form-control rounded-3 py-2" value="{{$customer->mobile_name}}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Work Type</label>
                        <input type="text" name="work" class="form-control rounded-3 py-2" value="{{$customer->work}}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">IMEI Number</label>
                        <input type="text" name="imei_number" class="form-control rounded-3 py-2" value="{{$customer->imei_number}}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Invoice/Bill No.</label>
                        <input type="text" name="invoice_bill" class="form-control rounded-3 py-2" value="{{$customer->invoice_bill}}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Entry Date</label>
                        <input type="date" name="date" class="form-control rounded-3 py-2" value="{{$customer->date}}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Current Document</label>
                        <div>
                            @if($customer->document)
                                <a href="{{ Storage::url($customer->document) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-eye me-1"></i> View Document
                                </a>
                            @else
                                <span class="text-muted small">No document uploaded</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Update Document</label>
                        <input type="file" name="document" class="form-control rounded-3 py-2">
                        <div class="form-text small text-muted">PDF, JPG, PNG (Max 5MB)</div>
                    </div>
                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="fas fa-save me-2"></i> Update Record
                        </button>
                        <a href="{{route('customers.index')}}" class="btn btn-light ms-2 px-5">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
