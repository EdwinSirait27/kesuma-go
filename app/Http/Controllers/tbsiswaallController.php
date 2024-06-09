<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbsiswa;
use App\Models\prestasi;
use App\Models\listakunsiswa;
use App\Models\siswamengajar;

use App\Models\pengumpulantugas;
use App\Models\SiswaEkstraGuru;
use App\Models\organisasiguru;
use App\Models\SiswaOrganisasiGuru;

use App\Models\osis;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class tbsiswaallController extends Controller
{

//     public function removeall(Request $request)
// {
//     $ids = $request->ids;
//     if (!empty($ids) && is_array($ids)) {
//         try {
//             $modelsWithSiswaId = ['tbsiswa', 'listakunsiswa', 'prestasi', 'SiswaOrganisasiGuru', 'organisasiguru', 'osis', 'siswamengajar', 'SiswaEkstraGuru', 'pengumpulantugas']; // Gantilah dengan nama model yang sesuai
            
//             foreach ($modelsWithSiswaId as $model) {
//                 $model::whereIn('siswa_id', $ids)->delete();
//             }

//             return response()->json(['success' => true]);
//         } catch (\Exception $e) {
//             $errorMessage = $e->getMessage();
//             return response()->json(['error' => $errorMessage], 500);
//         }
//     } else {
//         return response()->json(['error' => 'No IDs provided.'], 400);
//     }
// }

    
    // inii
    public function updatesiswa(Request $request)
    {
        // Validasi request
        $request->validate([
            'siswa_id' => 'required|array',

        ]);

        // Ambil siswa_id dari request
        $siswaIds = $request->input('siswa_id');

        // Lakukan pengubahan hak akses menjadi "Siswa" untuk setiap siswa yang dipilih
        tbsiswa::whereIn('siswa_id', $siswaIds)->each(function ($siswa) {
            $siswa->update(['status' => 'Lulus']);
             // Perbarui hak akses di relasi listakunsiswa
        });

        // Beri respons sukses
        return response()->json(['message' => 'Hak akses berhasil diubah menjadi Siswa']);
    }
    public function removeall(Request $request)
    {
        $ids = $request->ids; 
        if (!empty($ids) && is_array($ids)) {
            try {
                tbsiswa::whereIn('siswa_id', $ids)->delete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
            }
        } else {
            return response()->json(['error' => 'No IDs provided.'], 400);
        }
    }
    function removeall1(Request $request)
    {

        $prestasi_id_array = $request->input('prestasi_id');
        $data = prestasi::whereIn('prestasi_id', $prestasi_id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
    // public function removeall(Request $request)
    // {
    //     $ids = $request->ids; // Ambil ids yang dikirimkan dari AJAX

    //     // Pastikan $ids adalah array dan tidak kosong
    //     if (!empty($ids) && is_array($ids)) {
    //         try {
    //             // Hapus siswa berdasarkan ids
    //             tbsiswa::whereIn('siswa_id', $ids)->delete();

    //             // Jika berhasil, kembalikan respons sukses
    //             return response()->json(['success' => true]);
    //         } catch (\Exception $e) {
    //             // Jika terjadi kesalahan, kembalikan respons error
    //             return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
    //         }
    //     } else {
    //         // Jika $ids kosong atau bukan array, kembalikan respons error
    //         return response()->json(['error' => 'No IDs provided.'], 400);
    //     }
    // }
    
    public function index1(Request $request)
    {
        if ($request->ajax()) {
            $data = tbsiswa::with('listakunsiswa', 'kelas')
            ->whereHas('listakunsiswa', function ($query) {
                $query->where('hakakses', 'Siswa');
                $query->where('status', 'Aktif','Tidak Aktif');
            })->select(
                'siswa_id',
                'foto',
                'NamaLengkap',
                'NomorInduk',
                'JenisKelamin',
                'NISN',
                'Agama',
                'NomorTelephone',
                'Email',
                'status',
                'kelas_id'
            )   ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $encodedId = base64_encode($data->siswa_id); 
                    $button1 = '<a href="' . route('siswaall.show' , ['encodedId' => $encodedId]) .  '" class="btn btn-primary">Edit </a>';
                    $encryptedSiswaId = substr(Crypt::encryptString($data->siswa_id), 0, 12);
                    $redirectButton = '<a href="' . route('siswaex.index', ['kesuma-goencrypted' => $encryptedSiswaId]) . '" class="btn btn-success">Detail</a>';
                    $encodedId = base64_encode($data->siswa_id);
                    $redirectButton1 = '<a href="' . route('prestasi.index', ['encodedId' => $encodedId]) . '"  class="btn btn-dark">Prestasi</a>';

                    // $redirectButton1 = '<a href="' . route('prestasi.index', $data->siswa_id) . '" class="btn btn-dark">Prestasi</a>';
                    return $button1 . ' ' . $redirectButton . ' ' . $redirectButton1;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$siswa_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('siswaall.index');
    }
    public function indexlulus(Request $request)
    {
        if ($request->ajax()) {
            $data = tbsiswa::with('listakunsiswa', 'kelas')
            ->whereHas('listakunsiswa', function ($query) {
                $query->where('hakakses', 'Siswa');
                $query->where('status', 'Lulus');
            })->select(
                'siswa_id',
                'foto',
                'NamaLengkap',
                'NomorInduk',
                'JenisKelamin',
                'NISN',
                'NomorTelephone',
                'TahunMeninggalkanSekolah',
                'TamatBelajarTahun',
                'status',
                
            )   ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $encodedId = base64_encode($data->siswa_id); 
                    $button1 = '<a href="' . route('goodbye.show' , ['encodedId' => $encodedId]) .  '" class="btn btn-primary">Edit </a>';
                   
                    return $button1;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$siswa_id}}" />')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('goodbye.index');
    }
    // public function index1(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = tbsiswa::select(
    //             'siswa_id',
    //             'foto',
    //             'NamaLengkap',
    //             'NomorInduk',
    //             'JenisKelamin',
    //             'NISN',
    //             'Agama',
    //             'NomorTelephone',
    //             'Email',
    //             'status',
    //             'kelas_id'
    //         )->with('listakunsiswa', 'kelas')
    //             ->whereHas('listakunsiswa', function ($query) {
    //                 $query->where('hakakses', 'Siswa');
    //             })
    //             ->get();
    //         return Datatables::of($data)->addIndexColumn()
    //             ->addColumn('action', function ($data) {
    //                 $encodedId = base64_encode($data->siswa_id); 
    //                 $button1 = '<a href="' . route('siswaall.show' , ['encodedId' => $encodedId]) .  '" class="btn btn-primary">Edit </a>';
    //                 $encryptedSiswaId = substr(Crypt::encryptString($data->siswa_id), 0, 12);
    //                 $redirectButton = '<a href="' . route('siswaex.index', ['kesuma-goencrypted' => $encryptedSiswaId]) . '" class="btn btn-success">Detail</a>';
    //                 $redirectButton1 = '<a href="' . route('prestasi.index', $data->siswa_id) . '" class="btn btn-dark">Prestasi</a>';
    //                 return $button1 . ' ' . $redirectButton . ' ' . $redirectButton1;
    //             })
    //             ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$siswa_id}}" />')
    //             ->rawColumns(['checkbox', 'action'])
    //             ->make(true);
    //     }
    //     return view('siswaall.index');
    // }



    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = tbsiswa::with('listakunsiswa')
                ->whereHas('listakunsiswa', function ($query) {
                    $query->where('hakakses', 'Siswa');
                })
                ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->siswa_id . ');" class="btn btn-primary">Edit</button>';
                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$siswa_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('siswaex.index');
    }

    
    // function removeall(Request $request)
    // {
    //     $siswa_id_array = $request->input('siswa_id');
    //     $data = tbsiswa::whereIn('siswa_id', $siswa_id_array);
    

    //     if ($data->delete()) {
    //         return response()->json(['message' => 'Data Deleted']);
    //     }
    // }


    // function removeall(Request $request)
    // {
    //     $siswa_id_array = $request->input('siswa_id');

    //     DB::beginTransaction();
    //     try {
    //         // Nonaktifkan aturan foreign key sementara
    //         DB::statement('SET FOREIGN_KEY_CHECKS=0');

    //         // Coba hapus siswa dan entri terkait di listakunsiswa
    //         foreach ($siswa_id_array as $siswa_id) {
    //             $siswa = tbsiswa::find($siswa_id);

    //             // Jika siswa terikat ke kelas, coba pisahkan atau hapus kelas terlebih dahulu
    //             if ($siswa && $siswa->kelas_id !== null) {
    //                 // Contoh: Pisahkan siswa dari kelas
    //                 // $kelas = Kelas::find($siswa->kelas_id);
    //                 // $kelas->siswa()->detach($siswa); // Contoh menggunakan Eloquent Relationships
    //                 // $kelas->delete(); // Atau menghapus kelas
    //             }

    //             // Hapus siswa
    //             tbsiswa::destroy($siswa_id);

    //             // Hapus entri terkait di listakunsiswa
    //             listakunsiswa::where('siswa_id', $siswa_id)->delete();
    //             siswamengajar::where('siswa_id', $siswa_id)->delete();
    //             prestasi::where('siswa_id', $siswa_id)->delete();
    //             pengumpulantugas::where('siswa_id', $siswa_id)->delete();
    //             siswaekstraguru::where('siswa_id', $siswa_id)->delete();
    //             siswaorganisasiguru::where('siswa_id', $siswa_id)->delete();
    //             // organisasiguru::where('siswa_id', $siswa_id)->delete();
    //         }

    //         // Aktifkan kembali aturan foreign key
    //         DB::statement('SET FOREIGN_KEY_CHECKS=1');

    //         DB::commit();

    //         return response()->json(['message' => 'Data Deleted']);
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return response()->json(['error' => $e->getMessage()]);
    //     }
    // }



    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($request->txt_id),
                ],
                'foto' => 'image|mimes:jpeg|max:512', 
            ], [
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Format file gambar harus jpeg.',
                'foto.max' => 'Ukuran file gambar tidak boleh melebihi 512 KB.',
            ]);

            $hakakses = 'Siswa';

            if ($request->txt_id !== '0') {
                $existingSiswa = tbsiswa::find($request->txt_id);

                if ($existingSiswa) {
                    $existingSiswa->NamaLengkap = $request->NamaLengkap;
                    $existingSiswa->NomorInduk = $request->NomorInduk;
                    $existingSiswa->NamaPanggilan = $request->NamaPanggilan;
                    $existingSiswa->JenisKelamin = $request->JenisKelamin;
                    $existingSiswa->NISN = $request->NISN;
                    $existingSiswa->TempatLahir = $request->TempatLahir;
                    $existingSiswa->TanggalLahir = $request->TanggalLahir;
                    $existingSiswa->Agama = $request->Agama;
                    $existingSiswa->Alamat = $request->Alamat;
                    $existingSiswa->RT = $request->RT;
                    $existingSiswa->RW = $request->RW;
                    $existingSiswa->Kelurahan = $request->Kelurahan;
                    $existingSiswa->Kecamatan = $request->Kecamatan;
                    $existingSiswa->KabKota = $request->KabKota;
                    $existingSiswa->Provinsi = $request->Provinsi;
                    $existingSiswa->KodePos = $request->KodePos;
                    $existingSiswa->Email = $request->Email;
                    $existingSiswa->NomorTelephone = $request->NomorTelephone;
                    $existingSiswa->Kewarganegaraan = $request->Kewarganegaraan;
                    $existingSiswa->NIK = $request->NIK;
                    $existingSiswa->GolDarah = $request->GolDarah;
                    $existingSiswa->TinggalDengan = $request->TinggalDengan;
                    $existingSiswa->StatusSiswa = $request->StatusSiswa;
                    $existingSiswa->AnakKe = $request->AnakKe;
                    $existingSiswa->SaudaraKandung = $request->SaudaraKandung;
                    $existingSiswa->SaudaraTiri = $request->SaudaraTiri;
                    $existingSiswa->Tinggicm = $request->Tinggicm;
                    $existingSiswa->Beratkg = $request->Beratkg;
                    $existingSiswa->RiwayatPenyakit = $request->RiwayatPenyakit;
                    $existingSiswa->AsalSMP = $request->AsalSMP;
                    $existingSiswa->AlamatSMP = $request->AlamatSMP;
                    $existingSiswa->NPSNSMP = $request->NPSNSMP;
                    $existingSiswa->KabKotaSMP = $request->KabKotaSMP;
                    $existingSiswa->ProvinsiSMP = $request->ProvinsiSMP;
                    $existingSiswa->NoIjasah = $request->NoIjasah;
                    $existingSiswa->NoSKHUN = $request->NoSKHUN;
                    $existingSiswa->DiterimaTanggal = $request->DiterimaTanggal;
                    $existingSiswa->DiterimaDiKelas = $request->DiterimaDiKelas;
                    $existingSiswa->DiterimaSemester = $request->DiterimaSemester;
                    $existingSiswa->MutasiAsalSMA = $request->MutasiAsalSMA;
                    $existingSiswa->AlasanPindah = $request->AlasanPindah;
                    $existingSiswa->NoPesertaUNSMP = $request->NoPesertaUNSMP;
                    $existingSiswa->TglIjasah = $request->TglIjasah;
                    $existingSiswa->NamaOrangTuaPadaIjasah = $request->NamaOrangTuaPadaIjasah;
                    $existingSiswa->NamaAyah = $request->NamaAyah;
                    $existingSiswa->TahunLahirAyah = $request->TahunLahirAyah;
                    $existingSiswa->AlamatAyah = $request->AlamatAyah;
                    $existingSiswa->NomorTelephoneAyah = $request->NomorTelephoneAyah;
                    $existingSiswa->AgamaAyah = $request->AgamaAyah;
                    $existingSiswa->PendidikanTerakhirAyah = $request->PendidikanTerakhirAyah;
                    $existingSiswa->PekerjaanAyah = $request->PekerjaanAyah;
                    $existingSiswa->PenghasilanAyah = $request->PenghasilanAyah;
                    $existingSiswa->NamaIbu = $request->NamaIbu;
                    $existingSiswa->TahunLahirIbu = $request->TahunLahirIbu;
                    $existingSiswa->AlamatIbu = $request->AlamatIbu;
                    $existingSiswa->NomorTelephoneIbu = $request->NomorTelephoneIbu;
                    $existingSiswa->AgamaIbu = $request->AgamaIbu;
                    $existingSiswa->PendidikanTerakhirIbu = $request->PendidikanTerakhirIbu;
                    $existingSiswa->PekerjaanIbu = $request->PekerjaanIbu;
                    $existingSiswa->PenghasilanIbu = $request->PenghasilanIbu;
                    $existingSiswa->NamaWali = $request->NamaWali;
                    $existingSiswa->TahunLahirWali = $request->TahunLahirWali;
                    $existingSiswa->AlamatWali = $request->AlamatWali;
                    $existingSiswa->NomorTelephoneWali = $request->NomorTelephoneWali;
                    $existingSiswa->AgamaWali = $request->AgamaWali;
                    $existingSiswa->PendidikanTerakhirWali = $request->PendidikanTerakhirWali;
                    $existingSiswa->PekerjaanWali = $request->PekerjaanWali;
                    $existingSiswa->WaliPenghasilan = $request->WaliPenghasilan;
                    $existingSiswa->StatusHubunganWali = $request->StatusHubunganWali;
                    $existingSiswa->MenerimaBeasiswaDari = $request->MenerimaBeasiswaDari;
                    $existingSiswa->TahunMeninggalkanSekolah = $request->TahunMeninggalkanSekolah;
                    $existingSiswa->AlasanSebab = $request->AlasanSebab;
                    $existingSiswa->TamatBelajarTahun = $request->TamatBelajarTahun;
                    $existingSiswa->TanggalNomorSTTB = $request->TanggalNomorSTTB;
                    $existingSiswa->InformasiLain = $request->InformasiLain;
                    $existingSiswa->cita = $request->cita;
                    $existingSiswa->status = $request->status;

                    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                        $file = $request->file('foto');
                        $fileName = time() . '_' . $file->getClientOriginalName(); // Gunakan timestamp untuk membuat nama file unik
                        $file->storeAs('public/fotosiswa', $fileName); // Pindahkan file ke direktori publik
                        $existingSiswa->foto = $fileName; // Simpan nama file ke dalam database
                    }

                    $existingSiswa->save();

                    if ($existingSiswa->listakunsiswa) {
                        $existingSiswa->listakunsiswa->update([
                            "username" => $request->username,
                            "password" => bcrypt($request->password),
                            "hakakses" => $hakakses,
                        ]);
                    } else {
                        if ($request->username && $request->password) {
                            $existingSiswa->listakunsiswa()->create([
                                "username" => $request->username,
                                "password" => bcrypt($request->password),
                                "hakakses" => $hakakses,
                                "remember_token" => Str::random(60),
                            ]);
                        }
                    }
                }
            } else {
                $val = [
                    "NamaLengkap" => $request->NamaLengkap,
                    "NomorInduk" => $request->NomorInduk,
                    "NamaPanggilan" => $request->NamaPanggilan,
                    "JenisKelamin" => $request->JenisKelamin,
                    "NISN" => $request->NISN,
                    "TempatLahir" => $request->TempatLahir,
                    "TanggalLahir" => $request->TanggalLahir,
                    "Agama" => $request->Agama,
                    "Alamat" => $request->Alamat,
                    "RT" => $request->RT,
                    "RW" => $request->RW,
                    "Kelurahan" => $request->Kelurahan,
                    "Kecamatan" => $request->Kecamatan,
                    "KabKota" => $request->KabKota,
                    "Provinsi" => $request->Provinsi,
                    "KodePos" => $request->KodePos,
                    "Email" => $request->Email,
                    "NomorTelephone" => $request->NomorTelephone,
                    "Kewarganegaraan" => $request->Kewarganegaraan,
                    "NIK" => $request->NIK,
                    "GolDarah" => $request->GolDarah,
                    "TinggalDengan" => $request->TinggalDengan,
                    "StatusSiswa" => $request->StatusSiswa,
                    "AnakKe" => $request->AnakKe,
                    "SaudaraKandung" => $request->SaudaraKandung,
                    "SaudaraTiri" => $request->SaudaraTiri,
                    "Tinggicm" => $request->Tinggicm,
                    "Beratkg" => $request->Beratkg,
                    "RiwayatPenyakit" => $request->RiwayatPenyakit,
                    "AsalSMP" => $request->AsalSMP,
                    "AlamatSMP" => $request->AlamatSMP,
                    "NPSNSMP" => $request->NPSNSMP,
                    "KabKotaSMP" => $request->KabKotaSMP,
                    "ProvinsiSMP" => $request->ProvinsiSMP,
                    "NoIjasah" => $request->NoIjasah,
                    "NoSKHUN" => $request->NoSKHUN,
                    "DiterimaTanggal" => $request->DiterimaTanggal,
                    "DiterimaDiKelas" => $request->DiterimaDiKelas,
                    "DiterimaSemester" => $request->DiterimaSemester,
                    "MutasiAsalSMA" => $request->MutasiAsalSMA,
                    "AlasanPindah" => $request->AlasanPindah,
                    "NoPesertaUNSMP" => $request->NoPesertaUNSMP,
                    "TglIjasah" => $request->TglIjasah,
                    "NamaOrangTuaPadaIjasah" => $request->NamaOrangTuaPadaIjasah,
                    "NamaAyah" => $request->NamaAyah,
                    "TahunLahirAyah" => $request->TahunLahirAyah,
                    "AlamatAyah" => $request->AlamatAyah,
                    "NomorTelephoneAyah" => $request->NomorTelephoneAyah,
                    "AgamaAyah" => $request->AgamaAyah,
                    "PendidikanTerakhirAyah" => $request->PendidikanTerakhirAyah,
                    "PekerjaanAyah" => $request->PekerjaanAyah,
                    "PenghasilanAyah" => $request->PenghasilanAyah,
                    "NamaIbu" => $request->NamaIbu,
                    "TahunLahirIbu" => $request->TahunLahirIbu,
                    "AlamatIbu" => $request->AlamatIbu,
                    "NomorTelephoneIbu" => $request->NomorTelephoneIbu,
                    "AgamaIbu" => $request->AgamaIbu,
                    "PendidikanTerakhirIbu" => $request->PendidikanTerakhirIbu,
                    "PekerjaanIbu" => $request->PekerjaanIbu,
                    "PenghasilanIbu" => $request->PenghasilanIbu,
                    "NamaWali" => $request->NamaWali,
                    "TahunLahirWali" => $request->TahunLahirWali,
                    "AlamatWali" => $request->AlamatWali,
                    "NomorTelephoneWali" => $request->NomorTelephoneWali,
                    "AgamaWali" => $request->AgamaWali,
                    "PendidikanTerakhirWali" => $request->PendidikanTerakhirWali,
                    "PekerjaanWali" => $request->PekerjaanWali,
                    "WaliPenghasilan" => $request->WaliPenghasilan,
                    "StatusHubunganWali" => $request->StatusHubunganWali,
                    "MenerimaBeasiswaDari" => $request->MenerimaBeasiswaDari,
                    "TahunMeninggalkanSekolah" => $request->TahunMeninggalkanSekolah,
                    "AlasanSebab" => $request->AlasanSebab,
                    "TamatBelajarTahun" => $request->TamatBelajarTahun,
                    "TanggalNomorSTTB" => $request->TanggalNomorSTTB,
                    "InformasiLain" => $request->InformasiLain,
                    "cita" => $request->cita,
                    "status" => $request->status,
                ];
                $newSiswa = tbsiswa::create($val);

                if ($newSiswa) {
                    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                        $file = $request->file('foto');
                        $fileName = time() . '_' . $file->getClientOriginalName(); // Gunakan timestamp untuk membuat nama file unik
                        $file->storeAs('public/fotosiswa', $fileName);
            $newSiswa->foto = $fileName; // Simpan nama file ke dalam database
                    }

                    $newSiswa->save();

                    $newSiswa->listakunsiswa()->create([
                        "username" => $request->username,
                        "password" => bcrypt($request->password),
                        "hakakses" => $hakakses,
                        "remember_token" => Str::random(60),
                    ]);
                }
            }

            DB::commit();
            return redirect('/siswaall')->with('success', 'Siswa Berhasil Diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }





    public function edit($id)
    {
        $data = tbsiswa::with('listakunsiswa')->find($id);
        if ($data) {
            $response = [
                'foto',
                'NOPDF',
                'NamaLengkap',
                'NomorInduk',
                'NamaPanggilan',
                'JenisKelamin',
                'NISN',
                'TempatLahir',
                'TanggalLahir',
                'Agama',
                'Alamat',
                'RT',
                'RW',
                'Kelurahan',
                'Kecamatan',
                'KabKota',
                'Provinsi',
                'KodePos',
                'Email',
                'NomorTelephone',
                'Kewarganegaraan',
                'NIK',
                'GolDarah',
                'TinggalDengan',
                'StatusSiswa',
                'AnakKe',
                'SaudaraKandung',
                'SaudaraTiri',
                'Tinggicm',
                'Beratkg',
                'RiwayatPenyakit',
                'AsalSMP',
                'AlamatSMP',
                'NPSNSMP',
                'KabKotaSMP',
                'ProvinsiSMP',
                'NoIjasah',
                'NoSKHUN',
                'DiterimaTanggal',
                'DiterimaDiKelas',
                'DiterimaSemester',
                'MutasiAsalSMA',
                'AlasanPindah',
                'NoPesertaUNSMP',
                'TglIjasah',
                'NamaOrangTuaPadaIjasah',
                'NamaAyah',
                'TahunLahirAyah',
                'AlamatAyah',
                'NomorTelephoneAyah',
                'AgamaAyah',
                'PendidikanTerakhirAyah',
                'PekerjaanAyah',
                'PenghasilanAyah',
                'NamaIbu',
                'TahunLahirIbu',
                'AlamatIbu',
                'NomorTelephoneIbu',
                'AgamaIbu',
                'PendidikanTerakhirIbu',
                'PekerjaanIbu',
                'PenghasilanIbu',
                'NamaWali',
                'TahunLahirWali',
                'AlamatWali',
                'NomorTelephoneWali',
                'AgamaWali',
                'PendidikanTerakhirWali',
                'PekerjaanWali',
                'WaliPenghasilan',
                'StatusHubunganWali',
                'MenerimaBeasiswaDari',
                'TahunMeninggalkanSekolah',
                'AlasanSebab',
                'TamatBelajarTahun',
                'TanggalNomorSTTB',
                'InformasiLain',
                'cita',
                'status',
            ];

            foreach ($response as $field) {
                $response[$field] = $data->$field;
            }
            if ($data->listakunsiswa) {
                $response += [
                    'username' => $data->listakunsiswa->username,
                    'password' => $data->listakunsiswa->password,
                    'hakakses' => $data->listakunsiswa->hakakses,
                ];
            } else {
                $response += [
                    'username' => null,
                    'password' => null,
                    'hakakses' => null,
                ];
            }
            return response()->json($response);
        }
        return response()->json(null, 404);
    }
    public function store(Request $request, $siswa_id )
    {
        
        // $encodedId = $request->encodedId;
    
        // // Check if encodedId is present and valid
        // if (!$encodedId || !($siswa_id = base64_decode($encodedId, true))) {
        //     // Handle error if decoding fails
        //     return redirect()->back()->with('error', 'Invalid data');
        // }
    
       // Validasi input
        $validatedData = $request->validate([
            'prestasi' => 'required',
            'keterangan' => 'required',
            'foto' => 'image|mimes:jpeg|max:512', 
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format file gambar harus jpeg.',
            'foto.max' => 'Ukuran file gambar tidak boleh melebihi 512 KB.',
        ]);

        // Simpan prestasi
        $prestasi = new Prestasi();
        $prestasi->siswa_id = $siswa_id;
        $prestasi->prestasi = $request->prestasi;
        $prestasi->keterangan = $request->keterangan;
        $prestasi->save();

        // Jika Anda ingin memberikan respons atau kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Prestasi berhasil disimpan!');
    }
    public function indexx(Request $request)
    {
        $encodedId = $request->encodedId;
    
        // Check if encodedId is present and valid
        if (!$encodedId || !($siswa_id = base64_decode($encodedId, true))) {
            // Handle error if decoding fails
            return redirect()->back()->with('error', 'Invalid data');
        }
    
        $prestasis = Prestasi::where('siswa_id', $siswa_id)->get();
    
        if ($request->ajax()) {
            $data = Prestasi::select(
                    'prestasi_id',
                    'siswa_id',
                    'prestasi',
                    'keterangan'
                )->where('siswa_id', $siswa_id)->get();
    
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('checkbox', function($row) {
                    return '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="'.$row->prestasi_id.'" />';
                })
                ->rawColumns(['checkbox'])
                ->make(true);
        }
    
        return view('prestasi.index', compact('prestasis', 'siswa_id'));
    }
    
    // public function indexx(Request $request)
    // { 
    //     $encodedId = $request->encodedId;
    //     $siswa_id = base64_decode($encodedId);
    //     $prestasis = Prestasi::where('siswa_id', $siswa_id)->get();

    //     if (!$siswa_id) {
    //         // Handle error if decoding fails
    //         return redirect()->back()->with('error', 'Invalid data');
    //     }
    //     if ($request->ajax()) {
    //         $data = Prestasi::select(
            
    //             'prestasi_id',
    //             'siswa_id',
    //             'prestasi',
    //             'keterangan'
                
    //         )->get();

    //         return Datatables::of($data)->addIndexColumn()
                
    //             ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$prestasi_id}}" />')
    //             ->rawColumns(['checkbox'])
    //             ->make(true);
    //     }
    //     return view('prestasi.index', compact('prestasis','siswa_id'));
    // }
        // Ambil daftar prestasi siswa berdasarkan $siswa_id
    //     $prestasis = Prestasi::where('siswa_id', $siswa_id)->get();

    //     // Kembalikan view 'index' sambil mengirimkan data prestasi ke dalam view
    //     return view('prestasi.index', compact('prestasis','siswa_id'));
    // }
    // public function indexx($siswa_id)
    // {
    //     // Ambil daftar prestasi siswa berdasarkan $siswa_id
    //     $prestasis = Prestasi::where('siswa_id', $siswa_id)->get();

    //     // Kembalikan view 'index' sambil mengirimkan data prestasi ke dalam view
    //     return view('prestasi.index', compact('prestasis', 'siswa_id'));
    // }

    public function create(Request $request)
    {
        $encodedId = $request->encodedId;
        $siswa_id = base64_decode($encodedId);

        if (!$siswa_id) {
            // Handle error if decoding fails
            return redirect()->back()->with('error', 'Invalid data');
        }
        $prestasis = Prestasi::where('siswa_id', $siswa_id)->get();
        return view('prestasi.create', compact('siswa_id', 'prestasis'));
    }
    public function show(Request $request)
    {
        $encodedId = $request->encodedId;
        $siswa_id = base64_decode($encodedId);
       
        $siswa = tbsiswa::with('listakunsiswa', 'kelas')->findOrFail($siswa_id);
        return view('siswaall.show', compact('siswa'));
    }
    public function indexxx(Request $request)
    {
        $encodedId = $request->encodedId;
        $siswa_id = base64_decode($encodedId);
       
        $siswa = tbsiswa::with('listakunsiswa', 'kelas')->findOrFail($siswa_id);
        return view('editpassword.index', compact('siswa'));
    }
    public function show1(Request $request)
    {
        $encodedId = $request->encodedId;
        $siswa_id = base64_decode($encodedId);
        $siswa = tbsiswa::with('listakunsiswa', 'kelas')->findOrFail($siswa_id);
        return view('editpassword.index', compact('siswa'));
    }
    public function updatee(Request $request)
    {
        $encodedId = $request->encodedId;
        $siswa_id = base64_decode($encodedId);
        $request->validate([
            'NamaLengkap' => 'required|string|max:255',
            'foto' => 'image|mimes:jpeg|max:512', 
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format file gambar harus jpeg.',
            'foto.max' => 'Ukuran file gambar tidak boleh melebihi 512 KB.',
        ]);
        $siswa = tbsiswa::with('listakunsiswa')->findOrFail($siswa_id);
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName(); 
            $file->storeAs('public/fotosiswa', $fileName); 
            $siswa->foto = $fileName;
        }
       
        $siswa->NamaLengkap = $request->input('NamaLengkap');
        $siswa->NomorInduk = $request->input('NomorInduk');
        $siswa->NamaPanggilan = $request->input('NamaPanggilan');
        $siswa->JenisKelamin = $request->input('JenisKelamin');
        $siswa->NISN = $request->input('NISN');
        $siswa->TempatLahir = $request->input('TempatLahir');
        $siswa->TanggalLahir = $request->input('TanggalLahir');
        $siswa->Agama = $request->input('Agama');
        $siswa->Alamat = $request->input('Alamat');
        $siswa->RT = $request->input('RT');
        $siswa->RW = $request->input('RW');
        $siswa->Kelurahan = $request->input('Kelurahan');
        $siswa->Kecamatan = $request->input('Kecamatan');
        $siswa->KabKota = $request->input('KabKota');
        $siswa->Provinsi = $request->input('Provinsi');
        $siswa->KodePos = $request->input('KodePos');
        $siswa->Email = $request->input('Email');
        $siswa->NomorTelephone = $request->input('NomorTelephone');
        $siswa->Kewarganegaraan = $request->input('Kewarganegaraan');
        $siswa->NIK = $request->input('NIK');
        $siswa->GolDarah = $request->input('GolDarah');
        $siswa->TinggalDengan = $request->input('TinggalDengan');
        $siswa->StatusSiswa = $request->input('StatusSiswa');
        $siswa->AnakKe = $request->input('AnakKe');
        $siswa->SaudaraKandung = $request->input('SaudaraKandung');
        $siswa->SaudaraTiri = $request->input('SaudaraTiri');
        $siswa->Tinggicm = $request->input('Tinggicm');
        $siswa->Beratkg = $request->input('Beratkg');
        $siswa->RiwayatPenyakit = $request->input('RiwayatPenyakit');
        $siswa->AsalSMP = $request->input('AsalSMP');
        $siswa->AlamatSMP = $request->input('AlamatSMP');
        $siswa->NPSNSMP = $request->input('NPSNSMP');
        $siswa->KabKotaSMP = $request->input('KabKotaSMP');
        $siswa->ProvinsiSMP = $request->input('ProvinsiSMP');
        $siswa->NoIjasah = $request->input('NoIjasah');
        $siswa->NoSKHUN = $request->input('NoSKHUN');
        $siswa->DiterimaTanggal = $request->input('DiterimaTanggal');
        $siswa->DiterimaDiKelas = $request->input('DiterimaDiKelas');
        $siswa->DiterimaSemester = $request->input('DiterimaSemester');
        $siswa->MutasiAsalSMA = $request->input('MutasiAsalSMA');
        $siswa->AlasanPindah = $request->input('AlasanPindah');
        $siswa->NoPesertaUNSMP = $request->input('NoPesertaUNSMP');
        $siswa->TglIjasah = $request->input('TglIjasah');
        $siswa->NamaOrangTuaPadaIjasah = $request->input('NamaOrangTuaPadaIjasah');
        $siswa->NamaAyah = $request->input('NamaAyah');
        $siswa->TahunLahirAyah = $request->input('TahunLahirAyah');
        $siswa->AlamatAyah = $request->input('AlamatAyah');
        $siswa->NomorTelephoneAyah = $request->input('NomorTelephoneAyah');
        $siswa->AgamaAyah = $request->input('AgamaAyah');
        $siswa->PendidikanTerakhirAyah = $request->input('PendidikanTerakhirAyah');
        $siswa->PekerjaanAyah = $request->input('PekerjaanAyah');
        $siswa->PenghasilanAyah = $request->input('PenghasilanAyah');
        $siswa->NamaIbu = $request->input('NamaIbu');
        $siswa->TahunLahirIbu = $request->input('TahunLahirIbu');
        $siswa->AlamatIbu = $request->input('AlamatIbu');
        $siswa->NomorTelephoneIbu = $request->input('NomorTelephoneIbu');
        $siswa->AgamaIbu = $request->input('AgamaIbu');
        $siswa->PendidikanTerakhirIbu = $request->input('PendidikanTerakhirIbu');
        $siswa->PekerjaanIbu = $request->input('PekerjaanIbu');
        $siswa->PenghasilanIbu = $request->input('PenghasilanIbu');
        $siswa->NamaWali = $request->input('NamaWali');
        $siswa->TahunLahirWali = $request->input('TahunLahirWali');
        $siswa->AlamatWali = $request->input('AlamatWali');
        $siswa->NomorTelephoneWali = $request->input('NomorTelephoneWali');
        $siswa->AgamaWali = $request->input('AgamaWali');
        $siswa->PendidikanTerakhirWali = $request->input('PendidikanTerakhirWali');
        $siswa->PekerjaanWali = $request->input('PekerjaanWali');
        $siswa->WaliPenghasilan = $request->input('WaliPenghasilan');
        $siswa->StatusHubunganWali = $request->input('StatusHubunganWali');
        $siswa->MenerimaBeasiswaDari = $request->input('MenerimaBeasiswaDari');
        $siswa->TahunMeninggalkanSekolah = $request->input('TahunMeninggalkanSekolah');
        $siswa->AlasanSebab = $request->input('AlasanSebab');
        $siswa->TamatBelajarTahun = $request->input('TamatBelajarTahun');
        $siswa->TanggalNomorSTTB = $request->input('TanggalNomorSTTB');
        $siswa->InformasiLain = $request->input('InformasiLain');
        $siswa->cita = $request->input('cita');
        $siswa->status = $request->input('status');
        $siswa->save();
      
        
        // return redirect()->route('siswaall.show', $siswa_id)->with('success', 'Data siswa berhasil diperbarui.');
        return redirect()->route('siswaall.show', ['encodedId' => base64_encode($siswa_id)])->with('success', 'Data siswa berhasil diperbarui.');

    }
    public function lulus(Request $request)
    {
        $encodedId = $request->encodedId;
        $siswa_id = base64_decode($encodedId);
        $request->validate([
            'NamaLengkap' => 'required|string|max:255',
            'foto' => 'image|mimes:jpeg|max:512', 
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format file gambar harus jpeg.',
            'foto.max' => 'Ukuran file gambar tidak boleh melebihi 512 KB.',
        ]);
        $siswa = tbsiswa::with('listakunsiswa')->findOrFail($siswa_id);
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName(); 
            $file->storeAs('public/fotosiswa', $fileName); 
            $siswa->foto = $fileName;
        }
       
        $siswa->NamaLengkap = $request->input('NamaLengkap');
        $siswa->NomorInduk = $request->input('NomorInduk');
        $siswa->NamaPanggilan = $request->input('NamaPanggilan');
        $siswa->JenisKelamin = $request->input('JenisKelamin');
        $siswa->NISN = $request->input('NISN');
        $siswa->TempatLahir = $request->input('TempatLahir');
        $siswa->TanggalLahir = $request->input('TanggalLahir');
        $siswa->Agama = $request->input('Agama');
        $siswa->Alamat = $request->input('Alamat');
        $siswa->RT = $request->input('RT');
        $siswa->RW = $request->input('RW');
        $siswa->Kelurahan = $request->input('Kelurahan');
        $siswa->Kecamatan = $request->input('Kecamatan');
        $siswa->KabKota = $request->input('KabKota');
        $siswa->Provinsi = $request->input('Provinsi');
        $siswa->KodePos = $request->input('KodePos');
        $siswa->Email = $request->input('Email');
        $siswa->NomorTelephone = $request->input('NomorTelephone');
        $siswa->Kewarganegaraan = $request->input('Kewarganegaraan');
        $siswa->NIK = $request->input('NIK');
        $siswa->GolDarah = $request->input('GolDarah');
        $siswa->TinggalDengan = $request->input('TinggalDengan');
        $siswa->StatusSiswa = $request->input('StatusSiswa');
        $siswa->AnakKe = $request->input('AnakKe');
        $siswa->SaudaraKandung = $request->input('SaudaraKandung');
        $siswa->SaudaraTiri = $request->input('SaudaraTiri');
        $siswa->Tinggicm = $request->input('Tinggicm');
        $siswa->Beratkg = $request->input('Beratkg');
        $siswa->RiwayatPenyakit = $request->input('RiwayatPenyakit');
        $siswa->AsalSMP = $request->input('AsalSMP');
        $siswa->AlamatSMP = $request->input('AlamatSMP');
        $siswa->NPSNSMP = $request->input('NPSNSMP');
        $siswa->KabKotaSMP = $request->input('KabKotaSMP');
        $siswa->ProvinsiSMP = $request->input('ProvinsiSMP');
        $siswa->NoIjasah = $request->input('NoIjasah');
        $siswa->NoSKHUN = $request->input('NoSKHUN');
        $siswa->DiterimaTanggal = $request->input('DiterimaTanggal');
        $siswa->DiterimaDiKelas = $request->input('DiterimaDiKelas');
        $siswa->DiterimaSemester = $request->input('DiterimaSemester');
        $siswa->MutasiAsalSMA = $request->input('MutasiAsalSMA');
        $siswa->AlasanPindah = $request->input('AlasanPindah');
        $siswa->NoPesertaUNSMP = $request->input('NoPesertaUNSMP');
        $siswa->TglIjasah = $request->input('TglIjasah');
        $siswa->NamaOrangTuaPadaIjasah = $request->input('NamaOrangTuaPadaIjasah');
        $siswa->NamaAyah = $request->input('NamaAyah');
        $siswa->TahunLahirAyah = $request->input('TahunLahirAyah');
        $siswa->AlamatAyah = $request->input('AlamatAyah');
        $siswa->NomorTelephoneAyah = $request->input('NomorTelephoneAyah');
        $siswa->AgamaAyah = $request->input('AgamaAyah');
        $siswa->PendidikanTerakhirAyah = $request->input('PendidikanTerakhirAyah');
        $siswa->PekerjaanAyah = $request->input('PekerjaanAyah');
        $siswa->PenghasilanAyah = $request->input('PenghasilanAyah');
        $siswa->NamaIbu = $request->input('NamaIbu');
        $siswa->TahunLahirIbu = $request->input('TahunLahirIbu');
        $siswa->AlamatIbu = $request->input('AlamatIbu');
        $siswa->NomorTelephoneIbu = $request->input('NomorTelephoneIbu');
        $siswa->AgamaIbu = $request->input('AgamaIbu');
        $siswa->PendidikanTerakhirIbu = $request->input('PendidikanTerakhirIbu');
        $siswa->PekerjaanIbu = $request->input('PekerjaanIbu');
        $siswa->PenghasilanIbu = $request->input('PenghasilanIbu');
        $siswa->NamaWali = $request->input('NamaWali');
        $siswa->TahunLahirWali = $request->input('TahunLahirWali');
        $siswa->AlamatWali = $request->input('AlamatWali');
        $siswa->NomorTelephoneWali = $request->input('NomorTelephoneWali');
        $siswa->AgamaWali = $request->input('AgamaWali');
        $siswa->PendidikanTerakhirWali = $request->input('PendidikanTerakhirWali');
        $siswa->PekerjaanWali = $request->input('PekerjaanWali');
        $siswa->WaliPenghasilan = $request->input('WaliPenghasilan');
        $siswa->StatusHubunganWali = $request->input('StatusHubunganWali');
        $siswa->MenerimaBeasiswaDari = $request->input('MenerimaBeasiswaDari');
        $siswa->TahunMeninggalkanSekolah = $request->input('TahunMeninggalkanSekolah');
        $siswa->AlasanSebab = $request->input('AlasanSebab');
        $siswa->TamatBelajarTahun = $request->input('TamatBelajarTahun');
        $siswa->TanggalNomorSTTB = $request->input('TanggalNomorSTTB');
        $siswa->InformasiLain = $request->input('InformasiLain');
        $siswa->cita = $request->input('cita');
        $siswa->status = $request->input('status');
        $siswa->save();
      
        
        // return redirect()->route('siswaall.show', $siswa_id)->with('success', 'Data siswa berhasil diperbarui.');
        return redirect()->route('goodbye.show', ['encodedId' => base64_encode($siswa_id)])->with('success', 'Data siswa berhasil diperbarui.');

    }
    public function updateee(Request $request)
    {
        $encodedId = $request->encodedId;
        $siswa_id = base64_decode($encodedId);
        $request->validate([
            'password' => 'required',
          
        ]);
        $siswa = tbsiswa::with('listakunsiswa')->findOrFail($siswa_id);
        
        $hashedPassword = Hash::make($request->input('password'));

        // Update password untuk setiap akun siswa terkait
        $siswa->listakunsiswa()->update(['password' => $hashedPassword]);
$siswa->save();
        return redirect()->route('editpassword.index', ['encodedId' => base64_encode($siswa_id)])->with('success', 'Password berhasil diperbarui.');

    }
}
// foreach ($siswa->listakunsiswa as $akun) {
//     // Assuming the username field in listakunsiswa table is 'username', adjust it if different
//     $akun->password = $request->input('password'); // Update username with the new name
//     $akun->save(); // Save the changes
// }