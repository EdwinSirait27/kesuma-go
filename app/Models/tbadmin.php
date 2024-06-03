<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class tbadmin extends Model
{
    use HasFactory;
    protected $table   = 'pengumuman';
    protected $guarded = ['id'];
    protected $fillable = ['dokumen','oleh'];
    public $timestamps = true;
}
