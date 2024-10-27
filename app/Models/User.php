<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'password',
        'email',
        'roleId',
        'alamat',
        'telepon',
        'verify_key',
        'active',
        'nik',
        'nip',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi User ke Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'roleId', 'roleId'); // 'roleId' adalah foreign key di tabel users, 'id' adalah primary key di tabel roles
    }


}
