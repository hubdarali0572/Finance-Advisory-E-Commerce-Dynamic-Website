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
            <h4 class="m-0">Listing Of Subcategory</h4>
        </div>
        <div>
            @can('create subcategory')
                <a href="{{ route('subcategory.create') }}" class="btn btn-sm text-white px-4 py-2"
                    style=" background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius: 50px;">
                    <strong>+</strong></i> SubCategory
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
                                    <th>Category Name</th>
                                    <th> Name</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($subCategories as $subCategory)
                                    <tr class="py-1">
                                        @if (Auth::user()->user_type === 'superAdmin')
                                            <td class="py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle me-2">
                                                        @php
                                                            // Check if category has a related user
                                                            $name = $subCategory->user->name ?? 'N/A';

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
                                                    <span class="fw-semibold">{{ $subCategory->user->id }}-{{ $name }}</span>
                                                </div>
                                            </td>
                                        @endif
                                        <td class="py-2">{{ $subCategory->category->name ?? 'N/A' }}</td>
                                        <td class="py-2">{{ $subCategory->name }}</td>
                                        <td class="py-2">{{ $subCategory->title }}</td>
                                        <td class="py-2">
                                            <span class="gradient-badge 
                                            {{ $subCategory->status == 'active' ? 'badge-active-gradient' :
                                            ($subCategory->status == 'expired' ? 'badge-expired-gradient' :
                                                ($subCategory->status == 'cancelled' ? 'badge-cancelled-gradient' :
                                                    'badge-pending-gradient')) }}">
                                                <i class="fas fa-circle me-1" style="font-size: 0.6rem;"></i>
                                                {{ ucfirst($subCategory->status ?? 'Pending') }}
                                            </span>
                                        </td>

                                        <td class="py-1">

                                            <div class="d-flex justify-content-center align-items-center gap-1">

                                                @can('show subcategory')
                                                    <a href="{{ route('subcategory.show', $subCategory->id) }}"
                                                        class="action-btn view-btn-gradient" title="Edit">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan

                                                @if (Auth::user()->user_type !== 'superAdmin')
                                                    @can('edit subcategory')

                                                        <a href="{{ route('subcategory.edit', $subCategory->id) }}"
                                                            class="action-btn edit-btn-gradient" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete subcategory')
                                                        <form id="delete-form-{{ $subCategory->id }}"
                                                            action="{{ route('subcategory.destroy', $subCategory->id) }}" method="POST"
                                                            class="d-inline m-0 p-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" onclick="confirmDelete({{ $subCategory->id }})"
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