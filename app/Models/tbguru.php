<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Controllers\datakelasdatamengajarController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class tbguru extends Model
{
    use HasFactory;
    protected $table   = 'tb_guru';
   
    public $timestamps = false;
    protected $fillable = ['foto','Nama', 'TempatLahir','TanggalLahir','Agama','JenisKelamin','StatusPegawai','NipNips','Nuptk','Nik','Npwp','NomorSertifikatPendidik','TahunSertifikasi','pangkatgt','jadwalkenaikanpangkat','jadwalkenaikangaji','TMT','PendidikanAkhir','TahunTamat','Jurusan','TugasMengajar','TugasTambahan','JamPerMinggu','TahunPensiun','Berkala','Pangkat','Jabatan','NomorTelephone','Alamat','Email','status','id'];
    protected $primaryKey = 'guru_id';
    public function akunguru()
    {
        return $this->hasOne(listakun::class, 'id');
        
    }
    public function user()
{
    return $this->belongsTo(User::class, 'id','guru_id');
}
    // jangan diganti diatas
    public function akun()
    {
        return $this->belongsTo(listakun::class, 'guru_id', 'id');
    }
    
    public function guru()
    {
    return $this->belongsTo(listakun::class, 'Nama');
    }
  
    public function datamengajars()
    {
        return $this->hasMany(datamengajar::class, 'guru_id');
    }
   // Di dalam model Guru.php

    public function datakelasdatamengajars()
    {
        return $this->hasMany(datakelasdatamengajar::class, 'datakelas_datamengajar_id');
    }
   
    // public function listakun()
    // {
    //     return $this->belongsTo(listakun::class, 'guru_id', 'id');
    // }
    public function listakun()
    {
        return $this->hasOne(listakun::class, 'guru_id','guru_id');
    }
 
    
    public function datamengajar()
    {
        return $this->hasMany(datamengajar::class, 'guru_id');
    }
    public function datakelas()
    {
        return $this->hasMany(datakelas::class, 'guru_id');
    }
   
    public function ekstraguru()
    {
        return $this->hasMany(ekstraguru::class, 'guru_id');
    }
    public function tahun()
    {
        return $this->hasMany(datakelas::class, 'tahunakademik_id');
    }
    public function tahun1()
    {
        return $this->hasMany(tahunakademik::class, 'tahunakademik_id');
    }
    public function tugas()
    {
        return $this->hasMany(tugas::class);
    }
}