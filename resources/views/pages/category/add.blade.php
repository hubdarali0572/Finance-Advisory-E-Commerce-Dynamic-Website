@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/easymde/easymde.min.css') }}" rel="stylesheet" />

@endpush

@section('content')
    @include('includes.messages')

    <nav class="page-breadcrumb">
        <h4 class="card-title">Add The Category</h4>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="name" class="form-label"><strong>Category Name </strong><span
                                        style="color:red;">*</span></label>
                                <input id="name" class="form-control border border-secondary" name="name"
                                    value="{{old('name')}}" type="text" placeholder="Please Enter the Name">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="title" class="form-label"><strong>Category Title </strong><span
                                        style="color:red;">*</span></label>
                                <input id="title" class="form-control border border-secondary" name="title"
                                    value="{{old('title')}}" type="text" placeholder="Please Enter the Title">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="seo_title" class="form-label"><strong>Seo Title </strong><span
                                        style="color:red;">*</span></label>
                                <input id="seo_title" class="form-control border border-secondary" name="seo_title"
                                    value="{{old('seo_title')}}" type="text" placeholder="Please Enter the Seo Title">
                            </div>
                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="seo_keywords" class="form-label"><strong>Seo Keyword </strong><span
                                        style="color:red;">*</span></label>
                                <input id="seo_keywords" class="form-control border border-secondary" name="seo_keywords"
                                    value="{{old('seo_keywords')}}" type="text" placeholder="Please Enter the Seo Keyword">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="status" class="form-label"><strong>Status</strong></label>
                                <select name="status" id="status" class="form-control border border-secondary">
                                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>-- Select Status --
                                    </option>
                                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>

                            </div>

                            {{-- video path --}}
                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="file_path" class="form-label"><strong>Upload Video</strong></label>
                                <input type="file" name="file_path" id="file_path"
                                    class="form-control border border-secondary">
                            </div>

                            {{-- image path --}}

                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="image_path" class="form-label"><strong>Upload Image</strong></label>
                                <input type="file" name="image_path" id="image_path"
                                    class="form-control border border-secondary">
                            </div>
                            {{-- audio path --}}
                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="audio_path" class="form-label"><strong>Upload Audio</strong></label>
                                <input type="file" name="audio_path" id="audio_path"
                                    class="form-control border border-secondary">
                            </div>

                            <div class="col-12 col-md-12 col-lg-12 mb-3">
                                <label for="tags" class="form-label">
                                    <strong>Tags</strong>
                                </label>
                                <textarea id="tags" name="tags" class="form-control border border-secondary" rows="3"
                                    placeholder="Please enter tags, separated by commas">{{ old('tags') }}</textarea>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><strong>Description</strong></h4>
                                        <textarea class="form-control border border-secondary" name="description"
                                            style="min-height: 100px !important;" id="descriptionEditor"
                                            rows="10">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><strong>Seo Description</strong></h4>
                                        <textarea class="form-control border border-secondary" name="seo_description"
                                            id="seoDescriptionEditor" rows="10">{{ old('seo_description') }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-3 justify-content-center">
                                <div class="col-auto">
                                    <a href="{{ route('category.index') }}" class="btn text-white"
                                        style=" background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%);border-radius:40px; width:90px">Cancel</a>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn text-white"
                                        style=" background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%);border-radius:40px; width:90px">Submit</button>
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
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/tinymce.js') }}"></script>
    <script src="{{ asset('assets/js/easymde.js') }}"></script>
    <script src="{{ asset('assets/js/ace.js') }}"></script>
@endpush