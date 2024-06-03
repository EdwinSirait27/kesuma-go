<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengumpulantugas extends Model
{
    protected $table = 'pengumpulan';
    protected $guarded = ['pengumpulan_id'];
    protected $primaryKey = 'pengumpulan_id';
    public $timestamps = false;
    protected $fillable = [ 'siswa_id', 'tugas_id','dokumen','tanggal','status'];
    public function siswa()
{
    return $this->belongsTo(tbsiswa::class,'siswa_id');
}
public function tugas()
{
    return $this->belongsTo(tugas::class,'tugas_id');
}

public function datakelasdatamengajar()
{
    return $this->belongsTo(DatakelasDatamengajar::class,'datakelas_datamengajar_id');
}
public function datamengajar()
{
    return $this->belongsTo(datamengajar::class,'datamengajar_id');
}
public function guru()
{
    return $this->belongsTo(tbguru::class,'guru_id');
}

public function matpel()
{
    return $this->belongsTo(tbmatpel::class,'matpel_id');
}
}