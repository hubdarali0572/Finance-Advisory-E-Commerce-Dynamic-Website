@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/easymde/easymde.min.css') }}" rel="stylesheet" />

@endpush

@section('content')
    @include('includes.messages')

    <nav class="page-breadcrumb">
        <h4 class="fw-bold text-dark">Detailed Blog Information</h4>
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
                                    @if($blog->file_path && file_exists(public_path('assets/blog/video/' . $blog->file_path)))
                                        <video class="media-preview" controls>
                                            <source src="{{ asset('assets/blog/video/' . $blog->file_path) }}" type="video/mp4">
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
                                    @if($blog->image_path && file_exists(public_path('assets/blog/image/' . $blog->image_path)))
                                        <img src="{{ asset('assets/blog/image/' . $blog->image_path) }}" alt="Blog Image"
                                            class="media-preview">
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
                                    @if($blog->audio_path && file_exists(public_path('assets/blog/audio/' . $blog->audio_path)))
                                        <div class="audio-wrapper mt-3">
                                            <audio controls class="w-100">
                                                <source src="{{ asset('assets/blog/audio/' . $blog->audio_path) }}"
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
                                    <div class="info-label"><i class="fas fa-folder me-2"></i>Category</div>
                                    <div class="info-value">{{ $blog->category->name ?? 'N/A' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-folder-open me-2"></i>SubCategory</div>
                                    <div class="info-value">{{ $blog->subcategory->name ?? 'N/A' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-user me-2"></i>Author</div>
                                    <div class="info-value">{{ $blog->user->name ?? 'N/A' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-toggle-on me-2"></i>Status</div>
                                    <div class="mt-2">
                                        @if($blog->status == 'approved')
                                            <span class="status-badge badge-active-gradient">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Approved
                                            </span>
                                        @elseif($blog->status == 'rejected')
                                            <span class="status-badge badge-inactive-gradient">
                                                <i class="fas fa-times-circle me-1"></i>
                                                Rejected
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
                                    <div class="info-label"><i class="fas fa-heading me-2"></i>Blog Title</div>
                                    <div class="info-value">{{ $blog->title ?? 'N/A' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-link me-2"></i>Slug</div>
                                    <div class="info-value">{{ $blog->slug ?? 'N/A' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-calendar-alt me-2"></i>Blog Date</div>
                                    <div class="info-value-small">{{ $blog->blog_date ?? 'N/A' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-tags me-2"></i>Tags</div>
                                    <div class="mt-2">
                                         @if($blog->tags)
                                            @foreach(json_decode($blog->tags) as $tag)
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

                    <!-- Metrics Badges (Views, Shares, Likes, Comments) -->
                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-3">
                                <span class="gradient-badge badge-views-gradient">
                                    <i class="fas fa-eye me-1" style="font-size:0.85rem;"></i>
                                    {{ $blog->views ?? 0 }}
                                </span>

                                <span class="gradient-badge badge-shares-gradient">
                                    <i class="fas fa-share-alt me-1" style="font-size:0.85rem;"></i>
                                    {{ $blog->shares ?? 0 }}
                                </span>

                                <span class="gradient-badge badge-likes-gradient">
                                    <i class="fas fa-heart me-1" style="font-size:0.85rem;"></i>
                                    {{ $blog->likes ?? 0 }}
                                </span>

                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <div class="description-card">
                                <div class="description-header"><i class="fas fa-file-alt me-2"></i>Short Description
                                </div>
                                <div class="description-content">
                                     {!! \Illuminate\Support\Str::markdown($blog->short_description) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="description-card">
                                <div class="description-header"><i class="fas fa-file-alt me-2"></i>Content</div>
                                <div class="description-content">
                                         {!! \Illuminate\Support\Str::markdown($blog->content) !!}
                               
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="description-card">
                                <div class="description-header"><i class="fas fa-search-plus me-2"></i>SEO Description</div>
                                <div class="description-content">
                                    {!! \Illuminate\Support\Str::markdown($blog->seo_description) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <hr class="my-4" style="border-top: 2px solid rgba(102, 126, 234, 0.2);">
                    <div class="text-center">
                        <a href="{{ route('blogs.index') }}" class="action-button back-button">
                            <i class="fas fa-arrow-left me-2"></i>
                            Back to List
                        </a>
                        @if (Auth::user()->user_type !== 'superAdmin')
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="action-button edit-button">
                                <i class="fas fa-edit me-2"></i>
                                Edit Blog
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