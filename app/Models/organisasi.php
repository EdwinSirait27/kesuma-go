<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class organisasi extends Model
{
    use HasFactory;
    protected $table   = 'organisasi';
    protected $guarded = ['organisasi_id'];
    protected $fillable = ['nama', 'kapasitas','status', 'keterangan'];
    protected $primaryKey = 'organisasi_id';
    
    public $timestamps = false;
    public function SiswaOrganisasiGuru()
    {
        return $this->hasMany(SiswaOrganisasiGuru::class, 'organisasi_id');
    }
}