<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listakun extends Model
{
    use HasFactory;
    protected $table   = 'users';
    
    
    protected $fillable = ['id','username', 'password', 'hakakses', 'remember_token','role','halaman'];
    public $timestamps = true;
    protected $primaryKey = 'id';
    
    public function guru()
    {
        return $this->hasOne(tbguru::class, 'guru_id', 'id');
    }
    // public function guru()
    // {
    //     return $this->hasOne(tbguru::class, 'guru_id');
    // }
    public function guru1()
    {
        return $this->belongsTo(tbguru::class, 'id');
    }

    public function tbguru()
{
    return $this->belongsTo(tbguru::class, 'guru_id', 'guru_id');
}
// relasi akun dengan model tbguru
}
