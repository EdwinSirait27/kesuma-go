<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profil extends Model
{
    use HasFactory;
    
    protected $table   = 'tb_guru_copy';
    protected $guarded = ['guru_id'];
    public $timestamps = false;
    protected $fillable = ['Nama','TempatTanggalLahir','Agama','JenisKelamin','StatusPegawai','NipNips','Nuptk','Nik','Npwp','NomorSertifikatPendidik','TahunSertifikasi','PangkatGolonganTerakhir','TMT','PendidikanAkhir','TahunTamat','Jurusan','TugasMengajar','TugasTambahan','JamPerMinggu','TahunPensiun','Berkala','Pangkat','Jabatan','NomorTelephone','Alamat','Email'];

    protected $primaryKey = 'guru_id';
    public function user()
{
    return $this->belongsTo(User::class);
}
}
