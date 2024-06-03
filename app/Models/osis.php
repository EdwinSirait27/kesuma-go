<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class osis extends Model
{
    use HasFactory;
    
    protected $table   = 'osis';
    protected $guarded = ['osis_id'];
    protected $fillable = ['siswa_id', 'foto','visi', 'misi'];
    protected $primaryKey = 'osis_id';
    public $timestamps = false;
    public function siswa()
    {
        return $this->belongsTo(tbsiswa::class, 'siswa_id');
    }
    public function guru()
    {
        return $this->belongsTo(tbguru::class, 'guru_id');
    }
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }
}




