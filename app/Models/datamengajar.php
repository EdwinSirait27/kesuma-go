<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datamengajar extends Model
{
    protected $table   = 'datamengajar';
   
    public $timestamps = false;
    protected $fillable = ['matpel_id','guru_id','hari','time_start','time_end','time_start1','time_end1','keterangan','kelas_id'];
    protected $primaryKey = 'datamengajar_id';

    public function datakelas()
    {
        return $this->belongsToMany(Datakelas::class, 'datakelas_datamengajar', 'datamengajar_id', 'datakelas_id');
    }
    
    public function guru()
    {
        return $this->belongsTo(tbguru::class, 'guru_id');
    }
    public function matpel()
    {
        return $this->belongsTo(tbmatpel::class, 'matpel_id');
    }
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }
    
    public function datakelasdatamengajars()
    {
        return $this->hasMany(DatakelasDatamengajar::class, 'datamengajar_id');
    }
    public function datakelasdatamengajar()
    {
        return $this->hasMany(DatakelasDatamengajar::class, 'datakelas_datamengajar_id');
    }
    // Di dalam model Datamengajar

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($datamengajar) {
            $kelas_id_baru = $datamengajar->kelas_id;
            $kelas_id_lama = $datamengajar->getOriginal('kelas_id');

            // Jika nilai kelas_id berubah
            if ($kelas_id_baru !== $kelas_id_lama) {
                // Temukan dan hapus entri siswamengajar yang memiliki datamengajar_id yang sesuai
                Siswamengajar::where('datamengajar_id', $datamengajar->datamengajar_id)->delete();
            }
        });
    }

}




