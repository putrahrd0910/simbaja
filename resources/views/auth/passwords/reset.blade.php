<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link rel="stylesheet" href="{{ asset('major/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('major/assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('major/assets/images/logo/simbaja-logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('major/assets/images/logo/simbaja-logo.png') }}" type="image/png">
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header text-center">
                <img src="{{ asset('major/assets/images/logo/simbaja.png') }}" alt="Logo" class="logo mb-4">
                <h4 class="card-title text-muted h2 mb-4">Reset Password</h4>
            </div>

            <div class="card-content">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}" class="form form-vertical">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-body">
                            <div class="row">
                                

                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="password-id-icon">{{ __('Password Baru') }}</label>
                                        <div class="position-relative">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Masukkan password baru">
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                            <span class="position-absolute toggle-password" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                                <i class="bi bi-eye-slash" id="toggle-password-icon"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="password-confirm-id-icon">{{ __('Konfirmasi Password Baru') }}</label>
                                        <div class="position-relative">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Masukkan password baru">
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                            <span class="position-absolute toggle-password-confirm" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                                <i class="bi bi-eye-slash" id="toggle-confirm-password-icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">{{ __('Reset Password') }}</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}">{{ __('Kembali ke Login') }}</a>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('.toggle-password');
        const passwordField = document.querySelector('#password');
        const toggleIcon = document.querySelector('#toggle-password-icon');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });

        const toggleConfirmPassword = document.querySelector('.toggle-password-confirm');
        const confirmPasswordField = document.querySelector('#password-confirm');
        const confirmToggleIcon = document.querySelector('#toggle-confirm-password-icon');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordField.setAttribute('type', type);
            confirmToggleIcon.classList.toggle('bi-eye');
            confirmToggleIcon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>

</html>
