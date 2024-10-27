@extends('layouts.app')

@section('title', 'SIMBAJA | Create Users')

@section('content')

<h3 class="card-title">Create User</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-right">
        <li class="breadcrumb-item"><a href="/users">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
</nav>
<div class="card-content">
    <div class="card-body">
        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        <form action="{{route('users.store')}}" method="post">
            @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-12">
                        <!-- NIK -->
                        <div class="form-group has-icon-left">
                            <label for="nik-id-icon">NIK</label>
                            <div class="position-relative">
                                <input type="text" name="nik" class="form-control" placeholder="NIK" id="nik-id-icon"
                                    required pattern="^\d{16}$" title="NIK harus berisi 16 angka." inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)">
                                <div class="form-control-icon">
                                    <i class="bi bi-credit-card"></i>
                                </div>
                            </div>
                        </div>
                        <!-- NIP -->
                        <div class="form-group has-icon-left">
                            <label for="nip-id-icon">NIP</label>
                            <div class="position-relative">
                                <input type="text" name="nip" class="form-control" placeholder="NIP" id="nip-id-icon"
                                    required pattern="^\d{18}$" title="NIP harus berisi 18 angka." inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 18)">
                                <div class="form-control-icon">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Nama Lengkap -->
                        <div class="form-group has-icon-left">
                            <label for="nama-lengkap-id-icon">Nama Lengkap</label>
                            <div class="position-relative">
                                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap"
                                    id="nama-lengkap-id-icon" required>
                                <div class="form-control-icon">
                                    <i class="bi bi-person-badge"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Jenis Kelamin -->
                        <div class="form-group has-icon-left">
                            <label for="jenis-kelamin-id-icon">Jenis Kelamin</label>
                            <div class="position-relative">
                                <select name="jenis_kelamin" class="form-control" id="jenis-kelamin-id-icon" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="form-control-icon">
                                    <i class="bi bi-gender-ambiguous"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Tanggal Lahir -->
                        <div class="form-group has-icon-left">
                            <label for="tanggal-lahir-id-icon">Tanggal Lahir</label>
                            <div class="position-relative">
                                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir"
                                    id="tanggal-lahir-id-icon" required>
                                <div class="form-control-icon">
                                    <i class="bi bi-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Alamat -->
                        <div class="form-group has-icon-left">
                            <label for="alamat-id-icon">Alamat</label>
                            <div class="position-relative">
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat"
                                    id="alamat-id-icon" required>
                                <div class="form-control-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Telepon -->
                        <div class="form-group has-icon-left">
                            <label for="telepon-id-icon">Telepon</label>
                            <div class="position-relative">
                                <input type="text" name="telepon" class="form-control" placeholder="Telepon"
                                    id="telepon-id-icon" required pattern="^\d{1,12}$" inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)"
                                    title="Nomor telepon harus hanya berisi angka, tanpa spasi atau tanda baca, dan maksimal 12 angka.">
                                <div class="form-control-icon">
                                    <i class="bi bi-telephone"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Username -->
                        <div class="form-group has-icon-left">
                            <label for="username-id-icon">Username</label>
                            <div class="position-relative">
                                <input type="text" name="username" class="form-control" placeholder="Username"
                                    id="username-id-icon" required>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Email -->
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
                        <!-- Password -->
                        <div class="form-group has-icon-left">
                            <label for="password-id-icon">Password</label>
                            <div class="position-relative">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    id="password-id-icon" required
                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[^\s]{8,}$"
                                    title="Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, karakter khusus, dan tanpa spasi.">
                                <div class="form-control-icon">
                                    <i class="bi bi-lock"></i>
                                </div>
                                <span class="position-absolute toggle-password"
                                    style="top: 50%; right: 10px; transform: translateY(-50%);">
                                    <i class="bi bi-eye-slash" id="toggle-password-icon"></i>
                                </span>
                            </div>
                        </div>
                        <!-- Alamat -->
                        <div class="form-group has-icon-left">
                            <label for="alamat-id-icon">Alamat</label>
                            <div class="position-relative">
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat"
                                    id="alamat-id-icon" required>
                                <div class="form-control-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Role -->
                        <div class="form-group has-icon-left">
                            <label for="role-id-icon"></i> Role</label>
                            <div class="position-relative">
                                <select name="roleId" class="form-control" id="role-id-icon">
                                    @foreach ($role as $a)
                                        <option class="form-control" value="{{ $a->roleId }}">
                                            {{ $a->roleName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-user"></i> Register
                        </button>
                        <hr>
                        <p class="text-center">Sudah punya akun? Silahkan <a href="/login">Login</a> Disini!</p>
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


@endsection