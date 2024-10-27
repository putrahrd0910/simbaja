<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMBAJA | Login</title>

    <link rel="stylesheet" href="{{ asset('major/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('major/assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('major/assets/images/logo/simbaja-logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('major/assets/images/logo/simbaja-logo.png') }}" type="image/png">

    <style>
        .toggle-password {
            cursor: pointer;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6 col-12">
        <div class="card" style="border-top: 4px solid #0DA15D;">
            <div class="card-header text-center">
                <img src="{{ asset('major/assets/images/logo/simbaja.png') }}" alt="Logo" class="logo mb-4">
                <h4 class="card-title text-muted h2 mb-4">Sign In Your Account</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    {!! NoCaptcha::renderJs() !!} <!-- utk render script reCAPTCHA -->

                    @if(session('error'))
                        <div class="alert alert-danger">
                            <b>Opps!</b> {{session('error')}}
                        </div>
                    @endif
                    <form action="{{ route('actionlogin') }}" method="post" class="form form-vertical">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="email-id-icon">Email</label>
                                        <div class="position-relative">
                                            <input type="email" name="email" class="form-control" placeholder="Email"
                                                id="email-id-icon" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="password-id-icon">Password</label>
                                        <div class="position-relative">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password" id="password-id-icon" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                            <span class="position-absolute toggle-password"
                                                style="top: 50%; right: 10px; transform: translateY(-50%);">
                                                <i class="bi bi-eye-slash" id="toggle-password-icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- reCAPTCHA -->
                                <div class="col-12">
                                    <div class="form-group">
                                        {!! NoCaptcha::display() !!} <!-- Tambahkan ini untuk widget reCAPTCHA -->
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <div class="checkbox mt-2">
                                            <input type="checkbox" id="remember-me-v" class="form-check-input" checked>
                                            <label for="remember-me-v">Remember Me</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-12">
                                    <p class="text-center">Belum punya akun? <a
                                            href="{{ route('register') }}">Register</a> sekarang!</p>
                                </div> -->
                                <div class="col-12">
                                    <p class="text-center">Lupa password? <a
                                            href="{{ route('password.request') }}">Reset</a> disini!</p>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Log In</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('.toggle-password');
        const passwordField = document.querySelector('#password-id-icon');
        const toggleIcon = document.querySelector('#toggle-password-icon');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute between 'password' and 'text'
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the eye icon between showing and hiding the password
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>

</html>