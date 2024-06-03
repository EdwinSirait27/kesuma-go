<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahunakademik extends Model
{
    use HasFactory;
    protected $table   = 'tahunakademik';
    protected $guarded = ['tahunakademik_id'];
    protected $fillable = ['tahunakademik', 'kurikulum_id','semester','tahun1','tahun2','statusaktif','keterangan'];
    protected $primaryKey = 'tahunakademik_id';
    public $timestamps = false;
    public function datamengajar()
    {
        return $this->hasMany(datamengajar::class, 'tahunakademik_id');
    }
    public function datakelas()
    {
        return $this->hasMany(datakelas::class, 'tahunakademik_id');
    }
    // Model tahunakademik

public function kurikulum()
{
    return $this->belongsTo(kurikulum::class, 'kurikulum_id');
}

}
