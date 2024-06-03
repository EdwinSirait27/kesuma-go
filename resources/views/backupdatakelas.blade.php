<?php

namespace App\Http\Controllers;

use App\Models\tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\datakelas;
use App\Models\kelas;
use App\Models\tbsiswa;
use setasign\Fpdi\Fpdi;
use App\Models\tbguru;
use App\Models\DatakelasDatamengajar;
use App\Models\datamengajar;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
class datakelasController extends Controller
{
    
 
    public function index1(Request $request)
    {
        try {
            $siswaId = Auth::user()->siswa_id;
            $kelasIdSiswa = Tbsiswa::where('siswa_id', $siswaId)->value('kelas_id');
            $datakelas = Datakelas::where('kelas_id', $kelasIdSiswa)->first();
    if ($datakelas) {
                $datakelas->load('kelas', 'guru');
                $namakelas = $datakelas->kelas->namakelas;
                $kapasitas = $datakelas->kelas->kapasitas;
                $namaGuru = $datakelas->guru->Nama;
                $tahunakademik = $datakelas->tahun->tahunakademik;
                $semester = $datakelas->tahun->semester;
                $siswaIds = Tbsiswa::where('kelas_id', $kelasIdSiswa)->pluck('siswa_id')->toArray();
    return view('listsiswa.index', [
                    'kelasId' => $datakelas->kelas_id,
                    'siswaIds' => $siswaIds,
                    'namakelas' => $namakelas,
                    'namaGuru' => $namaGuru,
                    'kapasitas' => $kapasitas,
                    'datakelas' => $datakelas,
                    'tahunakademik' => $tahunakademik,
                    'semester' => $semester
                ]);
            } else {
                return redirect('/SiswaBeranda')->with('error', 'Siswa belum masuk kelazzz.');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/SiswaBeranda')->with('error', 'Data kelas tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect('/SiswaBeranda')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }



    
    
    public function indexall(Request $request)
    {
        try {

            $datakelasId = $request->query('datakelas_id');
            $datakelas = Datakelas::where('datakelas_id', $datakelasId)->firstOrFail();
            
            $datakelas->load('kelas', 'guru');
            $namakelas = $datakelas->kelas->namakelas;
            $kapasitas = $datakelas->kelas->kapasitas;
            $namaGuru = $datakelas->guru->Nama;
            $tahunakademik = $datakelas->tahun->tahunakademik;
            $semester = $datakelas->tahun->semester;
            $siswaIds = tbsiswa::where('kelas_id', $datakelas->kelas->kelas_id)->pluck('siswa_id')->toArray();
            return view('listkelas.index', [
                'datakelasId' => $datakelasId,
                'siswaIds' => $siswaIds,
                'namakelas' => $namakelas,
                'namaGuru' => $namaGuru,
                'kapasitas' => $kapasitas,
                'datakelas' => $datakelas,
                'tahunakademik' => $tahunakademik,
                'semester' => $semester
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/datakelass')->with('error', 'Data kelas tidak ditemukan untuk kelas_id: ' . $datakelasId);
        } catch (\Exception $e) {
            return redirect('/datakelass')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    // public function index1(Request $request)
    // {
    //     try {

    //         $datakelasId = $request->query('datakelas_id');
    //         $datakelas = Datakelas::findOrFail($datakelasId);
    //         $datakelas->load('kelas', 'guru');
    //         $namakelas = $datakelas->kelas->namakelas;
    //         $kapasitas = $datakelas->kelas->kapasitas;
    //         $namaGuru = $datakelas->guru->Nama;
    //         $tahunakademik = $datakelas->tahun->tahunakademik;
    //         $semester = $datakelas->tahun->semester;
    //         $siswaIds = tbsiswa::where('kelas_id', $datakelas->kelas->kelas_id)->pluck('siswa_id')->toArray();
    //         return view('listsiswa.index', [
    //             'datakelasId' => $datakelasId,
    //             'siswaIds' => $siswaIds,
    //             'namakelas' => $namakelas,
    //             'namaGuru' => $namaGuru,
    //             'kapasitas' => $kapasitas,
    //             'datakelas' => $datakelas,
    //             'tahunakademik' => $tahunakademik,
    //             'semester' => $semester
    //         ]);
    //     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //         return redirect('/datakelas')->with('error', 'Data kelas tidak ditemukan untuk datakelas_id: ' . $datakelasId);
    //     } catch (\Exception $e) {
    //         return redirect('/datakelas')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
    //     }
    // }


    public function indexguru(Request $request)
    {
        try {
            $guruId = Auth::user()->guru_id;
            $datakelas = Datakelas::where('guru_id', $guruId)->first();
            if ($datakelas) {
                $datakelas->load('kelas', 'guru');
                $namakelas = $datakelas->kelas->namakelas;
                $kapasitas = $datakelas->kelas->kapasitas;
                $namaGuru = $datakelas->guru->Nama;
                $tahunakademik = $datakelas->tahun->tahunakademik;
                $semester = $datakelas->tahun->semester;
                $siswaIds = Tbsiswa::where('kelas_id', $datakelas->kelas->kelas_id)->pluck('siswa_id')->toArray();
                return view('listkelass.index', [
                    'kelasId' => $datakelas->kelas_id,
                    'siswaIds' => $siswaIds,
                    'namakelas' => $namakelas,
                    'namaGuru' => $namaGuru,
                    'kapasitas' => $kapasitas,
                    'datakelas' => $datakelas,
                    'tahunakademik' => $tahunakademik,
                    'semester' => $semester
                ]);
            } else {
                return redirect('/datakelas')->with('warning', 'Diarahkan ke Datakelas Karena Anda bukan Wali Kelas.');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/datakelas')->with('error', 'Data kelas tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect('/datakelas')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }

  
    
   

    public function index2(Request $request)
    {
        try {
            $kelasId = $request->query('kelas_id');
            $datakelas = Datakelas::where('kelas_id', $kelasId)->first();
    
            if (!$datakelas) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
            }        
            $datamengajars = $datakelas->datamengajars; // Mengambil seluruh datamengajars terkait
            return view('jadwal.index', [
                'kelasId' => $kelasId, 
                'datakelas' => $datakelas, 
                'datamengajars' => $datamengajars
            ]); 
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/datakelas')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect('/datakelas')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    // public function index2(Request $request)
    // {
    //     try {
    //         $datakelasId = $request->query('datakelas_id');
    //         $datakelas = Datakelas::where('datakelas_id', $datakelasId)->first();
    
    //         if (!$datakelas) {
    //             throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
    //         }        
    //         $datamengajars = $datakelas->datamengajars; // Mengambil seluruh datamengajars terkait
    //         return view('jadwal.index', [
    //             'datakelasId' => $datakelasId, 
    //             'datakelas' => $datakelas, 
    //             'datamengajars' => $datamengajars
    //         ]);
    //     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //         return redirect('/datakelas')->with('success', 'Data berhasil disimpan.');
    //     } catch (\Exception $e) {
    //         return redirect('/datakelas')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
    //     }
    // }
    public function hapus(Request $request)
{
    // Mengecek apakah ada item yang dipilih
    if (empty($request->selected)) {
        // Mengembalikan pengguna ke halaman /datakelas dengan pesan peringatan
        return redirect('/datakelass')->with('warning', 'Tidak ada yang tercentang.');
    }

    try {
        // Menghapus data dari tabel DatakelasDatamengajar
        DatakelasDatamengajar::whereIn('datamengajar_id', $request->selected)->delete();
        
        // Mengatur datakelas_id menjadi null pada tabel Datamengajar
        Datamengajar::whereIn('datamengajar_id', $request->selected)->update(['datakelas_id' => null]);
        
        // Mengembalikan pengguna ke halaman /datakelas dengan pesan sukses
        return redirect('/datakelas')->with('success', 'Data berhasil dihapus.');
    } catch (\Exception $e) {
        // Mengembalikan pengguna ke halaman /datakelas dengan pesan kesalahan
        return redirect('/datakelas')->with('success', 'Data berhasil dihapus.');
    }
}

    public function create(Request $request)
    {
        try {
            // Mengecek nilai datakelas_id yang diberikan
            $datakelasId = intval($request->input('datakelas_id'));
    
            // Melakukan pencarian Datakelas berdasarkan datakelas_id
            $datakelas = Datakelas::where('datakelas_id', $datakelasId)->first();
    
            // Memeriksa apakah Datakelas ditemukan
            if (!$datakelas) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
            }
            
            // Melakukan operasi lainnya
            $datamengajars = Datamengajar::all();
            
            // Mengembalikan view dengan siswa_ids, namakelas, dan namaGuru
            return view('jadwal.create', [
                'datakelasId' => $datakelasId,
                'datakelas' => $datakelas,
                'datamengajars' => $datamengajars
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Menangani jika Datakelas tidak ditemukan
            return Redirect::route('jadwal.create')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Menangani kesalahan umum
            return redirect('/datakelass')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    

   
    public function store(Request $request)
    {
        try {
            // Mencari Datakelas berdasarkan datakelas_id yang valid
            $datakelasId = Datakelas::find($request->input('datakelas_id'));
    
            if (!$datakelasId) {
                // Jika Datakelas tidak ditemukan, kembalikan pesan kesalahan
                return Redirect::back()->with('error', 'Datakelas tidak ditemukan.');
            }
    
            $datamengajarIds = $request->input('datamengajar_id');
    
            // Pengecekan jika tidak ada mata pelajaran yang dipilih
            if (!$datamengajarIds || !is_array($datamengajarIds) || count($datamengajarIds) == 0) {
                return Redirect::back()->with('error', 'Tidak ada mata pelajaran yang dipilih.');
            }
    
            DB::beginTransaction();
    
            try {
                foreach ($datamengajarIds as $datamengajarId) {
                    $datakelasDatamengajar = new DatakelasDatamengajar();
                    $datakelasDatamengajar->datakelas_id = $datakelasId->datakelas_id;
                    $datakelasDatamengajar->datamengajar_id = $datamengajarId;
                    $datakelasDatamengajar->save();
                }
    
                DB::commit();
    
                return Redirect::route('jadwal.store')->with('success', 'Data berhasil disimpan.');
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
        

   
    
    public function download($kelasId)
    {
        try {
            $datakelas = Datakelas::findOrFail($kelasId);
            $namakelas = $datakelas->kelas->namakelas;
            $namaGuru = $datakelas->guru->Nama;
            $tahunakademik = $datakelas->tahun->tahunakademik;
            $semester = $datakelas->tahun->semester;
            
            // Mendapatkan ID siswa untuk kelas tertentu
            $siswaIds = tbsiswa::where('kelas_id', $datakelas->kelas->kelas_id)->pluck('siswa_id')->toArray();
            
            $kopSuratPath = public_path('kop/KOP[1].pdf');
            $outputPdfPath = storage_path('app/Absensi_Kelas' . $namakelas . '_document.pdf');
            $tempPath = storage_path('app/temp_kop_surat.pdf');
            copy($kopSuratPath, $tempPath);
            $pdf = new Fpdi();
            $pdf->setSourceFile($tempPath);
            $tplIdx = $pdf->importPage(1);
            $pdf->addPage();
            $pdf->useTemplate($tplIdx, 0, 0);
            $pdf->SetFont('times', 'B', 14);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(20, 65);
            $pdf->Cell(0, 10, 'DAFTAR ABSENSI SISWA', 0, 1, 'C');
            $pdf->SetFont('times', '', 12);
            $tableDataGuru = [
                ['Tahun Akademik :', $tahunakademik],
                ['Semester :', $semester],
                ['Wali Kelas :', $namaGuru],
                ['Kelas :', $namakelas],
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
            $lebarNamaSiswa = ($lebarHalaman - $lebarNo - 60) * 0.6;
            $lebarTandaTangan = ($lebarHalaman - $lebarNo - 60) * 0.3;
            $lebarIzin = 15;
            $lebarSakit = 15;
            $lebarAlpa = 15;
            $pdf->Cell($lebarNo, $cellHeight, 'No', 1, 0, 'C');
            $pdf->Cell($lebarNamaSiswa, $cellHeight, 'Nama Siswa', 1, 0, 'C');
            $pdf->Cell($lebarTandaTangan, $cellHeight, 'Tanda Tangan', 1, 0, 'C');
            $pdf->Cell($lebarIzin, $cellHeight, 'I', 1, 0, 'C');
            $pdf->Cell($lebarSakit, $cellHeight, 'S', 1, 0, 'C');
            $pdf->Cell($lebarAlpa, $cellHeight, 'A', 1, 1, 'C');
            $pdf->SetFont('times', '', 12);
            $nomorUrut = 1;
            foreach ($siswaIds as $siswaId) {
                $siswa = tbsiswa::where('siswa_id', $siswaId)->first();
                $pdf->Cell($lebarNo, $cellHeight, $nomorUrut++, 1, 0, 'C');
                $pdf->Cell($lebarNamaSiswa, $cellHeight, $siswa ? $siswa->NamaLengkap : 'Nama tidak ditemukan', 1, 0, 'L');
                $pdf->Cell($lebarTandaTangan, $cellHeight, '', 1, 0, 'C');
                $pdf->Cell($lebarIzin, $cellHeight, '', 1, 0, 'C');
                $pdf->Cell($lebarSakit, $cellHeight, '', 1, 0, 'C');
                $pdf->Cell($lebarAlpa, $cellHeight, '', 1, 1, 'C');
            }
            $marginLeft = 130;
            $pdf->SetX($pdf->GetX() + $marginLeft);
            $pdf->Cell(0, $cellHeight, 'Mataram, ' . date('d-m-Y'), 0, 1, 'L');
            $marginTop = -5;
            $marginLeft = 140;
            $pdf->SetY($pdf->GetY() + $marginTop);
            $pdf->SetX($pdf->GetX() + $marginLeft);
            $pdf->Cell(0, $cellHeight, 'Wali Kelas', 0, 1, 'L');
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
            return redirect('/listkelas')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    // public function indexx(Request $request)
    // {
    //     $hakakses = Auth::user()->hakakses;
    //     $kelass = kelas::all();
    //     $gurus = tbguru::all();
    //     $tahuns = tahunakademik::all();
    //     $kelas_id = $request->get('kelas_id');
    //     $siswas = tbsiswa::with('kelas')->get();
    //     $datakelas = null;
    //     $datakelass = datakelas::all();
    //     $kapasitas_kelas = kelas::first()->kapasitas;
    //     if ($request->ajax()) {
    //         $data = datakelas::with(['kelas' => function ($query) {
    //             $query->select('kelas_id','namakelas','kapasitas');
    //         }, 'guru', 'siswa', 'tahun'])
    //             ->select(
    //                 'datakelas_id',
    //                 'kelas_id',
    //                 'guru_id',
    //                 'keterangan',
    //                 'tahunakademik_id'
    //             )
    //             ->get();
    //             foreach ($data as $item) {
    //                 $item->jumlah_siswa = tbsiswa::where('kelas_id', $item->kelas_id)->count();
    //             }

    //         return Datatables::of($data)->addIndexColumn()
    //             ->addColumn('action', function ($data) use ($kelas_id, $hakakses) {
    //                 if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
    //                     $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->datakelas_id . ', ' . $kelas_id . ');" class="btn btn-primary">Edit</button>';
    //                 } else {
    //                     $button = ''; // Tidak menampilkan tombol edit untuk peran siswa, guru, atau kurikulum
    //                 }
    //                 if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
    //                     $redirectButton = '<a href="' . route('listkelas.index', ['kelas_id' => $data->kelas_id]) . '" class="btn btn-success">Lihat Detail</a>';
    //                 } else {
    //                     $redirectButton = ''; // Tidak menampilkan tombol edit untuk peran siswa, guru, atau kurikulum
    //                 }
    //                 if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
    //                     $redirectButton2 = '<a href="' . route('jadwal.index', ['kelas_id' => $data->kelas_id]) . '" class="btn btn-dark">Jadwal</a>';
    //                 } else {
    //                     $redirectButton2 = ''; // Tidak menampilkan tombol edit untuk peran siswa, guru, atau kurikulum
    //                 }
    //                 if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
    //                 $redirectButton3 = '<a href="' . route('jadwal.create', ['datakelas_id' => $data->datakelas_id]) . '" class="btn btn-info">Tambah Jadwal</a>';
    //             } else {
    //                 $redirectButton3 = ''; 
    //             }
    //                 return $button . ' ' . $redirectButton . ' ' . $redirectButton2 . ' ' . $redirectButton3;
    //             })
    //             ->addColumn('checkbox', function ($data) {
    //                 return '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="' . $data->datakelas_id . '" />';
    //             })

               

    //             ->rawColumns(['checkbox', 'action'])
    //             ->make(true);
    //     }

    //     return view('datakelass.index', compact('kelass', 'siswas', 'gurus', 'kelas_id', 'datakelas','datakelass', 'kapasitas_kelas','tahuns'));
    // }
    public function index(Request $request)
    {
        $hakakses = Auth::user()->hakakses;
        $kelass = kelas::all();
        $gurus = tbguru::all();
        $tahuns = tahunakademik::all();
        $kelas_id = $request->get('kelas_id');
        $siswas = tbsiswa::with('kelas')->get();
        $datakelas = null;
        $datakelass = datakelas::all();
        $kapasitas_kelas = kelas::first()->kapasitas;
        if ($request->ajax()) {
            $data = datakelas::with(['kelas' => function ($query) {
                $query->select('kelas_id','namakelas','kapasitas');
            }, 'guru', 'siswa', 'tahun'])
                ->select(
                    'datakelas_id',
                    'kelas_id',
                    'guru_id',
                    'keterangan',
                    'tahunakademik_id'
                )
                ->get();
                foreach ($data as $item) {
                    $item->jumlah_siswa = tbsiswa::where('kelas_id', $item->kelas_id)->count();
                }

            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) use ($kelas_id, $hakakses) {
                    if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
                        $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->datakelas_id . ', ' . $kelas_id . ');" class="btn btn-primary">Edit</button>';
                    } else {
                        $button = ''; // Tidak menampilkan tombol edit untuk peran siswa, guru, atau kurikulum
                    }
                    if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
                        $redirectButton = '<a href="' . route('listkelas.index', ['kelas_id' => $data->kelas_id]) . '" class="btn btn-success">Lihat Detail</a>';
                    } else {
                        $redirectButton = ''; // Tidak menampilkan tombol edit untuk peran siswa, guru, atau kurikulum
                    }
                    if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
                        $redirectButton2 = '<a href="' . route('jadwal.index', ['kelas_id' => $data->kelas_id]) . '" class="btn btn-dark">Jadwal</a>';
                    } else {
                        $redirectButton2 = ''; // Tidak menampilkan tombol edit untuk peran siswa, guru, atau kurikulum
                    }
                    $siswa_id = Auth::user()->siswa_id;

                    if ($siswa_id) {
                        $siswa = tbsiswa::find($siswa_id);
                        if ($siswa && $siswa->kelas_id == $data->kelas_id) {
                            $redirectButton2 = '<a href="' . route('jadwal.index', ['kelas_id' => $data->kelas_id]) . '" class="btn btn-dark">Jadwal</a>';
                        } else {
                            $redirectButton2 = '<span class="text-warning">Anda tidak memiliki akses</span>';
                        }
                    } else {
                        $redirectButton2 = '<span class="text-warning">Anda tidak memiliki akses</span>';
                    }
                    if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
                    $redirectButton3 = '<a href="' . route('jadwal.create', ['datakelas_id' => $data->datakelas_id]) . '" class="btn btn-info">Tambah Jadwal</a>';
                } else {
                    $redirectButton3 = ''; 
                }
                    return $button . ' ' . $redirectButton . ' ' . $redirectButton2 . ' ' . $redirectButton3;
                })
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="' . $data->datakelas_id . '" />';
                })

               

                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('datakelas.index', compact('kelass', 'siswas', 'gurus', 'kelas_id', 'datakelas','datakelass', 'kapasitas_kelas','tahuns'));
    }
   
    // public function index(Request $request)
    // {
    //     $hakakses = Auth::user()->hakakses;
    //     $kelass = kelas::all();
    //     $gurus = tbguru::all();
    //     $tahuns = tahunakademik::all();
    //     $kelas_id = $request->get('kelas_id');
    //     $siswas = tbsiswa::with('kelas')->get();
    //     $datakelas = null;
    //     $datakelass = datakelas::all();
    //     $kapasitas_kelas = kelas::first()->kapasitas;
    //     if ($request->ajax()) {
    //         $data = datakelas::with(['kelas' => function ($query) {
    //             $query->select('kelas_id','namakelas','kapasitas');
    //         }, 'guru', 'siswa', 'tahun'])
    //             ->select(
    //                 'datakelas_id',
    //                 'kelas_id',
    //                 'guru_id',
    //                 'keterangan',
    //                 'tahunakademik_id'
    //             )
    //             ->get();
    //             foreach ($data as $item) {
    //                 $item->jumlah_siswa = tbsiswa::where('kelas_id', $item->kelas_id)->count();
    //             }

    //         return Datatables::of($data)->addIndexColumn()
    //             ->addColumn('action', function ($data) use ($kelas_id, $hakakses) {
    //                 if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
    //                     $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->datakelas_id . ', ' . $kelas_id . ');" class="btn btn-primary">Edit</button>';
    //                 } else {
    //                     $button = ''; // Tidak menampilkan tombol edit untuk peran siswa, guru, atau kurikulum
    //                 }
    //                 if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
    //                     $redirectButton = '<a href="' . route('listkelas.index', ['kelas_id' => $data->kelas_id]) . '" class="btn btn-success">Lihat Detail</a>';
    //                 } else {
    //                     $redirectButton = ''; // Tidak menampilkan tombol edit untuk peran siswa, guru, atau kurikulum
    //                 }
    //                 $redirectButton2 = '<a href="' . route('jadwal.index', ['kelas_id' => $data->kelas_id]) . '" class="btn btn-dark">Jadwal</a>';
    //                 if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
    //                 $redirectButton3 = '<a href="' . route('jadwal.create', ['datakelas_id' => $data->datakelas_id]) . '" class="btn btn-info">Tambah Jadwal</a>';
    //             } else {
    //                 $redirectButton3 = ''; 
    //             }
    //                 return $button . ' ' . $redirectButton . ' ' . $redirectButton2 . ' ' . $redirectButton3;
    //             })
    //             ->addColumn('checkbox', function ($data) {
    //                 return '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="' . $data->datakelas_id . '" />';
    //             })

               

    //             ->rawColumns(['checkbox', 'action'])
    //             ->make(true);
    //     }

    //     return view('datakelas.index', compact('kelass', 'siswas', 'gurus', 'kelas_id', 'datakelas','datakelass', 'kapasitas_kelas','tahuns'));
    // }
    
    public function removeall1(Request $request)
    {
        $siswa_id_array = $request->input('siswa_id');
        datakelas::whereIn('siswa_id', $siswa_id_array)->update(['siswa_id' => null]);
        return response()->json(['message' => 'Siswa ID Deleted']);
    }
    public function edit($id)
    {
        $data = DataKelas::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        $kapasitas = $data->kelas->kapasitas;
        return response()->json([
            "kelas_id" => $data->kelas_id,
            "guru_id" => $data->guru_id,
            "keterangan" => $data->keterangan,
            "kapasitas" => $kapasitas,
            "tahunakademik_id" => $data->tahunakademik_id,
        ]);
    }
    public function edit1($id)
    {
        $data = DataKelas::find($id);
    
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        $kapasitas = $data->kelas->kapasitas;
        return response()->json([
            "kelas_id" => $data->kelas_id,
            "kapasitas" => $kapasitas,
        ]);
    }
    
    
 
   

    public function update(Request $request)
{
    try {
        DB::beginTransaction();

        $request->validate([
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'tahunakademik_id' => 'required',
        ]);

        $kelas = Kelas::find($request->kelas_id);
        if (!$kelas) {
            throw new \Exception('Kelas tidak ditemukan.');
        }

        $maxCapacity = $kelas->kapasitas;
        $existingStudentsCount = DataKelas::where('kelas_id', $request->kelas_id)
            ->where('datakelas_id', '!=', $request->txt_id)
            ->count();
        
        if ($existingStudentsCount >= $maxCapacity) {
            throw new \Exception('Kelas sudah mencapai kapasitas maksimum.');
        }

        $selectedSiswa = $request->selected_siswa;
        $selectedSiswa = is_string($selectedSiswa) ? explode(',', $selectedSiswa) : $selectedSiswa;
        $totalSelected = is_array($selectedSiswa) ? count($selectedSiswa) : 0;

        if ($totalSelected == 0) {
            if ($request->txt_id != '0') {
                DataKelas::where('datakelas_id', $request->txt_id)->update([
                    "kelas_id" => $request->kelas_id,
                    "guru_id" => $request->guru_id,
                    "keterangan" => $request->keterangan,
                    "tahunakademik_id" => $request->tahunakademik_id,
                ]);
            } else {
                $val["kelas_id"] = $request->kelas_id;
                $val["guru_id"] = $request->guru_id;
                $val["keterangan"] = $request->keterangan;
                $val["tahunakademik_id"] = $request->tahunakademik_id;
                DataKelas::create($val);
            }
            DB::commit();
            return redirect('/datakelas')->with('success', 'Data Kelas berhasil diperbarui!');
        }

        $availableCapacity = $maxCapacity - $existingStudentsCount;
        
        if ($totalSelected > $availableCapacity) {
            throw new \Exception('Jumlah siswa yang dipilih melebihi sisa kapasitas yang tersedia untuk kelas.');
        }
        
        if ($totalSelected < $availableCapacity) {
            throw new \Exception('Jumlah siswa yang dipilih kurang, harus pas dengan kapasitas kelas.');
        }
        
        $totalAfterSelection = $existingStudentsCount + $totalSelected;
        
        if ($totalAfterSelection > $maxCapacity) {
            throw new \Exception('Jumlah siswa yang dipilih melebihi kapasitas maksimum kelas.');
        }

        if ($request->txt_id != '0') {
                        DataKelas::where('datakelas_id', $request->txt_id)->update([
                            "kelas_id" => $request->kelas_id,
                            "guru_id" => $request->guru_id,
                            "keterangan" => $request->keterangan,
                            "tahunakademik_id" => $request->tahunakademik_id,
                        ]);
         
                        TBSiswa::whereIn('siswa_id', $selectedSiswa)->update(['kelas_id' => $request->kelas_id]);
                    } else {
                        $val["kelas_id"] = $request->kelas_id;
                        $val["guru_id"] = $request->guru_id;
                        $val["keterangan"] = $request->keterangan;
                        $val["tahunakademik_id"] = $request->tahunakademik_id;
                        $newDataKelas = DataKelas::create($val);
            
                        TBSiswa::whereIn('siswa_id', $selectedSiswa)->update(['kelas_id' => $newDataKelas->kelas_id]);
                    }
            
                    DB::commit();
        return redirect('/datakelas')->with('success', 'Data Kelas berhasil diperbarui!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect('/datakelas')->with('error', 'Terjadi kesalahan. ' . $e->getMessage());
    }
}
    public function removeall(Request $request)
    {
        $datakelas_id_array = $request->input('datakelas_id');
        try {
            foreach ($datakelas_id_array as $datakelas_id) {
                $datakelas = datakelas::find($datakelas_id);
                if ($datakelas) {
                    tbsiswa::where('kelas_id', $datakelas->kelas_id)->update(['kelas_id' => null]);
                    $datakelas->delete();
                }
            }
            return response()->json(['message' => 'Kelas ID removed from Tbsiswa']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to remove Kelas ID from Tbsiswa', 'error' => $e->getMessage()], 500);
        }
    }
    public function removeKelasFromSiswa(Request $request)
    {
        $siswa_id_array = $request->input('siswa_id');
    
        foreach ($siswa_id_array as $siswa_id) {
            $siswa = Tbsiswa::find($siswa_id);
            
            if ($siswa) {
                $siswa->kelas_id = null;
                $siswa->save();
            }
        }
    
        return response()->json(['message' => 'Kelas ID Deleted']);
    }
   
}
