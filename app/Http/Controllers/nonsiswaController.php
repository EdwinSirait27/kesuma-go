<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbsiswa;
use App\Models\ppdb;
use App\Models\User;
use App\Models\listakunsiswa;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class nonsiswaController extends Controller
{
    public function index()
    {
        // Ambil data ppdb dari database
        $ppdb = ppdb::first();

        // Periksa apakah ada data ppdb
        if ($ppdb) {
            // Ambil rentang waktu dari data ppdb
            $start_date = Carbon::parse($ppdb->start_date);
            $end_date = Carbon::parse($ppdb->end_date);

            // Periksa apakah waktu saat ini berada di dalam rentang waktu ppdb
            if (Carbon::now()->between($start_date, $end_date)) {
                // Jika waktu saat ini berada di dalam rentang waktu ppdb, tampilkan halaman daftar.index
                return view('daftar.index');
            } else {
                // Jika waktu saat ini berada di luar rentang waktu ppdb, tampilkan pesan peringatan
                return redirect()->back()->with('warning', 'PPDB masih tertutup.');
            }
        } else {
            // Jika tidak ada data ppdb, tampilkan pesan peringatan
            return redirect()->back()->with('warning', 'Data PPDB tidak tersedia.');
        }
    }


    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validasi request
            $request->validate([
                'foto' => 'image|mimes:jpeg|max:512',
                'username' => 'required|unique:users,username,' . $request->txt_id // Menambahkan pengecualian untuk username yang sedang diupdate
            ], [
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Format file gambar harus jpeg.',
                'foto.max' => 'Ukuran file gambar harus dibawah 512 MB.',
                'username.required' => 'Username harus diisi.',
                'username.unique' => 'Username sudah digunakan, silahkan gunakan yang lain.'
            ]);

            $hakakses = 'NonSiswa';
            if ($request->txt_id !== '0') {
                $existingSiswa = tbsiswa::find($request->txt_id);
                if ($existingSiswa) {
                    $existingSiswa->NamaLengkap = $request->NamaLengkap;
                    $existingSiswa->NISN = $request->NISN;
                    $existingSiswa->NomorInduk = $request->NomorInduk;
                    $existingSiswa->NamaPanggilan = $request->NamaPanggilan;
                    $existingSiswa->JenisKelamin = $request->JenisKelamin;
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
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $file->storeAs('public/fotononsiswa', $fileName);
                        $existingSiswa->foto = $fileName;
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
                        $fileName = time() . '_' . $file->getClientOriginalName();

                        $file->storeAs('public/fotosiswa', $fileName);
                        $newSiswa->foto = $fileName;
                        $newSiswa->save();
                    }
                    function generateUniqueCode() {
        return mt_rand(100000, 999999); // Menghasilkan nomor acak antara 100000 dan 999999
    }

    $worldTimeAPIResponse = file_get_contents('http://worldtimeapi.org/api/ip');
    $worldTimeAPIResult = json_decode($worldTimeAPIResponse);
    $currentDateTime = new \datetime($worldTimeAPIResult->datetime);

    // Mendapatkan tahun dari tanggal saat ini
    $currentYear = $currentDateTime->format('Y');
    $currentYear1 = $currentDateTime->format('Y-M-D');

    // Mendapatkan kode unik
    $uniqueCode = generateUniqueCode(); 

    // Membuat no_pdf
    $noPdf = "kesuma-go-$currentYear-$uniqueCode";

                    $newSiswa->listakunsiswa()->create([
                        "username" => $request->username,
                            "password" => bcrypt($request->password),
                            "hakakses" => $hakakses,
                            "remember_token" => Str::random(60),
                            "created_at" => now(), // Tambahkan created_at jika diperlukan
                            "no_pdf" => $noPdf, // Tambahkan no_pdf di sini
                    ]);
                }
            }
            DB::commit();
            return redirect('/')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $exists = User::where('username', $username)->exists();

        return response()->json(['exists' => $exists]);
    }

    //     public function update(Request $request)
    //     {
    //         DB::beginTransaction();
    //         try {
    //             $request->validate(
    //                 [
    //                     'foto' => 'image|mimes:jpeg|max:512',
    //                     'username' => 'required|unique:users,username,'
    //                 ],
    //                 [
    //                     'foto.image' => 'File harus berupa gambar.',
    //                     'foto.mimes' => 'Format file gambar harus jpeg.',
    //                     'foto.max' => 'Ukuran file gambar harus dibawah 512 MB.',
    //                 ]
    //             );
    //             $hakakses = 'NonSiswa';
    //             if ($request->txt_id !== '0') {
    //                 $existingSiswa = tbsiswa::find($request->txt_id);
    //                 if ($existingSiswa) {
    //                     $existingSiswa->NamaLengkap = $request->NamaLengkap;
    //                     
    //                     if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
    //                         $file = $request->file('foto');
    //                         $fileName = time() . '_' . $file->getClientOriginalName();
    //                         $file->storeAs('public/fotononsiswa', $fileName);
    //                         $existingSiswa->foto = $fileName; 
    //                     }

    //                     $existingSiswa->save();
    //                     if ($existingSiswa->listakunsiswa) {
    //                         $existingSiswa->listakunsiswa->update([
    //                             "username" => $request->username,
    //                             "password" => bcrypt($request->password),
    //                             "hakakses" => $hakakses,
    //                         ]);
    //                     } else {
    //                         if ($request->username && $request->password) {
    //                             $existingSiswa->listakunsiswa()->create([
    //                                 "username" => $request->username,
    //                                 "password" => bcrypt($request->password),
    //                                 "hakakses" => $hakakses,
    //                                 "remember_token" => Str::random(60),
    //                             ]);
    //                         }
    //                     }
    //                 }
    //             } else {
    //                 $val = [
    //                     "NamaLengkap" => $request->NamaLengkap,
    //                     "NomorInduk" => $request->NomorInduk,
    //     "NamaPanggilan" => $request->NamaPanggilan,
    //     "JenisKelamin" => $request->JenisKelamin,
    //     "NISN" => $request->NISN,
    //     "TempatLahir" => $request->TempatLahir,
    //     "TanggalLahir" => $request->TanggalLahir,
    //     "Agama" => $request->Agama,
    //     "Alamat" => $request->Alamat,
    //     "RT" => $request->RT,
    //     "RW" => $request->RW,
    //     "Kelurahan" => $request->Kelurahan,
    //     "Kecamatan" => $request->Kecamatan,
    //     "KabKota" => $request->KabKota,
    //     "Provinsi" => $request->Provinsi,
    //     "KodePos" => $request->KodePos,
    //     "Email" => $request->Email,
    //     "NomorTelephone" => $request->NomorTelephone,
    //     "Kewarganegaraan" => $request->Kewarganegaraan,
    //     "NIK" => $request->NIK,
    //     "GolDarah" => $request->GolDarah,
    //     "TinggalDengan" => $request->TinggalDengan,
    //     "StatusSiswa" => $request->StatusSiswa,
    //     "AnakKe" => $request->AnakKe,
    //     "SaudaraKandung" => $request->SaudaraKandung,
    //     "SaudaraTiri" => $request->SaudaraTiri,
    //     "Tinggicm" => $request->Tinggicm,
    //     "Beratkg" => $request->Beratkg,
    //     "RiwayatPenyakit" => $request->RiwayatPenyakit,
    //     "AsalSMP" => $request->AsalSMP,
    //     "AlamatSMP" => $request->AlamatSMP,
    //     "NPSNSMP" => $request->NPSNSMP,
    //     "KabKotaSMP" => $request->KabKotaSMP,
    //     "ProvinsiSMP" => $request->ProvinsiSMP,
    //     "NoIjasah" => $request->NoIjasah,
    //     "NoSKHUN" => $request->NoSKHUN,
    //     "DiterimaTanggal" => $request->DiterimaTanggal,
    //     "DiterimaDiKelas" => $request->DiterimaDiKelas,
    //     "DiterimaSemester" => $request->DiterimaSemester,
    //     "MutasiAsalSMA" => $request->MutasiAsalSMA,
    //     "AlasanPindah" => $request->AlasanPindah,
    //     "NoPesertaUNSMP" => $request->NoPesertaUNSMP,
    //     "TglIjasah" => $request->TglIjasah,
    //     "NamaOrangTuaPadaIjasah" => $request->NamaOrangTuaPadaIjasah,
    //     "NamaAyah" => $request->NamaAyah,
    //     "TahunLahirAyah" => $request->TahunLahirAyah,
    //     "AlamatAyah" => $request->AlamatAyah,
    //     "NomorTelephoneAyah" => $request->NomorTelephoneAyah,
    //     "AgamaAyah" => $request->AgamaAyah,
    //     "PendidikanTerakhirAyah" => $request->PendidikanTerakhirAyah,
    //     "PekerjaanAyah" => $request->PekerjaanAyah,
    //     "PenghasilanAyah" => $request->PenghasilanAyah,
    //     "NamaIbu" => $request->NamaIbu,
    //     "TahunLahirIbu" => $request->TahunLahirIbu,
    //     "AlamatIbu" => $request->AlamatIbu,
    //     "NomorTelephoneIbu" => $request->NomorTelephoneIbu,
    //     "AgamaIbu" => $request->AgamaIbu,
    //     "PendidikanTerakhirIbu" => $request->PendidikanTerakhirIbu,
    //     "PekerjaanIbu" => $request->PekerjaanIbu,
    //     "PenghasilanIbu" => $request->PenghasilanIbu,
    //     "NamaWali" => $request->NamaWali,
    //     "TahunLahirWali" => $request->TahunLahirWali,
    //     "AlamatWali" => $request->AlamatWali,
    //     "NomorTelephoneWali" => $request->NomorTelephoneWali,
    //     "AgamaWali" => $request->AgamaWali,
    //     "PendidikanTerakhirWali" => $request->PendidikanTerakhirWali,
    //     "PekerjaanWali" => $request->PekerjaanWali,
    //     "WaliPenghasilan" => $request->WaliPenghasilan,
    //     "StatusHubunganWali" => $request->StatusHubunganWali,
    //     "MenerimaBeasiswaDari" => $request->MenerimaBeasiswaDari,
    //     "TahunMeninggalkanSekolah" => $request->TahunMeninggalkanSekolah,
    //     "AlasanSebab" => $request->AlasanSebab,
    //     "TamatBelajarTahun" => $request->TamatBelajarTahun,
    //     "TanggalNomorSTTB" => $request->TanggalNomorSTTB,
    //     "InformasiLain" => $request->InformasiLain,
    //     "cita" => $request->cita,
    //     "status" => $request->status,
    //                 ];
    //                 $newSiswa = tbsiswa::create($val);
    //                 if ($newSiswa) {
    //                     if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
    //                         $file = $request->file('foto');
    //                         $fileName = time() . '_' . $file->getClientOriginalName(); 

    //                         $file->storeAs('public/fotononsiswa', $fileName);
    //                         $newSiswa->foto = $fileName;
    //                         $newSiswa->save();
    //                     }

    // function generateUniqueCode() {
    //     return mt_rand(100000, 999999); // Menghasilkan nomor acak antara 100000 dan 999999
    // }

    // $worldTimeAPIResponse = file_get_contents('http://worldtimeapi.org/api/ip');
    // $worldTimeAPIResult = json_decode($worldTimeAPIResponse);
    // $currentDateTime = new \datetime($worldTimeAPIResult->datetime);

    // // Mendapatkan tahun dari tanggal saat ini
    // $currentYear = $currentDateTime->format('Y');
    // $currentYear1 = $currentDateTime->format('Y-M-D');

    // // Mendapatkan kode unik
    // $uniqueCode = generateUniqueCode(); 

    // // Membuat no_pdf
    // $noPdf = "kesuma-go-$currentYear-$uniqueCode";





    //                     // Membuat entri baru dengan no_pdf yang telah dibuat
    //                     $newSiswa->listakunsiswa()->create([
    //                         "username" => $request->username,
    //                         "password" => bcrypt($request->password),
    //                         "hakakses" => $hakakses,
    //                         "remember_token" => Str::random(60),
    //                         "created_at" => now(), // Tambahkan created_at jika diperlukan
    //                         "no_pdf" => $noPdf, // Tambahkan no_pdf di sini
    //                     ]);

    //                 }
    //             }
    //             DB::commit();
    //             return redirect('/')->with('success', 'Data berhasil disimpan!');

    //         } catch (\Exception $e) {
    //             DB::rollBack();
    //             return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    //         }
    //     }

}
