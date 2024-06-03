<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ekstraguru extends Model
{
    protected $table = 'ekstra_guru_siswa';

    public $timestamps = false;
    protected $fillable = ['ekskul_id', 'guru_id', 'keterangan','tahunakademik_id'];
    protected $primaryKey = 'ekstra_guru_id';
    public function ekskul()
    {
        return $this->belongsTo(ekstra::class, 'ekskul_id');
    }
    public function guru()
    {
        return $this->belongsTo(tbguru::class, 'guru_id');
    }
    public function siswaekstragurus()
    {
        return $this->hasMany(SiswaEkstraGuru::class, 'ekstra_guru_id');
    }
    public function tahun()
    {
        return $this->belongsTo(datakelas::class, 'tahunakademik_id');
        
    }
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
        
    }
    public function tahun1()
    {
        return $this->belongsTo(tahunakademik::class, 'tahunakademik_id');
    }
    // public function siswa()
    // {
    //     return $this->belongsTo(tbsiswa::class, 'siswa_id', 'siswa_id');
    // }

    // public function siswas()
    // {
    //     return $this->hasMany(TbSiswa::class, 'ekstra_guru_id', 'ekstra_guru_id');
    // }

    // public function ekstrakurikulers()
    // {
    //     return $this->hasMany(ekstra::class, 'ekskul_id');
    // }

    // public function ekstraGurus()
    // {
    //     return $this->belongsToMany(EkstraGuru::class, 'siswa_id', 'ekstra_guru_id');
    // }


}








// <?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class ekstraguru extends Model
// {
//     protected $table   = 'ekstra_guru_siswa';

//     public $timestamps = false;
//     protected $fillable = ['ekskul_id','guru_id','keterangan'];
//     protected $primaryKey = 'ekstra_guru_id';

//     public function ekskul()
//     {
//         return $this->belongsTo(ekstra::class, 'ekskul_id');
//     }
//     public function guru()
//     {
//         return $this->belongsTo(tbguru::class, 'guru_id');
//     }
//     public function siswa()
//     {
//         return $this->belongsTo(tbsiswa::class, 'siswa_id','siswa_id');
//     }
// //     public function siswas()
// // {
// //     return $this->belongsToMany(tbsiswa::class, 'ekstraguru', 'ekstra_guru_id', 'siswa_id');
// // }
// public function siswas()
// {
//     return $this->hasMany(TbSiswa::class, 'ekstra_guru_id', 'ekstra_guru_id');
// }

// public function ekstrakurikulers()
// {
//     return $this->hasMany(ekstra::class, 'ekskul_id');
// }

// public function ekstraGurus()
// {
//     return $this->belongsToMany(EkstraGuru::class, 'siswaekstraguru', 'siswa_id', 'ekstra_guru_id');
// }

// }








