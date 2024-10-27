<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .alert-custom {
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .footer-text {
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success alert-custom" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <p>{{ __('Your password has been successfully reset.') }}</p>
                        <div class="footer-text">
                            <a href="{{ route('login') }}">{{ __('Click here to log in') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>