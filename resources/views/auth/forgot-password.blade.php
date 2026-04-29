<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Advisory - Forgot Password</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f2f6fc;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 500px;
            min-width: 500px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.08);
        }

        .logo-wrapper img {
            height: 70px;
            display: block;
            margin: 0 auto 20px auto;
        }

        .login-title {
            font-weight: 700;
            font-size: 24px;
            text-align: center;
            margin-bottom: 10px;
        }

        .desc-text {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>
    <div>
        <h1 class="text-center p-3">Forgot Password</h1>

        <div class="login-card">

            <!-- Logo -->
            <div class="logo-wrapper">
                <img src="{{ asset('assets/images/others/Finance Advisory Logo Design.png') }}"
                    alt="Finance Advisory Logo">
            </div>

            <!-- Description -->
            <p class="desc-text">
                Forgot your password? No worries. Enter your email address and we’ll send you a password reset link.
            </p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success small text-center">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-control" placeholder="example@email.com">

                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex gap-2 mb-4">
                    <button type="submit" class="btn flex-fill"
                        style="background-color:#0077B5; border:none; color:white; font-weight:600;">
                        Email Password Reset Link
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-dark small">
                        Back to Login
                    </a>
                </div>
            </form>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
