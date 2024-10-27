<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Session;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('login');
        }
    }

    public function actionLogin(Request $request)
    {
        // Lakukan validasi manual termasuk validasi reCAPTCHA
        $validator = Validator::make($request->all(), [
            
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $data = $request->only('email', 'password');

        // Ambil user berdasarkan email
        $user = DB::table('users')->where('email', $data['email'])->first();

        // Cek apakah user ditemukan
        if ($user) {
            // Cek apakah akun tidak aktif
            if ($user->active == 0) {
                return redirect()->back()->with('error', 'Akun tidak aktif');
            }
            // Cek apakah validasi gagal
        if ($validator->fails()) {
            // Kembalikan ke halaman login dengan error
            return redirect()->back()->with('error', 'Please complete the reCaptcha');
        }

            // Cek apakah password cocok dan auth attempt berhasil
            if (Auth::attempt($data)) {
                // Jika login berhasil, arahkan ke halaman 'home'
                return redirect()->route('home');
            } else {
                // Jika password salah
                return redirect()->back()->with('error', 'Email atau password salah');
            }
        } else {
            // Jika pengguna tidak ditemukan
            return redirect()->back()->with('error', 'Akun tidak ditemukan');
        }
    }

    public function actionLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
