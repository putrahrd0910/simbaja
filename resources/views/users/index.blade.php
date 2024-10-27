@extends('layouts.app')

@section('title', 'SIMBAJA | Users')

@section('content')
<div class="container">
    <h1>Daftar Users</h1>
    @if(auth()->user()->roleId == '1')
        <!-- Tombol disembunyikan dengan CSS jika kondisi terpenuhi -->
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>
    @else
        <!-- Tombol ditampilkan jika roleId tidak memenuhi kondisi tertentu -->
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3" style="display: none;">Tambah User</a>
    @endif



    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive rounded bg-white p-3">
        <table class="table table-bordered table-hover mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <!-- <td>{{ $user->password }}</td> -->
                        <td>{{ $user->telepon }}</td>
                        <td>{{ $user->active == 1 ? 'Aktif' : 'Non-Aktif' }}</td>
                        <td>
                            {{ $user->roleName }}
                        </td>
                        <td>
                        
                        <a href="{{ route('users.show', $user->id_user) }}" class="btn btn-info">Detail</a>    
                        @if(auth()->user()->roleId == '1')

                                <a href="{{ route('users.edit', $user->id_user) }}" class="btn btn-warning">Edit</a>

                                @if ($user->email_verified_at == 0)
                                    <span class="badge bg-secondary">Belum Aktivasi</span>
                                @else
                                    @if ($user->active == 1)
                                        <form action="{{ route('users.nonaktifkan', $user->id_user) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Anda yakin ingin menonaktifkan user ini?')">Non-Aktif</button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.aktifkan', $user->id_user) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success"
                                                onclick="return confirm('Anda yakin ingin mengaktifkan user ini?')">Aktifkan</button>
                                        </form>
                                    @endif
                                @endif

                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection