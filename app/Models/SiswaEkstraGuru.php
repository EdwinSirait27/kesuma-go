<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaEkstraGuru extends Model
{
 
    protected $table = 'siswaekstraguru';
    public $timestamps = false;
    protected $fillable = ['siswa_id', 'ekstra_guru_id','predikat','keterangann'];
    protected $primaryKey = 'siswa_ekstra_guru_id';
    public function siswa()
    {
        return $this->belongsTo(tbsiswa::class, 'siswa_id');
    }

    public function ekstraguru()
    {
        return $this->belongsTo(ekstraguru::class, 'ekstra_guru_id');
    }
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
        
    }
}




