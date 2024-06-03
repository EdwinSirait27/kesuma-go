<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ppdb extends Model
{
    use HasFactory;
    protected $table   = 'ppdb';
    protected $fillable = ['url', 'start_date', 'end_date','created_at','updated_at'];

}
