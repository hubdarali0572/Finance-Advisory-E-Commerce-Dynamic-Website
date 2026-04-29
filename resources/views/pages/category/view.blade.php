@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/easymde/easymde.min.css') }}" rel="stylesheet" />

@endpush

@section('content')
    @include('includes.messages')
    <nav class="page-breadcrumb mb-4">
        <h4 class="fw-bold text-dark d-flex align-items-center">
            <i class="fas fa-newspaper me-2" style="color: #667eea;"></i>
            Detailed Category Information
        </h4>
    </nav>

    <div class="row">
        <div class="col-12">
            <!-- Main Card with Gradient Header -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative">

                <!-- Gradient Header -->
                <div class="position-absolute top-0 start-0 w-100"
                    style="height: 120px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); z-index: 0;">
                </div>

                <div class="card-body p-4 position-relative" style="z-index: 1;">

                    <!-- Media Preview Section -->
                    <div class="row g-4 mb-4" style="margin-top: 40px;">

                        <!-- Video Preview -->
                        <div class="col-md-4">
                            <div class="media-card video-card">
                                <div class="media-icon-badge">
                                    <i class="fas fa-video"></i>
                                </div>
                                <div class="media-content">
                                    @if($category->file_path && file_exists(public_path('assets/category/video/' . $category->file_path)))
                                        <video class="media-preview" controls>
                                            <source src="{{ asset('assets/category/video/' . $category->file_path) }}"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        <div class="media-placeholder">
                                            <i class="fas fa-video fa-4x"></i>
                                            <p class="mt-3 mb-0">No Video Uploaded</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div class="col-md-4">
                            <div class="media-card image-card">
                                <div class="media-icon-badge">
                                    <i class="fas fa-image"></i>
                                </div>
                                <div class="media-content">
                                    @if($category->image_path && file_exists(public_path('assets/category/image/' . $category->image_path)))
                                        <img src="{{ asset('assets/category/image/' . $category->image_path) }}"
                                            alt="Article Image" class="media-preview">
                                    @else
                                        <div class="media-placeholder">
                                            <i class="fas fa-image fa-4x"></i>
                                            <p class="mt-3 mb-0">No Image Uploaded</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Audio Preview -->
                        <div class="col-md-4">
                            <div class="media-card audio-card">
                                <div class="media-icon-badge">
                                    <i class="fas fa-music"></i>
                                </div>
                                <div class="media-content">
                                    @if($category->audio_path && file_exists(public_path('assets/category/audio/' . $category->audio_path)))
                                        <div class="audio-wrapper">
                                            <i class="fas fa-music fa-3x text-white mb-3"></i>
                                            <audio controls class="w-100">
                                                <source src="{{ asset('assets/category/audio/' . $category->audio_path) }}"
                                                    type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    @else
                                        <div class="media-placeholder">
                                            <i class="fas fa-music fa-4x"></i>
                                            <p class="mt-3 mb-0">No Audio Uploaded</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Information Cards -->
                    <div class="row g-4 mb-4">

                        <!-- Left Column -->
                        <div class="col-12 col-md-6">
                            <div class="info-card gradient-border-left">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-folder me-2"></i>
                                        Category Name
                                    </div>
                                    <div class="info-value">{{ $category->name ?? 'N/A' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-heading me-2"></i>
                                         Title
                                    </div>
                                    <div class="info-value">{{ $category->title ?? 'N/A' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                         Date
                                    </div>
                                    <div class="info-value-small">
                                        {{ $category->created_at ? $category->created_at->format('d M Y') : 'N/A' }}
                                    </div>

                                </div>

                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-toggle-on me-2"></i>
                                        Status
                                    </div>
                                    <div class="mt-2">
                                        @if($category->status == 'active')
                                            <span class="status-badge badge-active-gradient">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Active
                                            </span>
                                        @elseif($category->status == 'inactive')
                                            <span class="status-badge badge-inactive-gradient">
                                                <i class="fas fa-times-circle me-1"></i>
                                                Inactive
                                            </span>
                                        @else
                                            <span class="status-badge badge-pending-gradient">
                                                <i class="fas fa-clock me-1"></i>
                                                Pending
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-12 col-md-6">
                            <div class="info-card gradient-border-right">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-search me-2"></i>
                                         SEO Title
                                    </div>
                                    <div class="info-value-small">{{ $category->seo_title ?? 'N/A' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-key me-2"></i>
                                        SEO Keywords
                                    </div>
                                    <div class="info-value-small">{{ $category->seo_keywords ?? 'N/A' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-tags me-2"></i>
                                        Tags
                                    </div>
                                    <div class="mt-2">
                                      @if($category->tags)
                                            @foreach(json_decode($category->tags) as $tag)
                                                <span class="tag-badge">
                                                    <i class="fas fa-tag me-1"></i>
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <div class="description-card">
                                <div class="description-header">
                                    <i class="fas fa-file-alt me-2"></i>
                                     Description
                                </div>
                                <div class="description-content">
                                    {!! Illuminate\Support\Str::markdown($category->description) ?? '<p class="text-muted">N/A</p>' !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="description-card">
                                <div class="description-header">
                                    <i class="fas fa-search-plus me-2"></i>
                                     SEO Description
                                </div>
                                <div class="description-content">
                                    {!! Illuminate\Support\Str::markdown($category->seo_description) ?? '<p class="text-muted">N/A</p>' !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <hr class="my-4" style="border-top: 2px solid rgba(102, 126, 234, 0.2);">
                    <div class="text-center">
                        <a href="{{ route('category.index') }}" class="action-button back-button">
                            <i class="fas fa-arrow-left me-2"></i>
                            Back to List
                        </a>
                        @if (Auth::user()->user_type !== 'superAdmin')
                            <a href="{{ route('category.edit', $category->id) }}" class="action-button edit-button">
                                <i class="fas fa-edit me-2"></i>
                                Edit Category
                            </a>
                        @endif
                    </div>

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