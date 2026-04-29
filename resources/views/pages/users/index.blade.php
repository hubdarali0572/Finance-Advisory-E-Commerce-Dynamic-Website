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
            <h4 class="m-0">Listing Of Users</h4>
        </div>

        <!-- Add Button -->
        <div>
            @can('create user')
                <a href="{{ route('users.create') }}" class="btn btn-sm text-white px-4 py-2"
                    style=" background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius: 50px;">
                    <strong>+ </strong> User
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
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Subscription</th>
                                    <th>Status</th>
                                    <th>User Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="py-1 table-row-hover">
                                        {{-- User Name --}}
                                        <td class="py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-2">
                                                    @php
                                                        // Get user's name or fallback
                                                        $name = $user->name ?? 'N/A';

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
                                                <span class="fw-semibold">{{ $user->name ?? 'N/A' }}</span>
                                            </div>
                                        </td>

                                        {{-- Email --}}
                                        <td class="py-2">
                                            <span class="text-muted">
                                                <i class="fas fa-envelope me-1" style="font-size: 0.85rem;"></i>
                                                {{ $user->phone ?? '03000000000' }}
                                            </span>
                                        </td>
                                        <td class="py-2">
                                            <span class="text-muted">
                                                <i class="fas fa-envelope me-1" style="font-size: 0.85rem;"></i>
                                                {{ $user->email ?? 'example@email.com' }}
                                            </span>
                                        </td>

                                        {{-- Subscriptions Button --}}
                                        <td class="py-2">
                                            @if($user->subscriptions && $user->subscriptions->isNotEmpty())
                                                <button class="btn btn-sm btn-primary rounded-pill px-4 py-1" data-bs-toggle="modal"
                                                    data-bs-target="#userSubscriptionsModal{{ $user->id }}">
                                                    View Subscriptions ({{ $user->subscriptions->count() }})
                                                </button>
                                            @else
                                                <span class="badge rounded-pill text-white px-3 py-2"
                                                    style="background: linear-gradient(90deg, #ff7e5f, #feb47b);">
                                                    No Active Plan
                                                </span>
                                            @endif
                                        </td>


                                        {{-- Status --}}
                                        <td class="py-2">
                                            @php
                                                $statusClass = match ($user->status) {
                                                    'active' => 'badge-active-gradient',
                                                    'inactive' => 'badge-inactive-gradient',
                                                    'pending' => 'badge-pending-gradient',
                                                    default => 'badge-unknown-gradient'
                                                };
                                            @endphp
                                            <span class="gradient-badge {{ $statusClass }}">
                                                <i class="fas fa-circle me-1" style="font-size: 0.6rem;"></i>
                                                {{ ucfirst($user->status ?? 'Unknown') }}
                                            </span>
                                        </td>

                                        {{-- User Type --}}
                                        <td class="py-2">
                                            <span
                                                class="gradient-badge {{ $user->user_type == 'superAdmin' ? 'badge-superadmin-gradient' : 'badge-user-gradient' }}">
                                                <i class="fas fa-user-shield me-1" style="font-size: 0.85rem;"></i>
                                                {{ ucfirst($user->user_type ?? 'User') }}
                                            </span>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="py-1">
                                            <div class="d-flex justify-content-center align-items-center gap-1">
                                                @can('show user')
                                                    <a href="{{ route('users.show', $user->id) }}"
                                                        class="action-btn view-btn-gradient" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('edit user')
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="action-btn edit-btn-gradient" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete user')
                                                    <form id="delete-form-{{ $user->id }}"
                                                        action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        class="d-inline m-0 p-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete({{ $user->id }})"
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
                        @foreach($users as $user)
                            @if($user->subscriptions && $user->subscriptions->isNotEmpty())
                                <div class="modal fade" id="userSubscriptionsModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                                        <div class="modal-content border-0 shadow-lg rounded-4">

                                            <!-- Header -->
                                            <div class="modal-header bg-light rounded-top-4">
                                                <h5 class="modal-title fw-semibold">
                                                    <i class="bi bi-box-seam me-2 text-primary"></i>
                                                    {{ $user->name }}’s Subscriptions
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <div class="row g-4">

                                                    @foreach($user->subscriptions as $sub)
                                                        <div class="col-md-6">
                                                            <div class="card h-100 border-0 shadow-sm rounded-4">

                                                                <div class="card-body">

                                                                    <!-- Plan Title -->
                                                                    <h5 class="fw-bold mb-3 text-primary">
                                                                        <i class="bi bi-award me-2"></i>
                                                                        {{ $sub->subscription->title ?? 'No Plan' }}
                                                                    </h5>

                                                                    <!-- Status -->
                                                                    <p class="mb-2">
                                                                        <i
                                                                            class="bi bi-circle-fill me-2 
                                                                                    {{ $sub->status == 'active' ? 'text-success' : ($sub->status == 'expired' ? 'text-danger' : 'text-secondary') }}">
                                                                        </i>
                                                                        <strong>Status:</strong>
                                                                        <span
                                                                            class="badge rounded-pill
                                                                                    {{ $sub->status == 'active' ? 'bg-success' : ($sub->status == 'expired' ? 'bg-danger' : 'bg-secondary') }}">
                                                                            {{ ucfirst($sub->status) }}
                                                                        </span>
                                                                    </p>

                                                                    <!-- Dates -->
                                                                    <p class="mb-2 text-muted small">
                                                                        <i class="bi bi-calendar-check me-2 text-success"></i>
                                                                        <strong>Start:</strong>
                                                                        {{ $sub->start_date ? \Carbon\Carbon::parse($sub->start_date)->format('d M Y') : '-' }}
                                                                        <br>
                                                                        <i class="bi bi-calendar-x me-2 text-danger"></i>
                                                                        <strong>End:</strong>
                                                                        {{ $sub->end_date ? \Carbon\Carbon::parse($sub->end_date)->format('d M Y') : '-' }}
                                                                    </p>

                                                                    <!-- Stats -->
                                                                    <div class="d-flex gap-2 mt-3 flex-wrap">
                                                                        <span class="badge bg-light text-dark border">
                                                                            <i class="bi bi-file-earmark-text me-1 text-primary"></i>
                                                                            Posts: {{ $sub->subscription->post_number ?? 0 }}
                                                                        </span>
                                                                        <span class="badge bg-light text-dark border">
                                                                            <i class="bi bi-currency-dollar me-1 text-success"></i>
                                                                            Price: {{ $sub->subscription->price ?? 0 }}
                                                                        </span>
                                                                    </div>

                                                                </div>

                                                                <!-- Footer -->
                                                                <div class="card-footer bg-transparent border-0 pt-0">
                                                                    <a href="{{ route('user.subscription.table') }}"
                                                                        class="btn btn-outline-primary btn-sm w-100 rounded-pill">
                                                                        <i class="bi bi-eye me-1"></i>
                                                                        View Details
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>

                                            <!-- Footer -->
                                            <div class="modal-footer bg-light rounded-bottom-4">
                                                <button type="button" class="btn btn-secondary rounded-pill px-4"
                                                    data-bs-dismiss="modal">
                                                    <i class="bi bi-x-circle me-1"></i> Close
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach


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