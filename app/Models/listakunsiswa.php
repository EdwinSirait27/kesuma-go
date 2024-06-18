<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listakunsiswa extends Model
{
    use HasFactory;
    protected $table   = 'users';
    
     protected $fillable = ['id','username', 'password', 'hakakses', 'remember_token','no_pdf','tahundaftar'];
    public $timestamps = true;
    protected $primaryKey = 'id';
    
 
    public function siswa()
{
    return $this->hasOne(tbsiswa::class, 'siswa_id');
}
public function siswaaa()
{
    return $this->belongsTo(tbsiswa::class); // Definisi relasi back-to-one
}
public function siswaa()
{
    return $this->belongsTo(tbsiswa::class, 'siswa_id', 'id');
}
public function tbsiswa()
{
    return $this->belongsTo(tbsiswa::class, 'siswa_id', 'id');
}
// public function tbsiswa()
// {
//     return $this->belongsTo(tbsiswa::class, 'siswa_id', 'siswa_id');
// }

public function ekskul()
{
    return $this->belongsTo(Ekstra::class, 'ekskul_id');
}
// ListAkunSiswa.php
public function ekstraguru()
{
    return $this->belongsToMany(EkstraGuru::class, 'ekstra_guru_id','ekstraguru','id');
}
 public function listakunsiswa()
{
    return $this->hasOne(listakunsiswa::class, 'id','id');
}

}
