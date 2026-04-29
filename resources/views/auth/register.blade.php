<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Advisory - Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f2f6fc;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            width: 100%;
            max-width: 500px;
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

        .register-title {
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-finance {
            background-color: #4AABDC;
            color: #fff;
            width: 100%;
            font-weight: 600;
            border: none;
            border-radius: 10px;
        }

        .btn-finance:hover {
            background-color: #3A97C8;
        }

        .small1 {
            color: #4AABDC;
        }
    </style>
</head>

<body>
    <div>
        <h1 class="text-center p-3">Register</h1>
        <div class="register-card">

            <!-- Logo -->
            <div class="logo-wrapper">
                <img src="{{ asset('assets/images/others/Finance Advisory Logo Design.png') }}"
                    alt="Finance Advisory Logo">
            </div>

            <!-- Register Form -->

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="form-control">
                    </div>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

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
                    <i class="fa-solid fa-eye position-absolute"
                        style="top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer;"
                        onclick="togglePassword('password', this)"></i>

                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4 position-relative">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="form-control pe-5">
                    <i class="fa-solid fa-eye position-absolute"
                        style="top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer;"
                        onclick="togglePassword('password_confirmation', this)"></i>

                    @error('password_confirmation')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-start align-items-center">
                    <span class="mb-4 text-dark"> <a href="{{ url('/Privacy') }}" class="text-dark">Privacy
                            Policy</a></span>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" name="remember" class="form-check-input">
                    <label class="form-check-label">Please confirm that you agree to our privacy policy</label>
                </div>

                <div class="d-flex gap-2 mb-4">
                    <button type="submit" class="btn flex-fill"
                        style="background-color:#0077B5; border:none; color:white; font-weight:600;">
                        Register
                    </button>
                    <a href="{{ route('login') }}" class="btn flex-fill text-white"
                        style="background-color:#0077B5; border:none; font-weight:600;">
                        Log In
                    </a>
                </div>

            </form>

        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(fieldId, icon) {
            const input = document.getElementById(fieldId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>