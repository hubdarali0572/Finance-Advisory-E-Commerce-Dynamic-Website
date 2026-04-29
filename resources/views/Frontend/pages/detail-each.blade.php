@extends('Frontend.frontend-layout.app')

@section('title', 'Excellence in Modern Education')

    <link href="{{ asset('assets/plugins/easymde/easymde.min.css') }}" rel="stylesheet" />
@section('content')
    <div class="py-12">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 mt-16">

            <section>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">

                    <div class="col-span-12 lg:col-span-8">

                        @if($blog->file_path || $blog->audio_path)
                            <div class="mb-8 space-y-4">
                                @if($blog->file_path)
                                    <div class="overflow-hidden shadow-xl">
                                        <video controls class="w-full h-auto">
                                            <source src="{{ asset('assets/blog/video/' . $blog->file_path) }}" type="video/mp4">
                                        </video>
                                    </div>
                                @endif

                                {{-- @if($blog->audio_path) --}}
                                <div class="bg-gradient-to-r from-rose-400 to-rose-500 p-3 shadow-lg">
                                    <audio controls class="w-full">
                                        <source src="{{ asset('assets/blog/audio/' . $blog->audio_path) }}" type="audio/mpeg">
                                    </audio>
                                </div>
                                {{-- @endif --}}
                            </div>
                        @endif

                        <div class="shadow-md overflow-hidden">

                            <div class="bg-gradient-to-r from-rose-400 to-rose-500 px-8 py-6">
                                <h1 class="text-xl md:text-3xl font-semibold md:font-bold text-white mb-2">
                                    {{ $blog->title ?? 'Untitled' }}
                                </h1>
                            </div>

                            <div class="px-8 py-8 space-y-8">

                                @if($blog->short_description)
                                    <div class="bg-green-50 border-l-4 border-rose-500 p-6 rounded-r-lg">


                                        <div class="flex items-center gap-2 mb-3">
                                            <i class="ph ph-info text-rose4500 text-xl"></i>
                                            <h3 class="text-lg font-semibold text-rose-500">Summary</h3>
                                        </div>
                                        <div class="text-gray-700 leading-relaxed prose max-w-none">
                                            {!! Illuminate\Support\Str::markdown($blog->short_description) !!}
                                        </div>
                                    </div>
                                @endif

                                <div class="prose max-w-none text-gray-800">
                                    {!! \Illuminate\Support\Str::markdown($blog->content) !!}
                                </div>

                                @if($blog->seo_description)
                                    <div class="bg-blue-50 border-l-4 border-rose-500 p-6 rounded-r-lg">
                                        <div class="flex items-center gap-2 mb-3">
                                            <i class="ph ph-magnifying-glass text-rose-600 text-xl"></i>
                                            <h3 class="text-lg font-semibold text-rose-500">SEO Description</h3>
                                        </div>
                                        <div class="text-gray-700 leading-relaxed prose max-w-none">
                                            {!! \Illuminate\Support\Str::markdown($blog->seo_description) !!}
                                            
                                        </div>
                                    </div>
                                @endif

                                @if($blog->tags && json_decode($blog->tags))
                                    <div class="pt-6 border-t border-gray-200">
                                        <div class="flex items-center gap-2 mb-3">
                                            <i class="fas fa-tags text-gray-600 text-lg"></i>
                                            <span class="text-sm font-semibold text-gray-700">Tags:</span>
                                        </div>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(json_decode($blog->tags) as $tag)
                                                <span
                                                    class="inline-flex items-center gap-1 bg-rose-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                                    <i class="fas fa-hashtag text-xs"></i>
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>

                    {{-- RIGHT SIDE: Sidebar --}}
                    <div class="col-span-12 lg:col-span-4">
                        <div class="lg:sticky lg:top-8 space-y-6">

                            {{-- Author Card --}}
                            <div class="shadow-md p-6 text-center space-y-4 group">
                                {{-- Profile Photo --}}
                                <div class="relative inline-block mx-auto">
                                    <img src="{{ $blog->user && $blog->user->profile_photo && file_exists(public_path('userimages/' . $blog->user->profile_photo)) ? asset('userimages/' . $blog->user->profile_photo) : 'https://i.pravatar.cc/100?img=1' }}"
                                        alt="{{ $blog->user->name ?? 'Author' }}"
                                        class="w-28 h-28 rounded-full object-cover ring-4 ring-green-200 transform duration-700 group-hover:scale-125">
                                    {{-- Verified Badge --}}
                                    <div
                                        class="absolute bottom-0 right-0 w-8 h-8 bg-rose-500 rounded-full border-2 border-white flex items-center justify-center">
                                        <i class="fas fa-check text-white text-sm"></i>
                                    </div>
                                </div>

                                {{-- Badges --}}
                                <div class="flex flex-wrap justify-center gap-2 mt-4">

                                    <span class="inline-flex items-center gap-1 bg-rose-50 text-rose-600 px-3 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas fa-user text-xs"></i>
                                        {{ $blog->user->name ?? 'Anonymous' }}
                                    </span>

                                    <span class="inline-flex items-center gap-1 bg-rose-50 text-rose-600 px-3 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas fa-folder-open text-xs"></i>
                                        {{ $blog->category->name ?? 'Uncategorized' }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 bg-rose-50 text-rose-600 px-3 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas fa-calendar-alt text-xs"></i>
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
                                    </span>

                                </div>

                                {{-- Contact Info --}}
                                <div class="pt-4 border-t border-gray-100 space-y-2 text-sm text-gray-700">
                                    @if($blog->user->email ?? false)
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fas fa-envelope text-rose-500 "></i>
                                            <span class="truncate max-w-[180px]">{{ $blog->user->email }}</span>
                                        </div>
                                    @endif
                                    @if($blog->user->phone ?? false)
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fas fa-phone text-rose-500"></i>
                                            <span>{{ $blog->user->phone }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Stats Card --}}
                            <div class="shadow-md p-6 text-sm space-y-3">
                                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="fas fa-chart-line text-rose-500"></i> Statistics
                                </h3>
                                <div class="space-y-3">
                                    <div
                                        class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-eye text-gray-600 text-xl"></i>
                                            <span class="text-gray-700 font-medium">Views</span>
                                        </div>
                                        <span
                                            class="text-xl font-bold text-gray-900">{{ number_format($blog->views ?? 0) }}</span>
                                    </div>

                                    <div
                                        class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-heart text-rose-500 text-xl"></i>
                                            <span class="text-gray-700 font-medium">Likes</span>
                                        </div>
                                        <span
                                            class="text-xl font-bold text-gray-900">{{ number_format($blog->likes ?? 0) }}</span>
                                    </div>

                                    <div
                                        class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-share-alt text-blue-500 text-xl"></i>
                                            <span class="text-gray-700 font-medium">Shares</span>
                                        </div>
                                        <span
                                            class="text-xl font-bold text-gray-900">{{ number_format($blog->shares ?? 0) }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Category Info --}}
                            <div class="shadow-md p-6 text-sm">
                                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="fas fa-folder-open text-rose-500"></i> Category
                                </h3>
                                <p class="text-gray-800 font-medium mb-4">{{ $blog->category->title ?? 'Uncategorized' }}</p>

                                @if($blog->category && $blog->category->tags)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(json_decode($blog->category->tags) as $tag)
                                            <span
                                                class="inline-flex items-center gap-1 bg-rose-500 text-white px-3 py-1.5 rounded-lg text-xs font-medium">
                                                <i class="fas fa-hashtag text-xs"></i>
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            
                            {{-- SubCategory Info --}}
                            <div class="shadow-md p-6 text-sm">
                                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="fas fa-folder-open text-rose-500"></i> SubCategory
                                </h3>
                                <p class="text-gray-800 font-medium mb-4">{{ $blog->SubCategory->title ?? 'Uncategorized' }}</p>

                                @if($blog->SubCategory && $blog->SubCategory->tags)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(json_decode($blog->SubCategory->tags) as $tag)
                                            <span
                                                class="inline-flex items-center gap-1 bg-rose-500 text-white px-3 py-1.5 rounded-lg text-xs font-medium">
                                                <i class="fas fa-hashtag text-xs"></i>
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Media Links --}}
                            @if($blog->video_url || $blog->audio_url)
                                <div class="shadow-md p-6 text-sm space-y-2">
                                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                        <i class="fas fa-link text-rose-500"></i> Media Links
                                    </h3>
                                    <div class="space-y-2">
                                        @if($blog->video_url)
                                            <a href="{{ $blog->video_url }}" target="_blank"
                                                class="flex items-center gap-2 p-3 bg-blue-50 hover:bg-blue-100 rounded-lg text-blue-600 hover:text-blue-700 transition group">
                                                <i class="fas fa-video text-xl"></i>
                                                <span class="font-medium flex-1">Watch Video</span>
                                                <i class="fas fa-arrow-up-right-from-square"></i>
                                            </a>
                                        @endif
                                        @if($blog->audio_url)
                                            <a href="{{ $blog->audio_url }}" target="_blank"
                                                class="flex items-center gap-2 p-3 bg-purple-50 hover:bg-purple-100 rounded-lg text-purple-600 hover:text-purple-700 transition group">
                                                <i class="fas fa-music text-xl"></i>
                                                <span class="font-medium flex-1">Listen Audio</span>
                                                <i class="fas fa-arrow-up-right-from-square"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>


                </div>
            </section>

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