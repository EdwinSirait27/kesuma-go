<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    use HasFactory;
    protected $table   = 'jurusan';
    protected $guarded = ['jurusan_id'];
    protected $fillable = ['namajurusan', 'jurusan','keterangan'];
    protected $primaryKey = 'jurusan_id';
    public $timestamps = false;
}
