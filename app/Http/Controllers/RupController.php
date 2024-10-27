<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Session;

class RupController extends Controller
{
    // Fungsi untuk menampilkan data dari database
    public function getData()
    {
        // Mengambil data dari tabel 'rup-paketswakelola-terumumkan' yang ada di database
        $posts = DB::table('rup-paketswakelola-terumumkan')->get();

        // Menampilkan view dengan data dari database (bisa kosong atau tidak)
        return view('apidata', ['posts' => $posts]);
    }


    // Fungsi untuk mengambil data dari API dan menyimpannya ke database ketika refresh
    public function refreshData()
    {
        $ta = 2024; // Tahun Anggaran

        // Memanggil API JSON
        $response = Http::get('https://isb.lkpp.go.id/isb-2/api/fd7a6453-4473-483b-beac-e653420cf271/json/10154/RUP-PaketSwakelola-Terumumkan/tipe/4:12/parameter/' . $ta . ':D159');

        // Jika request berhasil
        if ($response->successful()) {
            // Mendapatkan data dari API dalam bentuk array
            $posts = $response->json();

            // Menghapus semua data dari tabel sebelum menyimpan data baru
            DB::table('rup-paketswakelola-terumumkan')->delete();

            // Menyimpan data baru
            foreach ($posts as $post) {
                DB::table('rup-paketswakelola-terumumkan')->insert(
                    [
                        'kd_rup' => $post['kd_rup'], // Kondisi unik
                        'tahun_anggaran' => $post['tahun_anggaran'],
                        'kd_klpd' => $post['kd_klpd'],
                        'nama_klpd' => $post['nama_klpd'],
                        'jenis_klpd' => $post['jenis_klpd'],
                        'nama_satker' => $post['nama_satker'],
                        'kd_satker' => $post['kd_satker'],
                        'kd_satker_str' => $post['kd_satker_str'],
                        'nama_paket' => $post['nama_paket'],
                        'pagu' => $post['pagu'],
                        'tipe_swakelola' => $post['tipe_swakelola'],
                        'volume_pekerjaan' => $post['volume_pekerjaan'],
                        'uraian_pekerjaan' => $post['uraian_pekerjaan'],
                        'kd_klpd_penyelenggara' => $post['kd_klpd_penyelenggara'],
                        'nama_klpd_penyelenggara' => $post['nama_klpd_penyelenggara'],
                        'nama_satker_penyelenggara' => $post['nama_satker_penyelenggara'],
                        'tgl_awal_pelaksanaan_kontrak' => $post['tgl_awal_pelaksanaan_kontrak'],
                        'tgl_akhir_pelaksanaan_kontrak' => $post['tgl_akhir_pelaksanaan_kontrak'],
                        'tgl_buat_paket' => $post['tgl_buat_paket'],
                        'tgl_pengumuman_paket' => $post['tgl_pengumuman_paket'],
                        'nip_ppk' => $post['nip_ppk'],
                        'nama_ppk' => $post['nama_ppk'],
                        'username_ppk' => $post['username_ppk'],
                        'kd_rup_lokal' => $post['kd_rup_lokal'],
                        'status_aktif_rup' => $post['status_aktif_rup'],
                        'status_delete_rup' => $post['status_delete_rup'],
                        'status_umumkan_rup' => $post['status_umumkan_rup'],
                    ]
                );
            }

            // Setelah refresh dan penyimpanan data, set flash message
            session()->flash('success', 'Data berhasil diperbarui.');

            // Redirect kembali ke halaman RUP
            return redirect()->route('rup');
        } else {
            // Jika gagal memuat data dari API, kembali ke halaman dengan pesan error
            return redirect()->route('rup')->withErrors('Gagal memuat data dari API.');
        }
    }


}
