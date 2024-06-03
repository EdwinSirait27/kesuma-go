<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calon extends Model
{
    use HasFactory;
    protected $table   = 'calon';
    protected $guarded = ['calon_id'];
    protected $fillable = ['id', 'foto','visi', 'misi'];
    protected $primaryKey = 'calon_id';
    
}
