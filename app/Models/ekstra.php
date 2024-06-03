<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;


class ekstra extends Model
{
    use HasFactory;
    protected $table   = 'tb_ekstrakulikuler';

    protected $fillable = ['ekskul_id','namaekskul','kapasitas','status','keterangan'];
    public $timestamps = false;  
     protected $primaryKey = 'ekskul_id';
    //  public function ekstraguru()
    //  {
    //      return $this->hasMany(ekstraguru::class, 'ekskul_id');
    //  }
     public function SiswaEkstraGuru()
     {
         return $this->hasMany(SiswaEkstraGuru::class, 'ekskul_id');
     }

     
}