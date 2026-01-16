@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold mb-0">Add New Shop Owner</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('shop-owners.index')}}">Shop Owners</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="glass-card">
            <div class="card-body p-4">
                <form action="{{route('shop-owners.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Owner Name</label>
                        <input type="text" name="name" class="form-control rounded-3 py-2" placeholder="Enter full name" required>
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
                        <input type="text" name="mobile_name" class="form-control rounded-3 py-2" placeholder="e.g. iPhone 15" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">Work Type</label>
                        <input type="text" name="work" class="form-control rounded-3 py-2" placeholder="Describe the work (e.g. Broken Display)">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase">IMEI Number</label>
                        <input type="text" name="imei_number" class="form-control rounded-3 py-2" placeholder="Enter IMEI">
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
                    <a href="{{route('shop-owners.index')}}" class="btn btn-light ms-2 px-5">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="glass-card bg-primary bg-opacity-10 border-0">
            <h5 class="fw-bold text-primary mb-3">Instructions</h5>
            <ul class="text-muted small ps-3">
                <li class="mb-2">Ensure all mandatory fields marked with * are filled.</li>
                <li class="mb-2">Aadhar and IMEI numbers are optional but recommended for tracking.</li>
                <li class="mb-2">Entry date defaults to today's date.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
