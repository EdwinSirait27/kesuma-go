<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;


class beranda extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $guarded = ['id'];
    protected $fillable = ['dokumen','created_at','updated_at'];
    public $timestamps = false;
    protected $dates = ['tanggal'];
}