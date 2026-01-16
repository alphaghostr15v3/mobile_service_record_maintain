@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold mb-0">Add New Customer</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('customers.index')}}">Customers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="glass-card">
            <div class="card-body p-4">
            <form action="{{route('customers.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Customer Name</label>
                        <input type="text" name="name" class="form-control rounded-3 py-2" placeholder="Enter customer name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Aadhar Number</label>
                        <input type="text" name="aadhar_number" class="form-control rounded-3 py-2" placeholder="12 digit aadhar">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Mobile Number</label>
                        <input type="text" name="mobile_number" class="form-control rounded-3 py-2" placeholder="10 digit mobile" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Mobile Device Name</label>
                        <input type="text" name="mobile_name" class="form-control rounded-3 py-2" placeholder="e.g. Samsung S24" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Work Type</label>
                        <input type="text" name="work" class="form-control rounded-3 py-2" placeholder="Describe the work (e.g. Battery Replacement)">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">IMEI Number</label>
                        <input type="text" name="imei_number" class="form-control rounded-3 py-2" placeholder="Enter IMEI">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Invoice/Bill No.</label>
                        <input type="text" name="invoice_bill" class="form-control rounded-3 py-2" placeholder="Enter Bill No.">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Entry Date</label>
                        <input type="date" name="date" class="form-control rounded-3 py-2" value="{{date('Y-m-d')}}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Device Status</label>
                        <select name="device_status" class="form-select rounded-3 py-2">
                            <option value="Listed">Listed</option>
                            <option value="Blacklisted">Blacklisted</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Upload Document</label>
                        <input type="file" name="document" class="form-control rounded-3 py-2">
                        <div class="form-text small text-muted">PDF, JPG, PNG (Max 5MB)</div>
                    </div>
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="fas fa-save me-2"></i> Save Record
                    </button>
                    <a href="{{route('customers.index')}}" class="btn btn-light ms-2 px-5">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
