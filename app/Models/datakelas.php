<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class datakelas extends Model
{
    use hasFactory;
    protected $table   = 'datakelas';
    public $timestamps = false;
    protected $fillable = ['kelas_id','guru_id','siswa_id','keterangan','tahunakademik_id'];
    protected $primaryKey = 'datakelas_id';

    public function tahun()
    {
        return $this->belongsTo(tahunakademik::class, 'tahunakademik_id');
    }
   
    public function datamengajars()
    {
        return $this->belongsToMany(datamengajar::class, 'datakelas_datamengajar', 'datakelas_id', 'datamengajar_id');
    }
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }
    public function siswa()
    {
        return $this->belongsTo(tbsiswa::class, 'siswa_id','siswa_id');
    }
    public function siswmengajar()
    {
        return $this->belongsTo(siswamengajar::class, 'siswa_id','siswa_id');
    }
    public function guru()
    {
        return $this->belongsTo(tbguru::class, 'guru_id');
    }
    public function kurikulum()
    {
        return $this->belongsTo(kurikulum::class, 'kurikulum_id');
    }
 
    public function siswass()
    {
        return $this->hasMany(tbSiswa::class, 'datakelas_id', 'kelas_id');
    }
 
    public function siswas()
{
    return $this->belongsToMany(tbsiswa::class, 'datakelas', 'datakelas_id', 'siswa_id');
}

public function isKelasFull()
{
    // Ambil kapasitas maksimal dari relasi kelas
    $maxCapacity = $this->kelas->kapasitas;

    // Hitung jumlah siswa yang sudah terkait dengan kelas
    $currentCapacity = $this->kelas ? $this->kelas->datakelas->count() : 0;

    // Cek apakah kapasitas sudah mencapai maksimal
    return $currentCapacity >= $maxCapacity;
}
public function datakelasdatamengajars()
{
    return $this->hasMany(DatakelasDatamengajar::class, 'datakelas_id');
}

public function siswaa()
{
    return $this->hasMany(tbsiswa::class, 'kelas_id', 'kelas_id');
}
}




