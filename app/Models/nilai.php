<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    protected $table = 'tb_nilai';
 
    
        protected $primaryKey = 'nilai_id';
    
    
    protected $fillable = [
        'nilai_id',
        'siswa_id',
        'datakelas_id',
        'matpel_id',
       'nilaitugas',
       'nilaiuts',
       'nilaiuas',
       'nilaikeaktifan',
       'nilaitotal',
       'keterangan',
    ];
    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(tbSiswa::class, 'siswa_id', 'siswa_id');
    }
    
    
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }
    public function matpel()
    {
        return $this->belongsTo(tbmatpel::class, 'matpel_id');
    }
    
    public function dataKelasDataMengajar()
    {
        return $this->belongsTo(DataKelasDataMengajar::class, 'datakelas_datamengajar_id');
    }
    public function datamengajar()
    {
        return $this->belongsTo(datamengajar::class, 'datamengajar_id');
    }
}
