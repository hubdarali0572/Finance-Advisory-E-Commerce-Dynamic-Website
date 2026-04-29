<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Advisory - Reset Password</title>

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

            <h3 class="login-title">Reset Password</h3>
            <p class="desc-text">
                Enter your new password below to reset your account password.
            </p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success small text-center">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Password Reset Form -->
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email"
                        value="{{ old('email', $request->email) }}" required autofocus
                        class="form-control" placeholder="example@email.com">
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3 position-relative">
                    <label class="form-label">New Password</label>
                    <input type="password" id="password" name="password" required
                        class="form-control pe-5" placeholder="Enter new password">
                    <i id="togglePassword" class="fa-solid fa-eye"
                        style="position: absolute; top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer;"
                        onclick="togglePassword()"></i>
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4 position-relative">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="form-control pe-5" placeholder="Confirm password">
                    @error('password_confirmation')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-flex gap-2 mb-3">
                    <button type="submit" class="btn flex-fill"
                        style="background-color:#0077B5; border:none; color:white; font-weight:600;">
                        Reset Password
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-dark small">Back to Login</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const confirmField = document.getElementById('password_confirmation');
            const icon = document.getElementById('togglePassword');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                confirmField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                confirmField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>
