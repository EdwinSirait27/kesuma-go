<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class tbmatpel extends Model
{
    use HasFactory;
    protected $table   = 'tb_matapelajaran';   
   
    protected $fillable = ['MataPelajaran','status','KKM','keterangan'];
    protected $primaryKey = 'matpel_id';
    public $timestamps = false;
    public function datamengajar()
    {
        return $this->hasMany(datamengajar::class, 'matpel_id');
    }
}
