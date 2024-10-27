<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        // Mengambil data user yang sedang login dan memuat data role terkait
        $user = Auth::user()->load('role'); // Eager load relasi role

        // Jika user tidak ditemukan, berikan pesan error atau redirect
        if (!$user) {
            return redirect()->route('login')->with('error', 'Akun Tidak Ditemukan!');
        }

        // Memastikan role name ada
        $roleName = $user->role ? $user->role->roleName : 'Role tidak ditemukan';

        // Passing data user dan roleName ke view
        return view('profile/myProfile', compact('user', 'roleName'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nik' => 'required',
            'nip' => 'required',
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'telepon' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required', 
        ]);
    
        if ($request->hasFile('profile')) {
            // Hapus foto lama jika ada
            if ($user->profile && Storage::exists('public/profile_photos/' . $user->profile)) {
                Storage::delete('public/profile_photos/' . $user->profile);
            }
    
            $file = $request->file('profile');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile_photos', $filename);
    
            $user->profile = $filename;
            $user->save();
        }

        // Perbarui data pengguna
        $user->update([
            'nik' => $request->nik,
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'tanggal_lahir' => $request->tanggal_lahir, 
            'jenis_kelamin' => $request->jenis_kelamin, 
        ]);
    
        return redirect()->route('home.profile')->with('success', 'Profile updated successfully.');
    }    
}