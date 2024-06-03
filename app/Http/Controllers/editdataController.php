<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\editdata;
use App\Models\tbsiswa;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
class editdataController extends Controller
{
    public function index2(Request $request)
    {
        $buttons = editdata::all();
        if ($request->ajax()) {
            $data = editdata::select(
                'id',
                'url',
                'start_date',
                'end_date'
            )->get();

            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->id . ');" class="btn btn-primary">Edit</button>';
                  
                    return $button;
                })
                // ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id}}" />')
                ->rawColumns([ 'action'])
                ->make(true);
        }
        return view('editdata.index', compact('buttons'));
    }
    
    function removeall1(Request $request)
    {
        $id_array = $request->input('id');
        $data = editdata::whereIn('id', $id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
    public function edit1($id)
    {
        $data = editdata::find($id);
        if ($data) {
            
            $url = $data->url;
            $start_date = $data->start_date;
            $end_date = $data->end_date;
            
            
            return response()->json([
            
                "url" => $url,
                "start_date" => $start_date,
                "end_date" => $end_date
            ]);
        }
        return response()->json(null, 404);
    }
    public function update3(Request $request)
    {
        DB::beginTransaction();
        if ($request->txt_id <> '0') {
            editdata::where('id', '=', $request->txt_id)->update([ // Ganti 'id' dengan 'jurusan_id'
            
                // "url" => $request->url,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                
            ]);
        } else {
            
            // $val["url"] = $request->url;
            $val["start_date"] = $request->start_date;
            $val["end_date"] = $request->end_date;
            
            editdata::create($val);
        }
        DB::commit();
        return redirect('/editdata')->with('success', 'tanggal ppdb Berhasil Ditambahkan!');
    }

    public function index1(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        $active = editdata::whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->first();
    
        if ($active) {
            $active->start_date = Carbon::parse($active->start_date);
            $active->end_date = Carbon::parse($active->end_date);
    
            // Periksa apakah pemilihan sudah dimulai dan masih berlangsung
            $currentDateTime = Carbon::now();
            if (!($active->start_date <= $currentDateTime && $active->end_date >= $currentDateTime)) {
                return redirect('/AdminBeranda')->with('error', 'Pengeditan sudah berakhir.');
            }
        } else {
            // Periksa hak akses pengguna setelah memastikan pemilihan tidak ada
            if (auth()->user()->hakakses == 'Admin') {
                return redirect('/AdminBeranda')->with('error', 'Pengeditan belum dimulai.');
            }
        }
        $siswa_id = Auth::id(); // Mendapatkan ID siswa yang sedang login
    
        if ($request->ajax()) {
            $data = tbsiswa::select(
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
            )->with('listakunsiswa', 'kelas')
                ->where('siswa_id', $siswa_id) // Memastikan hanya data siswa yang sedang login yang ditampilkan
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
        return view('editdatasiswa.index');
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            
         

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
            
            
                    $existingSiswa->save();

                    
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
                    
                ];
                
            }

            DB::commit();
            return redirect('/editdatasiswa')->with('success', 'Siswa Berhasil Diperbarui!');
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
               
            ];

            foreach ($response as $field) {
                $response[$field] = $data->$field;
            }
            if ($data->listakunsiswa) {
                $response += [
                    'username' => $data->listakunsiswa->username,
                   
                ];
            } else {
                $response += [
                    'username' => null,
                   
                ];
            }
            return response()->json($response);
        }
        return response()->json(null, 404);
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
    //                 $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->siswa_id . ');" class="btn btn-primary">Edit</button>';
                   
                                    
    //                 $encryptedSiswaId = substr(Crypt::encryptString($data->siswa_id),0, 12);
    //                 $redirectButton = '<a href="' . route('siswaex.index', ['kesuma-goencrypted' => $encryptedSiswaId]) . '" class="btn btn-success">Lihat Detail</a>';
    //                 $redirectButton1 = '<a href="' . route('prestasi.index', $data->siswa_id) . '" class="btn btn-dark">Tambah Prestasi</a>';

    //                 return $button . ' ' . $redirectButton . ' ' . $redirectButton1;
    //             })
    //             ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$siswa_id}}" />')
    //             ->rawColumns(['checkbox', 'action'])
    //             ->make(true);
    //     }
    //     return view('editdatasiswa.index');
    // }


}
