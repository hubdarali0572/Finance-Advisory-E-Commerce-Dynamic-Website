@extends('Frontend.frontend-layout.app')

@push('plugin-styles')
@section('title', 'Excellence in Modern Education')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
<style>
    /* ===============================
   Layout
================================ */
    .subscription-container {
        display: flex;
        gap: 30px;
        width: 100%;
        flex-wrap: wrap;
        justify-content: center;
        padding: 40px 20px;
    }

    .subscription-card {
        background: white;
        border-radius: 10px;
        width: 350px;
        height: auto;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        transition: transform .3s ease, box-shadow .3s ease;
        display: flex;
        flex-direction: column;
    }

    .subscription-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
    }

    /* ===============================
   Header (SAME FOR ALL)
================================ */
    .subscription-header {
        padding: 50px 30px 40px;
        text-align: center;
        color: white;
        position: relative;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .subscription-header::before,
    .subscription-header::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, .12);
    }

    .subscription-header::before {
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
    }

    .subscription-header::after {
        bottom: -30px;
        left: -30px;
        width: 100px;
        height: 100px;
    }

    /* ===============================
   Price
================================ */
    .subscription-price {
        background: white;
        color: #667eea;
        display: inline-block;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .subscription-name {
        font-size: 18px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .subscription-duration {
        font-size: 11px;
        opacity: .9;
    }

    /* ===============================
   Body
================================ */
    .subscription-body {
        padding: 30px 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .subscription-features {
        list-style: none;
        margin-bottom: 30px;
        flex: 1;
    }

    .subscription-features li {
        padding: 15px 0;
        font-size: 13px;
        color: #666;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .subscription-features li::before {
        content: '✓';
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #E8F5E9;
        color: #4CAF50;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: bold;
    }

    /* ===============================
   Button (SAME FOR ALL)
================================ */
    .subscription-btn {
        width: 100%;
        padding: 13px;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all .3s ease;
        text-transform: uppercase;
        border: 2px solid #667eea;
        background: white;
        color: #667eea;
        text-align: center;
    }

    .subscription-btn:hover {
        background: #667eea;
        color: white;
    }

    /* ===============================
   Responsive
================================ */
    @media(max-width:768px) {
        .subscription-card {
            width: 100%;
            max-width: 350px;
        }
    }

    /* slide */
    .marquee {
        display: flex;
        gap: 1rem;
        animation: marquee 30s linear infinite;
    }

    .marquee:hover {
        animation-play-state: paused;
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-100%);
            /* scroll full width for seamless effect */
        }
    }

    /* Faster on smaller screens */
    @media (max-width: 768px) {
        .marquee {
            animation-duration: 8s;
            /* much faster */
        }
    }

    @media (max-width: 480px) {
        .marquee {
            animation-duration: 5s;
            /* super fast on very small screens */
        }
    }
</style>


@section('content')

    <!--  Section Category + Post Latest one display  start-->
    <section class="py-10 mt-12 bg-gray-50">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-[150px]">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Category Section --}}
                @foreach($categories as $category)
                    {{-- Main Featured Article --}}
                    <div class="lg:col-span-2">
                        <div
                            class="relative h-72 sm:h-96 md:h-[500px] lg:h-[670px] rounded-lg overflow-hidden group cursor-pointer">
                            @if($category->image_path && file_exists(public_path('assets/category/image/' . $category->image_path)))
                                <img src="{{ asset('assets/category/image/' . $category->image_path) }}"
                                    alt="{{ $category->title ?? 'Category Image' }}"
                                    style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <div class="d-flex flex-column align-items-center justify-content-center" style="height:100%;">
                                    <i class="fas fa-image fa-3x text-white/60 mt-5"></i>
                                    <p class="mt-2 text-white/60">No Image Uploaded</p>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 lg:p-8 group">
                                <h1
                                    class="transition-transform duration-500  group-hover:text-pink-500  text-white text-2xl sm:text-3xl md:text-4xl font-bold leading-tight mb-2 sm:mb-4">
                                    {{ $category->title }}
                                </h1>
                                <div class="flex items-center text-white/80 text-xs sm:text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($category->created_at)->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Blogs Sidebar --}}

                    <div class="lg:col-span-1">
                        <div class="flex border-b border-gray-200 mb-4 sm:mb-6">
                            <button
                                class="px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base font-medium text-gray-900 border-b-2 border-gray-900 flex items-center">
                                <span class="mr-2">⭐</span>
                                Recent Posts
                            </button>
                        </div>
                        <div>
                            @foreach($category->blogs->take(5) as $key => $blog)
                                <a href="{{ route('frontend.show', $blog->id) }}"
                                    class="flex gap-3 sm:gap-4 group cursor-pointer transition-shadow hover:shadow-lg rounded-lg p-2 sm:p-3 hover:bg-gray-50">

                                    <div class="relative flex-shrink-0">
                                        {{-- Number Badge --}}
                                        <span
                                            class="absolute -top-2 -left-2 bg-black text-white text-xs sm:text-sm font-bold w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center rounded z-10  transition-transform duration-500  group-hover:text-pink-500  group-hover:scale-105">
                                            {{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}
                                        </span>

                                        {{-- Blog Image --}}
                                        @if($blog->image_path && file_exists(public_path('assets/blog/image/' . $blog->image_path)))
                                            <img src="{{ asset('assets/blog/image/' . $blog->image_path) }}" alt="{{ $blog->title }}"
                                                class="w-16 h-16 sm:w-20 sm:h-20 rounded object-cover transition-transform duration-500 group-hover:scale-105">
                                        @else
                                            <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gray-200 rounded flex items-center justify-center">
                                                <i class="fas fa-image fa-2x text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        {{-- Category Name --}}
                                        <p
                                            class="text-xs sm:text-sm text-gray-500 uppercase tracking-wide mb-1 group-hover:text-pink-500">
                                            {{ $category->name }}
                                        </p>

                                        {{-- Blog Title --}}
                                        <h3
                                            class="text-sm sm:text-base font-semibold text-gray-900 leading-tight mb-1 sm:mb-2 group-hover:text-gray-600 transition-colors line-clamp-2">
                                            {{ $blog->title }}
                                        </h3>

                                        {{-- Blog Date --}}
                                        <div class="flex items-center text-xs sm:text-sm text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>{{ \Carbon\Carbon::parse($blog->blog_date)->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                    </div>

                @endforeach

            </div>
        </div>
    </section>
    <!--  Section Category + Post Latest one display  End-->

    {{-- Each User Display 6 latest blogs Start--}}
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            @foreach($users as $user)
                <h2 class="text-2xl font-bold mb-6">{{ $user->name }}'s Blogs</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($user->blogs as $blog)
                        <a href="{{ route('frontend.show', $blog->id) }}"
                            class="group block bg-white rounded-sm overflow-hidden shadow-sm hover:shadow-2xl transition-transform duration-500  hover:-translate-y-1">

                            {{-- Blog Image --}}
                            <div class="relative h-48 overflow-hidden">
                                @if($blog->image_path && file_exists(public_path('assets/blog/image/' . $blog->image_path)))
                                    <img src="{{ asset('assets/blog/image/' . $blog->image_path) }}" alt="{{ $blog->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="flex items-center justify-center w-full h-full bg-gray-200">
                                        <i class="fas fa-image fa-2x text-gray-400"></i>
                                    </div>
                                @endif

                                {{-- NEW Badge --}}
                                @if(\Carbon\Carbon::parse($blog->created_at)->diffInDays() <= 7)
                                    <span
                                        class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm transform duration-700 group-hover:scale-125 text-rose-500 text-xs font-bold px-3 py-1 rounded-full">NEW</span>
                                @endif
                            </div>

                            {{-- Blog Content --}}
                            <div class="p-5 space-y-3">
                                {{-- Category & Reading Time --}}
                                <div class="flex items-center gap-2 mb-2 text-xs sm:text-sm text-gray-500">
                                    <span class="flex items-center gap-1 text-rose-500">
                                        <i class="fas fa-folder"></i> {{ $blog->category->name ?? 'General' }}
                                    </span>
                                    <span>•</span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}
                                    </span>


                                </div>

                                {{-- Title --}}
                                <h3 class="text-lg font-bold text-gray-900 transition-colors line-clamp-2">
                                    {{ $blog->title }}
                                </h3>

                                {{-- Short Description --}}
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    {!! \Illuminate\Support\Str::limit(\Illuminate\Support\Str::markdown($blog->short_description)) !!}
                                </p>

                                {{-- Author & Date --}}
                                <div class="flex items-center justify-between mt-3 group">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ $user && $user->profile_photo && file_exists(public_path('userimages/' . $user->profile_photo)) ? asset('userimages/' . $user->profile_photo) : 'https://i.pravatar.cc/40?img=1' }}"
                                            alt="{{ $user->name }}"
                                            class="w-8 h-8 rounded-full group-hover:scale-125 transform duration-500">
                                        <span
                                            class="text-sm font-medium text-gray-700 group-hover:text-rose-500">{{ $user->name }}</span>
                                    </div>
                                    <span class="text-xs text-gray-400 flex items-center gap-1 group-hover:text-rose-500">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ \Carbon\Carbon::parse($blog->blog_date)->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>

    </section>
    {{-- Each User Display 6 latest blogs End--}}

    {{-- Blogs Slider Start --}}

    <section class="relative py-12 bg-gradient-to-b from-white to-gray-50">

        <!-- HEADER -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8 text-center">
            <h2 class="text-2xl font-semibold text-gray-900 tracking-tight">
                Explore Trending Blogs
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Discover the latest stories, insights, and updates shared by our amazing community. Stay inspired and
                informed!
            </p>
        </div>
        @php
            $category = $categories->first();
        @endphp

        @if($category && $category->blogs && $category->blogs->count())
            <!-- MARQUEE WRAPPER -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden">
                <div class="flex gap-4 marquee">

                    @foreach($category->blogs as $blog)
                        <a href="{{ route('frontend.show', $blog->id) }}"
                            class="flex-shrink-0 w-[300px] bg-white rounded-sm shadow-sm flex flex-col">
                            <div class="h-44 overflow-hidden rounded-t-xl">
                                @if($blog->image_path && file_exists(public_path('assets/blog/image/' . $blog->image_path)))
                                    <img src="{{ asset('assets/blog/image/' . $blog->image_path) }}" class="w-full h-full object-cover"
                                        alt="{{ $blog->title }}">
                                @else
                                    <div class="h-44 bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-3xl"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- CONTENT -->
                            <div class="p-4 flex-1 flex flex-col justify-center space-y-2 text-center group">
                                <h3 class="text-sm font-medium text-gray-900 line-clamp-2">
                                    {{ $blog->title }}
                                </h3>

                                <!-- META -->
                                <div class="flex justify-center space-x-3 mt-2 text-gray-500 text-xs sm:text-sm">
                                    <span class="flex items-center gap-1 bg-gray-100 px-2 py-1 rounded-full">
                                        <i class="fas fa-eye"></i> {{ $blog->views ?? 0 }}
                                    </span>
                                    <span class="flex items-center gap-1 bg-pink-100 px-2 py-1 rounded-full">
                                        <i class="fas fa-heart"></i> {{ $blog->likes ?? 0 }}
                                    </span>
                                    <span class="flex items-center gap-1 bg-green-100 px-2 py-1 rounded-full">
                                        <i class="fas fa-share"></i> {{ $blog->shares ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach

                    <!-- Duplicate for seamless scroll -->
                    @foreach($category->blogs as $blog)
                        <a href="{{ route('frontend.show', $blog->id) }}"
                            class="flex-shrink-0 w-[300px] bg-white rounded-xl shadow-sm flex flex-col">
                        </a>
                    @endforeach

                </div>
            </div>

        @endif
    </section>

    {{-- Blogs Slider End --}}

    <!-- Subscription Plans Section Start-->
    <div class="text-center mb-5 py-6" id="subscriptions">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">
            Find the Perfect Plan for Your Growth
        </h2>
        <p class="text-gray-600 text-lg sm:text-xl">
            Flexible, transparent pricing designed to scale with your goals—no hidden costs, no surprises.
        </p>
    </div>
    <div class="subscription-container">

        @foreach($subscriptions as $subscription)
            @php
                $days = \Carbon\Carbon::parse($subscription->start_date)
                    ->diffInDays(\Carbon\Carbon::parse($subscription->end_date)) + 1;
            @endphp

            <div class="subscription-card group ">

                <div class="subscription-header ">
                    <div class="subscription-price transform duration-700 group-hover:scale-125">
                        ${{ number_format($subscription->price, 0) }}
                    </div>
                    <div class="subscription-name transform duration-700 group-hover:scale-125">{{ $subscription->title }}</div>
                    <div class="subscription-duration transform duration-700 group-hover:scale-125">{{ $days }} DAYS</div>
                </div>

                <div class="subscription-body">

                    @php
                        $html = \Illuminate\Support\Str::markdown($subscription->description);
                        $doc = new DOMDocument();
                        libxml_use_internal_errors(true);
                        $doc->loadHTML('<body>' . $html . '</body>');
                        libxml_clear_errors();
                        $lis = $doc->getElementsByTagName('li');
                    @endphp

                    <ul class="subscription-features transform duration-700 group-hover:scale-105">
                        @foreach($lis as $li)
                            <li>{{ $li->nodeValue }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ route('login') }}" class="subscription-btn"> Subscribe Now →</a>

                </div>
            </div>

        @endforeach
    </div>

    <!-- Subscription Plans Section End-->







@endsection