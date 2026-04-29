<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Advisory - Login</title>

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

        .small1 {
            color: #4AABDC;
        }
    </style>
</head>

<body>
    <div>
        <h1 class="text-center p-3">Login to Account</h1>
        <div class="login-card">

            <div class="logo-wrapper">
                <img src="{{ asset('assets/images/others/Finance Advisory Logo Design.png') }}"
                    alt="Finance Advisory Logo">
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label">Email / Phone</label>
                    <div>
                        <input type="text" name="login" value="{{ old('login') }}"  required autofocus
                            class="form-control" placeholder="Email or 03xxxxxxxxx">
                    </div>
                    @error('login')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4 position-relative">
                    <label class="form-label">Password</label>
                    <input type="password" id="password" name="password" required class="form-control pe-5">

                    <i id="togglePassword" class="fa-solid fa-eye"
                        style="position: absolute; top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer;"
                        onclick="togglePassword()"></i>

                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" name="remember" class="form-check-input">
                    <label class="form-check-label">Keep me signed in</label>
                </div>

                <div class="d-flex gap-2 mb-4">
                    <button type="submit" class="btn flex-fill"
                        style="background-color:#0077B5; border:none; color:white; font-weight:600;">
                        Log In
                    </button>
                    <a href="{{ route('register') }}" class="btn flex-fill text-white"
                        style="background-color:#0077B5; border:none; font-weight:600;">
                        Register
                    </a>
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-dark small mb-4 mt-3">Forgot Password?</a>
                    @endif
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <span class="mb-4 text-dark"> Or Login with LinkedIn</span>
                </div>


                <div class="d-flex gap-2 mb-4">
                    <a href="#" target="_blank"
                        class="btn flex-fill text-white d-flex align-items-center justify-content-center"
                        style="background-color:#0077B5; border:none; font-weight:600;">
                        <i class="fab fa-linkedin me-2"></i> LinkedIn
                    </a>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/Terms') }}" class="text-dark small">Terms & Conditions</a>
                    <a href="{{ url('/Privacy') }}" class="text-dark small">Privacy Policy</a>
                </div>

            </form>


        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const icon = document.getElementById('togglePassword');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>