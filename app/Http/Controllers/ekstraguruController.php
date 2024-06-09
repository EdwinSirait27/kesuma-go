<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ekstraguru;
use App\Models\SiswaEkstraGuru;
use App\Models\tbguru;
use App\Models\ekstra;

use setasign\Fpdi\Fpdi;
use App\Models\tbsiswa;
use App\Models\tahunakademik;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class ekstraguruController extends Controller
{


    public function index2(Request $request, $ekstra_guru_id = null)
    {
        try {
            if (!$ekstra_guru_id) {
                return redirect('/ekstrakulikuler')->with('error', 'Data kelas tidak ditemukan.');
            }
           
            $ekstraguru = EkstraGuru::with(['ekskul', 'guru'])->findorfail($ekstra_guru_id);
            if (!$ekstraguru) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
            }
            $tahunakademik = $ekstraguru->tahun1->tahunakademik;
            $semester = $ekstraguru->tahun1->semester;
            $namaekskul = $ekstraguru->ekskul->namaekskul;
            $namaGuru = $ekstraguru->guru->Nama;
            $siswas = SiswaEkstraGuru::with('siswa')->where('ekstra_guru_id', $ekstra_guru_id)->get();
            return view('listekstra.index', [
                'ekstra_guru_id' => $ekstra_guru_id,
                'namaekskul' => $namaekskul,
                'tahunakademik' => $tahunakademik,
                'semester' => $semester,
                'namaGuru' => $namaGuru,
                'siswas' => $siswas,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/ekstrakulikuler')->with('error', 'Tangannya nakal ya!');
        } catch (\Exception $e) {
            return redirect('/ekstrakulikuler')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }

    public function downloadd($ekstraguruId)
    {
        try {
            $ekstraguru = ekstraguru::with(['ekskul', 'guru'])->findOrFail($ekstraguruId);
            $namaGuru = $ekstraguru->guru->Nama;
            $namaekskul = $ekstraguru->ekskul->namaekskul;
            $tahunakademik = $ekstraguru->tahun1->tahunakademik;
            $semester = $ekstraguru->tahun1->semester;
            $siswas = SiswaEkstraGuru::with('siswa')->where('ekstra_guru_id', $ekstraguruId)->get();
            $kopSuratPath = storage_path('app/public/kop/KOP[1].pdf');
            $outputPdfPath = storage_path('app/public/ekstra/Absensi_Ekstrakurikuler_' . $namaekskul . '_document.pdf');
            $tempPath = storage_path('app/public/ekstra/temp_kop_surat.pdf');
            copy($kopSuratPath, $tempPath);
            $pdf = new Fpdi();
            $pdf->setSourceFile($tempPath);
            $tplIdx = $pdf->importPage(1);
            $pdf->addPage();
            $pdf->useTemplate($tplIdx, 0, 0);
            $pdf->SetFont('times', 'B', 14);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(20, 65);
            $pdf->Cell(0, 10, 'DATA ABSENSI EKSTRAKURIKULER', 0, 1, 'C');
            $pdf->SetFont('times', '', 12);
            $tableDataGuru = [
                ['Tahun Akademik :', $tahunakademik],
                ['Semester :', $semester],
                ['Guru Pembina :', $namaGuru],
                ['Ekstrakurikuler :', $namaekskul],
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
            // snhi
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
                $pdf->Cell($lebarNamaSiswa, $cellHeight, $siswa->siswa->NamaLengkap,  1, 0, 'C');
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
            return redirect('/ekstrakulikuler')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }


    public function index(Request $request)
    {
        $ekskuls = ekstra::all();
        $gurus = tbguru::all();
        // $ = tahunakademik::all();
        $tahunakademik = tahunakademik::where('statusaktif', 'Aktif')->get();
        $hakakses = Auth::user()->hakakses;

        if ($request->ajax()) {
            $data = ekstraguru::with(['ekskul', 'guru', 'tahun', 'tahun1'])
                ->select(
                    'ekstra_guru_id',
                    'ekskul_id',
                    'guru_id',
                    'keterangan',
                    'tahunakademik_id'
                )
                ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) use ($hakakses, $request) {
                    if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
                        $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->ekstra_guru_id . ');" class="btn btn-primary">Edit</button>';
                    } else {
                        $button = ''; // Tidak menampilkan tombol edit untuk peran siswa, guru, atau kurikulum
                    }
                        
                    $token = Str::random(32);
                    
                    $request->session()->put('listkekstra_token', $token);
                    $redirectButton = '<a href="' . route('listekstra.index', ['ekstra_guru_id' => $data->ekstra_guru_id, 'token' => $token]) . '" class="btn btn-success">Lihat Detail</a>';
                    return $button . ' ' . $redirectButton;
                })

                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$ekstra_guru_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);

        }

        return view('ekstrakulikuler.index', compact('ekskuls', 'gurus', 'tahunakademik'));
    }

    public function edit($id)
    {
        $data = ekstraguru::find($id);

        if ($data) {
            $ekskul_id = $data->ekskul_id;
            $guru_id = $data->guru_id;
            $keterangan = $data->keterangan;
            $tahunakademik_id = $data->tahunakademik_id;



            return response()->json([
                "ekskul_id" => $ekskul_id,
                "guru_id" => $guru_id,
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
                'ekskul_id' => 'required',
                'guru_id' => 'required',
                'tahunakademik_id' => 'required',

            ]);
            $existingEntry = ekstraguru::where('ekskul_id', $request->ekskul_id)
                ->where('guru_id', $request->guru_id)

                ->first();
            if ($existingEntry && $existingEntry->ekstra_guru_id != $request->txt_id) {
                return redirect('/ekstrakulikuler')->with('error', 'Duplikat entri: kombinasi Ekstrakulikuler dan Guru sudah ada dalam database.');
            }

            // Cek apakah organisasi_id sudah ada dalam tabel organisasiguru
            $duplicateEkskul = ekstraguru::where('ekskul_id', $request->ekskul_id)->first();

            $duplicateGuru = ekstraguru::where('guru_id', $request->guru_id)->first();

            if ($duplicateEkskul && $duplicateGuru->ekstra_guru_id != $request->txt_id) {
                return redirect('/ekstrakulikuler')->with('error', 'Ekstrakulikuler sudah memiliki entri lain dalam database.');
            }
            if ($duplicateGuru && $duplicateGuru->ekstra_guru_id != $request->txt_id) {
                return redirect('/ekstrakulikuler')->with('error', 'Guru sudah memiliki entri lain dalam database.');
            }
            if ($request->txt_id != '0') {
                ekstraguru::where('ekstra_guru_id', $request->txt_id)->update([
                    "ekskul_id" => $request->ekskul_id,
                    "guru_id" => $request->guru_id,
                    "keterangan" => $request->keterangan,
                    "tahunakademik_id" => $request->tahunakademik_id,
                ]);
            } else {
                $val["ekskul_id"] = $request->ekskul_id;
                $val["guru_id"] = $request->guru_id;
                $val["keterangan"] = $request->keterangan;
                $val["tahunakademik_id"] = $request->tahunakademik_id;
                ekstraguru::create($val);
            }
            DB::commit();
            return redirect('/ekstrakulikuler')->with('success', 'Data ekstrakulikuler berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/ekstrakulikuler')->with('error', 'Terjadi kesalahan. Data ekstrakulikuler tidak berhasil diperbarui. Pesan Kesalahan: ' . $e->getMessage());
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
            SiswaEkstraGuru::whereIn('siswa_ekstra_guru_id', $siswaIds)->delete();

            return redirect()->back()->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }

    function removeall(Request $request)
    {
        $ekstra_guru_id_array = $request->input('ekstra_guru_id');
        $data = ekstraguru::whereIn('ekstra_guru_id', $ekstra_guru_id_array);
        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }

    public function hapusEkstraGuruIdDariSiswaId($siswaId, $ekstraGuruId)
    {
        try {
            // Mendapatkan data siswa berdasarkan ID
            $siswa = tbsiswa::findOrFail($siswaId);

            // Mengecek apakah siswa memiliki ekstra_guru_id yang akan dihapus
            if ($siswa->ekstra_guru_id != $ekstraGuruId) {
                return redirect()->back()->with('error', 'Siswa tidak terdaftar pada ekstra guru dengan ID tersebut.');
            }

            // Mencari ekstraguru berdasarkan ID
            $ekstraGuru = EkstraGuru::findOrFail($ekstraGuruId);

            // Menghapus relasi ekstra_guru_id dari siswa
            $siswa->ekstraguru()->detach($ekstraGuruId);

            return redirect()->back()->with('success', 'Ekstra guru telah dihapus dari siswa.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }

}