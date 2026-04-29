@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/easymde/easymde.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush


@section('content')
    @include('includes.messages')

    <nav class="page-breadcrumb">
        <h4 class="card-title">Create New Subscription</h4>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('subscriptions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-12 col-md-6  col-lg-6 mb-3">
                                <label for="title" class="form-label"><strong> Name</strong><span
                                        style="color:red;">*</span></label>
                                <input id="title" class="form-control border border-secondary" name="title"
                                    value="{{ old('title') }}" type="text" placeholder="Enter Subscription Name" required>
                            </div>

                            <div class="col-12 col-md-6  col-lg-6 mb-3">
                                <label for="post_number" class="form-label"><strong>Number of Posts</strong><span
                                        style="color:red;">*</span></label>
                                <input id="price" class="form-control border border-secondary" name="post_number"
                                    value="{{ old('post_number') }}" type="post_number" placeholder="Enter post Number"
                                    required>
                            </div>

                            <div class="col-12 col-md-6  col-lg-6 mb-3">
                                <label for="price" class="form-label"><strong>Price</strong><span
                                        style="color:red;">*</span></label>
                                <input id="price" class="form-control border border-secondary" name="price"
                                    value="{{ old('price') }}" type="number" placeholder="Enter Price (e.g., 0.00)"
                                    required>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                <label for="start_date" class="form-label"><strong>Start Date</strong><span
                                        style="color:red;">*</span></label>
                                <div class="input-group border border-dark rounded">
                                    <input type="text" class="form-control flatpickr" name="start_date" id="start_date"
                                        placeholder="Enter  Start Date" data-input value="{{ old('start_date')}}">
                                    <span class="input-group-text input-group-addon" data-toggle><i
                                            data-feather="calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                <label for="end_date" class="form-label"><strong>End Date</strong><span
                                        style="color:red;">*</span></label>
                                <div class="input-group border border-dark rounded">
                                    <input type="text" class="form-control flatpickr" name="end_date" id="end_date"
                                        placeholder="EnterEnd Date" data-input value="{{ old('end_date')}}">
                                    <span class="input-group-text input-group-addon" data-toggle><i
                                            data-feather="calendar"></i></span>
                                </div>
                            </div>
                            <!-- Status -->
                            <div class="col-12 col-md-6  col-lg-6 mb-3">
                                <label for="status" class="form-label"><strong>Status</strong></label>
                                <select name="is_active" id="status" class="form-control border border-secondary">
                                    <option value="1" {{ (old('is_active', $subscription->is_active ?? 1) == 1) ? '1' : '' }}>
                                        Active</option>
                                    <option value="0" {{ (old('is_active', $subscription->is_active ?? 1) == 0) ? '0' : '' }}>
                                        Inactive</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><strong>Use bullet points for description</strong></h4>
                                        <textarea class="form-control border border-secondary" name="description"
                                            style="min-height: 100px !important;" id="descriptionEditor"
                                            rows="10">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Buttons -->
                            <div class="row mt-3 justify-content-center">
                                <div class="col-auto">
                                    <a href="{{ route('subscriptions.index') }}" class="btn text-white"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius:40px; width:90px">Cancel</a>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn text-white"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius:40px; width:90px">Submit</button>
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
    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/easymde/easymde.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/ace-builds/ace.js') }}"></script>
    <script src="{{ asset('assets/plugins/ace-builds/theme-chaos.js') }}"></script>
    <script src="{{ asset('assets/plugins/pickr/pickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/tinymce.js') }}"></script>
    <script src="{{ asset('assets/js/easymde.js') }}"></script>
    <script src="{{ asset('assets/js/ace.js') }}"></script>

    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/pickr.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
@endpush
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get today's date
        var today = new Date().toISOString().split('T')[0];

        // Initialize Flatpickr for start_date
        flatpickr('#start_date', {
            dateFormat: "Y-m-d",
            minDate: today // disable all past dates
        });

        // Initialize Flatpickr for end_date
        flatpickr('#end_date', {
            dateFormat: "Y-m-d",
            minDate: today // disable all past dates
        });
    });
</script>