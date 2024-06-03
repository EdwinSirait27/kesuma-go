<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buttonnilaiguru extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table   = 'inputnilaiguru';
    protected $fillable = ['url', 'start_date', 'end_date','created_at','updated_at'];
}
