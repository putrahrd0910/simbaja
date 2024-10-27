@extends('layouts.app')

@section('title', 'SIMBAJA | Detail Users')

@section('content')

<div class="card-header d-flex justify-content-between align-items-left">
    <h3>Detail User</h3>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-right">
        <li class="breadcrumb-item"><a href="/users">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>

<div class="row">
    <!-- Profile Photo and Other User Details in the Same Row -->
    <div class="col-md-4 d-flex justify-content-center align-items-start">
        <!-- Profile Photo Upload -->
        <div class="text-center">
            <div class="avatar-container mb-3">
                @if($user->profile)
                    <img src="{{ asset('storage/profile_photos/' . $user->profile) }}" alt="Profile Photo"
                        class="img-thumbnail rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/150" alt="Profile Photo" class="img-thumbnail rounded-circle"
                        style="width: 150px; height: 150px; object-fit: cover;">
                @endif
            </div>
        </div>
    </div>
    <!-- Other User Details -->
    <div class="col-md-8">
        <!-- NIK -->
        <div class="form-group has-icon-left">
            <label for="nik-id-icon">NIK</label>
            <div class="position-relative">
                <input type="text" name="nik" class="form-control" placeholder="NIK" id="nik-id-icon"
                    value="{{ $user->nik }}" pattern="^\d{16}$" title="NIK harus berisi 16 angka." inputmode="numeric"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)" required>
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
                    value="{{ $user->nip }}" pattern="^\d{18}$" title="NIP harus berisi 18 angka." inputmode="numeric"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 18)" required>
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
                    id="nama-lengkap-id-icon" value="{{ $user->nama_lengkap }}" required>
                <div class="form-control-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
            </div>
        </div>
        <!-- Tanggal Lahir -->
        <div class="form-group has-icon-left">
            <label for="tanggal-lahir-id-icon">Tanggal Lahir</label>
            <div class="position-relative">
                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir"
                    id="tanggal-lahir-id-icon" value="{{ $user->tanggal_lahir }}" required>
                <div class="form-control-icon">
                    <i class="bi bi-calendar"></i>
                </div>
            </div>
        </div>
        <!-- Jenis Kelamin -->
        <div class="form-group has-icon-left">
            <label for="jenis-kelamin-id-icon">Jenis Kelamin</label>
            <div class="position-relative">
                <select name="jenis_kelamin" class="form-control" id="jenis-kelamin-id-icon" required>
                    <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
                <div class="form-control-icon">
                    <i class="bi bi-gender-ambiguous"></i>
                </div>
            </div>
        </div>
        <!-- Alamat -->
        <div class="form-group has-icon-left">
            <label for="alamat-id-icon">Alamat</label>
            <div class="position-relative">
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" id="alamat-id-icon"
                    value="{{ $user->alamat }}" required>
                <div class="form-control-icon">
                    <i class="bi bi-geo-alt"></i>
                </div>
            </div>
        </div>
        <!-- Telepon -->
        <div class="form-group has-icon-left">
            <label for="telepon-id-icon">Telepon</label>
            <div class="position-relative">
                <input type="text" name="telepon" class="form-control" placeholder="Telepon" id="telepon-id-icon"
                    value="{{ $user->telepon }}" pattern="^\d{1,12}$" inputmode="numeric"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)"
                    title="Nomor telepon harus hanya berisi angka, tanpa spasi atau tanda baca, dan maksimal 12 angka."
                    required>
                <div class="form-control-icon">
                    <i class="bi bi-telephone"></i>
                </div>
            </div>
        </div>
        <!-- Username -->
        <div class="form-group has-icon-left">
            <label for="username-id-icon">Username</label>
            <div class="position-relative">
                <input type="text" name="username" class="form-control" placeholder="Username" id="username-id-icon"
                    value="{{ $user->username }}" readonly>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>
        <!-- Email -->
        <div class="form-group has-icon-left">
            <label for="email-id-icon">Email</label>
            <div class="position-relative">
                <input type="email" name="email" class="form-control" placeholder="Email" id="email-id-icon"
                    value="{{ $user->email }}" required>
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
        </div>
        <!-- Role -->
        <div class="form-group mb-3">
            <label for="role">Role</label>
            <input type="text" class="form-control" readonly="readonly" value="{{ $roleName }}" readonly>
        </div>
    </div>
</div>

<a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection