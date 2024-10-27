<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMBAJA | Reset Password</title>

    <!-- Menggunakan Bootstrap dan CSS -->
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
                <h4 class="card-title text-muted h2 mb-4">Reset Your Password</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="form form-vertical">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">{{ __('Username') }}</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}" required autofocus>
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Reset Password') }}
                            </button>
                            <center>
                                <p class="mt-2">Kembali ke <a href="{{ route('login') }}" class="text-primary">Login</a></p>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('major/assets/js/app.js') }}"></script>
</body>

</html>
