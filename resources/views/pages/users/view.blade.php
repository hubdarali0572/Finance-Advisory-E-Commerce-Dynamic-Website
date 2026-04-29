@extends('layout.master')

@section('content')
    @include('includes.messages')
    <nav class="page-breadcrumb mb-4">
        <h4 class="fw-bold text-dark d-flex align-items-center">
            <i class="fas fa-user-circle me-2 text-primary"></i>
            User Profile Details
        </h4>
    </nav>

    <div class="row">
        <div class="col-12">
            <!-- Main Profile Card with Gradient Background -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative mb-4">
                <!-- Decorative Background Gradient -->
                <div class="position-absolute top-0 start-0 w-100"
                    style="height: 180px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                </div>

                <div class="card-body p-4 position-relative">
                    <div class="row g-4">

                        <!-- Profile Image Section -->
                        <div class="col-12 col-md-12 text-center" style="margin-top: 60px;">
                            @if($user->profile_photo && file_exists(public_path('userimages/' . $user->profile_photo)))
                                <div class="position-relative d-inline-block">
                                    <img src="{{ asset('userimages/' . $user->profile_photo) }}" alt="{{ $user->name }}"
                                        class="img-fluid rounded-circle border border-white border-4 shadow-lg"
                                        style="width:150px; height:150px; object-fit:cover;">
                                    <span class="position-absolute bottom-0 end-0 badge rounded-pill 
                                                      {{ $user->status == 'active' ? 'bg-success' : 'bg-danger' }}"
                                        style="padding: 8px 12px;">
                                        <i class="fas fa-circle" style="font-size: 8px;"></i>
                                    </span>
                                </div>
                            @else
                                <div class="d-inline-block position-relative">
                                    <div class="bg-white rounded-circle shadow-lg d-inline-flex align-items-center justify-content-center"
                                        style="width:150px; height:150px;">
                                        <i class="fas fa-user fa-4x text-primary"></i>
                                    </div>
                                    <span class="position-absolute bottom-0 end-0 badge rounded-pill 
                                                      {{ $user->status == 'active' ? 'bg-success' : 'bg-danger' }}"
                                        style="padding: 8px 12px;">
                                        <i class="fas fa-circle" style="font-size: 8px;"></i>
                                    </span>
                                </div>
                            @endif

                            <h3 class="fw-bold mt-3 mb-2 text-dark">{{ $user->name ?? 'N/A' }}</h3>
                            <p class="text-muted mb-3">
                                <i class="fas fa-shield-alt me-2"></i>
                                {{ ucfirst($user->user_type) ?? 'User' }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Information Cards Row -->
            <div class="row g-4 mb-4">

                <!-- Contact Information Card -->
                <div class="col-12 col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-3 p-3 me-3"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="fas fa-address-card fa-2x text-white"></i>
                                </div>
                                <h5 class="fw-bold mb-0">Contact Information</h5>
                            </div>

                            <div class="mb-3 p-3 bg-light rounded-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-white p-2 me-3 shadow-sm">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Email Address</small>
                                        <strong class="text-dark">{{ $user->email ?? 'N/A' }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 bg-light rounded-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-white p-2 me-3 shadow-sm">
                                        <i class="fas fa-phone-alt text-success"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Phone Number</small>
                                        <strong class="text-dark">{{ $user->phone ?? 'N/A' }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 p-3 rounded-3"
                                style="background: linear-gradient(135deg, {{ $user->status == 'active' ? '#d4edda' : '#f8d7da' }} 0%, {{ $user->status == 'active' ? '#c3e6cb' : '#f5c6cb' }} 100%);">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-white p-2 me-3 shadow-sm">
                                        <i
                                            class="fas fa-user-check {{ $user->status == 'active' ? 'text-success' : 'text-danger' }}"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Account Status</small>
                                        <strong class="{{ $user->status == 'active' ? 'text-success' : 'text-danger' }}">
                                            {{ ucfirst($user->status) }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subscription Information Cards -->
                @foreach($user->subscriptions as $sub)
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-3 p-3 me-3"
                                        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                        <i class="fas fa-crown fa-2x text-white"></i>
                                    </div>
                                    <h5 class="fw-bold mb-0">{{ $sub->subscription->title ?? 'No Plan' }}</h5>
                                </div>

                                <div class="mb-3 p-3 bg-light rounded-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-white p-2 me-3 shadow-sm">
                                                <i class="fas fa-pencil-alt text-success"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Posts Limit</small>
                                                <strong class="text-dark">{{ $sub->subscription->post_number ?? 0 }}</strong>
                                            </div>
                                        </div>
                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            {{ $sub->subscription->post_number ?? 0 }} Posts
                                        </span>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="p-3 rounded-3 text-center"
                                            style="background: linear-gradient(135deg, #d4f1f4 0%, #b5e7eb 100%);">
                                            <i class="fas fa-calendar-alt text-info d-block mb-2"></i>
                                            <small class="text-muted d-block">Start Date</small>
                                            <strong class="text-dark">
                                                {{ $sub->start_date ? \Carbon\Carbon::parse($sub->start_date)->format('d M Y') : '-' }}
                                            </strong>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 rounded-3 text-center"
                                            style="background: linear-gradient(135deg, #ffd6d6 0%, #ffb3b3 100%);">
                                            <i class="fas fa-calendar-check text-danger d-block mb-2"></i>
                                            <small class="text-muted d-block">Expire Date</small>
                                            <strong class="text-dark">
                                                {{ $sub->end_date ? \Carbon\Carbon::parse($sub->end_date)->format('d M Y') : '-' }}
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 text-center">
                                    <span class="badge 
                                @if($sub->status == 'active') bg-success
                                @elseif($sub->status == 'expired') bg-danger
                                @else bg-secondary @endif
                                rounded-pill px-3 py-2">
                                        {{ ucfirst($sub->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if(!$user->subscriptions || !$user->subscriptions->count())
                    <div class="col-12">
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-inbox fa-4x text-muted opacity-50"></i>
                            </div>
                            <h6 class="text-muted">No Subscriptions</h6>
                            <p class="text-muted small mb-0">User has no subscription plans</p>
                        </div>
                    </div>
                @endif


            </div>

            <!-- Action Buttons -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 text-center">
                    <a href="{{ route('users.index') }}" class="btn btn-lg rounded-pill me-2 px-4 shadow-sm"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                        <i class="fas fa-arrow-left me-2"></i> Back to List
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-lg rounded-pill px-4 shadow-sm"
                        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                        <i class="fas fa-edit me-2"></i> Edit Profile
                    </a>
                </div>
            </div>

        </div>
    </div>


@endsection