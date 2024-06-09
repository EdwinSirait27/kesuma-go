<?php

namespace App\Models;

use App\Http\Controllers\datakelasdatamengajarController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tugas extends Model
{
    protected $table = 'tugas';
    protected $guarded = ['tugas_id'];
    protected $fillable = ['datakelas_datamengajar_id', 'dokumen','keterangan','tipe','created_at','updated_at'];
    protected $primaryKey = 'tugas_id';
    public $timestamps = false;
    public function datakelasdatamengajar()
{
    return $this->belongsTo(DatakelasDatamengajar::class, 'datakelas_datamengajar_id');
}
public function guru()
{
    return $this->belongsTo(tbguru::class);
}
public function datamengajar()
{
    return $this->belongsTo(datamengajar::class,'datamengajar_id');
}

public function datakelas()
{
    return $this->belongsTo(datakelas::class,'datakelas_id');
}

public function matpel()
{
    return $this->belongsTo(tbmatpel::class,'matpel_id');
}
public function tahunakademik()
{
    return $this->belongsTo(tahunakademik::class,'tahunakademik_id');
}
public function kurikulum()
{
    return $this->belongsTo(kurikulum::class,'kurikulum_id');
}
public function pengumpulan()
{
    return $this->belongsTo(pengumpulantugas::class,'pengumpulan_id');
}

}
