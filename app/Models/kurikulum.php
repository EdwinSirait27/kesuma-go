<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kurikulum extends Model
{
    use HasFactory;
    protected $table   = 'kurikulum';
    protected $guarded = ['kurikulum_id'];
    protected $fillable = ['Nama_Kurikulum', 'Status_Aktif', 'keterangan', 'created_at', 'updated_at'];
    protected $primaryKey = 'kurikulum_id';
    
    public $timestamps = false;
 

    public function datamengajar()
    {
        return $this->hasMany(datamengajar::class, 'kurikulum_id');
    }
}
