<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }

    //function ubah password
    public function changePassword(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',  
            'new_password' => [
                'required',
                'string',
                'min:8',              // Minimal 8 karakter
                'regex:/[a-z]/',      // Mengandung huruf kecil
                'regex:/[A-Z]/',      // Mengandung huruf besar
                'regex:/[0-9]/',      // Mengandung angka
                'regex:/[@$!%*#?&]/', // Mengandung karakter spesial
            ],
            'confirm_password' => 'required|same:new_password' // Harus sama dengan password baru
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Mengecek apakah password lama sesuai
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai'])->withInput();
        }

        // Update password pengguna
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('password.change')->with('status', 'Password berhasil diubah!');
    }
}
