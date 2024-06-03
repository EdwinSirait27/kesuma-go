<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswamengajar extends Model
{
    protected $table = 'siswa_mengajar';
 
    protected $guarded = ['siswa_mengajar_id'];

        protected $primaryKey = 'siswa_mengajar_id';
    
    
    protected $fillable = [
        'tahunakademik_id',
        'kurikulum_id',
        'siswa_id',
        'datakelas_id',
        'datamengajar_id',
        'nilaitugas',
        'nilaiuts',
        'nilaiuas',
        'nilaikeaktifan',
        'nilaitotal',
        
       'keterangan',
       'nilaitugas1',
       'nilaitugas2',
       'nilaitugas3',
       'nilaitugas4',
       'nilaitugas5',
       
    ];
    public $timestamps = false;
    public function tahunakademik()
    {
        return $this->belongsto(tahunakademik::class, 'tahunakademik_id');
    }
    public function kurikulum()
    {
        return $this->belongsto(kurikulum::class, 'kurikulum_id');
    }
    public function siswa()
    {
        return $this->belongsto(tbsiswa::class, 'siswa_id');
    }
    public function datakelas()
    {
        return $this->belongsto(datakelas::class, 'datakelas_id');
    }
    public function datamengajar()
    {
        return $this->belongsto(datamengajar::class, 'datamengajar_id');
    }
    public function kelas()
    {
        return $this->belongsto(kelas::class, 'kelas_id');
    }
    public function matpel()
    {
        return $this->belongsto(tbmatpel::class, 'matpel_id');
    }
    public function guru()
    {
        return $this->belongsto(tbguru::class, 'guru_id');
    }
}
