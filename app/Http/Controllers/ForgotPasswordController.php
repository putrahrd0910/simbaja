<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{

    // Menampilkan formulir permintaan reset password
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Mengirimkan email reset password
    public function sendResetLinkEmail(Request $request)
    {
        // Validasi input username dan email, pastikan email berasal dari Gmail
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'g-recaptcha-response' => 'required' // Validasi reCaptcha
        ]);

        // Jika validasi gagal, kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Memeriksa apakah reCAPTCHA terisi
        if (!$request->input('g-recaptcha-response')) {
            return redirect()->back()->withErrors([
                'g-recaptcha-response' => 'Silakan isi reCAPTCHA sebelum mengirimkan permintaan.'
            ])->withInput();
        }

        // Mencari pengguna berdasarkan email dan username
        $user = User::where('email', $request->input('email'))
            ->where('username', $request->input('username'))
            ->first();

        // Jika pengguna tidak ditemukan, kirimkan error
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email atau Username tidak ditemukan.'
            ]);
        }

        // Mengirimkan email reset password
        $response = Password::sendResetLink($request->only('email'));

        // Mengecek hasil pengiriman email dan menampilkan feedback dengan username
        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', __('Kami telah mengirimkan link reset password ke email Anda! Username: ' . $user->username))
            : back()->withErrors(['email' => __($response)]);
    }

    // Menampilkan formulir untuk reset password
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    // Mengatur ulang password
    public function reset(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'token' => 'required',
            'email' => 'required|email', // Tambahkan validasi untuk email juga
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',       // Mengandung huruf kecil
                'regex:/[A-Z]/',       // Mengandung huruf besar
                'regex:/[0-9]/',       // Mengandung angka
                'regex:/[@$!%*#?&]/',  // Mengandung karakter spesial
            ],
            'password_confirmation' => 'required|same:password',
        ]);

        // Proses reset password
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'), // Email juga harus disertakan
            function ($user, $password) use ($request) {
                // Update password di sini
                $user->password = Hash::make($password);
                $user->save();

                // Memicu event PasswordReset
                event(new PasswordReset($user));
            }
        );

        // Cek apakah reset password berhasil
        if ($response == Password::PASSWORD_RESET) {
            // Jika berhasil, alihkan ke halaman login dengan pesan sukses
            return redirect()->route('login')->with('status', 'Password berhasil direset!');
        } else {
            // Jika gagal, periksa jenis kesalahan
            return back()->withErrors(['email' => __('Gagal mereset password. Silakan coba lagi.')]);
        }
    }

}
