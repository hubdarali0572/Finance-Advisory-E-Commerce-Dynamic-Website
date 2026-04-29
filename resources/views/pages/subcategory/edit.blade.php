@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/easymde/easymde.min.css') }}" rel="stylesheet" />

@endpush

@section('content')
    @include('includes.messages')

    <h4 class="card-title mb-2">Edit the SubCategory </h4>

    <div class="row mb-4">
        @php $previewHeight = '350px'; @endphp

        {{-- Video Preview --}}
        {{-- Video Preview --}}
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card w-100 text-center p-2" style="height: 350px;">
                @if($subCategory->file_path && file_exists(public_path('assets/subcategory/video/' . $subCategory->file_path)))
                    <video width="100%" height="100%" controls style="object-fit: cover;">
                        <source src="{{ asset('assets/subcategory/video/' . $subCategory->file_path) }}" type="video/mp4">
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
                @if($subCategory->image_path && file_exists(public_path('assets/subcategory/image/' . $subCategory->image_path)))
                    <img src="{{ asset('assets/subcategory/image/' . $subCategory->image_path) }}" alt="Image"
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
                @if($subCategory->audio_path && file_exists(public_path('assets/subcategory/audio/' . $subCategory->audio_path)))
                    <audio controls style="width: 100%; margin-top: 40px;">
                        <source src="{{ asset('assets/subcategory/audio/' . $subCategory->audio_path) }}" type="audio/mpeg">
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
                    <form action="{{ route('subcategory.update', $subCategory->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                <label for="category_id" class="form-label"><strong>Category Name</strong> <span
                                        style="color: red;">*</span></label>
                                <select id="category_id" name="category_id" class="form-select border border-dark">
                                    <option value="" disabled>- Please Select Article -</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $subCategory->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="name" class="form-label"><strong> Name</strong> <span
                                        style="color:red;">*</span></label>
                                <input type="text" name="name" id="name" class="form-control border border-secondary"
                                    value="{{ old('name', $subCategory->name) }}" placeholder="Please Enter the Name">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="title" class="form-label">Title <span style="color:red;">*</span></label>
                                <input id="title" class="form-control border border-secondary" name="title"
                                    value="{{ old('title', $subCategory->title) }}" type="text"
                                    placeholder="Please Enter the title">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6  mb-3">
                                <label for="seo_title" class="form-label"><strong>Seo Title </strong><span
                                        style="color:red;">*</span></label>
                                <input id="seo_title" class="form-control border border-secondary" name="seo_title"
                                    value="{{old('seo_title', $subCategory->seo_title)}}" type="text"
                                    placeholder="Please Enter the Seo Title">
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="seo_keywords" class="form-label"><strong>Seo Keyword </strong><span
                                        style="color:red;">*</span></label>
                                <input id="seo_keywords" class="form-control border border-secondary" name="seo_keywords"
                                    value="{{old('seo_keywords', $subCategory->seo_keywords)}}" type="text"
                                    placeholder="Please Enter the Seo Keyword">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control border border-secondary">
                                    <option value="" disabled>-- Select Status --</option>
                                    <option value="active" {{ old('status', $subCategory->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $subCategory->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
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

                            {{-- Tags --}}
                            <div class="col-12 col-md-12 col-lg-12 mb-3">
                                <label for="tags" class="form-label"><strong>Tags</strong></label>
                                <textarea name="tags" id="tags" class="form-control border border-secondary" rows="3"
                                    placeholder="Please enter tags, separated by commas">{{ old('tags', implode(',', json_decode($subCategory->tags ?? '[]', true))) }}</textarea>
                            </div>



                            <div class="card-body  col-12 col-md-4 col-lg-4 mb-3">
                                <h4 class="card-title">Article Description</h4>
                                <textarea class="form-control border border-secondary" name="description"
                                    id="descriptionEditor"
                                    rows="10">{{ old('description', $subCategory->description) }}</textarea>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12 mb-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><strong>Seo Description</strong></h4>
                                        <textarea class="form-control border border-secondary" name="seo_description"
                                            id="seoDescriptionEditor"
                                            rows="10">{{ old('seo_description', $subCategory->seo_description) }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-2 justify-content-center">
                                <div class="col-auto">
                                    <a href="{{ route('subcategory.index') }}" class="btn text-white"
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
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/tinymce.js') }}"></script>
    <script src="{{ asset('assets/js/easymde.js') }}"></script>
    <script src="{{ asset('assets/js/ace.js') }}"></script>
@endpush