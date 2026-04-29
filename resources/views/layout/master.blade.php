<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') Finance Advisory</title>
    <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, laravel, theme, front-end, ui kit, web">
    <meta name="author" content="NobleUI">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/others/anzway-logo.png') }}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- End fonts -->

    <!-- FontAwesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <!-- <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}"> -->

    <!-- plugin css -->
    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- end plugin css -->

    @stack('plugin-styles')


    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <!-- end common css -->

    @stack('style')

    <style>
        html,
        body {
            overflow: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
            scroll-behavior: smooth;
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
    </style>

    {{-- listing css --}}

    <style>
        /* Gradient Badge Styles */
        .gradient-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            color: white;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease, transform 0.3s ease;
            white-space: nowrap;
            cursor: default;
        }

        /* Hover Animation for Badges */
        .gradient-badge:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        /* Status Badges */
        .badge-active-gradient {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .badge-rejected-gradient {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        }

        .badge-inactive-gradient {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        }

        .badge-pending-gradient {
            background: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%);
        }

        .badge-unknown-gradient {
            background: linear-gradient(135deg, #757F9A 0%, #D7DDE8 100%);
        }

        /* User Type Badges */
        .badge-superadmin-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .badge-user-gradient {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        /* Subscription Badges */
        .badge-subscription-gradient {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .badge-posts-gradient {
            background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
        }

        .badge-noplan-gradient {
            background: linear-gradient(135deg, #868f96 0%, #596164 100%);
        }

        /* Date Badges */
        .badge-start-gradient {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #333;
        }

        .badge-end-gradient {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: #333;
        }

        /* Views, Likes, Shares Badges */
        .badge-views-gradient {
            background: linear-gradient(135deg, #36D1DC 0%, #5B86E5 100%);
        }

        .badge-likes-gradient {
            background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%);
        }

        .badge-shares-gradient {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        /* Avatar Circle */
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.95rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .avatar-circle:hover {
            transform: scale(1.1);
        }

        /* Action Buttons with Gradients */
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            color: white;
        }

        .view-btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .edit-btn-gradient {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .delete-btn-gradient {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .action-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        /* Table Row Hover Effect */
        .table-row-hover {
            transition: all 0.3s ease;
        }

        .table-row-hover:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        /* Card Hover Effect */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .gradient-badge {
                font-size: 0.75rem;
                padding: 5px 10px;
            }

            .action-btn {
                width: 32px;
                height: 32px;
            }

            .avatar-circle {
                width: 35px;
                height: 35px;
                font-size: 0.85rem;
            }
        }
    </style>


    {{-- view page --}}


    <style>
        /* Media Cards */
        .media-card {
            position: relative;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            height: 350px;
            transition: all 0.3s ease;
        }

        .media-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .video-card {
            border: 3px solid transparent;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #667eea 0%, #764ba2 100%) border-box;
        }

        .image-card {
            border: 3px solid transparent;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #f093fb 0%, #f5576c 100%) border-box;
        }

        .audio-card {
            border: 3px solid transparent;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) border-box;
        }

        .media-icon-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 2;
        }

        .video-card .media-icon-badge i {
            color: #667eea;
        }

        .image-card .media-icon-badge i {
            color: #f5576c;
        }

        .audio-card .media-icon-badge i {
            color: #4facfe;
        }

        .badge-price-gradient {
            background: linear-gradient(90deg, #1c92d2, #f2fcfe);
            color: #000;
        }

        .badge-duration-gradient {
            background: linear-gradient(90deg, #ff512f, #dd2476);
        }

        .media-content {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .media-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }

        .media-placeholder {
            text-align: center;
            color: #adb5bd;
        }

        .audio-wrapper {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            padding: 30px;
            border-radius: 15px;
            height: 100%;
        }

        /* Info Cards */
        .info-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            height: 100%;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .gradient-border-left {
            border-left: 5px solid transparent;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #667eea 0%, #764ba2 100%) border-box;
        }

        .gradient-border-right {
            border-left: 5px solid transparent;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #f093fb 0%, #f5576c 100%) border-box;
        }

        .info-item {
            margin-bottom: 25px;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-weight: 700;
            font-size: 1rem;
            color: #495057;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .info-label i {
            color: #667eea;
        }

        .info-value {
            font-size: 1.25rem;
            color: #212529;
            font-weight: 600;
        }

        .info-value-small {
            font-size: 1rem;
            color: #6c757d;
            line-height: 1.6;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            color: white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .badge-active-gradient {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .badge-inactive-gradient {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        }

        .badge-pending-gradient {
            background: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%);
        }

        /* Tag Badge */
        .tag-badge {
            display: inline-block;
            padding: 8px 16px;
            margin: 4px;
            border-radius: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 0.85rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .tag-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        /* Description Cards */
        .description-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .description-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .description-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 30px;
            font-weight: 700;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }

        .description-content {
            padding: 30px;
            background: #f8f9fa;
            height: auto;
            line-height: 1.8;
            font-size: 1.05rem;
            color: #212529;
        }

        .description-content p {
            margin-bottom: 1rem;
        }

        /* Action Buttons */
        .action-button {
            display: inline-block;
            padding: 12px 30px;
            margin: 5px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .back-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .edit-button {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .action-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .media-card {
                height: 250px;
                margin-bottom: 20px;
            }

            .info-card {
                padding: 20px;
                margin-bottom: 20px;
            }

            .description-header {
                padding: 15px 20px;
                font-size: 1rem;
            }

            .description-content {
                padding: 20px;
                font-size: 0.95rem;
            }

            .action-button {
                display: block;
                width: 100%;
                margin: 10px 0;
            }
        }
    </style>

</head>

<body data-base-url="{{url('/')}}" id="body">

    <script src="{{ asset('assets/js/spinner.js') }}"></script>

    <div class="main-wrapper" id="app">

        @include('layout.sidebar')
        <div class="page-wrapper">
            @include('layout.header')
            <div class="page-content">
                @yield('content')
            </div>
            @include('layout.footer')
        </div>
    </div>

    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- end common js -->

    @stack('custom-scripts')

</body>

</html>