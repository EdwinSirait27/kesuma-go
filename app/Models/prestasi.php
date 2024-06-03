<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestasi extends Model
{
    use HasFactory;
    protected $table   = 'prestasi';
    protected $guarded = ['prestasi_id'];
    protected $fillable = ['siswa_id', 'prestasi', 'keterangan'];
    protected $primaryKey = 'prestasi_id';
    
    public $timestamps = false;
 
    public function siswa()
    {
        return $this->belongsto(tbsiswa::class, 'siswa_id');
    }
}




