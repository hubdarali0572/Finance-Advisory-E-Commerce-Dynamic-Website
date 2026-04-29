@extends('layout.master')

@push('plugin-styles')

    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/easymde/easymde.min.css') }}" rel="stylesheet" />

@endpush

@section('content')
    @include('includes.messages')

    <h4 class="card-title mb-2">Edit the Blog</h4>

    <div class="row mb-4">
        @php $previewHeight = '350px'; @endphp

        {{-- Video Preview --}}
        {{-- Video Preview --}}
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card w-100 text-center p-2" style="height: 350px;">
                @if($blog->file_path && file_exists(public_path('assets/blog/video/' . $blog->file_path)))
                    <video width="100%" height="100%" controls style="object-fit: cover;">
                        <source src="{{ asset('assets/blog/video/' . $blog->file_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <i class="fas fa-video fa-3x text-muted mt-5"></i>
                    <p class="mt-2">No Video Uploaded</p>
                @endif
            </div>
        </div>


        {{-- Image Preview --}}
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card w-100 text-center p-2" style="height: {{ $previewHeight }};">
                @if($blog->image_path && file_exists(public_path('assets/blog/image/' . $blog->image_path)))
                    <img src="{{ asset('assets/blog/image/' . $blog->image_path) }}" alt="Image"
                        style="width:100%; height:100%;">
                @else
                    <i class="fas fa-image fa-3x text-muted mt-5"></i>
                    <p class="mt-2">No Image Uploaded</p>
                @endif
            </div>
        </div>

        {{-- Audio Preview --}}
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card w-100 text-center p-2" style="height: {{ $previewHeight }};">
                @if($blog->audio_path && file_exists(public_path('assets/subcategory/audio/' . $subCategory->audio_path)))
                    <audio controls style="width: 100%; margin-top: 40px;">
                        <source src="{{ asset('assets/subcategory/audio/' . $blog->audio_path) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                @else
                    <i class="fas fa-music fa-3x text-muted mt-5"></i>
                    <p class="mt-2">No Audio Uploaded</p>
                @endif
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                <label for="category_id" class="form-label"><strong>Category Name</strong> <span
                                        style="color: red;">*</span></label>
                                <select id="category_id" name="category_id" class="form-select border border-dark">
                                    <option value="" disabled>- Please Select Category -</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                <label for="subcategory_id" class="form-label"><strong>SubCategory Name</strong> <span
                                        style="color: red;">*</span></label>
                                <select id="subcategory_id" name="subcategory_id" class="form-select border border-dark">
                                    <option value="" disabled>- Please Select Subcategory -</option>
                                    @if(old('category_id', $blog->category_id))
                                        @foreach($subCategories as $subcategory)
                                            @if($subcategory->category_id == old('category_id', $blog->category_id))
                                                <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $blog->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                    {{ $subcategory->name }}
                                                </option>
                                            @endif
                                        @endforeach

                                    @endif
                                </select>
                            </div>


                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="title" class="form-label"><strong>Title</strong><span
                                        style="color:red;">*</span></label>
                                <input id="title" class="form-control border border-secondary" name="title"
                                    value="{{ old('title', $blog->title) }}" type="text"
                                    placeholder="Please Enter the Title">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="slug" class="form-label"><strong> Slug</strong><span
                                        style="color:red;">*</span></label>
                                <input id="slug" class="form-control border border-secondary" name="slug"
                                    value="{{ old('slug', $blog->slug) }}" type="text" placeholder="Please Enter the Slug">
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                <label for="date" class="form-label"><strong> Date</strong><span
                                        style="color:red;">*</span></label>
                                <div class="input-group border border-dark rounded">
                                    <input type="text" class="form-control flatpickr" name="blog_date" id="date"
                                        placeholder="Enter Date" data-input
                                        value="{{ old('blog_date', $blog->blog_date) }}">
                                    <span class="input-group-text input-group-addon" data-toggle><i
                                            data-feather="calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="video_url" class="form-label"><strong>Video URL</strong></label>
                                <input id="video_url" class="form-control border border-secondary" name="video_url"
                                    value="{{ old('video_url', $blog->video_url) }}" type="text"
                                    placeholder="Please Enter the Video URL">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="audio_url" class="form-label"><strong>Audio URL</strong></label>
                                <input id="audio_url" class="form-control border border-secondary" name="audio_url"
                                    value="{{ old('audio_url', $blog->audio_url) }}" type="text"
                                    placeholder="Please Enter the Audio URL">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="seo_title" class="form-label"><strong>SEO Title</strong><span
                                        style="color:red;">*</span></label>
                                <input id="seo_title" class="form-control border border-secondary" name="seo_title"
                                    value="{{ old('seo_title', $blog->seo_title) }}" type="text"
                                    placeholder="Please Enter the SEO Title">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="seo_keywords" class="form-label"><strong>SEO Keywords</strong></label>
                                <input id="seo_keywords" class="form-control border border-secondary" name="seo_keywords"
                                    value="{{ old('seo_keywords', $blog->seo_keywords) }}" type="text"
                                    placeholder="Please Enter the SEO Keywords">
                            </div>


                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="views" class="form-label"><strong>Views</strong></label>
                                <input id="views" class="form-control border border-secondary" name="views"
                                    value="{{ old('views', $blog->views) }}" type="number"
                                    placeholder="Please Enter the Views">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="likes" class="form-label"><strong>Likes</strong></label>
                                <input id="likes" class="form-control border border-secondary" name="likes"
                                    value="{{ old('likes', $blog->likes) }}" type="number"
                                    placeholder="Please Enter the Likes">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="shares" class="form-label"><strong>Shares</strong></label>
                                <input id="shares" class="form-control border border-secondary" name="shares"
                                    value="{{ old('shares', $blog->shares) }}" type="number"
                                    placeholder="Please Enter the Shares">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="file_path" class="form-label"><strong>Upload Image/Video/Audio</strong></label>
                                <input type="file" name="file_path" id="file_path"
                                    class="form-control border border-secondary">
                            </div>



                            {{-- Upload Video --}}
                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="file_path" class="form-label"><strong>Upload Video</strong></label>
                                <input type="file" name="file_path" id="file_path"
                                    class="form-control border border-secondary">
                            </div>

                            {{-- Upload Image --}}
                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="image_path" class="form-label"><strong>Upload Image</strong></label>
                                <input type="file" name="image_path" id="image_path"
                                    class="form-control border border-secondary">
                            </div>

                            {{-- Upload Audio --}}
                            <div class="col-12 col-md-12 col-lg-12 mb-3">
                                <label for="audio_path" class="form-label"><strong>Upload Audio</strong></label>
                                <input type="file" name="audio_path" id="audio_path"
                                    class="form-control border border-secondary">
                            </div>

                            <div class="col-12 col-md-12 col-lg-12 mb-3">
                                <label for="tags" class="form-label"><strong>Tags</strong></label>
                                <textarea id="tags" name="tags" class="form-control border border-secondary" rows="3"
                                    placeholder="Enter tags separated by commas">{{ old('tags', $blog->tags ? implode(',', json_decode($blog->tags)) : '') }}</textarea>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><strong>Blog Short Description</strong></h4>
                                        <textarea class="form-control border border-secondary" name="short_description"
                                            id="blogShortDescriptionEditor" style="min-height: 100px !important;"
                                            rows="10">{{ old('short_description', $blog->short_description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><strong>Blog Content</strong></h4>
                                        <textarea class="form-control border border-secondary" name="content"
                                            id="contentEditor" style="min-height: 100px !important;"
                                            rows="10">{{ old('content', $blog->content) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12  mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><strong>Seo Description </strong></h4>
                                        <textarea class="form-control border border-secondary" name="seo_description"
                                            style="min-height: 100px !important;" id="seoBlogdescriptionEditor"
                                            rows="10">{{ old('seo_description', $blog->seo_description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-auto">
                                    <a href="{{ route('blogs.index') }}" class="btn text-white"
                                        style="background: #4AABDC;border-radius:40px; width:90px">Cancel</a>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn text-white"
                                        style="background: #4AABDC;border-radius:40px; width:90px">Update</button>
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
                        url: '/get-subcategories/' + categoryID, // Route to get subcategories
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append('<option value="" disabled selected>- Please Select Subcategory -</option>');
                            $.each(data, function (key, value) {
                                $('#subcategory_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory_id').empty();
                    $('#subcategory_id').append('<option value="" disabled selected>- Please Select Subcategory -</option>');
                }
            });

        });
    </script>
@endpush