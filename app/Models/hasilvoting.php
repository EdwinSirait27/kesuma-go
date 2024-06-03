<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasilvoting extends Model
{
    use HasFactory;
    protected $table   = 'hasilvoting';
    protected $guarded = ['hasil_id'];
    protected $fillable = ['calon_id', 'jumlahsuara','osis_id'];
    protected $primaryKey = 'hasil_id';
    public $timestamps = false;
    public function osis()
    {
        return $this->belongsTo(osis::class, 'osis_id');
    }
    public function siswa()
    {
        return $this->belongsTo(tbsiswa::class, 'siswa_id');
    }
}
