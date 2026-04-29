@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @include('includes.messages')

    <div class="d-flex flex-row justify-content-between align-items-center mb-4 gap-3">
        <!-- Heading -->
        <div>
            <h4 class="m-0">Listing Of Subscription</h4>
        </div>

        <!-- Add Button -->
        <div>
            @can('create subscriptions')
                <a href="{{ route('subscriptions.create') }}" class="btn btn-sm text-white px-4 py-2"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius: 50px;">
                    <strong> + </strong> Subscription
                </a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Price (USD)</th>
                                    <th>No of Posts</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $subscription)
                                    <tr class="table-row-hover">
                         <td class="py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-2">
                                                    @php
                                                        // Check if category has a related user
                                                        $name = $subscription->user->name ?? 'N/A';

                                                        // Split name by space and get first letters of first and last words
                                                        $nameParts = explode(' ', $name);
                                                        $initials = '';
                                                        if (count($nameParts) > 1) {
                                                            $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[count($nameParts) - 1], 0, 1));
                                                        } else {
                                                            // Single word name
                                                            $initials = strtoupper(substr($name, 0, 1));
                                                        }
                                                    @endphp
                                                    {{ $initials }}
                                                </div>
                                                <span class="fw-semibold">{{ $subscription->user->id }}-{{ $name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="gradient-badge badge-subscription-gradient">
                                                <i class="fas fa-crown me-1" style="font-size:0.85rem;"></i>
                                                {{ $subscription->title ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="gradient-badge badge-price-gradient">
                                                {{ $subscription->price }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="gradient-badge badge-posts-gradient">
                                                <i class="fas fa-pencil-alt me-1" style="font-size:0.85rem;"></i>
                                                {{ $subscription->post_number }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="gradient-badge badge-start-gradient">
                                                <i class="fas fa-calendar-alt me-1" style="font-size:0.85rem;"></i>
                                                {{ $subscription->start_date->format('d M Y') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="gradient-badge badge-end-gradient">
                                                <i class="fas fa-calendar-check me-1" style="font-size:0.85rem;"></i>
                                                {{ $subscription->end_date->format('d M Y') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="gradient-badge badge-duration-gradient">
                                                {{ max(0, $subscription->start_date->diffInDays($subscription->end_date) + 1) }}
                                                days
                                            </span>
                                        </td>
                                        <td>
                                            @if(now()->lt($subscription->start_date))
                                                <span class="gradient-badge badge-upcoming-gradient">
                                                    <i class="fas fa-clock me-1" style="font-size:0.75rem;"></i>
                                                    Not Started
                                                </span>
                                            @elseif(now()->gt($subscription->end_date))
                                                <span class="gradient-badge badge-end-gradient">
                                                    <i class="fas fa-times-circle me-1" style="font-size:0.75rem;"></i>
                                                    Expired
                                                </span>
                                            @else
                                                @if($subscription->user->user_type === 'user')
                                                    <span class="gradient-badge badge-active-gradient">
                                                        <i class="fas fa-check-circle me-1" style="font-size:0.75rem;"></i>
                                                        Renewed
                                                    </span>
                                                @else
                                                    <span class="gradient-badge badge-active-gradient">
                                                        <i class="fas fa-check-circle me-1" style="font-size:0.75rem;"></i>
                                                        Active
                                                    </span>
                                                @endif
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-1">
                                                @can('show subscriptions')
                                                    <a href="{{ route('subscriptions.show', $subscription->id) }}"
                                                        class="action-btn view-btn-gradient" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan

                                                @can('edit subscriptions')
                                                    <a href="{{ route('subscriptions.edit', $subscription->id) }}"
                                                        class="action-btn edit-btn-gradient" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('delete subscriptions')
                                                    <form id="delete-form-{{ $subscription->id }}"
                                                        action="{{ route('subscriptions.destroy', $subscription->id) }}"
                                                        method="POST" class="d-inline m-0 p-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete({{ $subscription->id }})"
                                                            class="action-btn delete-btn-gradient" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
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