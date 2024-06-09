<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class tbsiswa extends Model
{
    use HasFactory;
    protected $table   = 'tb_siswa';
    
    public $timestamps = false;
    protected $fillable = ['foto', 'NOPDF', 'NamaLengkap', 'NomorInduk','NISNSMP','NamaPanggilan', 'JenisKelamin', 'NISN', 'TempatLahir', 'TanggalLahir', 'Agama', 'Alamat', 'RT', 'RW', 'Kelurahan', 'Kecamatan', 'KabKota', 'Provinsi', 'KodePos', 'Email', 'NomorTelephone', 'Kewarganegaraan', 'NIK', 'GolDarah', 'TinggalDengan',  'StatusSiswa', 'AnakKe', 'SaudaraKandung', 'SaudaraTiri', 'Tinggicm', 'Beratkg', 'RiwayatPenyakit', 'AsalSMP', 'AlamatSMP', 'NPSNSMP', 'KabKotaSMP', 'ProvinsiSMP', 'NoIjasah', 'NoSKHUN','DiterimaTanggal', 'DiterimaDiKelas', 'DiterimaSemester', 'MutasiAsalSMA', 'AlasanPindah', 'NoPesertaUNSMP', 'TglIjasah', 'NamaOrangTuaPadaIjasah', 'NamaAyah','TahunLahirAyah', 'AlamatAyah', 'NomorTelephoneAyah', 'AgamaAyah', 'PendidikanTerakhirAyah', 'PekerjaanAyah', 'PenghasilanAyah', 'NamaIbu', 'TahunLahirIbu', 'AlamatIbu', 'NomorTelephoneIbu', 'AgamaIbu',  'PendidikanTerakhirIbu', 'PekerjaanIbu', 'PenghasilanIbu',  'NamaWali', 'TahunLahirWali', 'AlamatWali', 'NomorTelephoneWali', 'AgamaWali', 'PendidikanTerakhirWali', 'PekerjaanWali', 'WaliPenghasilan', 'StatusHubunganWali',  'MenerimaBeasiswaDari', 'TahunMeninggalkanSekolah', 'AlasanSebab', 'TamatBelajarTahun', 'TanggalNomorSTTB', 'InformasiLain','cita', 'status', 'kelas_id','sakit','izin','tk','catatan'];
    protected $primaryKey = 'siswa_id';
    public function ekstraguru()
    {
        return $this->belongsTo(Ekstraguru::class, 'ekstra_guru_id');
    }
    public function akunsiswaa()
    {
        return $this->hasoone(listakunsiswa::class, 'siswa_id','id');
    }
    public function SiswaEkstraGuru()
    {
        return $this->belongsTo(SiswaEkstraGuru::class, 'siswa_ekstra_guru_id');
    }
    public function akunsiswa()
    {
        return $this->belongsTo(listakunsiswa::class, 'id');
    }
    public function akunguru()
    {
        return $this->hasOne(listakunsiswa::class, 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id','siswa_id');
    }
    public function listakunsiswa()
    {
        return $this->hasOne(listakunsiswa::class, 'siswa_id','siswa_id');
    }
    public function listakunsiswaa()
    {
        return $this->hasOne(listakunsiswa::class, 'siswa_id', 'siswa_id');
    }
    // public function listakunsiswa()
    // {
    //     return $this->hasOne(listakunsiswa::class, 'siswa_id','siswa_id');
    // }
    

    public function nilai()
    {
        return $this->hasMany(nilai::class, 'siswa_id', 'siswa_id');
    }
    public function datakelas()
    {
        return $this->belongsToMany(datakelas::class, 'datakelas', 'siswa_id', 'datakelas_id');
    }
    public function siswa()
    {
        return $this->hasOne(tbsiswa::class, 'kelas_id', 'kelas_id');
    }
   // Di dalam model tbsiswa
public function kelas()
{
    return $this->belongsTo(kelas::class, 'kelas_id');
}
public function ekstragurus()
{
    return $this->hasMany(SiswaEkstraGuru::class, 'siswa_id');
}
public function organisasigurus()
{
    return $this->hasMany(SiswaOrganisasiGuru::class, 'siswa_id');
}
public function pengumpulantugas()
{
    return $this->hasMany(PengumpulanTugas::class);
}
// Di dalam model tbSiswa

public function datakelass()
{
    return $this->belongsTo(datakelas::class, 'kelas_id', 'datakelas_id');
}
public function datamengajar()
{
    return $this->belongsTo(datamengajar::class, 'datamengajar_id');
}
public function datakelasdatamengajar()
{
    return $this->belongsTo(datakelasdatamengajar::class, 'datakelas_datamengajar_id');
}
public function siswamengajar()
{
    return $this->belongsTo(siswamengajar::class, 'siswa_mengajar_id');
}
public function datakelasss()
{
    return $this->belongsTo(datakelas::class, 'kelas_id');
}




}
