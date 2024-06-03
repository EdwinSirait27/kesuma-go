<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // ...
    protected $table = 'users'; 
    protected $primaryKey = 'id';

    /**
     * Mendefinisikan relasi antara User dan UserProfile.
     */

    // ...

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'hakakses',
        'created_at',
        'updated_at',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'role' => 'array',
    ];



// relasi guru untuk ditampilkan di sidebar dan navbar

// Di dalam model User
public function guru()
{
    return $this->belongsto(tbguru::class, 'guru_id');
}
// Di model User
// Di dalam model User
public function tbsiswa()
{
    return $this->belongsTo(tbsiswa::class, 'siswa_id');
}
public function akunguru()
{
    return $this->belongsTo(listakun::class, 'id');
}
public function akunsiswa()
{
    return $this->belongsTo(listakun::class, 'id');
}
// jangan duiganti diatas
public function siswa()
{
    return $this->belongsto(tbsiswa::class, 'siswa_id');
}
// Dalam model ListAkun.php


}