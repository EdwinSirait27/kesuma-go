<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class identitas extends Model
{
    use HasFactory;
    protected $table   = 'identitas';
    protected $guarded = ['id'];
    protected $fillable = ['Nama_Sekolah', 'NPSN', 'Alamat_Sekolah', 'Kode_Pos', 'Nomor_Telephone', 'Kelurahan', 'Kecamatan', 'Kabupaten_Kota', 'Provinsi', 'Website', 'Email','akreditasi'];

    
}