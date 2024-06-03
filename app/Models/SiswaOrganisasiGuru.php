<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaOrganisasiGuru extends Model
{
    use HasFactory;
    protected $table = 'siswaorganisasiguru';
    public $timestamps = false;
    protected $fillable = ['siswa_id', 'organisasi_guru_siswa_id'];
    protected $primaryKey = 'siswa_organisasi_guru_id';
    public function siswa()
    {
        return $this->belongsTo(tbsiswa::class, 'siswa_id');
    }
    public function organisasiguru()
    {
        return $this->belongsTo(organisasiguru::class, 'organisasi_guru_siswa_id');
    }
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
        
    }
}


