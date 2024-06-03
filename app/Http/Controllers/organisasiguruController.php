<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\organisasiguru;
use App\Models\SiswaOrganisasiGuru;
use App\Models\tbguru;
use App\Models\organisasi;
use App\Models\tbsiswa;
use App\Models\tahunakademik;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Fpdi;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
class organisasiguruController extends Controller
{
    
    public function index(Request $request)
    {
        $organisasis = organisasi::all();
        $gurus = tbguru::all();
        $siswas = tbsiswa::all();
        $tahunakademiks = tahunakademik::all();
        $hakakses = Auth::user()->hakakses;

        if ($request->ajax()) {
            $data = organisasiguru::with(['organ', 'guru', 'siswa','tahun1','tahun','kurs'])
                ->select(
                    'organisasi_guru_siswa_id',
                    'organisasi_id',
                    'guru_id',
                    'siswa_id',
                    'keterangan',
                    'tahunakademik_id'
                )
                ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) use ($hakakses, $request) {
                    if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
                        $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->organisasi_guru_siswa_id . ');" class="btn btn-primary">Edit</button>';
                    } else {
                        $button = ''; // Tidak menampilkan tombol edit untuk peran siswa, guru, atau kurikulum
                    }
                    $token = Str::random(32);
                    
                    $request->session()->put('listorganisasi_token', $token);
                    $redirectButton = '<a href="' . route('listorganisasi.index', ['organisasi_guru_siswa_id' => $data->organisasi_guru_siswa_id, 'token' => $token]) . '" class="btn btn-success">Lihat Detail</a>';
                    return $button . ' ' . $redirectButton;
                })

                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$organisasi_guru_siswa_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('organisasisiswaall.index', compact('organisasis', 'gurus', 'siswas','tahunakademiks'));
    }
    public function index3(Request $request, $organisasi_guru_siswa_id = null)
    {
        try {
            if (!$organisasi_guru_siswa_id) {
                return redirect('/organisasisiswaall')->with('error', 'Data kelas tidak ditemukan.');
            }
           
            $organisasiguru = organisasiGuru::with(['organ', 'guru'])->findorfail($organisasi_guru_siswa_id);
            if (!$organisasiguru) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
            }
           
            $tahunakademik = $organisasiguru->tahun1->tahunakademik;
            $semester = $organisasiguru->tahun1->semester;
            $namaorgan = $organisasiguru->organ->nama;
            $kapasitas = $organisasiguru->organ->kapasitas;
            $namaGuru = $organisasiguru->guru->Nama;
            $siswas = SiswaOrganisasiGuru::with('siswa')->where('organisasi_guru_siswa_id', $organisasi_guru_siswa_id)->get();
            return view('listorganisasi.index', [
                'organisasi_guru_siswa_id' => $organisasi_guru_siswa_id,
                'namaorgan' => $namaorgan,
                'namaGuru' => $namaGuru,
                'kapasitas' => $kapasitas,
                'tahunakademik' => $tahunakademik,
                'semester' => $semester,
                
                'siswas' => $siswas,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/ekstrakulikuler')->with('error', 'Tangannya nakal ya!');
        } catch (\Exception $e) {
            return redirect('/ekstrakulikuler')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    public function downloadddd($organisasigurusiswaId)
    {
        try {
            $organisasiguru = organisasiguru::with(['organ', 'guru'])->findOrFail($organisasigurusiswaId);
            $namaGuru = $organisasiguru->guru->Nama;
            $namaorgan = $organisasiguru->organ->nama;
            $tahunakademik = $organisasiguru->tahun1->tahunakademik;
            $semester = $organisasiguru->tahun1->semester;
            $siswas = SiswaOrganisasiGuru::with('siswa')->where('organisasi_guru_siswa_id', $organisasigurusiswaId)->get();
            $kopSuratPath = storage_path('app/public/kop/KOP[1].pdf');
            $outputPdfPath = storage_path('app/public/organisasi/Absensi_Kelas' . $namaorgan . '_document.pdf');
            $tempPath = storage_path('app/public/organisasi/temp_kop_surat.pdf');
            copy($kopSuratPath, $tempPath);
            $pdf = new Fpdi();
            $pdf->setSourceFile($tempPath);
            $tplIdx = $pdf->importPage(1);
            $pdf->addPage();
            $pdf->useTemplate($tplIdx, 0, 0);
            $pdf->SetFont('times', 'B', 14);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(20, 65);
            $pdf->Cell(0, 10, 'DAFTAR ABSENSI Organisasi', 0, 1, 'C');
            $pdf->SetFont('times', '', 12);
            $tableDataGuru = [
                ['Tahun Akademik :', $tahunakademik],
                ['Semester :', $semester],
                ['Guru Pembina :', $namaGuru],
                ['Organisasi :', $namaorgan],
            ];
            $tableX = 20;
            $tableY = 80;
            $cellHeight = 10;

            foreach ($tableDataGuru as $row) {
                $pdf->SetXY($tableX, $tableY);
                $pdf->Cell(40, $cellHeight, $row[0], 0);
                $pdf->Cell(0, $cellHeight, $row[1], 0, 1);
                $tableY += $cellHeight;
            }
            $lebarHalaman = $pdf->GetPageWidth();
            $marginTop = 5;
            $pdf->SetY($tableY + $marginTop);
            $pdf->SetFont('times', 'B', 12);
            $lebarNo = 10;
            $lebarNamaSiswa = ($lebarHalaman - $lebarNo - 85) * 0.6;
            $lebarkelas = ($lebarHalaman - $lebarNo - 175) * 0.6;
            $lebarTandaTangan = ($lebarHalaman - $lebarNo - -110) * 0.3;
            $pdf->Cell($lebarNo, $cellHeight, 'No', 1, 0, 'C');
            $pdf->Cell($lebarNamaSiswa, $cellHeight, 'Nama Siswa', 1, 0, 'C');
            $pdf->Cell($lebarkelas, $cellHeight, 'Kelas', 1, 0, 'C');
            $pdf->Cell($lebarTandaTangan, $cellHeight, 'Tanda Tangan', 1, 1, 'C');
            $pdf->SetFont('times', '', 12);
            $nomorUrut = 1;
            foreach ($siswas as $siswa) {
                $pdf->Cell($lebarNo, $cellHeight, $nomorUrut++, 1, 0, 'C');
                $pdf->Cell($lebarNamaSiswa, $cellHeight, $siswa->siswa->NamaLengkap, 1, 0, 'L');
                $pdf->Cell($lebarkelas, $cellHeight, $siswa->siswa->kelas->namakelas,  1, 0, 'C');
                $lebarBagian = $lebarTandaTangan / 20;
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 0, 'C');
                $pdf->Cell($lebarBagian, $cellHeight, '', 'LTRB', 1, 'C');
            }
            $marginLeft = 130;
            $pdf->SetX($pdf->GetX() + $marginLeft);
            $pdf->Cell(0, $cellHeight, 'Mataram, ' . date('d-m-Y'), 0, 1, 'L');
            $marginTop = -5;
            $marginLeft = 136;
            $pdf->SetY($pdf->GetY() + $marginTop);
            $pdf->SetX($pdf->GetX() + $marginLeft);
            $pdf->Cell(0, $cellHeight, 'Guru Pembina', 0, 1, 'L');
            $marginBottom = 15;
            $marginLeft = 130;
            $pdf->SetY($pdf->GetY() + $marginBottom);
            $pdf->SetX($pdf->GetX() + $marginLeft);
            $pdf->Cell(0, $cellHeight, $namaGuru, 0, 1, 'L');
            $pdf->Output($outputPdfPath, 'F');
            unlink($tempPath);
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment;filename="' . basename($outputPdfPath) . '"',
                'Cache-Control' => 'max-age=0',
            ];
            return response()->download($outputPdfPath, basename($outputPdfPath), $headers);
        } catch (\Exception $e) {
            return redirect('/organisasisiswaall')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    
    public function hapus(Request $request)
{
    try {
        // Periksa apakah ada siswa yang dipilih
        if (!$request->has('siswa_ids')) {
            return redirect()->back()->with('warning', 'Tidak ada siswa yang dipilih untuk dihapus.');
        }

        $siswaIds = $request->input('siswa_ids');
        
        // Hapus entri siswa berdasarkan ID yang dipilih
        SiswaOrganisasiGuru::whereIn('siswa_organisasi_guru_id', $siswaIds)->delete();

        return redirect()->back()->with('success', 'Data siswa berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
    }
}
    public function hapusOrganisasiSiswa(Request $request)
    {
        // Mengambil siswa yang sedang login
        $siswa = auth()->user()->siswa;

        // Mendapatkan ID ekstrakurikuler yang dipilih untuk dihapus dari request
        $siswaOrganisasiGuruIds = $request->input('hapusCheckbox');
        if ($siswaOrganisasiGuruIds !== null && count($siswaOrganisasiGuruIds) > 0) {
            // Hitung jumlah ekstrakurikuler yang berhasil dihapus
            $deletedCount = 0;
            foreach ($siswaOrganisasiGuruIds as $organisasiGuruId) {
                // Temukan data ekstrakurikuler yang akan dihapus
                $organisasiGuru = $siswa->organisasigurus()->where('siswa_organisasi_guru_id', $organisasiGuruId)->first();

                if ($organisasiGuru) {
                    // Hapus ekstrakurikuler jika ditemukan
                    $organisasiGuru->delete();
                    $deletedCount++; // Tambahkan hitungan untuk setiap penghapusan yang berhasil
                }
            }

            if ($deletedCount > 0) {
                return redirect()->back()->with('success', 'Organisasi yang dipilih berhasil dihapus.');
            } else {
                return redirect()->back()->with('error', 'Tidak ada Organisasi yang dipilih untuk dihapus.');
            }
        } else {
            // Jika tidak ada ekstrakurikuler yang dipilih untuk dihapus
            return redirect()->back()->with('error', 'Tidak ada Organisasi yang dipilih untuk dihapus.');
        }
    }





   


    public function edit($id)
    {
        $data = organisasiguru::find($id);

        if ($data) {
            $organisasi_id = $data->organisasi_id;
            $guru_id = $data->guru_id;
            $siswa_id = $data->siswa_id;
            $keterangan = $data->keterangan;
            $tahunakademik_id = $data->tahunakademik_id;



            return response()->json([
                "organisasi_id" => $organisasi_id,
                "guru_id" => $guru_id,
                "siswa_id" => $siswa_id,
                "keterangan" => $keterangan,
                "tahunakademik_id" => $tahunakademik_id


            ]);
        }

        return response()->json(null, 404);
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'organisasi_id' => 'required',
                'guru_id' => 'required',
                'siswa_id' => 'required',
                'tahunakademik_id' => 'required',
            ]);

            // Cek apakah ada entri dengan kombinasi organisasi_id, guru_id, dan siswa_id yang sama
            $existingEntry = organisasiguru::where('organisasi_id', $request->organisasi_id)
                ->where('guru_id', $request->guru_id)
                ->where('siswa_id', $request->siswa_id)
                ->first();

            if ($existingEntry && $existingEntry->organisasi_guru_siswa_id != $request->txt_id) {
                return redirect('/organisasisiswaall')->with('error', 'Duplikat entri: kombinasi Organisasi, Guru, dan Siswa sudah ada dalam database.');
            }

            // Cek apakah organisasi_id sudah ada dalam tabel organisasiguru
            $duplicateOrganisasi = organisasiguru::where('organisasi_id', $request->organisasi_id)->first();

            $duplicateGuru = organisasiguru::where('guru_id', $request->guru_id)->first();

            if ($duplicateOrganisasi && $duplicateOrganisasi->organisasi_guru_siswa_id != $request->txt_id) {
                return redirect('/organisasisiswaall')->with('error', 'Organisasi sudah memiliki entri lain dalam database.');
            }
            if ($duplicateGuru && $duplicateGuru->organisasi_guru_siswa_id != $request->txt_id) {
                return redirect('/organisasisiswaall')->with('error', 'Guru sudah memiliki entri lain dalam database.');
            }

            if ($request->txt_id != '0') {
                organisasiguru::where('organisasi_guru_siswa_id', $request->txt_id)->update([
                    "organisasi_id" => $request->organisasi_id,
                    "guru_id" => $request->guru_id,
                    "siswa_id" => $request->siswa_id,
                    "keterangan" => $request->keterangan,
                    "tahunakademik_id" => $request->tahunakademik_id,
                ]);
            } else {
                $val["organisasi_id"] = $request->organisasi_id;
                $val["guru_id"] = $request->guru_id;
                $val["siswa_id"] = $request->siswa_id;
                $val["keterangan"] = $request->keterangan;
                $val["tahunakademik_id"] = $request->tahunakademik_id;
                organisasiguru::create($val);
            }
            DB::commit();
            return redirect('/organisasisiswaall')->with('success', 'Data organisasi berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/organisasisiswaall')->with('error', 'Terjadi kesalahan. Data ekstrakurikuler tidak berhasil diperbarui. Pesan Kesalahan: ' . $e->getMessage());
        }
    }





    // public function update(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $request->validate([
    //             'organisasi_id' => 'required',
    //             'guru_id' => 'required',
    //             'siswa_id' => 'required',
    //         ]);

    //         // Cek apakah ada entri dengan kombinasi organisasi_id dan guru_id yang sama
    //         $existingEntry = organisasiguru::where('organisasi_id', $request->organisasi_id)
    //                                         ->where('guru_id', $request->guru_id)
    //                                         ->first();

    //         if ($existingEntry && $existingEntry->organisasi_guru_siswa_id != $request->txt_id) {
    //             return redirect('/organisasisiswaall')->with('error', 'Guru dan Organisasi sudah terdaftar sebelumnya.');
    //         }

    //         // Cek apakah ada entri dengan organisasi_id yang sama
    //         $duplicateOrganisation = organisasiguru::where('organisasi_id', $request->organisasi_id)->first();

    //         if ($duplicateOrganisation && $duplicateOrganisation->organisasi_guru_siswa_id != $request->txt_id) {
    //             return redirect('/organisasisiswaall')->with('error', 'Organisasi sudah memiliki entri lain dalam database.');
    //         }

    //         if ($request->txt_id != '0') {
    //             organisasiguru::where('organisasi_guru_siswa_id', $request->txt_id)->update([
    //                 "organisasi_id" => $request->organisasi_id,
    //                 "guru_id" => $request->guru_id,
    //                 "siswa_id" => $request->siswa_id,
    //                 "keterangan" => $request->keterangan,
    //             ]);
    //         } else {
    //             $val["organisasi_id"] = $request->organisasi_id;
    //             $val["guru_id"] = $request->guru_id;
    //             $val["siswa_id"] = $request->siswa_id;
    //             $val["keterangan"] = $request->keterangan;
    //             organisasiguru::create($val);
    //         }
    //         DB::commit();
    //         return redirect('/organisasisiswaall')->with('success', 'Data organisasi berhasil diperbarui!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect('/organisasisiswaall')->with('error', 'Terjadi kesalahan. Data ekstrakurikuler tidak berhasil diperbarui. Pesan Kesalahan: ' . $e->getMessage());
    //     }
    // }


    // public function update(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $request->validate([
    //             'organisasi_id' => 'required',
    //             'guru_id' => 'required',
    //             'siswa_id' => 'required',
    //         ]);
    //         if ($request->txt_id != '0') {
    //             organisasiguru::where('organisasi_guru_siswa_id', $request->txt_id)->update([
    //                 "organisasi_id" => $request->organisasi_id,
    //                 "guru_id" => $request->guru_id,
    //                 "siswa_id" => $request->siswa_id,
    //                 "keterangan" => $request->keterangan,
    //             ]);
    //         } else {
    //             $val["organisasi_id"] = $request->organisasi_id;
    //             $val["guru_id"] = $request->guru_id;
    //             $val["siswa_id"] = $request->siswa_id;
    //             $val["keterangan"] = $request->keterangan;
    //             organisasiguru::create($val);
    //         }
    //         DB::commit();
    //         return redirect('/organisasisiswaall')->with('success', 'Data organisasi berhasil diperbarui!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect('/organisasisiswaall')->with('error', 'Terjadi organisasi. Data ekstrakulikuler tidak berhasil diperbarui. Pesan Kesalahan: ' . $e->getMessage());
    //     }
    // }



    function removeall(Request $request)
    {
        $organisasi_guru_siswa_id_array = $request->input('organisasi_guru_siswa_id');
        $data = organisasiguru::whereIn('organisasi_guru_siswa_id', $organisasi_guru_siswa_id_array);
        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }

    // public function hapusEkstraGuruIdDariSiswaId($siswaId, $ekstraGuruId)
    // {
    //     try {
    //         // Mendapatkan data siswa berdasarkan ID
    //         $siswa = tbsiswa::findOrFail($siswaId);

    //         // Mengecek apakah siswa memiliki ekstra_guru_id yang akan dihapus
    //         if ($siswa->ekstra_guru_id != $ekstraGuruId) {
    //             return redirect()->back()->with('error', 'Siswa tidak terdaftar pada ekstra guru dengan ID tersebut.');
    //         }

    //         // Mencari ekstraguru berdasarkan ID
    //         $ekstraGuru = EkstraGuru::findOrFail($ekstraGuruId);

    //         // Menghapus relasi ekstra_guru_id dari siswa
    //         $siswa->ekstraguru()->detach($ekstraGuruId);

    //         return redirect()->back()->with('success', 'Ekstra guru telah dihapus dari siswa.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
    //     }
    // }

}
