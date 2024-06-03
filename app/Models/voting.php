<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voting extends Model
{
    use HasFactory;
    protected $table   = 'voting';
    protected $guarded = ['voting_id'];
    protected $fillable = ['id', 'calon_id','tanggal','osis_id'];
    protected $primaryKey = 'voting_id';
    public $timestamps = false;
    public function siswa()
    {
        return $this->belongsTo(tbsiswa::class, 'siswa_id');
    }
    public function guru()
    {
        return $this->belongsTo(tbguru::class, 'guru_id');
    }
    public function users()
    {
        return $this->belongsTo(user::class, 'id');
    }
}
