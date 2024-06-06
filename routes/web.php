<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tbsiswaallController;
use App\Http\Controllers\editprofileController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\editprofileControllerGuru;
use App\Http\Controllers\editprofileControllerSU;
use App\Http\Controllers\editprofileControllerKurikulum;
use App\Http\Controllers\editprofilesiswaController;
use App\Http\Controllers\tbmatpelController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\tbguruallController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BerandaControllerSU;
use App\Http\Controllers\ekstraguruController;
use App\Http\Controllers\tugasController;
use App\Http\Controllers\tugassiswaController;

use App\Http\Controllers\guruController;
use App\Http\Controllers\siswaController;
use App\Http\Middleware\hakakses;

use App\Http\Controllers\ekstraController;
use App\Http\Controllers\organisasiguruController;
use App\Http\Controllers\buttoninputnilaiguruController;
use App\Http\Controllers\buttoninputnilaikurikulumController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\osisController;
use App\Http\Controllers\osis2Controller;
use App\Http\Controllers\importController;
use App\Http\Controllers\datamengajarController;
use App\Http\Controllers\datakelasController;
use App\Http\Controllers\datakelassController;
use App\Http\Controllers\kurikulumController;
use App\Http\Controllers\tahunakademikController;
use App\Http\Controllers\jurusanController;
use App\Http\Controllers\buttonosisController;
use App\Http\Controllers\BerandaControllerSiswa;
use App\Http\Controllers\identitasController;
use App\Http\Controllers\buttonnilaisiswaController;
use App\Http\Controllers\BerandaControllerGuru;
use App\Http\Controllers\BerandaControllerKepalaSekolah;
use App\Http\Controllers\BerandaControllerKurikulum;
use App\Http\Controllers\editprofileControllerKepalaSekolah;
use App\Http\Controllers\kepsekController;
use App\Http\Controllers\editdataController;
use App\Http\Controllers\editprofilenonsiswaController;

use App\Http\Controllers\PdfController;
use App\Http\Controllers\ppdbController;
use App\Http\Controllers\nilaiController;
use App\Http\Controllers\nonsiswaController;
use App\Http\Controllers\BerandaControllerNonSiswa;
use App\Http\Controllers\editprofileControllerNonSiswa;
use App\Http\Controllers\DatakelasDatamengajarController;
use App\Http\Controllers\pengumpulanController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Artisan;




// Mengimpor namespace untuk kelas HakAkses jika berada di namespace App
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::middleware(['auth', hakakses::class . ':SU'])->group(function () {
    // edit profile
    // beranda
    Route::get('/SUBeranda', [BerandaControllerSU::class, 'index'])->name('SUBeranda');
    Route::get('/SUBeranda', [BerandaControllerSU::class, 'index'])->name('SUBeranda.beranda');
    Route::get('/SUBeranda-edit/{id}', [BerandaControllerSU::class, 'edit']);
    Route::post('/SUBeranda-update', [BerandaControllerSU::class, 'update']);
    Route::post('/SUBeranda-save', [BerandaControllerSU::class, 'save']);
    Route::get('/editprofileSU', [editprofileControllerSU::class, 'index'])->name('editprofileSU');
    Route::post('/editprofileSU', [editprofileControllerSU::class, 'update'])->name('editprofileSU.update');
});

Route::middleware(['auth', hakakses::class . ':Admin'])->group(function () {
   
    Route::get('/AdminBeranda', [BerandaController::class, 'index'])->name('AdminBeranda');
    Route::get('/AdminBeranda/index2', [BerandaController::class, 'index2'])->name('AdminBeranda.index2');
    Route::get('/AdminBeranda/removeall', [BerandaController::class, 'removeall'])->name('AdminBeranda.removeall');
    Route::post('/simpan', [BerandaController::class, 'simpan'])->name('simpan');

    // Route::get('/guruall', [tbguruallController::class, 'index1'])->name('guruall.index1');
    // Route::post('/guruall/removeall', [tbguruallController::class, 'removeall'])->name('guruall.removeall');
    Route::get('/guruall-edit/{id}', [tbguruallController::class, 'edit']);
    Route::post('/guruall-update', [tbguruallController::class, 'update']);
    Route::post('/guruall-save', [tbguruallController::class, 'save']);
    Route::get('guruex', [tbguruallController::class, 'index'])->name('guruex.index');
    // edit profile
    Route::get('/editprofile', [editprofileController::class, 'index'])->name('editprofile');
    Route::post('/editprofile', [editprofileController::class, 'update'])->name('editprofile.update');
    Route::get('/editpassadmin', [editprofileController::class, 'indexx'])->name('editpassadmin');
    Route::post('/editpassadmin', [editprofileController::class, 'update1'])->name('editpassadmin.update1');
});

Route::middleware(['auth', hakakses::class . ':Siswa'])->group(function () {
    Route::get('/editdatasiswa', [editdataController::class, 'index1'])->name('editdatasiswa.index1');
    Route::get('/editdatasiswa-edit/{id}', [editdataController::class, 'edit']);
    Route::get('/datanilaisiswa', [DatakelasController::class, 'indexdatasiswa'])->name('datanilaisiswa.index');
    Route::post('/editdatasiswa-update', [editdataController::class, 'update']);
    Route::get('/load-siswa-data', [datakelasController::class, 'loadSiswaData'])->name('load-siswa-data');

    Route::get('/nilai-ku', [datakelasController::class, 'indexsiswa'])->name('nilai-ku.index');
    Route::get('/pengumpulantugas', [pengumpulanController::class, 'index'])->name('pengumpulantugas.index');
    Route::get('/pengumpulantugas/removeall', [pengumpulanController::class, 'removeall'])->name('pengumpulantugas.removeall');
    Route::get('/pengumpulantugas-edit/{id}', [pengumpulanController::class, 'edit']);
    Route::post('/pengumpulantugas-update', [pengumpulanController::class, 'update']);
    Route::post('/pengumpulantugas-save', [pengumpulanController::class, 'save']);
    Route::get('/lihattugas', [tugassiswaController::class, 'index'])->name('lihattugas.index');
    Route::get('/tugassiswa', [tugasController::class, 'showtugassiswa'])->name('tugassiswa.index');
    Route::get('/SiswaBeranda', [BerandaControllerSiswa::class, 'index'])->name('SiswaBeranda');
    Route::get('/SiswaBeranda/index2', [BerandaControllerSiswa::class, 'index2'])->name('SiswaBeranda.index2');
    Route::get('/editprofilesiswa', [editprofilesiswaController::class, 'index'])->name('editprofilesiswa');
    Route::post('/editprofilesiswa', [editprofilesiswaController::class, 'update'])->name('editprofilesiswa.update');
    Route::get('/ekstrakulikulersiswa',  [editprofilesiswaController::class, 'showEkskul'])->name('siswa.ekskul');
    Route::POST('/ekstrakulikulersiswa/store', [editprofilesiswaController::class, 'store'])->name('ekstrakulikulersiswa.store');
    Route::post('/ekstrakulikulersiswa', [editprofilesiswaController::class, 'hapus'])->name('ekstrakulikulersiswa.hapus');
    Route::get('/ekstrakulikulersiswa/list', [editprofilesiswaController::class, 'listekstrakulikuler'])->name('ekstrakulikulersiswa.list');
    
    Route::get('/organisasisiswa',  [editprofilesiswaController::class, 'showorganisasi'])->name('siswa.organisasi');
    Route::POST('/organisasisiswa/storee', [editprofilesiswaController::class, 'storee'])->name('organisasisiswa.storee');
    Route::post('/organisasisiswa', [editprofilesiswaController::class, 'hapusOrganisasiSiswa'])->name('organisasisiswa.hapusOrganisasiSiswa');
    Route::get('/organisasisiswa/list', [editprofilesiswaController::class, 'listorganisasi'])->name('organisasisiswa.list');
    Route::get('/editpasssiswa', [editprofilesiswaController::class, 'indexx'])->name('editpasssiswa');
    Route::post('/editpasssiswa', [editprofilesiswaController::class, 'updatee'])->name('editpasssiswa.updatee');
    
});


Route::middleware(['auth', hakakses::class . ':Guru'])->group(function () {
    Route::get('datamengajarr/{datamengajar_id}/downloaddddd', [datakelascontroller::class, 'downloaddddd'])->name('datamengajarr.downloaddddd');
    
Route::get('/nilaisiswa/{encodedId}', [DatakelasController::class, 'viewSiswaByDatamengajar'])->name('nilaisiswa.index');

Route::get('/inputnilaiadmin', [DatakelasController::class, 'indexnilai1'])->name('inputnilaiadmin.index');

    
    Route::get('/inputnilaiguru', [DatakelasController::class, 'indexnilai'])->name('inputnilaiguru.index');
    Route::get('/inputnilaiguru-removeall1', [DatakelasController::class, 'removeall1'])->name('inputnilaiguru.removeall1');
    Route::get('/GuruBeranda', [BerandaControllerGuru::class, 'index'])->name('GuruBeranda');
    Route::get('/editprofileGuru', [editprofileControllerGuru::class, 'index'])->name('editprofileGuru');
    Route::post('/editprofileGuru', [editprofileControllerGuru::class, 'update'])->name('editprofileGuru.update');
    Route::get('/editpassguru', [editprofileControllerGuru::class, 'indexx'])->name('editpassguru');
    Route::post('/editpassguru', [editprofileControllerGuru::class, 'updatee'])->name('editpassguru.updatee');
    
    Route::get('/GuruBeranda/index2', [BerandaControllerGuru::class, 'index2'])->name('GuruBeranda.index2');
});
Route::middleware(['auth', hakakses::class . ':Kurikulum'])->group(function () {
    Route::get('/KurikulumBeranda', [BerandaControllerKurikulum::class, 'index'])->name('KurikulumBeranda');
    Route::get('/editprofileKurikulum', [editprofileControllerKurikulum::class, 'index'])->name('editprofileKurikulum');
    Route::post('/editprofileKurikulum', [editprofileControllerKurikulum::class, 'update'])->name('editprofileKurikulum.update');
    Route::get('/KurikulumBeranda/index2', [BerandaControllerKurikulum::class, 'index2'])->name('KurikulumBeranda.index2');
    Route::get('/editpasskurikulum', [editprofileControllerKurikulum::class, 'indexx'])->name('editpasskurikulum');
    Route::post('/editpasskurikulum', [editprofileControllerKurikulum::class, 'updatee'])->name('editpasskurikulum.updatee');
    
});
Route::middleware(['auth', 'hakakses:Guru,Kurikulum,Siswa'])->group(function () {
    Route::get('/jadwal', [datakelasController::class, 'index2'])->name('jadwal.index');
    Route::get('/datakelas', [datakelasController::class, 'index'])->name('datakelas.index');
    
});
Route::middleware(['auth', 'hakakses:Guru,Kurikulum,Siswa'])->group(function () {
    
});
Route::middleware(['auth', hakakses::class . ':NonSiswa'])->group(function () {
    Route::get('/editpassnonsiswa', [editprofileControllerNonSiswa::class, 'indexx'])->name('editpassnonsiswa');
    Route::post('/editpassnonsiswa', [editprofileControllerNonSiswa::class, 'updatee'])->name('editpassnonsiswa.updatee');
    
    Route::get('/NonSiswaBeranda', [BerandaControllerNonSiswa::class, 'index'])->name('NonSiswaBeranda');
    Route::get('/editprofileNonSiswa', [editprofileControllerNonSiswa::class, 'index'])->name('editprofileNonSiswa');
    Route::post('/editprofileNonSiswa', [editprofileControllerNonSiswa::class, 'update'])->name('editprofileNonSiswa.update');
    Route::get('/NonSiswaBeranda/index2', [BerandaControllerNonSiswa::class, 'index2'])->name('NonSiswaBeranda.index2');
  
});
Route::middleware(['auth', hakakses::class . ':KepalaSekolah'])->group(function () {
    Route::get('/KepalaSekolahBeranda', [BerandaControllerKepalaSekolah::class, 'index'])->name('KepalaSekolahBeranda');
    Route::get('/KepalaSekolahBeranda/index2', [BerandaControllerKepalaSekolah::class, 'index2'])->name('KepalaSekolahBeranda.index2');
    Route::get('/KepalaSekolahBeranda/removeall', [BerandaControllerKepalaSekolah::class, 'removeall'])->name('KepalaSekolahBeranda.removeall');
    Route::post('/simpan-ke', [BerandaControllerKepalaSekolah::class, 'simpan'])->name('simpan-ke');


    Route::get('/editprofileKepalaSekolah', [editprofileControllerKepalaSekolah::class, 'index'])->name('editprofileKepalaSekolah');
    Route::post('/editprofileKepalaSekolah', [editprofileControllerKepalaSekolah::class, 'update'])->name('editprofileKepalaSekolah.update');
    Route::get('/editpasskepalasekolah', [editprofileControllerKepalaSekolah::class, 'indexx'])->name('editpasskepalasekolah');
    Route::post('/editpasskepalasekolah', [editprofileControllerKepalaSekolah::class, 'updateee'])->name('editpasskepalasekolah.updateee');
});
Route::middleware(['auth', hakakses::class . ':KepalaSekolah'])->group(function () {
    Route::get('/kepsek/edit/{id}', [kepsekcontroller::class, 'edit'])->name('kepsek.edit');
    Route::post('/kepsek', [kepsekController::class, 'storeOrUpdate'])->name('kepsek.storeOrUpdate');
        Route::put('/kepsek/{id}', [kepsekcontroller::class, 'update'])->name('kepsek.update');
    Route::get('/kepsek', [kepsekController::class, 'index'])->name('kepsek.index');
    Route::get('/kepsek/removeall', [kepsekController::class, 'removeall'])->name('kepsek.removeall');
    Route::post('/simpan-kep', [kepsekController::class, 'simpan'])->name('simpan-kep');
    Route::get('kepsek/download/{dokumen}', [kepsekController::class, 'download'])->name('kepsek.download');

});
Route::get('/', [loginController::class, 'index'])->name('login');
Route::get('/about', function () {
    return view('about.about');
});

Route::get('/lupa', function () {
    return view('lupa.index');
});



Route::post('/', [LoginController::class, 'postLogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/daftar', [nonsiswaController::class, 'index'])->name('daftar.index');
// Route::get('/daftar', [nonsiswaController::class, 'cekUsername'])->name('daftar.cekUsername');
Route::post('/daftar-update', [nonsiswaController::class, 'update']);
// Route::post('/check-username', [nonsiswaController::class, 'checkUsernameAvailability'])->name('check.username.availability');
Route::post('/check-username', [nonsiswaController::class, 'checkUsername'])->name('check-username');

Route::middleware(['auth', 'hakakses:Admin,KepalaSekolah,Siswa,Guru,Kurikulum'])->group(function () {

    // Route::get('/pemilihan', [osisController::class, 'index'])->name('pemilihan.index');
    Route::get('/pemilihan', [osisController::class, 'index'])->name('pemilihan.index');
    // Route::get('/pemilihan', [osisController::class, 'index'])->name('pemilihan.index')
    //  ->middleware('check.pemilihan.active');
    Route::post('/pemilihan', [osisController::class, 'vote'])->name('pemilihan.ngetes');
    Route::get('/download/tugas/{tugas_id}', [tugasController::class, 'unduh'])->name('download.tugas');
    Route::get('/downloadd/tugas/{pengumpulan_id}', [pengumpulanController::class, 'unduh'])->name('downloadd.tugas');
     Route::get('/importsiswa', [importController::class, 'index'])->name('importsiswa.index');
     Route::post('/importsiswa/update', [importController::class, 'update'])->name('importsiswa.update');

Route::get('/tugas', [DatakelasDatamengajarController::class, 'index'])->name('tugas.index');

    Route::get('/nilai', [nilaiController::class, 'index'])->name('nilai.index');
    Route::get('/identitas', [identitasController::class, 'index']);
    Route::get('/siswaall', [tbsiswaallController::class, 'index1'])->name('siswaall.index1');
   
    Route::get('/siswaall/{encodedId}', [tbsiswaallController::class, 'show'])->name('siswaall.show');
    Route::get('/editpassword/{encodedId}', [tbsiswaallController::class, 'show1'])->name('editpassword.index');
    Route::post('/editpassword/{encodedId}', [tbsiswaallController::class, 'updateee'])->name('editpassword.updateee');
    Route::get('/guruall', [tbguruallController::class, 'index1'])->name('guruall.index1');
   
    Route::get('/download/{datakelasId}', [DatakelasController::class, 'download'])->name('download-pdf');
    Route::get('/downloaddd/{datakelasId}', [DatakelasController::class, 'downloaddd'])->name('download-pdff');
    
    Route::get('/guruall/{encodedId}', [tbguruallController::class, 'show'])->name('guruall.show');
    Route::get('/editpasswordguru/{encodedId}', [tbguruallController::class, 'show1'])->name('editpasswordguru.index');
    Route::post('/editpasswordguru/{encodedId}', [tbguruallController::class, 'updateee'])->name('editpasswordguru.updateee');
   

   
    Route::get('/listsiswa', [datakelasController::class, 'index1'])->name('listsiswa.index');
   
    Route::get('/listsiswaadmin', [datakelasController::class, 'indexguru'])->name('listsiswaadmin.index');
    Route::get('/ekstrakulikuler', [ekstraguruController::class, 'index'])->name('ekstrakulikuler.index');
    Route::get('/listekstra{ekstra_guru_id?}', [ekstraguruController::class, 'index2'])->name('listekstra.index')->middleware('check.listekstra_token');
      
    Route::get('/organisasisiswaall', [organisasiguruController::class, 'index'])->name('organisasisiswaall.index');
    Route::get('/listorganisasi{organisasi_guru_siswa_id?}', [organisasiguruController::class, 'index3'])->name('listorganisasi.index')->middleware('check.listorganisasi_token');
   
});
Route::middleware(['auth', 'hakakses:Admin,KepalaSekolah,Guru,Kurikulum'])->group(function () {
   
    Route::get('siswaaa/{siswa_id}/downloadddd', [datakelascontroller::class, 'downloadddd'])->name('siswaa.downloadddd');
    Route::put('/simpan-nilai/{siswa_id}', [datakelasController::class, 'simpanNilai'])->name('simpan.nilai');
    // Route::put('/simpan-nilai-matpel/{datamengajar_id}', [datakelasController::class, 'simpanNilaimatpel'])->name('simpan.nilai.matpel');
    Route::put('/simpan-nilai-matpel/{datamengajar_id}', [datakelasController::class, 'simpanNilaimatpel'])->name('simpan.nilai.matpel');
    // Route::put('/simpan-nilai-matpel/{siswa_id}', [datakelasController::class, 'simpanNilaimatpel'])->name('simpan.nilai.matpel');
    // Route::get('/inputnilai', [DatakelasController::class, 'showSiswa'])->name('inputnilai.index');
    
    

   Route::get('/tugas', [tugasController::class, 'showtugas'])->name('tugas.index');
    Route::get('/tugasguru', [tugasController::class, 'index'])->name('tugasguru.index');
    Route::get('/tugasguru/removeall', [tugasController::class, 'removeall'])->name('tugasguru.removeall');
    Route::get('/tugasguru-edit/{id}', [tugasController::class, 'edit']);
    Route::post('/tugasguru-update', [tugasController::class, 'update']);
    Route::post('/tugasguru-save', [tugasController::class, 'save']);

    Route::get('/cektugas', [pengumpulanController::class, 'index2'])->name('cektugas.index');
    
    Route::get('/cektugas-edit2/{id}', [pengumpulanController::class, 'edit2']);
    Route::post('/cektugas-update', [pengumpulanController::class, 'update2']);
    Route::post('/cektugas-save', [pengumpulanController::class, 'save']);
});
Route::middleware(['auth', 'hakakses:Admin,KepalaSekolah,Kurikulum'])->group(function () {
Route::get('/mata', [tbmatpelController::class, 'index'])->name('mata.index');
Route::get('/mata/removeall', [tbmatpelController::class, 'removeall'])->name('mata.removeall');
Route::get('/mata-edit/{id}', [tbmatpelController::class, 'edit']);
Route::post('/mata-update', [tbmatpelController::class, 'update']);
Route::post('/mata-save', [tbmatpelController::class, 'save']);
// Route::get('/inputnilai/{siswa_id?}', [DatakelasController::class, 'showSiswa'])->name('inputnilai.index')->middleware('check.inputnilai_token');
   

});

Route::middleware(['auth', 'hakakses:Kurikulum,KepalaSekolah'])->group(function () {
    Route::get('/inputnilaispc', [DatakelasController::class, 'indexadmin'])->name('inputnilaispc.index');
    Route::get('/inputnilaiall/{encodedId}', [DatakelasController::class, 'viewSiswaBySiswa'])->name('inputnilaiall.index');

});

Route::middleware(['auth', 'hakakses:Admin,KepalaSekolah'])->group(function () {
    Route::get('/goodbye/{encodedId}', [tbsiswaallController::class, 'show'])->name('goodbye.show');
    Route::put('/goodbye/{encodedId}', [tbsiswaallController::class, 'lulus'])->name('goodbye.lulus');
    Route::get('/goodbye', [tbsiswaallController::class, 'indexlulus'])->name('goodbye.index');
    Route::get('/datamengajar/{encodedId}', [datamengajarController::class, 'show1'])->name('datamengajar.show');
    
    Route::get('/prestasi/create/{siswa_id}/', [tbsiswaallController::class, 'create'])->name('prestasi.create');
Route::get('/prestasi/{siswa_id}/', [tbsiswaallController::class, 'indexx'])->name('prestasi.index');
Route::post('prestasi/{siswa_id}', [tbsiswaallController::class, 'store'])->name('prestasi.store');
    Route::get('/osis', [osis2Controller::class, 'index'])->name('osis.index');
    Route::get('/osis/removeall', [osis2Controller::class, 'removeall'])->name('osis.removeall');
    Route::get('/osis-edit/{id}', [osis2Controller::class, 'edit']);
    Route::post('/osis-update', [osis2Controller::class, 'update']);
   


    Route::get('/download-pdf', [datakelasController::class, 'downloadPDF'])->name('download.pdf');
    Route::get('/datamengajar', [datamengajarController::class, 'index'])->name('datamengajar.index');
    Route::get('/jadwal-create{datakelas_id?}', [datakelasController::class, 'create'])->name('jadwal.create')->middleware('check.jadwalcreateadmin_token');
    Route::get('/jadwaladmin{datakelas_id?}', [datakelasController::class, 'indexjadwal'])->name('jadwaladmin.index')->middleware('check.jadwaladmin_token');
    Route::get('/listkelas{datakelas_id?}', [DatakelasController::class, 'indexall'])->name('listkelas.index')->middleware('check.listkelas_token');
    Route::get('/datakelasadmin', [datakelassController::class, 'indexx'])->name('datakelasadmin.index');
// Route::get('/showsiswa/{datakelas_id}', 'NamaController@showSiswa')->name('showSiswa');


// Route::get('/inputnilai/{siswaId}', [datakelasController::class, 'showSiswa'])->name('inputnilai.index');

Route::post('/listorganisasi', [organisasiguruController::class, 'hapus'])->name('listorganisasi.hapus');
    Route::post('/listekstra', [ekstraguruController::class, 'hapus'])->name('listekstra.hapus');
    Route::get('/identitas/edit/{id}', [identitasController::class, 'edit'])->name('identitas.edit');
Route::post('/identitas', [identitasController::class, 'storeOrUpdate'])->name('identitas.storeOrUpdate');
    Route::put('/identitas/{id}', [identitasController::class, 'update'])->name('identitas.update');
   
    Route::get('/siswaall-edit/{id}', [tbsiswaallController::class, 'edit']);
    Route::get('siswaex', [tbsiswaallController::class, 'index'])->name('siswaex.index');

    Route::post('/siswaall-update', [tbsiswaallController::class, 'update']);
    Route::post('/siswaall/updatesiswa', [tbsiswaallController::class, 'updatesiswa'])->name('siswaall.updatesiswa');
    
    Route::put('/siswaall/{encodedId}', [tbsiswaallController::class, 'updatee'])->name('siswaall.updatee');
    Route::delete('/siswaall-del/{id}', [tbsiswaallController::class, 'hapus'])->name('siswaall.hapus');
    // Route::get('/siswaall/removeall', [tbsiswaallController::class, 'removeall'])->name('siswaall.removeall');
    Route::post('/siswaall/removeall', [tbsiswaallController::class, 'removeall'])->name('siswaall.removeall');

    Route::get('/siswaall-save', [tbsiswaallController::class, 'save']);
    //tabel guruall
    Route::post('/guruall/removeall', [tbguruallController::class, 'removeall'])->name('guruall.removeall');
    Route::get('/guruall-edit/{id}', [tbguruallController::class, 'edit']);
    Route::post('/guruall-update', [tbguruallController::class, 'update']);
    Route::put('/guruall/{encodedId}', [tbguruallController::class, 'updatee'])->name('guruall.updatee');
   
    Route::post('/guruall-save', [tbguruallController::class, 'save']);
    Route::get('guruex', [tbguruallController::class, 'index'])->name('guruex.index');


    Route::get('/kurikulum', [kurikulumController::class, 'index'])->name('kurikulum.index');
    Route::get('/kurikulum/removeall', [kurikulumController::class, 'removeall'])->name('kurikulum.removeall');
    Route::get('/kurikulum-edit/{id}', [kurikulumController::class, 'edit']);
    Route::post('/kurikulum-update', [kurikulumController::class, 'update']);
    Route::post('/kurikulum-save', [kurikulumController::class, 'save']);
    //kurikulum

    // Route::get('/datamengajar/removeall', [datamengajarController::class, 'removeall'])->name('datamengajar.removeall');
    Route::delete('/datamengajar/removeall', [datamengajarController::class, 'removeall'])->name('datamengajar.removeall');
    Route::get('/datamengajar-edit/{id}', [datamengajarController::class, 'edit']);
    Route::post('/datamengajar-update', [datamengajarController::class, 'update']);
    Route::post('/datamengajar-save', [datamengajarController::class, 'save']);


    Route::post('/generate-pdf', [PdfController::class, 'generatePdf']);

Route::get('/siswa-by-kelas/{kelasId}', [datakelasController::class, 'getSiswaByKelasId']);
Route::get('/siswa-by-kelas1/{kelasId}', [datakelasController::class, 'getSiswaByKelasId1']);
    Route::get('/datakelasadmin/removeall', [datakelasController::class, 'removeall'])->name('datakelasadmin.removeall');
    Route::get('/datakelasadmin-edit/{id}', [datakelassController::class, 'edit']);
    Route::get('/datakelasadmin-edit1/{id}', [datakelassController::class, 'edit']);
    Route::get('/siswa-by-kelas/{kelasId}', [datakelassController::class, 'getSiswaByKelasId']);

    Route::post('/datakelas-update', [datakelasController::class, 'update']);
    Route::post('/datakelasadmin-update1', [datakelassController::class, 'update1']);
    Route::post('/datakelasadmin-save', [datakelassController::class, 'save']);
    Route::post('/remove-kelas-from-siswa',      [datakelassController::class, 'removeKelasFromSiswa'])->name('remove.kelas.from.siswa');
    Route::post('/remove-kelas-from-siswa1',      [datakelassController::class, 'removeKelasFromSiswa1'])->name('remove.kelas.from.siswa1');
    Route::get('/get-kelas-id-by-datakelas-id/{id}', [datakelassController::class, 'getKelasIdByDataKelasId']);
    Route::get('/get-kelas-id-by-datakelas-id1/{id}', [datakelassController::class, 'getKelasIdByDataKelasId1']);



    // tahun akademil
    Route::get('/tahunakademik', [tahunakademikController::class, 'index'])->name('tahunakademik.index');
    Route::get('/tahunakademik/removeall', [tahunakademikController::class, 'removeall'])->name('tahunakademik.removeall');
    Route::get('/tahunakademik-edit/{id}', [tahunakademikController::class, 'edit']);
    Route::post('/tahunakademik-update', [tahunakademikController::class, 'update']);
    Route::post('/tahunakademik-save', [tahunakademikController::class, 'save']);

    //jurusna
    Route::get('/jurusan', [jurusanController::class, 'index'])->name('jurusan.index');
    Route::get('/jurusan/removeall', [jurusanController::class, 'removeall'])->name('jurusan.removeall');
    Route::get('/jurusan-edit/{id}', [jurusanController::class, 'edit']);
    Route::post('/jurusan-update', [jurusanController::class, 'update']);
    Route::post('/jurusan-save', [jurusanController::class, 'save']);

    //kelas
    Route::get('/kelas', [kelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/removeall', [kelasController::class, 'removeall'])->name('kelas.removeall');
    Route::get('/kelas-edit/{id}', [kelasController::class, 'edit']);
    Route::post('/kelas-update', [kelasController::class, 'update']);
    Route::post('/kelas-save', [kelasController::class, 'save']);
    //golongan

   
    Route::get('/organisasi', [OrganisasiController::class, 'index'])->name('organisasi.index');
    Route::get('/organisasi/removeall', [OrganisasiController::class, 'removeall'])->name('organisasi.removeall');
    Route::get('/organisasi-edit/{id}', [OrganisasiController::class, 'edit']);
    Route::post('/organisasi-update', [OrganisasiController::class, 'update']);
    Route::post('/organisasi-save', [OrganisasiController::class, 'save']);
    
    Route::get('/buttonppdb', [ppdbController::class, 'index2'])->name('buttonppdb.index2');
    Route::get('/buttonppdb/removeall1', [ppdbController::class, 'removeall1'])->name('buttonppdb.removeall1');
    Route::get('/buttonppdb-edit1/{id}', [ppdbController::class, 'edit1']);
    Route::post('/buttonppdb-update3', [ppdbController::class, 'update3']);
    Route::post('/buttonppdb-save', [ppdbController::class, 'save']);
    
    Route::get('/buttonosis', [buttonosisController::class, 'index2'])->name('buttonosis.index2');
    Route::get('/buttonosis/removeall1', [buttonosisController::class, 'removeall1'])->name('buttonosis.removeall1');
    Route::get('/buttonosis-edit1/{id}', [buttonosisController::class, 'edit1']);
    Route::post('/buttonosis-update3', [buttonosisController::class, 'update3']);
    Route::post('/buttonosis-save', [buttonosisController::class, 'save']);

    Route::get('/buttonnilaisiswa', [buttonnilaisiswaController::class, 'index2'])->name('buttonnilaisiswa.index2');
    Route::get('/buttonnilaisiswa/removeall1', [buttonnilaisiswaController::class, 'removeall1'])->name('buttonnilaisiswa.removeall1');
    Route::get('/buttonnilaisiswa-edit1/{id}', [buttonnilaisiswaController::class, 'edit1']);
    Route::post('/buttonnilaisiswa-update3', [buttonnilaisiswaController::class, 'update3']);
    Route::post('/buttonnilaisiswa-save', [buttonnilaisiswaController::class, 'save']);
    
    Route::get('/buttoninputnilaiguru', [buttoninputnilaiguruController::class, 'index2'])->name('buttoninputnilaiguru.index2');
    Route::get('/buttoninputnilaiguru/removeall1', [buttoninputnilaiguruController::class, 'removeall1'])->name('buttoninputnilaiguru.removeall1');
    Route::get('/buttoninputnilaiguru-edit1/{id}', [buttoninputnilaiguruController::class, 'edit1']);
    Route::post('/buttoninputnilaiguru-update3', [buttoninputnilaiguruController::class, 'update3']);
    Route::post('/buttoninputnilaiguru-save', [buttoninputnilaiguruController::class, 'save']);
    
    Route::get('/buttoninputnilaikurikulum', [buttoninputnilaikurikulumController::class, 'index2'])->name('buttoninputnilaikurikulum.index2');
    Route::get('/buttoninputnilaikurikulum/removeall1', [buttoninputnilaikurikulumController::class, 'removeall1'])->name('buttoninputnilaikurikulum.removeall1');
    Route::get('/buttoninputnilaikurikulum-edit1/{id}', [buttoninputnilaikurikulumController::class, 'edit1']);
    Route::post('/buttoninputnilaikurikulum-update3', [buttoninputnilaikurikulumController::class, 'update3']);
    Route::post('/buttoninputnilaikurikulum-save', [buttoninputnilaikurikulumController::class, 'save']);
    
    Route::get('/editdata', [editdataController::class, 'index2'])->name('editdata.index2');
    Route::get('/editdata/removeall1', [editdataController::class, 'removeall1'])->name('editdata.removeall1');
    Route::get('/editdata-edit1/{id}', [editdataController::class, 'edit1']);
    Route::post('/editdata-update3', [editdataController::class, 'update3']);
    Route::post('/editdata-save', [editdataController::class, 'save']);
    
    
    


    Route::get('/ekstra', [ekstraController::class, 'index'])->name('ekstra.index');
    Route::get('/ekstra/removeall', [ekstraController::class, 'removeall'])->name('ekstra.removeall');
    Route::get('/ekstra-edit/{id}', [ekstraController::class, 'edit']);
    Route::post('/ekstra-update', [ekstraController::class, 'update']);
    Route::post('/ekstra-save', [ekstraController::class, 'save']);

    Route::get('/siswa', [siswaController::class, 'index'])->name('siswa.index');

    Route::get('/siswa/downloadAll',  [siswaController::class, 'downloadAll']);
    Route::get('siswa/download/{id}', [siswaController::class, 'download'])->name('siswa.download');
    Route::get('siswa/downloadAll', [siswaController::class, 'downloadAll'])->name('siswa.downloadAll');
    Route::get('/guru', [guruController::class, 'index'])->name('guru.index');
    Route::get('/guru/downloadAll',  [guruController::class, 'downloadAll']);
    Route::get('guru/download/{id}', [guruController::class, 'download'])->name('guru.download');
    Route::get('guru/downloadAll', [guruController::class, 'downloadAll'])->name('guru.downloadAll');
    Route::get('/daftarekstra', [ekstraguruController::class, 'store'])->name('daftarekstra.index');
    Route::get('/ekstrakulikuler/removeall', [ekstraguruController::class, 'removeall'])->name('ekstrakulikuler.removeall');
    Route::get('/ekstrakulikuler-edit/{id}', [ekstraguruController::class, 'edit']);
    Route::post('/ekstrakulikuler-update', [ekstraguruController::class, 'update']);
    Route::post('/ekstrakulikuler-save', [ekstraguruController::class, 'save']);
    Route::post('/remove-ekskul-from-siswa',      [ekstraguruController::class, 'removeEkskulFromSiswa'])->name('remove.ekskul.from.siswa');
    Route::post('/delete-siswa', [ekstraguruController::class, 'deleteSiswa'])->name('delete-siswa');
    Route::get('/downloadd/{ekstra_guru_id}', [ekstraguruController::class, 'downloadd'])->name('downloadd');

    Route::delete('/hapus-siswa', [ekstraguruController::class, 'hapusSiswa'])->name('hapus_siswa');


    Route::post('/jadwal', [datakelasController::class, 'store'])->name('jadwal.store');



    Route::get('/ppdb', [ppdbController::class, 'index'])->name('ppdb.index');
    Route::get('/ppdb/removeall', [ppdbController::class, 'removeall'])->name('ppdb.removeall');
    Route::post('/ppdb/update', [ppdbController::class, 'update'])->name('ppdb.update');
    Route::post('/ppdb-update2', [ppdbController::class, 'update2']);
    Route::get('/ppdb-edit/{id}', [ppdbController::class, 'edit']);



    Route::post('/generate-pdf', [PdfController::class, 'generatePdf1']);
    Route::get('/organisasisiswaall/removeall', [organisasiguruController::class, 'removeall'])->name('organisasisiswaall.removeall');
    Route::get('/organisasisiswaall-edit/{id}', [organisasiguruController::class, 'edit']);
    Route::post('/organisasisiswaall-update', [organisasiguruController::class, 'update']);
    Route::post('/organisasisiswaall-save', [organisasiguruController::class, 'save']);
    Route::get('/downloadddd/{organisasi_guru_siswa_id}', [organisasiguruController::class, 'downloadddd'])->name('downloadddd');

    Route::delete('/hapus', [datakelasController::class, 'hapus'])->name('hapus');
    // Route::get('/hapus/{datakelas_id}', [datakelasController::class, 'hapus'])->name('hapus');
});

