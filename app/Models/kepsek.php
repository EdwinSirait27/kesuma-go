<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kepsek extends Model
{
    use HasFactory;

    protected $table   = 'kepsek';
    protected $guarded = ['id','dokumen','created_at','updated_at'];
    protected $fillable = ['id','dokumen','created_at','updated_at'];
    public $timestamps = false;
}
