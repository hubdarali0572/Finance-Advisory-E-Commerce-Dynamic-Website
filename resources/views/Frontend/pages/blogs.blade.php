@extends('Frontend.frontend-layout.app')

@section('title', 'Excellence in Modern Education')

@section('content')
    <div class="max-w-8xl mx-auto py-12 px-4 mt-[60px]">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">Explore Our Latest Blogs</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Dive into insightful articles, expert tips, and the latest trends in modern education. Stay informed,
                inspired, and ahead in your learning journey.
            </p>
        </div>

        <section class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @foreach($userBlogs as $user)
                    <h2 class="text-2xl font-bold mb-6">{{ $user->name }}'s Blogs</h2>

                    <div x-data="{ showAll: false }">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-4">
                            @foreach($user->blogs as $index => $blog)
                                <a href="{{ route('frontend.show', $blog->id) }}" class="group block"
                                    x-show="showAll || {{ $index }} < 6" x-transition>
                                    <article class="relative flex flex-col bg-white rounded-md shadow-md overflow-hidden 
                                                                                  ">
                                        <!-- Image -->
                                        <div class="relative h-56 overflow-hidden">
                                            @if($blog->image_path && file_exists(public_path('assets/blog/image/' . $blog->image_path)))
                                                <img src="{{ asset('assets/blog/image/' . $blog->image_path) }}"
                                                    alt="{{ $blog->title }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full bg-gray-200">
                                                    <i class="fas fa-image fa-2x text-gray-400"></i>
                                                </div>
                                            @endif

                                            @if(\Carbon\Carbon::parse($blog->created_at)->diffInDays() <= 7)
                                                <span
                                                    class="absolute top-3 right-3 bg-rose-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                                    NEW
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Content -->
                                        <div class="p-5 flex flex-col flex-1">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="text-xs font-semibold text-white bg-rose-500 px-2 py-1 rounded-full transform duration-500 group-hover:scale-105">
                                                    {{ $blog->category->name ?? 'General' }}
                                                </span>
                                                <span class="text-gray-300">•</span>
                                                <span class="text-xs text-gray-500">
                                                    {{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</span>
                                            </div>

                                            <h3 class="text-lg font-bold text-gray-900 transition-colors line-clamp-1">
                                                {{ $blog->title }}
                                            </h3>

                                            <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                                                {!! \Illuminate\Support\Str::limit(\Illuminate\Support\Str::markdown($blog->short_description), 100) !!}
                                            </p>

                                            <div class="flex items-center justify-between mb-4 text-gray-500 text-xs font-medium">
                                                <div class="flex items-center gap-4">
                                                    <div class="flex items-center gap-1">
                                                        <i class="fas fa-eye group-hover:text-red-600"></i>
                                                        <span>{{ $blog->views ?? 0 }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        <i class="fas fa-heart group-hover:text-red-600"></i>
                                                        <span>{{ $blog->likes ?? 0 }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        <i class="fas fa-share group-hover:text-red-600"></i>
                                                        <span>{{ $blog->shares ?? 0 }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-auto flex items-center justify-between">
                                                <div class="flex items-center gap-2">
                                                    <img src="{{ $user && $user->profile_photo && file_exists(public_path('userimages/' . $user->profile_photo)) ? asset('userimages/' . $user->profile_photo) : 'https://i.pravatar.cc/40?img=1' }}"
                                                        alt="{{ $user->name }}"
                                                        class="w-9 h-9 rounded-full border border-gray-200 transform duration-500 group-hover:scale-125">
                                                    <span
                                                        class="text-sm font-medium text-gray-700 group-hover:text-red-600">{{ $user->name }}</span>
                                                </div>
                                                <span
                                                    class="text-xs text-gray-400 group-hover:text-red-600">{{ \Carbon\Carbon::parse($blog->blog_date)->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    </article>
                                </a>
                            @endforeach
                        </div>

                        <!-- Show More Button -->
                        @if(count($user->blogs) > 6)
                            <div class="text-center mb-12">
                                <button @click="showAll = !showAll"
                                    class="px-6 py-2 bg-rose-500 text-white rounded-full hover:bg-red-700 transition">
                                    <span x-text="showAll ? 'Show Less' : 'Show More'"></span>
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach



            </div>
        </section>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>

@endsection