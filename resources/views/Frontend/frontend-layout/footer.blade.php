<!-- FOOTER -->
<footer class="w-full bg-[#111111] text-[#C4C2C2]  pt-16 pb-10 transition-all duration-500">

    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-12 lg:grid-cols-4 gap-12">

        <!-- Logo + About -->
        <div class="md:col-span-12 lg:col-span-1 md:flex md:flex-col md:items-center md:text-center">

            <img src="{{ asset('assets/images/others/ChatGPT Image Dec 10, 2025, 10_44_43 AM.png') }}"
                class="h-[100px] w-[200px]" alt="Logo" />

            <p class="text-sm leading-relaxed">
                <span class="font-semibold text-white">Finance Advisory</span><br>
                Guiding Financial Growth, Empowering Decisions, and Securing Your Future.
            </p>

        </div>

        <!-- Quick Links -->
        <div class="md:col-span-4 lg:col-span-1">
            <h3 class="text-lg text-white font-semibold mb-4">Quick Links</h3>

            <ul class="list-disc pl-5 space-y-3">
                <li><span class="inline-block transform transition duration-500 hover:translate-x-2 hover:text-white"><a
                            href="{{ route('frontend.blogs') }}">Blogs</a>
                    </span>
                </li>

                <li><a href="{{ url('/') }}#subscriptions"
                        class="inline-block transform transition duration-500 hover:translate-x-2 hover:text-white">Subscriptions</a>
                </li>
                <li><a href="{{ url('/Privacy') }}"
                        class="inline-block transform transition duration-500 hover:translate-x-2 hover:text-white">
                        Privacy Policy</a></li>
                <li><a href="{{ url('/Terms') }}"
                        class="inline-block transform transition duration-500 hover:translate-x-2 hover:text-white">
                        Terms & Conditions</a></li>
                <li><a href="{{ url('/contact') }}"
                        class="inline-block transform transition duration-500 hover:translate-x-2 hover:text-white">Contact</a>
                </li>
                <li><a href="#"
                        class="inline-block transform transition duration-500 hover:translate-x-2 hover:text-white">Login</a>
                </li>
            </ul>
        </div>


        <!-- Social Links -->
        <div class="md:col-span-4 lg:col-span-1">
            <h3 class="text-lg text-white font-semibold mb-4">Follow Us</h3>
            <ul class="list-disc pl-5 space-y-3">
                <li>
                    <a href="https://facebook.com" target="_blank"
                        class="items-center inline-block transform transition duration-500 hover:translate-x-2 hover:text-white">
                        <i class="fab fa-facebook-f mr-2 text-xl"></i> Facebook
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com" target="_blank"
                        class="items-center inline-block transform transition duration-500 hover:translate-x-2 hover:text-white">
                        <i class="fab fa-twitter mr-2 text-xl"></i> Twitter
                    </a>
                </li>
                <li>
                    <a href="https://instagram.com" target="_blank"
                        class="items-center inline-block transform transition duration-500 hover:translate-x-2 hover:text-white">
                        <i class="fab fa-instagram mr-2 text-xl"></i> Instagram
                    </a>
                </li>
                <li>
                    <a href="https://linkedin.com" target="_blank"
                        class="items-center inline-block transform transition duration-500 hover:translate-x-2 hover:text-white">
                        <i class="fab fa-linkedin-in mr-2 text-xl"></i> LinkedIn
                    </a>
                </li>
                <li>
                    <a href="https://youtube.com" target="_blank"
                        class="items-center inline-block transform transition duration-500 hover:translate-x-2 hover:text-white">
                        <i class="fab fa-youtube mr-2 text-xl"></i> YouTube
                    </a>
                </li>
            </ul>
        </div>

        <!-- Recent Posts (Static Example) -->
       <div class="md:col-span-4 lg:col-span-1">
    <h3 class="text-lg text-white font-semibold mb-4">Recent Posts</h3>

    @foreach($recentBlogs as $blog)
        <a href="{{ route('frontend.show', $blog->id) }}" class="flex items-start gap-3 mb-3 group hover:cursor-pointer transition-transform duration-300 hover:scale-105">
            <!-- Image -->
            @if($blog->image_path && file_exists(public_path('assets/blog/image/' . $blog->image_path)))
                <img src="{{ asset('assets/blog/image/' . $blog->image_path) }}"
                     class="rounded-sm w-[50px] h-[50px] object-cover transition-transform duration-500 group-hover:scale-110"
                     alt="{{ $blog->title }}">
            @else
                <div class="rounded-sm w-[50px] h-[50px] bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-image text-gray-400"></i>
                </div>
            @endif

            <!-- Content -->
            <div class="flex-1">
                <p class="text-xs text-gray-400 dark:text-gray-600">
                    {{ \Illuminate\Support\Str::limit($blog->category->title, 40) }}
                </p>

                <h4 class="text-sm font-medium text-gray-100 line-clamp-2">
                    {{ \Illuminate\Support\Str::limit($blog->title, 40) }}
                </h4>

                <!-- Meta -->
                <div class="flex justify-start space-x-3 text-[10px] text-gray-400 mt-1 items-center">
                    <span class="flex items-center gap-1">
                        <i class="fas fa-eye group-hover:text-rose-500"></i> {{ $blog->views ?? 0 }}
                    </span>

                    <span class="flex items-center gap-1">
                        <i class="fas fa-heart group-hover:text-rose-500"></i> {{ $blog->likes ?? 0 }}
                    </span>

                    <span class="flex items-center gap-1">
                        <i class="fas fa-share-alt group-hover:text-rose-500"></i> {{ $blog->shares ?? 0 }}
                    </span>
                </div>
            </div>
        </a>
    @endforeach
</div>


    </div>

    <!-- Social + Copyright -->
    <div class="mt-12 border-t border-gray-700 dark:border-gray-500 pt-6 text-center">
        <p class="text-sm">&copy; {{ date('Y') }} Finance Advisory. All Rights Reserved.</p>
    </div>
</footer>