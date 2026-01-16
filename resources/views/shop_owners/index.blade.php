@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">Shop Owners</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shop Owners</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('shop-owners.export-excel', request()->query()) }}" class="btn btn-success shadow-sm">
            <i class="fas fa-file-excel me-2"></i> Excel
        </a>
        <a href="{{ route('shop-owners.export-pdf', request()->query()) }}" class="btn btn-danger shadow-sm">
            <i class="fas fa-file-pdf me-2"></i> PDF
        </a>
        <a href="{{route('shop-owners.create')}}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-2"></i> Add Shop Owner
        </a>
    </div>
</div>

<div class="glass-card mb-4 border-0 shadow-sm">
    <form action="{{ route('shop-owners.index') }}" method="GET">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small text-muted text-uppercase fw-bold">Search</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Name, Mobile, IMEI..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted text-uppercase fw-bold">Date From</label>
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted text-uppercase fw-bold">Date To</label>
                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted text-uppercase fw-bold">Status</label>
                <select name="device_status" class="form-select">
                    <option value="">All Status</option>
                    <option value="Listed" {{ request('device_status') == 'Listed' ? 'selected' : '' }}>Listed</option>
                    <option value="Blacklisted" {{ request('device_status') == 'Blacklisted' ? 'selected' : '' }}>Blacklisted</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary px-4"><i class="fas fa-filter me-2"></i>Filter</button>
                <a href="{{ route('shop-owners.index') }}" class="btn btn-light px-4"><i class="fas fa-undo me-2"></i>Reset</a>
            </div>
        </div>
    </form>
</div>

<div class="glass-card">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Aadhar</th>
                    <th>Mobile</th>
                    <th>Device</th>
                    <th>Work</th>
                    <th>IMEI</th>
                    <th>Date</th>
                    <th>Device Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shopOwners as $owner)
                <tr>
                    <td>#{{$owner->id}}</td>
                    <td>
                        <div class="fw-bold">{{$owner->name}}</div>
                    </td>
                    <td>{{$owner->aadhar_number ?? 'N/A'}}</td>
                    <td>{{$owner->mobile_number}}</td>
                    <td>{{$owner->mobile_name}}</td>
                    <td>{{$owner->work ?? 'N/A'}}</td>
                    <td>{{$owner->imei_number ?? 'N/A'}}</td>
                    <td>{{$owner->date}}</td>
                    <td>
                        <span class="badge {{ $owner->device_status == 'Listed' ? 'badge-listed' : 'badge-blacklisted' }} rounded-pill px-3 py-2">
                            {{$owner->device_status}}
                        </span>
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{route('shop-owners.edit', $owner->id)}}" class="btn btn-sm btn-light border shadow-sm">
                                <i class="fas fa-edit text-primary"></i>
                            </a>
                            <form action="{{route('shop-owners.destroy', $owner->id)}}" method="POST" onsubmit="return confirm('Are you sure?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border shadow-sm">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted py-5">
                        <i class="fas fa-store fa-3x mb-3 d-block opacity-25"></i>
                        No shop owner records found. Click "Add Shop Owner" to get started.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $shopOwners->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
