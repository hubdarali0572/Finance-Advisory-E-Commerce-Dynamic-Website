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
            <h4 class="m-0">Listing Of Post</h4>
        </div>
        <div>
            @can('create posts')
                <a href="{{ route('blogs.create') }}" class="btn btn-sm text-white px-4 py-2"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius: 50px;">
                    <strong> + </strong> Post
                </a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th>Category</th>
                                    <th>SubCategory </th>
                                    <th>Post Title</th>
                                    <th>views</th>
                                    <th>Likes</th>
                                    <th>shares</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($blogs as $blog)
                                <tr class="py-1">
                                    <td class="py-2">{{ $blog->category->name ?? 'N/A' }}</td>
                                    
                                    <td class="py-2">{{ $blog->subCategory->name ?? 'N/A' }}</td>
                                    <td class="py-2 fw-semibold">
                                        {{ $blog->title }}
                                    </td>

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

                                    <td class="py-1">

                                        <div class="d-flex justify-content-center align-items-center gap-1">

                                            {{-- Approve + Reject (only for non-user types) --}}
                                            @if (Auth::user()->user_type !== 'user')

                                                @can('show posts')
                                                    <a href="{{ route('blogs.show', $blog->id) }}" class="action-btn edit-btn"
                                                        style="margin-top: -12px;" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan
                                                <form action="{{ route('blogs.approve', $blog->id) }}" method="POST">
                                                    @csrf
                                                    <button class="action-btn btn-success edit-btn" title="Approve">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>

                                                <form action="{{ route('blogs.reject', $blog->id) }}" method="POST">
                                                    @csrf
                                                    <button class="action-btn btn-danger edit-btn" title="Reject">
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