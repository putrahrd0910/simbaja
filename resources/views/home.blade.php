@extends('layouts.app')

@section('title', 'SIMBAJA | Home')

@section('content')

<div class="page-heading d-flex justify-content-between">
    <h2>Dashboard Sirup</h2>
    <div class="d-flex align-items-center">
        @php
            $user = Auth::user();
        @endphp

        <!-- Profil & User yang sedang login -->
        <div class="card">
            <div class="card-body py-4 px-4">
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ $user->username }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ $user->email }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ asset('storage/profile_photos/' . $user->profile) }}"
                                        alt="Profile Picture">
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li>
                            <a class="dropdown-item" href="{{ route('actionlogout') }}">
                                <i class="icon-mid bi bi-box-arrow-right me-2"></i> Logout
                            </a> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pilih Satuan Kerja -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pb-0"
                style="background: linear-gradient(to right, #435ebe, #0099ff); padding: 20px;">
                <h5 class="text-white mb-3">Pilih Satuan Kerja</h5>
            </div>

            <div class="card-body bg-progradient manage-project" style="padding-top: 20px;">
                <form method="post" action="https://simbaja.banyuwangikab.go.id/dashboard">
                    @csrf <!-- Tambahkan CSRF Token untuk keamanan -->
                    <div class="mb-4">
                        <div class="basic-form">
                            <div class="form-group">
                                <label for="single-select" class="form-label">Pilih Satuan Kerja:</label>
                                <select id="single-select" class="form-control wide mb-3" name="kd_satker"
                                    onchange="this.form.submit();">
                                    <option value="">All Satker</option>
                                    <option value="103299">Badan Kepegawaian, Pendidikan dan Pelatihan</option>
                                    <option value="60225">Badan Kesatuan Bangsa dan Politik</option>
                                    <!-- Tambahkan opsi lainnya di sini -->
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Area Konten Utama -->
    <div class="col-12">
        <div class="card">
            <div class="card-header"
                style="background: linear-gradient(to right, #435ebe, #0099ff); color: white;">
                RUP Paket Swakelola Terumumkan
            </div>
            <div class="card-body">
                @if (isset($error))
                    <div class="alert alert-danger">{{ $error }}</div>
                @endif

                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Satker</th>
                            <th>Pagu</th>
                            <th>Nama PPK</th>
                            <th>Tanggal Awal Kontrak</th>
                            <th>Tanggal Akhir Kontrak</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <!-- Card 1 -->
    <div class="col-xl-4 col-sm-12 mb-4">
        <div class="card" id="user-activity">
            <div class="card-header border-0 pb-0 flex-wrap"
                style="background: linear-gradient(to right, #435ebe, #0099ff);">
                <div>
                    <span class="mb-3 d-block fs-16 text-white">RUP Penyedia Terumumkan</span>
                    <h4 class="fs-24 font-w700 mb-3 text-white">
                        <label class="lblRupPenyedia">Rp. 1.247.034.517.568</label>
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="current-tab mt-3">
                    <ul class="nav nav-pills light" role="tablist">
                        <li class="nav-item me-4">
                            <a class="nav-link active" data-bs-toggle="tab" href="#Jenis" role="tab">Jenis Pengadaan</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link" data-bs-toggle="tab" href="#Metode" role="tab">Metode Pemilihan</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="Jenis">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Barang (<strong>48.65%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">513.961.795.189</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Pekerjaan Konstruksi (<strong>20.80%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">524.666.096.069</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Jasa Konsultansi (<strong>9.61%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">26.922.645.075</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Jasa Lainnya (<strong>20.94%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">181.483.981.235</span>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Metode">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Penunjukan Langsung (<strong>0.40%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">2.528.940.000</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Pemilihan Langsung (<strong>1.06%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">3.353.445.097</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Pengadaan Melalui Lelang (<strong>10.94%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">529.012.835.892</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Pengadaan secara Elektronik (<strong>87.59%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">1.000.000.000.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="col-xl-4 col-sm-12 mb-4">
        <div class="card" id="user-activity">
            <div class="card-header border-0 pb-0 flex-wrap"
                style="background: linear-gradient(to right, #435ebe, #0099ff);">
                <div>
                    <span class="mb-3 d-block fs-16 text-white">RUP Penyedia Terumumkan</span>
                    <h4 class="fs-24 font-w700 mb-3 text-white">
                        <label class="lblRupPenyedia">Rp. 1.247.034.517.568</label>
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="current-tab mt-3">
                    <ul class="nav nav-pills light" role="tablist">
                        <li class="nav-item me-4">
                            <a class="nav-link active" data-bs-toggle="tab" href="#Anggaran" role="tab">Anggaran</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link" data-bs-toggle="tab" href="#Perubahan" role="tab">Perubahan</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="Anggaran">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">APBD (<strong>48.65%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">513.961.795.189</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">APBD-P (<strong>20.80%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">524.666.096.069</span>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Perubahan">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Revisi Anggaran (<strong>5.30%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">2.528.940.000</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Tambahan Anggaran (<strong>1.06%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">3.353.445.097</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="col-xl-4 col-sm-12 mb-4">
        <div class="card" id="user-activity">
            <div class="card-header border-0 pb-0 flex-wrap"
                style="background: linear-gradient(to right, #435ebe, #0099ff);">
                <div>
                    <span class="mb-3 d-block fs-16 text-white">RUP Penyedia Terumumkan</span>
                    <h4 class="fs-24 font-w700 mb-3 text-white">
                        <label class="lblRupPenyedia">Rp. 1.247.034.517.568</label>
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="current-tab mt-3">
                    <ul class="nav nav-pills light" role="tablist">
                        <li class="nav-item me-4">
                            <a class="nav-link active" data-bs-toggle="tab" href="#Kontrak" role="tab">Kontrak</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link" data-bs-toggle="tab" href="#Perpanjangan" role="tab">Perpanjangan</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="Kontrak">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Kontrak Aktif (<strong>48.65%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">513.961.795.189</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Kontrak Tidak Aktif (<strong>20.80%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">524.666.096.069</span>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Perpanjangan">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Perpanjangan Kontrak (<strong>5.30%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">2.528.940.000</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fs-17 font-w500">Kontrak Dihentikan (<strong>1.06%</strong>)</span>
                            <span class="fs-17 font-w600 badge bg-primary">3.353.445.097</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection