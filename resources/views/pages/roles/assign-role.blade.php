@extends('layout.master')
@section('title', 'Assign Role')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @include('pages.includes.messages')

    <p class="addText">Assign Role</p>

    <div class="row mt-2">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form id="signupForm" action="{{ route('assign.role') }}" method="POST">
                        @csrf
                        <div class="row g-3 align-items-end">
                            <div class="col-12 col-md-6">
                                <label for="user_id" class="form-label fw-bold">User <span
                                        style="color:red">*</span></label>
                                <select name="user_id[]" id="user_id" class="js-example-basic-multiple form-select h-100"
                                    multiple="multiple" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="role" class="form-label fw-bold">Role <span style="color:red">*</span></label>
                                <select name="role" id="role" class="form-select h-100" required>
                                    <option value="" disabled selected>- Please Select -</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <a href="{{ route('roles.index') }}" class="btn text-white"
                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius:40px; width:130px;">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn text-white"
                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius:40px; width:130px;">
                                <i class="fas fa-check me-1"></i> Assign Role
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush