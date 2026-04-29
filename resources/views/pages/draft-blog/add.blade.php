@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/easymde/easymde.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @include('includes.messages')

    <nav class="page-breadcrumb">
        <h4 class="card-title">Add The Post</h4>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                <label for="category_id" class="form-label"><strong>Category</strong> <span
                                        style="color: red;">*</span></label>
                                <select id="category_id" name="category_id" class="form-select border border-dark">
                                    <option value="" selected disabled>- Please Select Category -</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                <label for="subcategory_id" class="form-label"><strong>SubCategory </strong> <span
                                        style="color: red;">*</span></label>
                                <select id="subcategory_id" name="subcategory_id" class="form-select border border-dark">
                                    <option value="" selected disabled>- Please Select Subcategory -</option>
                                    <!-- Subcategories will be loaded dynamically -->
                                </select>
                            </div>


                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="title" class="form-label"><strong>Post Title </strong><span
                                        style="color:red;">*</span></label>
                                <input id="title" class="form-control border border-secondary" name="title"
                                    value="{{ old('title') }}" type="text" placeholder="Please Enter the Title">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="slug" class="form-label"><strong>Post Slug </strong><span
                                        style="color:red;">*</span></label>
                                <input id="slug" class="form-control border border-secondary" name="slug"
                                    value="{{ old('slug') }}" type="text" placeholder="Please Enter the Slug">
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                <label for="date" class="form-label"><strong>Post Date</strong><span
                                        style="color:red;">*</span></label>
                                <div class="input-group border border-dark rounded">
                                    <input type="text" class="form-control flatpickr" name="blog_date" id="date"
                                        placeholder="Enter Date" data-input value="{{ old('blog_date')}}">
                                    <span class="input-group-text input-group-addon" data-toggle><i
                                            data-feather="calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="video_url" class="form-label"><strong>Video Url </strong></label>
                                <input id="video_url" class="form-control border border-secondary" name="video_url"
                                    value="{{old('video_url')}}" type="text" placeholder="Please Enter the video url">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="audio_url" class="form-label"><strong>Audio Url </strong></label>
                                <input id="audio_url" class="form-control border border-secondary" name="audio_url"
                                    value="{{old('audio_url')}}" type="text" placeholder="Please Enter the Audio url">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="seo_title" class="form-label"><strong>Seo Title </strong><span
                                        style="color:red;">*</span></label>
                                <input id="seo_title" class="form-control border border-secondary" name="seo_title"
                                    value="{{old('seo_title')}}" type="text" placeholder="Please Enter the Seo Title">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="seo_keywords" class="form-label"><strong>Seo Keyword </strong></label>
                                <input id="seo_keywords" class="form-control border border-secondary" name="seo_keywords"
                                    value="{{old('seo_keywords')}}" type="text" placeholder="Please Enter the Seo Keyword">
                            </div>


                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="views" class="form-label"><strong>Views</strong></label>
                                <input id="views" class="form-control border border-secondary" name="views"
                                    value="{{old('likes')}}" type="number" placeholder="Please Enter the Views">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="likes" class="form-label"><strong>Likes</strong></label>
                                <input id="likes" class="form-control border border-secondary" name="likes"
                                    value="{{old('likes')}}" type="number" placeholder="Please Enter the Likes">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="shares" class="form-label"><strong>Shares</strong></label>
                                <input id="shares" class="form-control border border-secondary" name="shares"
                                    value="{{old('shares')}}" type="number" placeholder="Please Enter the Shares">
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
                            <div class="col-12 col-md-12 col-lg-12  mb-3">
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

                            <div class="col-12 col-md-12 col-lg-12  mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><strong>Post Short Description</strong></h4>
                                        <textarea class="form-control border border-secondary" name="short_description"
                                            style="min-height: 100px !important;" id="blogShortDescriptionEditor"
                                            rows="10">{{ old('short_description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12  mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><strong>Post Content</strong></h4>
                                        <textarea class="form-control border border-secondary" name="content"
                                            style="min-height: 100px !important;" id="contentEditor"
                                            rows="10">{{ old('content') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12  mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><strong>Seo Description </strong></h4>
                                        <textarea class="form-control border border-secondary" name="seo_description"
                                            style="min-height: 100px !important;" id="seoBlogdescriptionEditor"
                                            rows="10">{{ old('seo_description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-auto">
                                    <a href="{{ route('blogs.index') }}" class="btn text-white"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%);border-radius:40px; width:90px">Cancel</a>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn text-white"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%);border-radius:40px; width:90px">Submit</button>
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
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/tinymce.js') }}"></script>
    <script src="{{ asset('assets/js/easymde.js') }}"></script>
    <script src="{{ asset('assets/js/ace.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/pickr.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            var today = new Date().toISOString().split('T')[0];
            flatpickr('#date', {

                dateFormat: "Y-m-d"
            });
        });
    </script>


    <script>
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        titleInput.addEventListener('input', function () {
            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/--+/g, '-');
            slugInput.value = slug;
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#category_id').on('change', function () {
                var categoryID = $(this).val();
                if (categoryID) {
                    $.ajax({
                        url: '/get-subcategories/' + categoryID,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append('<option value="" selected disabled>- Please Select Subcategory -</option>');
                            $.each(data, function (key, value) {
                                $('#subcategory_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory_id').empty();
                    $('#subcategory_id').append('<option value="" selected disabled>- Please Select Subcategory -</option>');
                }
            });
        });
    </script>

@endpush