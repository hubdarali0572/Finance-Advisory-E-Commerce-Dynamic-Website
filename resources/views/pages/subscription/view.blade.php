@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/easymde/easymde.min.css') }}" rel="stylesheet" />

@endpush
@php
    use Carbon\Carbon;

    $start = Carbon::parse($subscription->start_date);
    $end = Carbon::parse($subscription->end_date);
    $durationDays = $start->diffInDays($end) + 1; // include both start & end
@endphp

@section('content')
    @include('includes.messages')
  <nav class="page-breadcrumb mb-4">
    <h4 class="fw-bold text-dark d-flex align-items-center">
        <i class="fas fa-crown me-2 text-warning"></i>
        Subscription Details
    </h4>
</nav>

<div class="row">
    <div class="col-12">

        <!-- Main Subscription Card -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative mb-4">
            <!-- Decorative Gradient -->
            <div class="position-absolute top-0 start-0 w-100"
                style="height: 180px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            </div>

            <div class="card-body p-4 position-relative">

                <div class="row g-4">

                    <!-- Subscription Info Header -->
                    <div class="col-12 text-center" style="margin-top: 60px;">
                        <h3 class="fw-bold text-dark mb-2">{{ $subscription->title ?? 'Subscription Title' }}</h3>
                        <span class="px-3 py-1 rounded-pill fw-semibold text-white"
                            style="background: {{ $subscription->is_active == 1 ? '#2FBF71' : ($subscription->is_active == 0 ? '#E5533D' : '#F4C430') }}">
                            {{ $subscription->is_active == 1 ? 'Active' : ($subscription->is_active == 0 ? 'Inactive' : 'Unknown') }}
                        </span>
                        <p class="text-white small mt-1">Managed Subscription Plan</p>
                    </div>

                    <!-- Info Cards Row -->
                    <div class="col-12 row g-4 mt-2">

                        <!-- User Info Card -->
                        <div class="col-12 col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-3 p-3 me-3"
                                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            <i class="fas fa-user-circle fa-2x text-white"></i>
                                        </div>
                                        <h5 class="fw-bold mb-0">User</h5>
                                    </div>
                                    <div class="mb-2 p-3 bg-light rounded-3">
                                        <small class="text-muted d-block">Name</small>
                                        <strong class="text-dark">{{ $subscription->user->name ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block">Number of Posts</small>
                                        <strong class="text-dark">{{ $subscription->post_number ?? 'N/A' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dates & Duration Card -->
                        <div class="col-12 col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-3 p-3 me-3"
                                            style="background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);">
                                            <i class="fas fa-clock fa-2x text-white"></i>
                                        </div>
                                        <h5 class="fw-bold mb-0">Subscription Period</h5>
                                    </div>
                                    <div class="row g-2 text-center">
                                        <div class="col-4 p-3 rounded-3" style="background: #eef6ff;">
                                            <small class="text-muted d-block">Start Date</small>
                                            <strong class="text-dark">{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y') }}</strong>
                                        </div>
                                        <div class="col-4 p-3 rounded-3" style="background: #f0f9ff;">
                                            <small class="text-muted d-block">End Date</small>
                                            <strong class="text-dark">{{ \Carbon\Carbon::parse($subscription->end_date)->format('d M Y') }}</strong>
                                        </div>
                                        <div class="col-4 p-3 rounded-3" style="background: #f9fafb;">
                                            <small class="text-muted d-block">Duration</small>
                                            <strong class="text-dark">{{ $subscription->start_date->diffInDays($subscription->end_date) + 1 }} Days</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Price Card -->
                        <div class="col-12 col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="rounded-3 p-3 me-3"
                                            style="background: linear-gradient(135deg, #16a34a 0%, #34d399 100%);">
                                            <i class="fas fa-dollar-sign fa-2x text-white"></i>
                                        </div>
                                        <h5 class="fw-bold mb-0">Price</h5>
                                    </div>
                                    <div class="fw-bold fs-5 text-success">{{ number_format($subscription->price, 2) }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Card -->
                        <div class="col-12 col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift"
                                style="background: linear-gradient(135deg, {{ $subscription->is_active == 1 ? '#d4edda' : '#f8d7da' }}, #ffffff);">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="rounded-3 p-3 me-3"
                                            style="background: {{ $subscription->is_active == 1 ? '#16a34a' : '#dc2626' }};">
                                            <i class="fas fa-toggle-on fa-2x text-white"></i>
                                        </div>
                                        <h5 class="fw-bold mb-0">Status</h5>
                                    </div>
                                    <div class="fw-bold fs-5 {{ $subscription->is_active == 1 ? 'text-success' : 'text-danger' }}">
                                        {{ $subscription->is_active == 1 ? 'Active' : 'Inactive' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description Card -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-4 hover-lift">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-3"><i class="fas fa-align-left me-1"></i> Description</h5>
                                    <div class="text-secondary fs-6" style="line-height:1.7;">
                                        {!! Illuminate\Support\Str::markdown($subscription->description) ?? 'N/A' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-center mt-4 gap-3">
                        <a href="{{ route('subscriptions.index') }}" class="btn btn-lg rounded-pill px-4 shadow-sm"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                            <i class="fas fa-arrow-left me-2"></i> Back
                        </a>
                        <a href="{{ route('subscriptions.edit', $subscription->id) }}" class="btn btn-lg rounded-pill px-4 shadow-sm"
                            style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                            <i class="fas fa-edit me-2"></i> Edit
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>



@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/easymde/easymde.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/ace-builds/ace.js') }}"></script>
    <script src="{{ asset('assets/plugins/ace-builds/theme-chaos.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/tinymce.js') }}"></script>
    <script src="{{ asset('assets/js/easymde.js') }}"></script>
    <script src="{{ asset('assets/js/ace.js') }}"></script>
@endpush