@extends('layouts.app')

@section('title', 'SIMBAJA | Ganti Password')

@section('content')
<div class="container py-2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('home') }}" class="btn btn-outline-primary">← Back</a>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.profile') }}">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ganti Password</h5>
                </div>
                <div class="card-body">
                    <!-- Pesan sukses jika ada -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Menampilkan error validasi -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <div class="mb-3 position-relative">
                            <label for="current_password" class="form-label">Password Lama</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                id="current_password" name="current_password" required>
                            <span class="toggle-password" toggle="#current_password"
                                style="cursor: pointer; position: absolute; right: 10px; top: 38px;">
                                <i class="fa fa-eye" id="toggleCurrentPassword"></i>
                            </span>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                id="new_password" name="new_password" required>
                            <span class="toggle-password" toggle="#new_password"
                                style="cursor: pointer; position: absolute; right: 10px; top: 38px;">
                                <i class="fa fa-eye" id="toggleNewPassword"></i>
                            </span>
                            <small class="text-muted">Password harus minimal 8 karakter dan mengandung huruf besar,
                                kecil, angka, dan karakter spesial.</small>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                                id="confirm_password" name="confirm_password" required>
                            <span class="toggle-password" toggle="#confirm_password"
                                style="cursor: pointer; position: absolute; right: 10px; top: 38px;">
                                <i class="fa fa-eye" id="toggleConfirmPassword"></i>
                            </span>
                            @error('confirm_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk mengaktifkan fitur show/hide password -->
<script>
    const togglePasswordVisibility = (passwordField, toggleIcon) => {
        const isPassword = passwordField.type === "password";
        passwordField.type = isPassword ? "text" : "password";
        toggleIcon.classList.toggle('fa-eye', isPassword);
        toggleIcon.classList.toggle('fa-eye-slash', !isPassword);
    };

    document.getElementById('toggleCurrentPassword').addEventListener('click', function () {
        togglePasswordVisibility(document.getElementById('current_password'), this);
    });

    document.getElementById('toggleNewPassword').addEventListener('click', function () {
        togglePasswordVisibility(document.getElementById('new_password'), this);
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        togglePasswordVisibility(document.getElementById('confirm_password'), this);
    });
</script>
@endsection