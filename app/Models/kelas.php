<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;
    protected $table   = 'kelas';
    protected $guarded = ['kelas_id'];
    protected $fillable = ['namakelas','kapasitas', 'keterangan'];
    protected $primaryKey = 'kelas_id';
    public $timestamps = false;
   
    public function datakelas()
    {
        return $this->hasMany(datakelas::class, 'kelas_id');
    }
    public function siswas()
    {
        return $this->hasMany(TbSiswa::class, 'kelas_id');
    }
}
