@extends('layouts.app')

@section('title', 'SIMBAJA | Edit User')

@section('content')
<div class="container">
    <h3 class="card-title">Edit User</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-right">
            <li class="breadcrumb-item"><a href="/users">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id_user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nik-id-icon" class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control" id="nik-id-icon" value="{{ $user->nik }}" required
                pattern="^\d{16}$" title="NIK harus berisi 16 angka." inputmode="numeric"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)">
        </div>

        <div class="mb-3">
            <label for="nip-id-icon" class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" id="nip-id-icon" value="{{ $user->nip }}" required
                pattern="^\d{18}$" title="NIP harus berisi 18 angka." inputmode="numeric"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 18)">
        </div>

        <div class="mb-3">
            <label for="nama-lengkap-id-icon" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" id="nama-lengkap-id-icon" value="{{ $user->nama_lengkap }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal-lahir-id-icon" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal-lahir-id-icon" value="{{ $user->tanggal_lahir }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis-kelamin-id-icon" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" id="jenis-kelamin-id-icon" required>
                <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="alamat-id-icon" class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" id="alamat-id-icon" value="{{ $user->alamat }}" required>
        </div>

        <div class="mb-3">
            <label for="telepon-id-icon" class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control" id="telepon-id-icon" value="{{ $user->telepon }}"
                required pattern="^\d{1,12}$" title="Nomor telepon harus maksimal 12 digit" inputmode="numeric"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)">
        </div>

        <div class="mb-3">
            <label for="username-id-icon" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username-id-icon" value="{{ $user->username }}" readonly>
        </div>

        <div class="mb-3">
            <label for="email-id-icon" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email-id-icon" value="{{ $user->email }}" required>
        </div>

        <!-- <div class="mb-3">
            <label for="password-id-icon" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password-id-icon">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
        </div> -->

        <div class="mb-3">
            <label for="roleId" class="form-label">Role</label>
            <select name="roleId" class="form-select" id="roleId" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->roleId }}" {{ $role->roleId == $user->roleId ? 'selected' : '' }}>
                        {{ $role->roleName }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 d-flex justify-content-start">
            <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection