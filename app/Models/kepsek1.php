<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kepsek1 extends Model
{
    use HasFactory;

    protected $table   = 'kepalasekolah';
    protected $guarded = ['id','nama','tempatlahir','ttl','nomor','email','sd','tahunlulussd','smp','tahunlulussmp','sma','tahunlulussma','s1','institusis1','tahunluluss1','s2','institusis2','tahunluluss2','s3','institusis3','tahunluluss3'];
    protected $fillable = ['id','nama','tempatlahir','ttl','nomor','email','sd','tahunlulussd','smp','tahunlulussmp','sma','tahunlulussma','s1','institusis1','tahunluluss1','s2','institusis2','tahunluluss2','s3','institusis3','tahunluluss3'];
    public $timestamps = false;
}

