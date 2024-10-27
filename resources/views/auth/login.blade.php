<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMBAJA | Log In</title>

    <link rel="stylesheet" href="{{ asset('major/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('major/assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('major/assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('major/assets/images/logo/favicon.png') }}" type="image/png">

    <style>
        /* Aturan CSS untuk mengatur warna teks menjadi hitam */
        body {
            color: #000;
            /* Warna teks default menjadi hitam */
        }

        .card-header {
            text-align: center;
            padding: 2rem; /* Tambahkan padding untuk jarak antara gambar dan teks */
        }

        .card-header img {
            max-width: 250px; /* Atur lebar gambar sesuai kebutuhan */
            height: auto;
            margin-bottom: 2rem; /* Jarak antara gambar dan teks */
        }

        .card-body {
            padding: 2rem; /* Tambahkan padding untuk ruang di dalam card */
        }

        /* Aturan untuk memastikan form tetap responsif */
        @media (max-width: 768px) {
            .card {
                width: 90%; /* Atur lebar card pada layar kecil */
            }
        }
    </style>

</head>

<body>
    <div id="main">
        <div class="page-heading">

            <!-- Basic Vertical form layout section start -->
            <section id="basic-vertical-layouts" class="d-flex justify-content-center align-items-center"
                style="min-height: 80vh;">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <img src="{{ asset('major/assets/images/logo/simbaja.png') }}" alt="SIMBAJA Logo" class="img-fluid">
                            <!-- <h4 class="card-title">Wellcome!</h4> -->
                            <p class="text-subtitle text-muted">Sign In Your Account!</p>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical">
                                    <div class="form-body">
                                        <div class="row">
                                            
                                            <div class="col-12">
                                            @if(session('error'))
            <div class="alert alert-danger">
                <b>Opps!</b> {{session('error')}}
            </div>
            @endif
            <form action="{{ route('actionlogin') }}" method="post">
            @csrf
                                                <div class="form-group has-icon-left">
                                                    <label for="email-id-icon">Email</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Email"
                                                            id="email-id-icon">
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
                                                        <input type="password" class="form-control"
                                                            placeholder="Password" id="password-id-icon">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-lock"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Style Checkbox -->
                                            <!-- <style>
                                                /* CSS untuk mengubah warna checkbox saat dicentang menjadi hijau */
                                                .custom-checkbox .form-check-input:checked {
                                                    background-color: #28a745;
                                                    border-color: #28a745;
                                                }
                                                .custom-checkbox .form-check-input:checked:focus {
                                                    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
                                                }
                                            </style> -->
                                            <div class="col-12">
                                                <div class='form-check custom-checkbox'>
                                                    <div class="checkbox mt-2">
                                                        <input type="checkbox" id="remember-me-v"
                                                            class='form-check-input' checked>
                                                        <label for="remember-me-v">Remember Me</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic Vertical form layout section end -->
        </div>
    </div>
    <script src="{{ asset('major/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('major/assets/js/app.js') }}"></script>
</body>

</html>