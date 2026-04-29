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

        <div>
            <h4 class="m-0">Listing Of Blogs</h4>
        </div>
        <div>
            @can('create posts')
                <a href="{{ route('blogs.create') }}" class="btn btn-sm text-white px-4 py-2"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius: 50px;">
                    <strong> + </strong> Blog
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
                                    @if (Auth::user()->user_type === 'superAdmin')
                                    <th>User</th>
                                    @endif
                                    <th>Category</th>
                                    <th>SubCategory </th>
                                    <th>views</th>
                                    <th>Likes</th>
                                    <th>shares</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Post Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($blogs as $blog)
                                <tr class="py-1">
                                    @if (Auth::user()->user_type === 'superAdmin')
                                          <td class="py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-2">
                                                    @php
                                                        // Check if category has a related user
                                                        $name = $blog->user->name ?? 'N/A';

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
                                                <span class="fw-semibold">{{ $blog->user->id }}-{{ $name }}</span>
                                            </div>
                                        </td>
                                    @endif
                                    <td class="py-2">{{ $blog->category->name ?? 'N/A' }}</td>
                                    <td class="py-2">{{ $blog->subCategory->name ?? 'N/A' }}</td>


                                    <td class="py-2">
                                        <span class="gradient-badge badge-views-gradient">
                                            <i class="fas fa-eye me-1" style="font-size:0.85rem;"></i>
                                            {{ $blog->views ?? 0 }}
                                        </span>
                                    </td>

                                    <td class="py-2">
                                        <span class="gradient-badge badge-shares-gradient">
                                            <i class="fas fa-share-alt me-1" style="font-size:0.85rem;"></i>
                                            {{ $blog->shares ?? 0 }}
                                        </span>
                                    </td>

                                    <td class="py-2">
                                        <span class="gradient-badge badge-likes-gradient">
                                            <i class="fas fa-heart me-1" style="font-size:0.85rem;"></i>
                                            {{ $blog->likes ?? 0 }}
                                        </span>
                                    </td>

                                    <td class="py-2">
                                        <span class="gradient-badge badge-start-gradient">
                                            <i class="fas fa-calendar-alt me-1" style="font-size:0.85rem;"></i>
                                            {{ \Carbon\Carbon::parse($blog->blog_date)->format('d M Y') }}
                                        </span>
                                    </td>

                                    <td class="py-2">
                                        <span class="gradient-badge 
                                            {{ $blog->status == 'approved' ? 'badge-active-gradient' :
                                            ($blog->status == 'rejected' ? 'badge-rejected-gradient' :
                                            'badge-pending-gradient') }}">
                                            <i class="fas fa-circle me-1" style="font-size:0.6rem;"></i>
                                            {{ ucfirst($blog->status ?? 'Pending') }}
                                        </span>
                                    </td>

                                    <td class="py-2">
                                        <span class="gradient-badge badge-start-gradient
                                            {{ $blog->publish_status == 'pushished' ? 'badge-active-gradient' :
                                            ($blog->publish_status == 'draft' ? 'badge-rejected-gradient' :
                                            'badge-pending-gradient') }}">
                                            <i class="fas fa-circle me-1" style="font-size:0.6rem;"></i>
                                            {{ ucfirst($blog->publish_status ?? 'draft') }}
                                        </span>
                                    </td>

                                    <td class="py-1">
                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                            {{-- Approve + Reject (only for non-user types) --}}
                                            @if (Auth::user()->user_type !== 'user')

                                                @can('show posts')
                                                    <a href="{{ route('blogs.show', $blog->id) }}"
                                                        class="action-btn view-btn-gradient" style="margin-top: -12px;"
                                                        title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan
                                            <!-- Approve Form -->
                                            <form id="approve-form-{{ $blog->id }}" action="{{ route('blogs.approve', $blog->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="button" class="action-btn edit-btn-gradient approve-btn" data-id="{{ $blog->id }}" title="Approve">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>

                                            <!-- Reject Form -->
                                            <form id="reject-form-{{ $blog->id }}" action="{{ route('blogs.reject', $blog->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="button" class="action-btn delete-btn-gradient reject-btn" data-id="{{ $blog->id }}" title="Reject">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                            @endif

                                            {{-- Edit & Delete (not for superAdmin) --}}
                                            @if (Auth::user()->user_type !== 'superAdmin')
                                                @can('show posts')
                                                    <a href="{{ route('blogs.show', $blog->id) }}"
                                                        class="action-btn  view-btn-gradient" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('edit posts')
                                                    <a href="{{ route('blogs.edit', $blog->id) }}"
                                                        class="action-btn edit-btn-gradient" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete posts')
                                                    <form id="delete-form-{{ $blog->id }}"
                                                        action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                                        class="m-0 p-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete({{ $blog->id }})"
                                                            class="action-btn delete-btn-gradient" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan

                                            @endif

                                        </div>

                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                                             <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4 text-center">

            <!-- Icon Section -->
            <div class="pt-3 pb-1">
                <div class="mx-auto d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10"
                    style="width: 60px; height: 60px;">
                    <i class="bi bi-check-circle-fill text-success fs-3"></i>
                </div>
            </div>

            <!-- Header -->
            <div class="modal-header border-0 justify-content-center py-1">
                <h5 class="modal-title fw-semibold text-success mb-0" id="modalTitle">
                    Approve Request
                </h5>
            </div>

            <!-- Body -->
            <div class="modal-body px-4 py-2">
                <p class="text-muted small mb-0" id="modalBody">
                    Are you sure you want to approve this request?
                    <br>
                    <span class="text-secondary">
                        This action cannot be undone.
                    </span>
                </p>
            </div>

            <!-- Footer -->
            <div class="modal-footer border-0 justify-content-center pt-1 pb-3">
                <button type="button" class="btn btn-light btn-sm px-3" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-success btn-sm px-3" id="confirmActionBtn">
                    Yes
                </button>
            </div>

        </div>
    </div>
</div>

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


    <script>
        document.addEventListener('DOMContentLoaded', function () {
    let formIdToSubmit = null;

    const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    const confirmBtn = document.getElementById('confirmActionBtn');

    // Approve button click
    document.querySelectorAll('.approve-btn').forEach(button => {
        button.addEventListener('click', function () {
            formIdToSubmit = 'approve-form-' + this.dataset.id;
            modalTitle.textContent = "Confirm Approve";
            modalBody.textContent = "Are you sure you want to approve this blog?";
            confirmModal.show();
        });
    });

    // Reject button click
    document.querySelectorAll('.reject-btn').forEach(button => {
        button.addEventListener('click', function () {
            formIdToSubmit = 'reject-form-' + this.dataset.id;
            modalTitle.textContent = "Confirm Reject";
            modalBody.textContent = "Are you sure you want to reject this blog?";
            confirmModal.show();
        });
    });

    // Confirm action button in modal
    confirmBtn.addEventListener('click', function () {
        if (formIdToSubmit) {
            document.getElementById(formIdToSubmit).submit();
            formIdToSubmit = null;
            confirmModal.hide();
        }
    });
});

    </script>

@endpush