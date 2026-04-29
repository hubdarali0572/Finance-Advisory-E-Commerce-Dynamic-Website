@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @include('includes.messages')

    <nav class="page-breadcrumb">
        <h4 class="card-title">Edit the User Profile</h4>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="name" class="form-label">Name <span style="color:red;">*</span></label>
                                <input id="name" class="form-control border border-secondary" name="name" type="text"
                                    value="{{ old('name', $user->name) }}" placeholder="Please Enter the Name">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="email" class="form-label">Email <span style="color:red;">*</span></label>
                                <input type="email" name="email" id="email" class="form-control border border-secondary"
                                    value="{{ old('email', $user->email) }}" placeholder="Please Enter the Email">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control border border-secondary"
                                    placeholder="Leave blank to keep current password">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="phone" class="form-label">Phone <span style="color:red;">*</span></label>
                                <input type="text" name="phone" id="phone" class="form-control border border-secondary"
                                    maxlength="11" value="{{ old('phone', $user->phone) }}"
                                    placeholder="Please Enter the Phone No">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control border border-secondary">
                                    <option value="" disabled>-- Select Status --</option>
                                    <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="profile_photo" class="form-label">Profile Image</label>
                                <input type="file" name="profile_photo" id="profile_photo"
                                    class="form-control border border-secondary">

                                @if($user->profile_photo && file_exists(public_path('userimages/' . $user->profile_photo)))
                                    <div class="mt-2">
                                        <img src="{{ asset('userimages/' . $user->profile_photo) }}" alt="{{ $user->name }}"
                                            style="width:100px; height:80px; object-fit: cover;">
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-center gap-3 mt-3">
                                <div class="col-auto">
                                    <a href="{{ route('users.index') }}" class="btn text-white"
                                        style=" background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius:40px; width:110px;">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn text-white"
                                        style=" background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius:40px; width:110px;">
                                        <i class="fas fa-check me-1"></i> Update
                                    </button>
                                </div>
                            </div>

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