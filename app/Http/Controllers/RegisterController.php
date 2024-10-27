<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\MailSend;
use Illuminate\Support\Facades\DB; 

class RegisterController extends Controller
{
    public function register()
    {
        $role = DB::table('role')->get();
        return view('register', compact('role'));
    }
    
    public function actionregister(Request $request)
    {
        //str random utk verif key
        $str = Str::random(100);
        
        $user = User::create([ 
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'roleId' => $request->roleId,
            'nik'=> $request->nik,
            'nip'=> $request->nip,
            'nama_lengkap'=> $request->nama_lengkap,
            'jenis_kelamin'=> $request->jenis_kelamin,
            'tanggal_lahir'=> $request->tanggal_lahir,
            'verify_key' => $str
            // 'active' => '1'
        ]);

        //array utk Verify Gmail
        $details = [
            'nip'=> $request->nip,
            'nik'=> $request->nik,
            'nama_lengkap'=> $request->nama_lengkap,
            'username' => $request->username,
            'roleId' => $request->roleId,
            'alamat' => $request->alamat,
            'telepon'=> $request->telepon,
            'jenis_kelamin'=> $request->jenis_kelamin,
            'tanggal_lahir'=> $request->tanggal_lahir,
            'website' => 'https://putrahrd0910.github.io/',
            'datetime' => date('Y-m-d h:i:s'),
            'url' => request()->getHttpHost().'/register/verify/'.$str
        ];

    Mail::to($request->email)->send(new MailSend($details));
    Session::flash('message', 'Link verifikasi telah dikrim ke Email Anda. Silahkan Cek Email Anda untuk Mengaktifkan Akun');
    return redirect('register');
    }

    public function verify($verify_key)
{
    $user = User::where('verify_key', $verify_key)->first();

    if (!$user) {
        return "Key tidak valid!";
    }

    $user->email_verified_at = now();
    $user->active = 1;
    $user->verify_key = null; //kosongkan value field verify key

    $user->save();

    // return "Verifikasi Berhasil. Akun Anda sudah aktif.";
    return view('verify');
}


}