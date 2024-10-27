<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $idLogin = Auth::user()->id_user;
        // Mengambil semua user dan melakukan join dengan tabel role untuk mendapatkan roleName
        $users = DB::table('users')
            ->leftJoin('role', 'users.roleId', '=', 'role.roleId')
            ->select('users.*', 'role.roleName')
            ->where('users.id_user', '!=', $idLogin)
            ->get();

        return view('users.index', compact('users'));
    }

    // Menampilkan form untuk menambah user baru
    public function create()
    {
        //multiuser
        if (auth()->user()->roleId !== '1') {
            $role = DB::table('role')->get();
            return view('users.create', compact('role'));
        } else {
            return redirect()->back();
        }
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'username' => 'required|unique:users,username', //unique
            'email' => 'required|email|unique:users,email', //unique
            'password' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'roleId' => 'required',
            'nik' => 'required',
            'nip' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        //str random utk verif key
        $str = Str::random(100);

        // Membuat user baru
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'roleId' => $request->roleId,
            'nik' => $request->nik,
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'verify_key' => $str
        ]);

        //array utk Verify Gmail
        $details = [
            'nip' => $request->nip,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'roleId' => $request->roleId,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'website' => 'https://putrahrd0910.github.io/',
            'datetime' => date('Y-m-d h:i:s'),
            'url' => request()->getHttpHost() . '/register/verify/' . $str
        ];

        Mail::to($request->email)->send(new MailSend($details));
        Session::flash('message', 'Link verifikasi telah dikrim ke Email Anda. Silahkan Cek Email Anda untuk Mengaktifkan Akun');
        return redirect('users/create');
        //return redirect()->back()->with('success', 'User berhasil dibuat!');
    }

    // Menampilkan informasi lengkap user
    public function show($id_user)
    {
        // Temukan user berdasarkan ID
        $user = User::find($id_user)->load('role');

        // Periksa apakah user ditemukan
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User tidak ditemukan.');
        }

        // Memastikan role name ada
        $roleName = $user->role ? $user->role->roleName : 'Role tidak ditemukan';

        // Passing data user dan roleName ke view
        return view('users/show', compact('user', 'roleName'));
    }

    // Menampilkan form untuk mengedit user
    public function edit($id_user)
    {
        //multiuser
        if (auth()->user()->roleId == '1') {
            $user = User::find($id_user);
            $roles = DB::table('role')->get(); // Ambil daftar role dari tabel role
            return view('users.edit', compact('user', 'roles'));
        } else {
            return redirect()->back();
        }
    }

    // Memperbarui data user
    public function update(Request $request, $id_user)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required',
            'nip' => 'required',
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'telepon' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
        ]);

        // Temukan pengguna berdasarkan ID         
        $user = User::find($id_user);

        // Periksa apakah pengguna ditemukan
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User tidak ditemukan.');
        }

        // Perbarui data pengguna
        $user->update([
            'nik' => $request->nik,
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'roleId' => $request->roleId,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function nonaktifkan($id_user)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::find($id_user);

        // Periksa apakah pengguna ditemukan
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User tidak ditemukan.');
        }

        // Perbarui kolom active menjadi 0
        $user->active = 0;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil dinonaktifkan.');
    }

    //Aktivasi Akun
    public function aktifkan($id_user)
    {
        // Temukan user berdasarkan ID
        $user = User::find($id_user);

        // Periksa apakah user ada
        if ($user) {
            // Set active menjadi 1
            $user->active = 1;
            $user->save(); // Simpan perubahan
        } else {
            $message = 'User tidak ditemukan';
        }

        // Redirect dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User berhasil diaktifkan');
    }

}