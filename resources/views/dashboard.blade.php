@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2 class="fw-bold">Welcome back, Admin!</h2>
        <p class="text-muted">Here's what's happening today.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="stat-card bg-blue mb-4 transition-hover">
            <h5>Shop Owners</h5>
            <h2 class="fw-bold">{{\App\Models\ShopOwner::count()}}</h2>
            <i class="fas fa-store"></i>
            <a href="{{route('shop-owners.index')}}" class="text-white text-decoration-none small">View details <i class="fas fa-chevron-right ms-1"></i></a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card bg-purple mb-4 transition-hover">
            <h5>Total Customers</h5>
            <h2 class="fw-bold">{{\App\Models\Customer::count()}}</h2>
            <i class="fas fa-users"></i>
            <a href="{{route('customers.index')}}" class="text-white text-decoration-none small">View details <i class="fas fa-chevron-right ms-1"></i></a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card bg-orange mb-4 transition-hover">
            <h5>Recent Records</h5>
            <h2 class="fw-bold">{{\App\Models\Customer::whereDate('created_at', today())->count() + \App\Models\ShopOwner::whereDate('created_at', today())->count()}}</h2>
            <i class="fas fa-clock"></i>
            <span class="small">Added today</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="glass-card">
            <h5 class="fw-bold mb-4">Recent Customer Records</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Device Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Customer::latest()->limit(5)->get() as $customer)
                        <tr>
                            <td>#{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->mobile_number}}</td>
                            <td>
                                <span class="badge {{ $customer->device_status == 'Listed' ? 'badge-listed' : 'badge-blacklisted' }} rounded-pill px-3 py-2">
                                    {{$customer->device_status}}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No records found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="glass-card h-100">
            <h5 class="fw-bold mb-4">Quick Links</h5>
            <div class="list-group list-group-flush">
                <a href="{{route('shop-owners.create')}}" class="list-group-item list-group-item-action border-0 px-0 d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 me-3">
                        <i class="fas fa-plus fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Add Shop Owner</h6>
                        <small class="text-muted">Register a new owner</small>
                    </div>
                </a>
                <a href="{{route('customers.create')}}" class="list-group-item list-group-item-action border-0 px-0 d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 me-3">
                        <i class="fas fa-user-plus fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Add Customer</h6>
                        <small class="text-muted">Record new purchase</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
