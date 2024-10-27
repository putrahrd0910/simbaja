<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    // $user ambil data user yg sedang login

    
    // public function profile()
    // {
    //     // $user = Auth::user();
    //     //mengambil data user
    //     $user = DB::table('users')
    //         ->join('role', 'users.roleId', '=', 'role.roleId')
    //         ->select('users.*', 'role.roleName') 
    //         ->get();
    //     return view('profile/myProfile', compact('user')); //data user dikirim ke view
    // }

    // public function getData()
    // {
    //     // Memanggil API JSON
    //     $response = Http::get('https://jsonplaceholder.typicode.com/posts');

    //     // Jika request berhasil
    //     if ($response->successful()) {
    //         // Mendapatkan data dari API dalam bentuk array
    //         $posts = $response->json();

    //         // Mengirim data ke view
    //         return view('home', ['posts' => $posts]);
    //     } else {
    //         // Jika gagal, kirim pesan error
    //         return view('home', ['error' => 'Gagal memuat data dari API.']);
    //     }
    // }

}