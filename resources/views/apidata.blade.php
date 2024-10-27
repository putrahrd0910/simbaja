@extends('layouts.app')

@section('title', 'SIMBAJA | API')

@section('content')
<div class="page-content">
    <div class="page-heading">

          <!-- Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-left: 10px; background: transparent; border: none; color: inherit;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <i class="fas fa-exclamation-triangle"></i>
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-left: 10px; background: transparent; border: none; color: inherit;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header" style="border-top: 4px solid #0DA15D; color: black;">
                    RUP Paket Swakelola Terumumkan
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <!-- Refresh Button -->
                        <form action="{{ route('refreshData') }}" method="GET">
                            <button type="submit" class="btn btn-primary">
                                Refresh Data
                            </button>
                        </form>
                    </div>

                    <!-- Table Data -->
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
                        <tbody>
                            @if($posts->isNotEmpty())
                                @foreach($posts as $key => $post)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $post->nama_satker }}</td>
                                        <td>{{ number_format($post->pagu, 2, ',', '.') }}</td>
                                        <td>{{ $post->nama_ppk }}</td>
                                        <td>{{ date('d-m-Y', strtotime($post->tgl_awal_pelaksanaan_kontrak)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($post->tgl_akhir_pelaksanaan_kontrak)) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data yang tersedia.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    // Automatically add the 'show' class to notifications to trigger the animation
    $(document).ready(function() {
        $('.alert').addClass('show');

        // Menghapus notifikasi setelah satu jam (1 jam = 3600000 ms)
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3600000); // 3600000 ms = 1 jam
    });
</script>

@endsection