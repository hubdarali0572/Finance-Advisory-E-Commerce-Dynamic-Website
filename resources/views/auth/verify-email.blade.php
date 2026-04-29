<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Advisory - Email Verification</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
            margin-bottom: 20px;
        }

        .desc-text {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            margin-bottom: 25px;
        }

        .btn-primary {
            background-color: #0077B5;
            border: none;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div>
        <div class="login-card">

            <!-- Logo -->
            <div class="logo-wrapper">
                <img src="{{ asset('assets/images/others/Finance Advisory Logo Design.png') }}"
                    alt="Finance Advisory Logo">
            </div>

            <h3 class="login-title">Verify Your Email</h3>

            <!-- Description -->
            <p class="desc-text">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the
                link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </p>

            <!-- Success Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success small text-center">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            @endif

            <div class="d-flex flex-column gap-3">
                <!-- Resend Verification Email -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100">
                        Resend Verification Email
                    </button>
                </form>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary w-100">
                        Log Out
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>