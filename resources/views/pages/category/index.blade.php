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
            <h4 class="m-0">Listing Of Category</h4>
        </div>

        <!-- Add Button -->
        <div>
            @can('create category')
                <a href="{{ route('category.create') }}" class="btn btn-sm text-white px-4 py-2"
                    style=" background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius: 50px;">
                    <strong>+ </strong> Category
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
                                    <th>Article Title</th>
                                    <th>Seo Title</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($categories as $category)
                                <tr class="py-1">
                                @if (Auth::user()->user_type === 'superAdmin')
                                    <td class="py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2">
                                                @php
                                                    // Check if category has a related user
                                                    $name = $category->user->name ?? 'N/A';

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
                                            <span class="fw-semibold">{{ $category->user->id }}-{{ $name }}</span>
                                        </div>
                                    </td>
                                @endif

                                    <td class="py-2">{{ $category->name ?? 'N/A' }}</td>
                                    <td class="py-2">{{ $category->seo_title ?? 'N/A' }}</td>

                                    <td class="py-2">
                                        <span class="gradient-badge badge-start-gradient">
                                            <i class="fas fa-calendar-alt me-1" style="font-size: 0.85rem;"></i>
                                            {{ $category->created_at ? $category->created_at->format('d M Y') : '-' }}
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        <span
                                        class="gradient-badge 
                                        {{ $category->status == 'active' ? 'badge-active-gradient' :
                                        ($category->status == 'inactive' ? 'badge-inactive-gradient' :
                                        ($category->status == 'pending' ? 'badge-pending-gradient' : 'badge-unknown-gradient')) }}">
                                        <i class="fas fa-circle me-1" style="font-size: 0.6rem;"></i>
                                        {{ ucfirst($category->status ?? 'Unknown') }}
                                        </span>
                                    </td>
                                    <td class="py-1">

                                        <div class="d-flex justify-content-center align-items-center gap-1">

                                            @can('show category')
                                                <a href="{{ route('category.show', $category->id) }}"
                                                    class="action-btn view-btn-gradient" title="Edit">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan
                                            @if (Auth::user()->user_type !== 'superAdmin')
                                                @can('edit category')

                                                    <a href="{{ route('category.edit', $category->id) }}"
                                                        class="action-btn edit-btn-gradient" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete category')
                                                    <form id="delete-form-{{ $category->id }}"
                                                        action="{{ route('category.destroy', $category->id) }}" method="POST"
                                                        class="d-inline m-0 p-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete({{ $category->id }})"
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