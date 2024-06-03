<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatakelasDatamengajar extends Model
{
    use HasFactory;
    protected $table = 'datakelas_datamengajar';
    protected $fillable = ['datakelas_id', 'datamengajar_id','updated_at','created_at'];
    public $timestamps = true;
    protected $guarded = ['datakelas_datamengajar_id'];
    protected $primaryKey = 'datakelas_datamengajar_id';
    public function guru()
    {
        return $this->belongsTo(tbguru::class, 'guru_id');
    }

    public function datakelas()
    {
        return $this->belongsTo(datakelas::class, 'datakelas_id');
    }
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }

    public function datamengajar()
    {
        return $this->belongsTo(datamengajar::class, 'datamengajar_id');
    }
    
    public function matpel()
    {
        return $this->belongsTo(tbmatpel::class, 'matpel_id');
    }
    public function tahunakademik()
{
    return $this->belongsTo(tahunakademik::class,'tahunakademik_id');
}
public function kurikulum()
{
    return $this->belongsTo(kurikulum::class,'kurikulum_id');
}
}
