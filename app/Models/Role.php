<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    // Relasi Role ke User
    public function users()
    {
        return $this->hasMany(User::class, 'roleId', 'roleId'); // 'roleId' adalah foreign key di tabel users
    }

    // Tentukan nama tabel jika berbeda dari konvensi Laravel
    protected $table = 'role';  // Ubah sesuai dengan nama tabel di database

    // Tentukan kolom yang dapat diisi
    protected $fillable = ['roleId'];
}
