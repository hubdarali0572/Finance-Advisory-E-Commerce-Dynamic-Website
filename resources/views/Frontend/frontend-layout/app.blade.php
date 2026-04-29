<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Anzway Institutes</title>
    <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
    <meta name="keywords"
    content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, laravel, theme, front-end, ui kit, web">
    <meta name="author" content="Anzway Institutes">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/others/anzway-logo.png') }}">

    <!-- AOS Jquery -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- css -->
    <style>
        /* Hide scrollbar for entire page */
        html,
        body {
            overflow: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
            scroll-behavior: smooth;
            font-family: 'Lora', serif !important;
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }


        /* Faculty Section Css */

        .overlay-delay {
            opacity: 0;
            animation: fadeOverlay 1s ease-in-out 1s forwards;
        }

        @keyframes fadeOverlay {
            from {
                opacity: 0;
            }

            to {
                opacity: 0.2;
            }
        }

        :root {
            --scroll-duration: 20s;
        }

        .infinite-carousel {
            padding-top: 20px;
            padding-bottom: 10px;
        }

        .carousel-track {
            display: flex;
            gap: 1rem;
            align-items: stretch;
            width: max-content;
            animation: scroll-left var(--scroll-duration) linear infinite;
            will-change: transform;
        }

        .carousel-item {
            flex: 0 0 auto;
        }

        .infinite-carousel:hover .carousel-track,
        .infinite-carousel:focus-within .carousel-track {
            animation-play-state: paused;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @media (max-width: 640px) {
            .carousel-item {
                min-width: 240px;
            }

            :root {
                --scroll-duration: 10s;
                /* Mobile faster speed */
            }
        }
    </style>


</head>

<body class="bg-gray-100">

    @include('Frontend.frontend-layout.header')

    <main>
        @yield('content')
    </main>

    @include('Frontend.frontend-layout.footer')

    <!-- AOS Jquery -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script>
        const links = document.querySelectorAll('#navbar a[href^="#"]');

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                // Remove active class from all links
                links.forEach(l => l.classList.remove('text-[#ff5a00]'));

                // Add active class to clicked link
                this.classList.add('text-[#ff5a00]');

                // Scroll to section manually (even if already at that section)
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>


    <script>
        // Wait 4 seconds then remove the message
        setTimeout(function () {
            var msg = document.getElementById('success-msg');
            if (msg) {
                msg.style.transition = "opacity 0.5s";
                msg.style.opacity = "0";
                setTimeout(() => msg.remove(), 500);
            }
        }, 4000); // 4000ms = 4 seconds
    </script>
</body>

</html>