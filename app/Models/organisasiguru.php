<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class organisasiguru extends Model
{
    protected $table = 'organisasi_guru_siswa';

    public $timestamps = false;
    protected $fillable = ['organisasi_id', 'guru_id', 'siswa_id','keterangan','tahunakademik_id'];
    protected $primaryKey = 'organisasi_guru_siswa_id';
    public function organ()
    {
        return $this->belongsTo(organisasi::class, 'organisasi_id');
    }
    public function guru()
    {
        return $this->belongsTo(tbguru::class, 'guru_id');
    }
    public function siswaorganisasigurus()
    {
        return $this->hasMany(SiswaOrganisasiGuru::class, 'organisasi_guru_siswa_id');
    }
    public function siswa()
    {
        return $this->belongsTo(tbsiswa::class, 'siswa_id');
    }

  public function tahun1()
    {
        return $this->belongsTo(tahunakademik::class, 'tahunakademik_id');
    }
    public function tahun()
    {
        return $this->belongsTo(datakelas::class, 'tahunakademik_id');
        
    }
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
        
    }
    public function kurs()
    {
        return $this->belongsTo(kurikulum::class, 'kurikulum_id');
        
    }

}