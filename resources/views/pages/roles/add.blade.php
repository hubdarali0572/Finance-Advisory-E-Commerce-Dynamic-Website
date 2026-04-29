@extends('layout.master')
@section('title', 'Add Role')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

@section('content')
    @include('includes.messages')

    <nav class="page-breadcrumb">
        <h4>Add the Role</h4>

    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <!-- Role Name -->
                            <div class="col-12 col-md-12 mb-3">
                                <label for="name" class="form-label fw-bold">Role Name</label>
                                <input id="name" class="form-control border border-secondary" name="name"
                                    value="{{ old('name') }}" type="text" placeholder="Please Enter Role Name" required>
                            </div>

                            <!-- Permissions -->
                            <div class="col-12">
                                <div class="card border-secondary shadow-sm">
                                    <div class="card-header bg-primary text-dark fw-bold">
                                        Assign Permissions
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            @foreach ($permissions as $permission)
                                                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="permissions[]"
                                                            value="{{ $permission->id }}" class="form-check-input"
                                                            id="permission-{{ $permission->id }}">

                                                        <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                            {{ ucfirst($permission->name) }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('roles.index') }}" class="btn text-white"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius:40px; width:120px;">
                    <i class="fas fa-times me-1"></i> Cancel
                </a>
                <button type="submit" class="btn text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius:40px; width:120px;">
                    <i class="fas fa-check me-1"></i> Submit
                </button>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush