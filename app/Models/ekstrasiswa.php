<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ekstrasiswa extends Model
{
    protected $table   = 'datamengajar';
   
    public $timestamps = false;
    protected $fillable = ['matpel_id','guru_id','keterangan'];
    protected $primaryKey = 'datamengajar_id';

    public function guru()
    {
        return $this->belongsTo(tbguru::class, 'guru_id');
    }
    public function matpel()
    {
        return $this->belongsTo(tbmatpel::class, 'matpel_id');
    }

  
}




