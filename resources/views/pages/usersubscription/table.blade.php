@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

<style>
    .dashboard-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 10px;
        width: 100%;
        max-width: 1700px;
        margin-bottom: 10px;
    }

    .stat-card {
        position: relative;
        padding: 10px 20px;
        border-radius: 10px;
        color: white;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        margin-bottom: 2px;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }

    .icon-bg {
        position: absolute;
        font-size: 100px;
        right: -20px;
        bottom: -20px;
        opacity: 0.15;
        transition: all 0.4s ease;
    }

    .stat-card:hover .icon-bg {
        transform: rotate(15deg) scale(1.1);
        opacity: 0.2;
    }

    .stat-card i:not(.icon-bg) {
        font-size: 25px;
        margin-bottom: 15px;
        display: block;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }

    .stat-card h6 {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
        opacity: 0.95;
    }

    .stat-card h3 {
        font-size: 32px;
        font-weight: 500;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    /* Color themes with enhanced gradients */
    .card-purple {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .card-blue {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .card-orange {
        background: linear-gradient(135deg, #ffb347 0%, #ff8c42 100%);
    }

    .card-green {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    /* Glow effects */
    .glow-purple {
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }

    .glow-purple:hover {
        box-shadow: 0 20px 50px rgba(102, 126, 234, 0.6);
    }

    .glow-blue {
        box-shadow: 0 10px 30px rgba(79, 172, 254, 0.4);
    }

    .glow-blue:hover {
        box-shadow: 0 20px 50px rgba(79, 172, 254, 0.6);
    }

    .glow-orange {
        box-shadow: 0 10px 30px rgba(255, 140, 66, 0.4);
    }

    .glow-orange:hover {
        box-shadow: 0 20px 50px rgba(255, 140, 66, 0.6);
    }

    .glow-green {
        box-shadow: 0 10px 30px rgba(17, 153, 142, 0.4);
    }

    .glow-green:hover {
        box-shadow: 0 20px 50px rgba(17, 153, 142, 0.6);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .dashboard-row {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 10px;
        }

        .stat-card {
            padding: 25px 20px;
        }

        .stat-card h3 {
            font-size: 36px;
        }

        .icon-bg {
            font-size: 90px;
        }
    }
</style>

@section('content')
    @include('includes.messages')

    <div class="d-flex flex-row justify-content-between align-items-center mb-2 gap-3">
        <div>
            <h4 class="m-0">Subscribed Plans</h4>
        </div>
        <div>
            <a href="{{ route('subscriptions.upgrade') }}" class="btn btn-sm text-white px-4 py-2"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius: 50px;">
                <i class="fas fa-arrow-circle-up me-2"></i> <strong>Upgrade Plan</strong>
            </a>

        </div>
    </div>
    <div class="dashboard-row">
        <!-- Total Subscription -->
        <div class="stat-card card-purple glow-purple">
            <i class="fa-solid fa-crown"></i>
            <i class="fa-solid fa-crown icon-bg"></i>
            <h6>Total Subscriptions</h6>
            <h3>{{ $userSubscriptionTotal }}</h3>
        </div>

        <!-- Total Posts -->
        <div class="stat-card card-blue glow-blue">
            <i class="fa-solid fa-file-lines"></i>
            <i class="fa-solid fa-file-lines icon-bg"></i>
            <h6>Allowed Posts</h6>
            <h3>{{ $totalAllowedPosts }}</h3>
        </div>

        <!-- Used Posts -->
        <div class="stat-card card-orange glow-orange">
            <i class="fa-solid fa-chart-line"></i>
            <i class="fa-solid fa-chart-line icon-bg"></i>
            <h6>Posted</h6>
            <h3>{{ $usedPosts }}</h3>
        </div>

        <!-- Remaining Posts -->
        <div class="stat-card card-green glow-green">
            <i class="fa-solid fa-hourglass-half"></i>
            <i class="fa-solid fa-hourglass-half icon-bg"></i>
            <h6>Remaining</h6>
            <h3>{{ $remainingPosts }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Plan</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Duration</th>
                                    <th>Price (USD)</th>
                                    <th>No of Posts</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $today = \Carbon\Carbon::today(); @endphp
                                @foreach($userSubscriptions as $sub)
                                    <tr class="table-row-hover">
                                        <td>
                                            <span class="gradient-badge badge-subscription-gradient">
                                                <i class="fas fa-crown me-1" style="font-size:0.85rem;"></i>
                                                {{ $sub->subscription->title ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="gradient-badge badge-start-gradient">
                                                <i class="fas fa-calendar-alt me-1" style="font-size:0.85rem;"></i>
                                                {{ $sub->start_date->format('d M Y') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="gradient-badge badge-end-gradient">
                                                <i class="fas fa-calendar-check me-1" style="font-size:0.85rem;"></i>
                                                {{ $sub->end_date->format('d M Y') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="gradient-badge badge-duration-gradient">
                                                {{ max(0, $sub->start_date->diffInDays($sub->end_date) + 1) }}
                                                Days
                                            </span>
                                        </td>
                                        <td>
                                            <span class="gradient-badge badge-posts-gradient">
                                                {{ $sub->price }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="gradient-badge badge-posts-gradient">
                                                {{ $sub->subscription->post_number ?? 0 }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($today->gt($sub->end_date) || $sub->start_date->gt($sub->end_date))
                                                <span class="gradient-badge  delete-btn-gradient reject-btn">
                                                    <i class="fas fa-times-circle me-1" style="font-size:0.75rem;"></i>
                                                    Expired
                                                </span>
                                            @elseif($sub->status === 'active')
                                                <span class="gradient-badge badge-active-gradient">
                                                    <i class="fas fa-check-circle me-1" style="font-size:0.75rem;"></i>
                                                    Active
                                                </span>
                                            @else
                                                <span class="gradient-badge badge-inactive-gradient">
                                                    <i class="fas fa-minus-circle me-1" style="font-size:0.75rem;"></i>
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($today->gt($sub->end_date) || $sub->start_date->gt($sub->end_date))
                                                <form action="{{ route('subscriptions.renew', $sub->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-primary">Renew</button>
                                                </form>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>

@endpush

@push('plugin-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

@endpush