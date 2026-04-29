<header class="bg-[#fff]  shadow-lg fixed top-0 w-full z-50">
    <div class="max-w-[1330px] mx-auto flex justify-between items-center md:p-4 p-5 relative">
        <a href="/"> <img src="{{ asset('assets/images/others/Finance Advisory Logo Design.png') }}"
                class="h-[40px] w-auto" alt="Logo"></a>
        <button id="menu-btn" class="lg:hidden text-[#111111] focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
        <nav class="hidden lg:flex">
            <ul class="flex items-center space-x-6 text-[#111111 " id="navbar">
                <li><a href="{{ route('frontend.blogs') }}"
                        class="transition duration-300 {{ request()->is('blogs') ? 'text-blue-600 font-bold' : '' }}">Blogs</a>
                </li>
                {{-- <li><a href="{{ url('/posts') }}"
                        class="transition duration-300 {{ request()->is('posts') ? 'text-blue-600 font-bold' : '' }}">Posts</a>
                </li> --}}
                <li>
                    <a href="{{ url('/') }}#subscriptions" id="subscriptions-link" class="transition duration-300">
                        Subscriptions
                    </a>
                </li>


                <li><a href="{{ url('/Privacy') }}"
                        class="transition duration-300 {{ request()->is('Privacy') ? 'text-blue-600 font-bold' : '' }}">
                        Privacy Policy</a></li>
                <li><a href="{{ url('/Terms') }}"
                        class="transition duration-300 {{ request()->is('Terms') ? 'text-blue-600 font-bold' : '' }}">Terms
                        & Conditions</a></li>
                <li><a href="{{ url('/contact') }}"
                        class="transition duration-300 {{ request()->is('contact') ? 'text-blue-600 font-bold' : '' }}">Contact</a>
                </li>
                <li>
                    <a href="/register" class="ml-4 px-2 py-2 rounded-full text-[#111111]">
                        <i class="fas fa-user-plus mr-2"></i> Register
                    </a>
                </li>
                <li>
                    <a href="/login" class="ml-4 px-2 py-2 rounded-full text-[#111111]">
                        <i class="fas fa-lock mr-2"></i> Login
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div id="mobile-menu" class="overflow-hidden max-h-0 transition-all duration-500 lg:hidden bg-[#fff] w-full px-4">
        <ul class="flex flex-col gap-4 text-[#111111] mt-4 pb-4" id="navbar">
            <li><a href="{{ url('/blogs') }}"
                    class="transition duration-300 {{ request()->is('blogs') ? 'text-blue-600 font-bold' : '' }}">Blogs</a>
            </li>
            {{-- <li><a href="{{ url('/posts') }}"
                    class="transition duration-300 {{ request()->is('posts') ? 'text-blue-600 font-bold' : '' }}">Posts</a>
            </li> --}}
            <li>
                <a href="{{ url('/') }}#subscriptions" id="subscriptions-link" class="transition duration-300">
                    Subscriptions
                </a>
            </li>
            <li><a href="{{ url('/Privacy') }}"
                    class="transition duration-300 {{ request()->is('Privacy') ? 'text-blue-600 font-bold' : '' }}">
                    Privacy Policy</a></li>
            <li><a href="{{ url('/Terms') }}"
                    class="transition duration-300 {{ request()->is('Terms') ? 'text-blue-600 font-bold' : '' }}">Terms
                    & Conditions</a></li>
            <li><a href="{{ url('/contact') }}"
                    class="transition duration-300 {{ request()->is('contact') ? 'text-blue-600 font-bold' : '' }}">Contact</a>
            </li>
            <li>
                <a href="/register" class="px-2 py-2 rounded-full text-[#111111]">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </a>
            </li>
            <li>
                <a href="/login" class="px-2 py-2 rounded-full text-[#111111]">
                    <i class="fas fa-lock mr-2"></i> Login
                </a>
            </li>
        </ul>
    </div>
</header>

<script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        if (menu.classList.contains('max-h-0')) {
            menu.classList.remove('max-h-0');
            menu.classList.add('max-h-[500px]'); // adjust max-height if needed
        } else {
            menu.classList.remove('max-h-[500px]');
            menu.classList.add('max-h-0');
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const link = document.getElementById('subscriptions-link');
        const section = document.querySelector('#subscriptions'); // make sure your section has id="subscriptions"

        function checkActiveLink() {
            // Get current scroll position
            const scrollPos = window.scrollY || window.pageYOffset;

            // Get section position
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;

            // Highlight if homepage and either:
            // 1. URL hash is #subscriptions OR
            // 2. User scrolls into subscriptions section
            if (window.location.pathname === '/' &&
                (window.location.hash === '#subscriptions' || (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight))) {
                link.classList.add('text-blue-600', 'font-bold');
            } else {
                link.classList.remove('text-blue-600', 'font-bold');
            }
        }

        // Run on load
        checkActiveLink();

        // Run on scroll
        window.addEventListener('scroll', checkActiveLink);

        // Run on hash change (if user clicks a link to #subscriptions)
        window.addEventListener('hashchange', checkActiveLink);
    });
</script>