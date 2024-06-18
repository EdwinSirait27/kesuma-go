<?php
namespace App\Http\Controllers;
use App\Models\tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\datakelas;
use App\Models\kelas;
use setasign\Fpdi\Fpdi;
use App\Models\tbsiswa;
use App\Models\prestasi;
use Carbon\Carbon;

use App\Models\tbguru;
use App\Models\siswamengajar;
use App\Models\DatakelasDatamengajar;
use App\Models\Kurikulum;
use App\Models\SiswaEkstraGuru;
use Illuminate\Support\Str;
use App\Models\datamengajar;
use App\Models\buttonnilaisiswa;
use App\Models\buttonnilaiguru;
use App\Models\buttonnilaikurikulum;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class datakelasController extends Controller
{

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
  
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'kelas_id' => 'required',
                'tahunakademik_id' => 'required',
            ]);
            $this->checkExistingDataKelas($request);
            $kelas = Kelas::find($request->kelas_id);
            if (!$kelas) {
                throw new \Exception('Kelas tidak ditemukan.');
            }
            $this->checkKelasCapacity($kelas, $request);
            $selectedSiswa = $this->parseSelectedSiswa($request->selected_siswa);
            if (count($selectedSiswa) > 0) {
                $this->validateSiswaSelection($kelas, $selectedSiswa, $request->txt_id);
            }
            $this->updateOrCreateDataKelas($request, $selectedSiswa);
            DB::commit();
            return redirect('/datakelasadmin')->with('success', 'Data Kelas berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/datakelasadmin')->with('error', 'Terjadi kesalahan. ' . $e->getMessage());
        }
    }
    private function checkExistingDataKelas($request)
    {
        $existingDataKelas = DataKelas::where('kelas_id', $request->kelas_id)
            ->where('datakelas_id', '!=', $request->txt_id)
            ->where('tahunakademik_id', $request->tahunakademik_id)
            ->first();
        if ($existingDataKelas) {
            throw new \Exception('Kombinasi kelas sudah ada untuk tahun akademik ini.');
        }
        $existingDataKelas = DataKelas::where('guru_id', $request->guru_id)
            ->where('datakelas_id', '!=', $request->txt_id)
            ->where('tahunakademik_id', $request->tahunakademik_id)
            ->first();
        if ($existingDataKelas) {
            throw new \Exception('Kombinasi guru sudah ada untuk tahun akademik ini.');
        }
        $existingDataKelas = DataKelas::where('kelas_id', $request->kelas_id)
            ->where('guru_id', $request->guru_id)
            ->where('datakelas_id', '!=', $request->txt_id)
            ->where('tahunakademik_id', $request->tahunakademik_id)
            ->first();
        if ($existingDataKelas) {
            throw new \Exception('Kombinasi kelas dan guru sudah ada untuk tahun akademik ini.');
        }
    }
    private function checkKelasCapacity($kelas, $request)
    {
        $maxCapacity = $kelas->kapasitas;
        $existingStudentsCount = DataKelas::where('kelas_id', $request->kelas_id)
            ->where('datakelas_id', '!=', $request->txt_id)
            ->count();
        if ($existingStudentsCount >= $maxCapacity) {
            throw new \Exception('Kelas sudah mencapai kapasitas maksimum.');
        }
    }
    private function parseSelectedSiswa($selectedSiswa)
    {
        if (is_null($selectedSiswa)) {
            return [];
        }
        return is_string($selectedSiswa) ? explode(',', $selectedSiswa) : $selectedSiswa;
    }
    private function validateSiswaSelection($kelas, $selectedSiswa, $txtId)
    {
        $totalSelected = count($selectedSiswa);
        $existingStudentsCount = DataKelas::where('kelas_id', $kelas->id)
            ->where('datakelas_id', '!=', $txtId)
            ->count();
        $availableCapacity = $kelas->kapasitas - $existingStudentsCount;
        if ($totalSelected > $availableCapacity) {
            throw new \Exception('Jumlah siswa yang dipilih melebihi sisa kapasitas yang tersedia untuk kelas.');
        }
        if ($totalSelected < $availableCapacity) {
            throw new \Exception('Jumlah siswa yang dipilih kurang, harus pas dengan kapasitas kelas.');
        }
    }
    private function updateOrCreateDataKelas($request, $selectedSiswa)
    {
        if (count($selectedSiswa) == 0) {
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
        } else {
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
        }
    }
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
                // $namaGuru = $datakelas->guru->Nama;
                $namaGuru = $datakelas->guru->Nama ?? null;
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


    public function index2(Request $request)
    {
        try {
            $datakelasId = session('datakelas_id');
            $datakelas = Datakelas::where('datakelas_id', $datakelasId)->first();
            if (!$datakelas) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
            }
            $datamengajars = $datakelas->datamengajars()->orderBy('hari')->orderBy('time_start')->get();
            return view('jadwal.index', [
                'datakelasId' => $datakelasId,
                'datakelas' => $datakelas,
                'datamengajars' => $datamengajars
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/datakelas')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect('/datakelas')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }

    public function indexall(Request $request, $datakelas_id = null)
    {
        try {
            if (!$datakelas_id) {
                return redirect('/listkelas')->with('error', 'Data kelas tidak ditemukan.');
            }
            $datakelas = datakelas::where('datakelas_id', $datakelas_id)->firstOrFail();
            if (!$datakelas) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
            }
            $datakelas->load('kelas', 'guru');
            $namakelas = $datakelas->kelas->namakelas;
            $kapasitas = $datakelas->kelas->kapasitas;
            $namaGuru = $datakelas->guru ? $datakelas->guru->Nama : 'belum di set';

            $tahunakademik = $datakelas->tahun->tahunakademik;
            $semester = $datakelas->tahun->semester;
            $siswaIds = tbsiswa::where('kelas_id', $datakelas->kelas->kelas_id)->pluck('siswa_id')->toArray();
            return view('listkelas.index', [
                'datakelasId' => $datakelas_id,
                'siswaIds' => $siswaIds,
                'namakelas' => $namakelas,
                'namaGuru' => $namaGuru,
                'kapasitas' => $kapasitas,
                'datakelas' => $datakelas,
                'tahunakademik' => $tahunakademik,
                'semester' => $semester
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/datakelasadmin')->with('error', 'Tangannya nakal ya!');
        } catch (\Exception $e) {
            return redirect('/datakelasadmin')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }

    public function detailSiswa($datakelasId)
    {
        try {
            $datakelas = Datakelas::findOrFail($datakelasId);

            // Mengambil siswa berdasarkan kelas dari model Datakelas
            $siswas = $datakelas->kelas->siswas;

            return view('inputnilai.index', [
                'siswas' => $siswas,
                'datakelas' => $datakelas,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/datakelasadmin')->with('error', 'Data kelas tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect('/datakelasadmin')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }

    public function indexguru(Request $request)
    {
        try {
            $hakakses = Auth::user()->hakakses;
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
                return view('listsiswaadmin.index', [
                    'datakelasId' => $datakelas->datakelas_id,
                    'siswaIds' => $siswaIds,
                    'namakelas' => $namakelas,
                    'namaGuru' => $namaGuru,
                    'kapasitas' => $kapasitas,
                    'datakelas' => $datakelas,
                    'tahunakademik' => $tahunakademik,
                    'semester' => $semester
                ]);
            }
            if ($hakakses == 'Guru') {
                // Jika pengguna adalah guru, langsung diarahkan ke halaman Datakelas
                return redirect('/datakelas')->with('warning', 'Diarahkan ke Datakelas Karena Anda bukan Wali Kelas.');
            } else {

                return redirect('/datakelasadmin')->with('warning', 'Diarahkan ke Datakelas Karena Anda bukan Wali Kelas.');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/datakelasadmin')->with('error', 'Data kelas tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect('/datakelasadmin')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }

    public function indexjadwal(Request $request, $datakelas_id = null)
    {
        try {
            if (!$datakelas_id) {
                return redirect('/datakelasadmin')->with('error', 'Data kelas tidak ditemukan.');
            }

            $datakelas = Datakelas::where('datakelas_id', $datakelas_id)->firstOrFail();

            if (!$datakelas) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
            }
            $datamengajars = $datakelas->datamengajars()->orderBy('hari')->orderBy('time_start')->get();
            return view('jadwal.index', [
                'datakelasId' => $datakelas_id,
                'datakelas' => $datakelas,
                'datamengajars' => $datamengajars
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/datakelasadmin')->with('error', 'Tangannya nakal ya!');
        } catch (\Exception $e) {
            return redirect('/datakelasadmin')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    public function hapus(Request $request)
    {
        try {
            // Mendapatkan daftar ID Datamengajar yang akan dihapus dari input form
            $datamengajarIds = $request->input('datamengajar_ids');

            // Pastikan ada ID yang dipilih untuk dihapus
            if (!$datamengajarIds) {
                return redirect()->back()->with('error', 'Tidak ada item yang dipilih untuk dihapus.');
            }

            // Hapus terlebih dahulu baris yang terkait di tabel datakelas_datamengajar
            DatakelasDatamengajar::whereIn('datamengajar_id', $datamengajarIds)->delete();

            // Setelah itu, hapus baris di tabel datamengajar
            siswamengajar::whereIn('datamengajar_id', $datamengajarIds)->delete();

            return redirect()->back()->with('success', 'Datamengajars berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    public function create(Request $request, $datakelas_id = null)
    {
        try {
            if (!$datakelas_id) {
                return redirect('/datakelasadmin')->with('error', 'Data kelas tidak ditemukan.');
            }
            $datakelas = Datakelas::where('datakelas_id', $datakelas_id)->firstOrFail();
            if (!$datakelas) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
            }
            $datamengajars = Datamengajar::where('kelas_id', $datakelas->kelas->kelas_id)->get();
        
$kelasIdDatakelas = $datakelas->kelas->kelas_id;

$siswa_id = tbsiswa::whereHas('kelas', function ($query) use ($kelasIdDatakelas) {
    $query->where('kelas_id', $kelasIdDatakelas);
})->pluck('siswa_id');


            return view('jadwal.create', [
                'datakelas' => $datakelas,
                'datamengajars' => $datamengajars,
                'siswa_id' => $siswa_id
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Redirect::route('jadwal.create')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect('/datakelasadmin')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    function removeall1(Request $request)
    {
        $siswa_mengajar_id_array = $request->input('siswa_mengajar_id');
        $data = siswamengajar::whereIn('siswa_mengajar_id', $siswa_mengajar_id_array);


        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
    public function indexnilai(Request $request)
    {
        if ($request->ajax()) {
            $data = siswamengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])->select(
                'tahunakademik_id',
                'datakelas_id',
                'siswa_id'
            )
                ->distinct()
                ->get();
            $index = 1;
            foreach ($data as $item) {
                $item->index_increment = $index++;
            }
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) use ($request) {
                    $token = Str::random(32);
                    $request->session()->put('inputnilai_token', $token);
                    $redirectButton = '<a href="' . route('inputnilai.index', ['siswa_id' => $data->siswa_id, 'token' => $token]) . '" class="btn btn-success">input Nilai</a>';
                    return $redirectButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('inputnilaiguru.index');
    }
    public function indexadmin(Request $request)
    {
        $activePemilihan = buttonnilaikurikulum::whereNotNull('start_date')
        ->whereNotNull('end_date')
        ->first();
    
    if ($activePemilihan) {
        $activePemilihan->start_date = Carbon::parse($activePemilihan->start_date);
        $activePemilihan->end_date = Carbon::parse($activePemilihan->end_date);
        $currentDateTime = Carbon::now();
        
        if (!($activePemilihan->start_date <= $currentDateTime && $activePemilihan->end_date >= $currentDateTime)) {
            return redirect('/SiswaBeranda')->with('error', 'Belum Terbuka.');
        }
    } else {
        if (auth()->user()->hakakses == 'Siswa') {
            return redirect('/SiswaBeranda')->with('error', 'Belum Terbuka.');
        }
    }
        $tahunAkademiks = tahunakademik::all();
        $taon = tahunakademik::where('statusaktif','Aktif')->get();
        $kurs = Kurikulum::where('Status_Aktif', 'Aktif')->get();
        
        if ($request->ajax()) {
            $data = siswamengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
                ->when($request->tahunakademik_id, function ($query) use ($request) {
                    return $query->where('tahunakademik_id', $request->tahunakademik_id);
                })
                ->get();
                $groupedData = $data->groupBy('datakelas.kelas.kelas_id');
            // $uniqueData = $data->unique(function ($item) {
                $uniqueData = collect([]);
               
                foreach ($groupedData as $kelasId => $siswaMengajarCollection) {
                    $uniqueItems = $siswaMengajarCollection->unique(function ($item) {
                        return $item->siswa->NamaLengkap;
                    });
    
                    $uniqueItems->each(function ($item, $key) use ($uniqueData) {
                        $item->index_increment = $key + 1;
                        $uniqueData->push($item);
                    });
                }
            return Datatables::of($uniqueData)->addIndexColumn()
                ->addColumn('action', function ($data) use ($request) {
               
                    
                    $encodedId = base64_encode($data->siswa_id);
                    $redirectButton = '<a href="' . route('inputnilaiall.index', ['encodedId' => $encodedId]) . '"  class="btn btn-success">Lihat Detail</a>';


                    return $redirectButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('inputnilaispc.index', compact('tahunAkademiks','kurs','taon'));
    }
    // public function indexadmin(Request $request)
    // {
    //     $tahunAkademiks = tahunakademik::all();

    //     if ($request->ajax()) {
    //         $data = siswamengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
    //             ->when($request->tahunakademik_id, function ($query) use ($request) {
    //                 return $query->where('tahunakademik_id', $request->tahunakademik_id);
    //             })
    //             ->get();

    //         $uniqueData = $data->unique(function ($item) {
    //             return $item->siswa->NamaLengkap;
    //         });

    //         $uniqueData->each(function ($item, $key) {
    //             $item->index_increment = $key + 1;
    //         });

    //         return Datatables::of($uniqueData)->addIndexColumn()
    //             ->addColumn('action', function ($data) use ($request) {
               
                    
    //                 $encodedId = base64_encode($data->siswa_id);
    //                 $redirectButton = '<a href="' . route('inputnilaiall.index', ['encodedId' => $encodedId]) . '"  class="btn btn-success">Lihat Detail</a>';


    //                 return $redirectButton;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('inputnilaispc.index', compact('tahunAkademiks'));
    // }
    
    public function indexdatasiswa(Request $request)
    {
       

        $tahunAkademiks = tahunakademik::all();
        $user = Auth::user();
        $taon = tahunakademik::where('statusaktif','Aktif')->get();
        
        $kurs = Kurikulum::where('Status_Aktif', 'Aktif')->get();
        // Mengambil siswa_id dari user yang sedang login
        $siswaId = $user->siswa_id;
        
        if ($request->ajax()) {
            try {
                $data = siswamengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
                    ->where('siswa_id', $siswaId)
                    ->when($request->tahunakademik_id, function ($query) use ($request) {
                        return $query->where('tahunakademik_id', $request->tahunakademik_id);
                    })
                    ->get();

                $uniqueData = $data->unique('siswa.NamaLengkap');
                $uniqueData->values()->each(function ($item, $key) {
                    $item->index_increment = $key + 1;
                });

                return Datatables::of($uniqueData)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        $redirectButton = '<a href="' . route('nilai-ku.index') . '" class="btn btn-primary">Lihat Nilai</a>';
                        return $redirectButton;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Terjadi kesalahan dalam pengambilan data'], 500);
            }
        }

        return view('datanilaisiswa.index', compact('tahunAkademiks','kurs','taon'));
    }

    // public function indexdatasiswa(Request $request)
    // {
    //     $activeulr = buttonnilaisiswa::whereNotNull('start_date')
    //     ->whereNotNull('end_date')
    //     ->first();
    // if ($activeulr) {
    //     $activeulr->start_date = Carbon::parse($activeulr->start_date);
    //     $activeulr->end_date = Carbon::parse($activeulr->end_date);
    //     $currentDateTime = Carbon::now();
    //     if (!($activeulr->start_date <= $currentDateTime && $activeulr->end_date >= $currentDateTime)) {
    //         return redirect('/SiswaBeranda')->with('error', 'Belum Terbuka.');
    //     }
    // } else {
    //     if (auth()->user()->hakakses == 'Siswa') {
    //         return redirect('/SiswaBeranda')->with('error', 'Belum Terbuka.');
    //     }
    // }
    //     $tahunAkademiks = tahunakademik::all();
    //     $siswaId = Auth::id();
    //     if ($request->ajax()) {
    //         try {
    //             $data = siswamengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
    //                 ->where('siswa_id', $siswaId) 
    //                 ->when($request->tahunakademik_id, function ($query) use ($request) {
    //                     return $query->where('tahunakademik_id', $request->tahunakademik_id);
    //                 })
    //                 ->get();
    //             $uniqueData = $data->unique(function ($item) {
    //                 return $item->siswa->NamaLengkap;
    //             });
    //             $uniqueData->each(function ($item, $key) {
    //                 $item->index_increment = $key + 1;
    //             });
    //             return Datatables::of($uniqueData)->addIndexColumn()
    //                 ->addColumn('action', function ($data) use ($request) {
    //                     $redirectButton = '<a href="' . route('nilai-ku.index') . '" class="btn btn-primary">Lihat Nilai</a>';
    //                     return $redirectButton;
    //                 })
    //                 ->rawColumns(['action'])
    //                 ->make(true);
    //         } catch (\Exception $e) {
    //             return response()->json(['error' => 'Terjadi kesalahan dalam pengambilan data'], 500);
    //         }
    //     }
    //     return view('datanilaisiswa.index', compact('tahunAkademiks'));
    // }
    public function downloaddddd($datamengajar_id)
    {
        try {
            $datamengajar = SiswaMengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel','datamengajar.guru'])
            ->where('datamengajar_id', $datamengajar_id)
            ->first();
            if (!$datamengajar_id) {
                // Handle error if decoding fails
                return redirect()->back()->with('error', 'Invalid data');
            }

        if (!$datamengajar) {
            // Handle error if no data found
            return redirect()->back()->with('error', 'Data not found');
        }

        // Mengambil semua data mengajar terkait dengan datamengajar_id
        $datamengajars = SiswaMengajar::where('datamengajar_id', $datamengajar_id)->get();

        $siswa_ids = [];
        foreach ($datamengajars as $datamengajar) {
            $siswa_ids[$datamengajar->siswa_id] = [
                'siswa_id' => $datamengajar->siswa_id,
                'NamaLengkap' => $datamengajar->siswa->NamaLengkap,
                'nilaitugas1' => $datamengajar->nilaitugas1,
                'nilaitugas2' => $datamengajar->nilaitugas2,
                'nilaitugas3' => $datamengajar->nilaitugas3,
                'nilaitugas4' => $datamengajar->nilaitugas4,
                'nilaitugas5' => $datamengajar->nilaitugas5,
                'nilaitugas' => $datamengajar->nilaitugas,
                'nilaiuts' => $datamengajar->nilaiuts,
                'nilaiuas' => $datamengajar->nilaiuas,
                'nilaikeaktifan' => $datamengajar->nilaikeaktifan,
                'nilaitotal' => $datamengajar->nilaitotal,
                'keterangan' => $datamengajar->keterangan,
            ];
        }
        
            $pdf = new Fpdi();
            $pdf->setSourceFile(storage_path('app/public/doc/doc.pdf'));
            $tplIdx = $pdf->importPage(1);
            $pdf->addPage();
            $pdf->useTemplate($tplIdx, 0, 0);
            $pdf->SetFont('times', 'B', 12);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(20, 30);
            $startX = 15;
            $endX = 195;
            $lineY = 40;
            $pdf->SetLineWidth(0.8);
            $pdf->Line($startX, $lineY, $endX, $lineY);

            $pdf->SetLineWidth(0.2);

            $pdf->Line($startX, $lineY, $endX, $lineY);
            $pdf->Cell(0, 33, 'LAPORAN HASIL PENILAIAN GURU', 0, 1, 'C');
            $pdf->SetFont('times', 'B', 11);
            $pdf->SetXY(14, 10);
            $pdf->Cell(0, 10, 'Nama Sekolah     :' . '   SMAK Kesuma Mataram', 0, 1);
            $pdf->SetXY(14, 15);
            $pdf->Cell(0, 10, 'Alamat                 :   ' .   'Jln. Pejanggik No. 110 Cakranegara', 0, 1);
            $pdf->SetXY(14, 20);
            $pdf->Cell(0, 10, 'Nama Lengkap   :   ' . $datamengajar->datamengajar->guru->Nama, 0, 1);
            $pdf->SetXY(14, 25);
            $pdf->Cell(0, 10, 'Mata Pelajaran   :   ' . $datamengajar->datamengajar->matpel->MataPelajaran, 0, 1);
            $pdf->SetXY(125, 10);
            $pdf->Cell(0, 10, 'Fase                        :' . '  E', 0, 1);
            $pdf->SetXY(125, 15);
            $pdf->Cell(0, 10, 'Semester                :  ' .   $datamengajar->tahunakademik->semester, 0, 1);
            $pdf->SetXY(125, 20);
            $pdf->Cell(0, 10, 'Tahun Akademik :   ' .   $datamengajar->tahunakademik->tahunakademik, 0, 1);
            $pdf->SetXY(125, 25);
            $pdf->Cell(0, 10, 'Kurikulum            :   ' .   $datamengajar->tahunakademik->kurikulum->Nama_Kurikulum, 0, 1);


            // Mengatur posisi awal tabel pertama
            $startingY = 50;

            $pdf->SetXY(14, $startingY);
            $pdf->Cell(0, 10, 'A.   ' . 'Akademik', 0, 1);
            $pdf->SetFont('times', 'B', 10);
            $pdf->SetX(14);
            $pdf->Cell(10, 10, 'No', 1, 0, 'C');
            $pdf->Cell(60, 10, 'Nama Siswa', 1, 0, 'C');
            $pdf->Cell(18, 10, 'Nilai Akhir', 1, 0, 'C');
            $pdf->Cell(93, 10, 'Capaian Kompetensi', 1, 1, 'C');
            $pdf->SetFont('times', '', 9);

            $no = 1;
            $cellHeight = 15;
            $fixedLineHeight = 5;

            foreach ($datamengajars as $datamengajar) {
                $pdf->SetX(14);

                $noOfLinesNo = ceil(strlen($no) / 3);
                $noOfLinesMatpel = ceil(strlen($datamengajar->siswa->NamaLengkap) / 10);
                $noOfLinesNilai = ceil(strlen($datamengajar->nilaitotal) / 5);
                $maxNoOfLines = max($noOfLinesNo, $noOfLinesMatpel, $noOfLinesNilai);

                $pdf->Cell(10, $cellHeight, $no, 1, 0, 'C');
                $pdf->Cell(60, $cellHeight, $datamengajar->siswa->NamaLengkap, 1, 0, 'C');
                $pdf->Cell(18, $cellHeight, $datamengajar->nilaitotal, 1, 0, 'C');
                $pdf->MultiCell(93, $fixedLineHeight, $datamengajar->keterangan, 1, 'J');

                $no++;
            }

            // Menghitung tinggi tabel pertama
            $tabelPertamaHeight = $pdf->GetY() - $startingY;

            // Mengatur posisi awal tabel kedua berdasarkan tinggi tabel pertama
          
            $startingY += $tabelPertamaHeight + 5;
            $pdf->SetXY(20, $startingY);
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(0, 10, 'Guru Mata Pelajaran,', 0, 0, 'L');
            $pdf->Cell(0, 10, 'Mataram, ' . date('d-m-Y'), 0, 1, 'R');
            // $pdf->Cell(-4, 10, 'Mataram, ' . date('d-m-Y'), 0, 1, 'R');
            $pdf->Cell(0, 1, 'Wali Kelas,', 0, 0, 'R');

            $pdf->SetFont('times', 'BU', 12);
            $pdf->Cell(0, 50, $datamengajar->datakelas->guru->Nama, 0, 0, 'R');
            $tabelKeenamHeight = $pdf->GetY() - $startingY;
            $startingY += $tabelKeenamHeight + 20;
            $pdf->SetFont('times', '', 12);
            $pdf->SetXY(20, $startingY);
            $pdf->Cell(0, 10, $datamengajar->datamengajar->guru->Nama, 0, 0, 'L');
            $tabelKetujuHeight = $pdf->GetY() - $startingY;
            $startingY += $tabelKetujuHeight + 20;
            $pdf->SetXY(14, $startingY);
            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(0, 10, 'Mengetahui,', 0, 0, 'C');
            $startingY += $tabelKetujuHeight + 5;
            $pdf->SetXY(14, $startingY);

            // Tambahkan teks kepala sekolah
            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(0, 10, 'Kepala SMAK Kesuma Mataram', 0, 1, 'C');
            $startingY += $tabelKetujuHeight + 25;
            $pdf->SetXY(14, $startingY);

            $pdf->SetFont('times', 'BU', 12);
            $nama_guru = tbguru::where('TugasMengajar', 'Kepala Sekolah')->pluck('Nama')->toArray();
            $hakakses = implode(", ", $nama_guru);
            $pdf->Cell(0, 10, $hakakses, 0, 1, 'C');

            $outputPdfPath = storage_path('app/public/nilaipegangan/nilai_' . $datamengajar->datamengajar->guru->Nama . $datamengajar->datamengajar->matpel->MataPelajaran . '_document.pdf');

            $pdf->Output($outputPdfPath, 'F');
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment;filename="' . basename($outputPdfPath) . '"',
                'Cache-Control' => 'max-age=0',
            ];
            return response()->download($outputPdfPath, basename($outputPdfPath), $headers);
        } catch (\Exception $e) {
            return redirect()->route('inputnilaiadmin.index')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
   public function indexnilai1(Request $request)
    {
        $activePemilihan = buttonnilaiguru::whereNotNull('start_date')
        ->whereNotNull('end_date')
        ->first();
    
    if ($activePemilihan) {
        $activePemilihan->start_date = Carbon::parse($activePemilihan->start_date);
        $activePemilihan->end_date = Carbon::parse($activePemilihan->end_date);
        $currentDateTime = Carbon::now();
        
        if (!($activePemilihan->start_date <= $currentDateTime && $activePemilihan->end_date >= $currentDateTime)) {
            return redirect('/SiswaBeranda')->with('error', 'Belum Terbuka.');
        }
    } else {
        if (auth()->user()->hakakses == 'Siswa') {
            return redirect('/SiswaBeranda')->with('error', 'Belum Terbuka.');
        }
    }
    $tahunAkademiks = tahunakademik::all();
    $taon = tahunakademik::where('statusaktif','Aktif')->get();
    $user = Auth::user();
    $guruId = $user->guru_id;
    $kurs = Kurikulum::where('Status_Aktif', 'Aktif')->get();
        if ($request->ajax()) {
            $data = siswamengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
                ->when($request->tahunakademik_id, function ($query) use ($request) {
                    return $query->where('tahunakademik_id', $request->tahunakademik_id);
                })
                ->get();

            // Kelompokkan data berdasarkan kelas_id
            $groupedData = $data->groupBy('datakelas.kelas.kelas_id');

            $uniqueData = collect([]);
            foreach ($groupedData as $kelasId => $siswaMengajarCollection) {
                $uniqueItems = $siswaMengajarCollection->unique(function ($item) {
                    return $item->datamengajar->matpel->MataPelajaran;              
                });

                $uniqueItems->each(function ($item, $key) use ($uniqueData) {
                    $item->index_increment = $key + 1;
                    $uniqueData->push($item);
                });
            }

            return Datatables::of($uniqueData)->addIndexColumn()
                ->addColumn('action', function ($data) use ($request,$user) {
                    $guruId = $user->guru_id;
                    // $currentGuruId = auth()->user()->guru_id;
                    $isAccessAllowed = $data->datamengajar->guru_id == $guruId;
                    $encodedId = base64_encode($data->datamengajar_id);

                    if ($isAccessAllowed) {
                        $redirectButton1 = '<a href="' . route('nilaisiswa.index', ['encodedId' => $encodedId]) . '" class="btn btn-dark">Lihat Siswa</a>';
                    } else {
                        $redirectButton1 = 'Anda tidak mempunyai akses';
                    }

                    return $redirectButton1;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('inputnilaiadmin.index', compact('tahunAkademiks','kurs','taon'));
    }

    public function index(Request $request)
    {
        $hakakses = Auth::user()->hakakses;
        $kelass = kelas::all();
        $gurus = tbguru::all();
        $tahuns = tahunakademik::all();
        $taon = tahunakademik::where('statusaktif', 'Aktif')->get();
        $kurs = Kurikulum::where('Status_Aktif', 'Aktif')->get();
        $kelas_id = $request->get('kelas_id');
        $siswas = tbsiswa::with('kelas')->get();
        $datakelas = null;
        $datakelass = datakelas::all();
        $kapasitas_kelas = kelas::first()->kapasitas;

        if ($request->ajax()) {
            $data = datakelas::with(['tahun.kurikulum', 'guru', 'siswa', 'kelas'])
                ->when($request->tahunakademik_id, function ($query) use ($request) {
                    return $query->where('tahunakademik_id', $request->tahunakademik_id);
                })
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
                ->addColumn('action', function ($data) use ($hakakses,$request) {
                    $buttons = '';

                    if ($hakakses == 'Kurikulum' || $hakakses == 'Guru') {
                      
                            session(['datakelas_id' => $data->datakelas_id]);
                            // $buttons .= '<a href="' . route('jadwal.index') . '" class="btn btn-success">Jadwal</a>';
                            $token = Str::random(32);
                    
                            $request->session()->put('jadwaladmin_token', $token);
                            $buttons = '<a href="' . route('jadwaladmin.index', ['datakelas_id' => $data->datakelas_id, 'token' => $token]) . '" class="btn btn-dark">Jadwal </a>';
                    }

                    if ($hakakses == 'Siswa') {
                        $siswa_id = Auth::user()->siswa_id;
                        $siswa = tbsiswa::find($siswa_id);

                        if ($siswa && $siswa->kelas_id == $data->kelas_id) {
                            session(['datakelas_id' => $data->datakelas_id]);
                            $buttons .= '<a href="' . route('jadwal.index') . '" class="btn btn-dark">Jadwal</a>';
                        } else {
                            $buttons .= '<span class="text-warning">Anda tidak memiliki akses</span>';
                        }
                    }

                    return $buttons;
                })
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="' . $data->datakelas_id . '" />';
                })
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('datakelas.index', compact('kelass', 'siswas', 'gurus', 'kelas_id', 'datakelas', 'datakelass', 'kurs','kapasitas_kelas', 'tahuns','taon'));
    }
    // public function index(Request $request)
    // {
    //     $hakakses = Auth::user()->hakakses;
    //     $kelass = kelas::all();
    //     $gurus = tbguru::all();
    //     $tahuns = tahunakademik::all();
    //     $taon = tahunakademik::where('statusaktif', 'Aktif')->get();
       
    //     $kelas_id = $request->get('kelas_id');
    //     $siswas = tbsiswa::with('kelas')->get();
    //     $datakelas = null;
    //     $datakelass = datakelas::all();
    //     $kapasitas_kelas = kelas::first()->kapasitas;

    //     if ($request->ajax()) {
    //         $data = datakelas::with(['tahun.kurikulum', 'guru', 'siswa', 'kelas'])
    //             ->when($request->tahunakademik_id, function ($query) use ($request) {
    //                 return $query->where('tahunakademik_id', $request->tahunakademik_id);
    //             })
    //             ->select(
    //                 'datakelas_id',
    //                 'kelas_id',
    //                 'guru_id',
    //                 'keterangan',
    //                 'tahunakademik_id'
    //             )
    //             ->get();

    //         foreach ($data as $item) {
    //             $item->jumlah_siswa = tbsiswa::where('kelas_id', $item->kelas_id)->count();
    //         }

    //         return Datatables::of($data)->addIndexColumn()
    //             ->addColumn('action', function ($data) use ($hakakses) {
    //                 $buttons = '';

    //                 if ($hakakses == 'Kurikulum' || $hakakses == 'Guru') {
    //                     $guru_id = Auth::user()->guru_id;
    //                     $datakelas = datakelas::where('guru_id', $guru_id)->where('kelas_id', $data->kelas_id)->first();

    //                     if ($datakelas) {
    //                         session(['datakelas_id' => $data->datakelas_id]);
    //                         $buttons .= '<a href="' . route('jadwal.index') . '" class="btn btn-success">Jadwal</a>';
    //                     } else {
    //                         $buttons .= '<span class="text-warning">Anda tidak memiliki akses</span>';
    //                     }
    //                 }

    //                 if ($hakakses == 'Siswa') {
    //                     $siswa_id = Auth::user()->siswa_id;
    //                     $siswa = tbsiswa::find($siswa_id);

    //                     if ($siswa && $siswa->kelas_id == $data->kelas_id) {
    //                         session(['datakelas_id' => $data->datakelas_id]);
    //                         $buttons .= '<a href="' . route('jadwal.index') . '" class="btn btn-dark">Jadwal</a>';
    //                     } else {
    //                         $buttons .= '<span class="text-warning">Anda tidak memiliki akses</span>';
    //                     }
    //                 }

    //                 return $buttons;
    //             })
    //             ->addColumn('checkbox', function ($data) {
    //                 return '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="' . $data->datakelas_id . '" />';
    //             })
    //             ->rawColumns(['checkbox', 'action'])
    //             ->make(true);
    //     }

    //     return view('datakelas.index', compact('kelass', 'siswas', 'gurus', 'kelas_id', 'datakelas', 'datakelass', 'kapasitas_kelas', 'tahuns','taon'));
    // }


    public function downloadddd($siswa_id)
    {
        try {
            $siswa = SiswaMengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
                ->where('siswa_id', $siswa_id)
                ->first();
            if (!$siswa) {
                return redirect()->route('inputnilaiguru.index')->with('error', 'Siswa tidak ditemukan.');
            }
            // $hakakses = tbguru::where('TugasMengajar', 'Kepala Sekolah')->pluck('Nama');

            $datamengajars = SiswaMengajar::where('siswa_id', $siswa_id)->get();
            $datamengajar_ids = [];
            foreach ($datamengajars as $datamengajar) {
                $datamengajar_ids[$datamengajar->datamengajar_id] = [
                    'datamengajar_id' => $datamengajar->datamengajar_id,
                    'MataPelajaran' => $datamengajar->datamengajar->matpel->MataPelajaran,
                    'nilaitugas' => $datamengajar->nilaitugas,
                    'nilaiuts' => $datamengajar->nilaiuts,
                    'nilaiuas' => $datamengajar->nilaiuas,
                    'nilaikeaktifan' => $datamengajar->nilaikeaktifan,
                    'nilaitotal' => $datamengajar->nilaitotal,
                    'keterangan' => $datamengajar->keterangan,
                ];
            }
            $ekstragurus = siswaekstraguru::with(['ekstraguru.ekskul'])->where('siswa_id', $siswa_id)->get();
            $ekstra_guru_ids = [];
            foreach ($ekstragurus as $ekstraguru) {
                $ekstra_guru_ids[$ekstraguru->ekstra_guru_id] = [
                    'ekstra_guru_id' => $ekstraguru->ekstra_guru_id,
                    'namaekskul' => $ekstraguru->ekstraguru->ekskul->namaekskul,
                    'predikat' => $ekstraguru->predikat,
                    'keterangann' => $ekstraguru->keterangann,

                ];
            }
            $tbguru = tbguru::where('guru_id')->get();
            $tbsiswas = tbsiswa::where('siswa_id', $siswa_id)->get();
            $siswa_ids = [];
            foreach ($tbsiswas as $tbsiswa) {
                $siswa_ids[$tbsiswa->siswa_id] = [
                    'siswa_id' => $tbsiswa->siswa_id,
                    'NamaLengkap' => $tbsiswa->NamaLengkap,
                    'izin' => $tbsiswa->izin,
                    'sakit' => $tbsiswa->sakit,
                    'tk' => $tbsiswa->tk,
                    'catatan' => $tbsiswa->catatan,

                ];
            }
            $prestasis = prestasi::where('siswa_id', $siswa_id)->get();

            $prestasiData = []; // Inisialisasi array untuk menyimpan data

            foreach ($prestasis as $prestasi) {
                // Menambahkan data ke dalam array
                $prestasiData[] = [
                    'prestasi' => $prestasi->prestasi,
                    'keterangan' => $prestasi->keterangan
                ];
            }
            $pdf = new Fpdi();
            $pdf->setSourceFile(storage_path('app/public/doc/doc.pdf'));
            $tplIdx = $pdf->importPage(1);
            $pdf->addPage();
            $pdf->useTemplate($tplIdx, 0, 0);
            $pdf->SetFont('times', 'B', 12);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(20, 30);
            $startX = 15;
            $endX = 195;
            $lineY = 40;
            $pdf->SetLineWidth(0.8);
            $pdf->Line($startX, $lineY, $endX, $lineY);

            $pdf->SetLineWidth(0.2);

            $pdf->Line($startX, $lineY, $endX, $lineY);
            $pdf->Cell(0, 33, 'LAPORAN HASIL BELAJAR', 0, 1, 'C');
            $pdf->SetFont('times', 'B', 11);
            $pdf->SetXY(14, 10);
            $pdf->Cell(0, 10, 'Nama Sekolah     :' . '   SMAK Kesuma Mataram', 0, 1);
            $pdf->SetXY(14, 15);
            $pdf->Cell(0, 10, 'Alamat                 :   ' .   'Jln. Pejanggik No. 110 Cakranegara', 0, 1);
            $pdf->SetXY(14, 20);
            $pdf->Cell(0, 10, 'Nama Lengkap   :   ' . $siswa->siswa->NamaLengkap, 0, 1);
            $pdf->SetXY(14, 25);
            $pdf->Cell(0, 10, 'NISN                    :   ' . $siswa->siswa->NISN, 0, 1);
            $pdf->SetXY(14, 30);
            $pdf->Cell(0, 10, 'Wali Kelas           :   ' . $siswa->datakelas->guru->Nama, 0, 1);
            $pdf->SetXY(125, 10);
            $pdf->Cell(0, 10, 'Kelas                      :  ' .   $siswa->datakelas->kelas->namakelas, 0, 1);
            $pdf->SetXY(125, 15);
            $pdf->Cell(0, 10, 'Fase                        :' . '  E', 0, 1);
            $pdf->SetXY(125, 20);
            $pdf->Cell(0, 10, 'Semester                :  ' .   $siswa->tahunakademik->semester, 0, 1);
            $pdf->SetXY(125, 25);
            $pdf->Cell(0, 10, 'Tahun Akademik :   ' .   $siswa->tahunakademik->tahunakademik, 0, 1);
            $pdf->SetXY(125, 30);
            $pdf->Cell(0, 10, 'Kurikulum            :   ' .   $siswa->tahunakademik->kurikulum->Nama_Kurikulum, 0, 1);


            // Mengatur posisi awal tabel pertama
            $startingY = 50;

            $pdf->SetXY(14, $startingY);
            $pdf->Cell(0, 10, 'A.   ' . 'Akademik', 0, 1);
            $pdf->SetFont('times', 'B', 10);
            $pdf->SetX(14);
            $pdf->Cell(10, 10, 'No', 1, 0, 'C');
            $pdf->Cell(60, 10, 'Mata Pelajaran', 1, 0, 'C');
            $pdf->Cell(18, 10, 'Nilai Akhir', 1, 0, 'C');
            $pdf->Cell(93, 10, 'Capaian Kompetensi', 1, 1, 'C');
            $pdf->SetFont('times', '', 9);

            $no = 1;
            $cellHeight = 15;
            $fixedLineHeight = 5;

            foreach ($datamengajars as $datamengajar) {
                $pdf->SetX(14);

                $noOfLinesNo = ceil(strlen($no) / 3);
                $noOfLinesMatpel = ceil(strlen($datamengajar->datamengajar->matpel->MataPelajaran) / 10);
                $noOfLinesNilai = ceil(strlen($datamengajar->nilaitotal) / 5);
                $maxNoOfLines = max($noOfLinesNo, $noOfLinesMatpel, $noOfLinesNilai);

                $pdf->Cell(10, $cellHeight, $no, 1, 0, 'C');
                $pdf->Cell(60, $cellHeight, $datamengajar->datamengajar->matpel->MataPelajaran, 1, 0, 'C');
                $pdf->Cell(18, $cellHeight, $datamengajar->nilaitotal, 1, 0, 'C');
                $pdf->MultiCell(93, $fixedLineHeight, $datamengajar->keterangan, 1, 'J');

                $no++;
            }

            // Menghitung tinggi tabel pertama
            $tabelPertamaHeight = $pdf->GetY() - $startingY;

            // Mengatur posisi awal tabel kedua berdasarkan tinggi tabel pertama
            $startingY += $tabelPertamaHeight + 5; // Beri jarak antar tabel

            $pdf->SetXY(14, $startingY);
            $pdf->SetFont('times', 'B', 10);
            $pdf->Cell(0, 10, 'B.' . 'Ekstrakulikuler', 0, 1);
            $pdf->SetXY(14, $startingY + 13); // Atur posisi untuk header kolom
            $pdf->SetFont('times', 'B', 10);
            $pdf->Cell(10, 10, 'No', 1, 0, 'C');
            $pdf->Cell(60, 10, 'Ekstrakulikuler', 1, 0, 'C');
            $pdf->Cell(18, 10, 'Predikat', 1, 0, 'C');
            $pdf->Cell(93, 10, 'Deskripsi', 1, 1, 'C');
            $pdf->SetFont('times', '', 9);

            $no = 1;
            $cellHeight = 15;
            $fixedLineHeight = 5;

            foreach ($ekstragurus as $ekstraguru) {
                $pdf->SetX(14);
                $noOfLinesNo = ceil(strlen($no) / 3);
                $noOfLinesEkskul = ceil(strlen($ekstraguru->ekstraguru->ekskul->namaekskul) / 10);
                $noOfLinesPredikat = ceil(strlen($ekstraguru->predikat) / 5);
                $maxNoOfLines = max($noOfLinesNo, $noOfLinesEkskul, $noOfLinesPredikat);
                $pdf->Cell(10, $cellHeight, $no, 1, 0, 'C');
                $pdf->Cell(60, $cellHeight, $ekstraguru->ekstraguru->ekskul->namaekskul, 1, 0, 'C');
                $pdf->Cell(18, $cellHeight, $ekstraguru->predikat, 1, 0, 'C');
                $pdf->MultiCell(93, $fixedLineHeight, $ekstraguru->keterangann, 1, 'L');
                $no++;
            }

            // Menghitung tinggi tabel kedua
            $tabelKeduaHeight = $pdf->GetY() - $startingY;
            $startingY += $tabelKeduaHeight + 5;

            $pdf->SetXY(14, $startingY);
            $pdf->SetFont('times', 'B', 10);
            $pdf->Cell(0, 10, 'C.' . 'Prestasi', 0, 1);
            $pdf->SetXY(14, $startingY + 13); // Atur posisi untuk header kolom
            $pdf->SetFont('times', 'B', 10);
            $pdf->Cell(10, 10, 'No', 1, 0, 'C');
            $pdf->Cell(60, 10, 'Jenis Kegiatan', 1, 0, 'C');
            $pdf->Cell(111, 10, 'Deskripsi', 1, 1, 'C');
            $pdf->SetFont('times', '', 9);

            $no = 1;
            $cellHeight = 15;
            $fixedLineHeight = 5;


            foreach ($prestasis as $prestasi) {
                $pdf->SetX(14);
                $noOfLinesNo = ceil(strlen($no) / 3);
                $noOfLinesPrestasi = ceil(strlen($prestasi->prestasi) / 10);
                $noOfLinesKeterangan = ceil(strlen($prestasi->keterangan) / 5);
                $maxNoOfLines = max($noOfLinesNo, $noOfLinesPrestasi, $noOfLinesKeterangan);
                $pdf->Cell(10, $cellHeight, $no, 1, 0, 'C');
                if ($prestasi->count() > 0) {
                    // Jika ada data, tampilkan nilai prestasi
                    $pdf->Cell(60, $cellHeight, strval($prestasi->prestasi), 1, 0, 'C');
                } else {
                    // Jika tidak ada data, tampilkan "Tidak ada"
                    $pdf->Cell(60, $cellHeight, 'Tidak ada', 1, 0, 'C');
                }

                // $pdf->Cell(60, $cellHeight, $prestasi->prestasi, 1, 0, 'C');

                $pdf->MultiCell(111, $fixedLineHeight, $prestasi->keterangan, 1, 'J');
                $no++;
            }


            // Mendapatkan tinggi tabel sebelumnya
            $tabelKetigaHeight = $pdf->GetY() - $startingY;
            $startingY += $tabelKetigaHeight + 5;

            // Menetapkan posisi untuk judul catatan wali kelas
            $pdf->SetXY(14, $startingY);
            $pdf->SetFont('times', 'B', 10);
            $pdf->Cell(0, 10, 'D. Catatan Wali Kelas', 0, 1);

            // Menetapkan posisi untuk header tabel catatan wali kelas
            $headerX = 14;
            $headerY = $startingY + 13;
            $pdf->SetXY($headerX, $headerY);
            $pdf->SetFont('times', 'B', 10);
            $pdf->Cell(10, 10, 'No', 1, 0, 'C');
            $pdf->Cell(171, 10, 'Catatan Wali Kelas', 1, 1, 'C');

            $pdf->SetFont('times', '', 9);

            $cellHeight = 15;

            // Menggambar isi tabel
            foreach ($tbsiswas as $index => $tbsiswa) {
                $pdf->SetX($headerX);
                $pdf->Cell(10, $cellHeight, $index + 1, 1, 0, 'C'); // Nomor urutan
                $pdf->Cell(171, $cellHeight, $tbsiswa->catatan, 1, 1, 'J'); // Catatan wali kelas
            }

            // Mendapatkan tinggi tabel terakhir
            $tabelKeempatHeight = $pdf->GetY() - $startingY;
            // Menghitung tinggi tabel keempat
            $startingY += $tabelKeempatHeight + 5;

            $pdf->SetXY(14, $startingY);
            $pdf->SetFont('times', 'B', 10);
            $pdf->Cell(0, 10, 'E. Ketidakhadiran', 0, 1);
            $pdf->SetXY(14, $startingY + 13); // Atur posisi untuk header kolom
            $pdf->SetFont('times', 'B', 10);

            // Tetapkan lebar yang sama untuk setiap kolom
            $columnWidth = 18;
            $pdf->Cell($columnWidth, 10, 'Izin', 1, 0, 'C');
            $pdf->Cell($columnWidth, 10, 'Sakit', 1, 0, 'C');
            $pdf->Cell($columnWidth, 10, 'TK', 1, 1, 'C');
            $pdf->SetFont('times', '', 9);

            $cellHeight = 10;
            $fixedLineHeight = 5;

            foreach ($tbsiswas as $index => $tbsiswa) {
                $pdf->SetX(14);
                $noOfLinesIzin = ceil(strlen($tbsiswa->izin) / 3);
                $noOfLinesSakit = ceil(strlen($tbsiswa->sakit) / 10);
                $noOfLinesTanpaKeterangan = ceil(strlen($tbsiswa->tk) / 10);

                $maxNoOfLines = max($noOfLinesIzin, $noOfLinesSakit, $noOfLinesTanpaKeterangan);
                $pdf->Cell($columnWidth, $cellHeight * $maxNoOfLines, $tbsiswa->izin . ' Hari ', 1, 0, 'C');
                $pdf->Cell($columnWidth, $cellHeight * $maxNoOfLines, $tbsiswa->sakit . ' Hari ', 1, 0, 'C');
                $pdf->MultiCell($columnWidth, $cellHeight * $maxNoOfLines, $tbsiswa->tk . ' Hari ', 1, 'C');
            }
            $tabelKelimaHeight = $pdf->GetY() - $startingY;
            $startingY += $tabelKelimaHeight + 5;
            $pdf->SetXY(28, $startingY);
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(0, 10, 'Orang Tua/Wali,', 0, 0, 'L');
            $pdf->Cell(0, 10, 'Mataram, ' . date('d-m-Y'), 0, 1, 'R');
            // $pdf->Cell(-4, 10, 'Mataram, ' . date('d-m-Y'), 0, 1, 'R');
            $pdf->Cell(0, 1, 'Wali Kelas,', 0, 0, 'R');

            $pdf->SetFont('times', 'BU', 12);
            $pdf->Cell(0, 50, $siswa->datakelas->guru->Nama, 0, 0, 'R');
            $tabelKeenamHeight = $pdf->GetY() - $startingY;
            $startingY += $tabelKeenamHeight + 20;
            $pdf->SetFont('times', '', 12);
            $pdf->SetXY(14, $startingY);
            $pdf->Cell(0, 10, '___________________________', 0, 0, 'L');
            $tabelKetujuHeight = $pdf->GetY() - $startingY;
            $startingY += $tabelKetujuHeight + 20;
            $pdf->SetXY(14, $startingY);
            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(0, 10, 'Mengetahui,', 0, 0, 'C');
            $startingY += $tabelKetujuHeight + 5;
            $pdf->SetXY(14, $startingY);

            // Tambahkan teks kepala sekolah
            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(0, 10, 'Kepala SMAK Kesuma Mataram', 0, 1, 'C');
            $startingY += $tabelKetujuHeight + 25;
            $pdf->SetXY(14, $startingY);

            $pdf->SetFont('times', 'BU', 12);
            $nama_guru = tbguru::where('TugasMengajar', 'Kepala Sekolah')->pluck('Nama')->toArray();
            $hakakses = implode(", ", $nama_guru);
            $pdf->Cell(0, 10, $hakakses, 0, 1, 'C');

            $outputPdfPath = storage_path('app/public/nilaisiswa/nilai_' . $siswa->siswa->NamaLengkap . '_document.pdf');

            $pdf->Output($outputPdfPath, 'F');
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment;filename="' . basename($outputPdfPath) . '"',
                'Cache-Control' => 'max-age=0',
            ];
            return response()->download($outputPdfPath, basename($outputPdfPath), $headers);
        } catch (\Exception $e) {
            return redirect()->route('inputnilaiguru.index')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    public function simpanNilai(Request $request, $siswa_id)
    {
        // dd($request->all());
        

        if (!empty($request->siswa_id)) {
            foreach ($request->datamengajar_id as $key => $datamengajar_id) {
                $nilai = SiswaMengajar::where('datamengajar_id', $datamengajar_id)->first();
                
                if ($nilai) {
                    $nilai->update([                'nilaitugas1' => $request->nilaitugas1[$key],
                        'nilaitugas2' => $request->nilaitugas2[$key],
                        'nilaitugas3' => $request->nilaitugas3[$key],
                        'nilaitugas4' => $request->nilaitugas4[$key],
                        'nilaitugas5' => $request->nilaitugas5[$key],
                        'nilaitugas' => $request->nilaitugas[$key],
                        'nilaiuts' => $request->nilaiuts[$key],
                        'nilaiuas' => $request->nilaiuas[$key],
                        'nilaikeaktifan' => $request->nilaikeaktifan[$key],
                        'nilaitotal' => $request->nilaitotal[$key],
                        'keterangan' => $request->keterangan[$key],
                    ]);
                }
            }
        }
        if (!empty($request->ekstra_guru_id)) {
            if ($request->ekstra_guru_id !== null) {
                foreach ($request->ekstra_guru_id as $key => $ekstra_guru_id) {
                    $nilai1 = siswaekstraguru::where('siswa_id', $siswa_id)
                        ->where('ekstra_guru_id', $ekstra_guru_id)
                        ->first();
                    if ($nilai1) {
                        $predikat = isset($request->predikat[$key]) ? $request->predikat[$key] : null;
                        $keterangann = isset($request->keterangann[$key]) ? $request->keterangann[$key] : null;
                        $nilai1->update([
                            'predikat' => $predikat,
                            'keterangann' => $keterangann,
                        ]);
                    }
                }
            }
        }
        if (is_array($request->siswa_id)) {
            foreach ($request->siswa_id as $key => $siswa_id) {
                $nilai2 = tbsiswa::where('siswa_id', $siswa_id)->first();
                if ($nilai2) {
                    $nilai2->update([
                        'izin' => $request->izin[$key],
                        'sakit' => $request->sakit[$key],
                        'tk' => $request->tk[$key],
                        'catatan' => $request->catatan[$key],
                    ]);
                }
            }
        } else {
         
        }
        
        return redirect()->back()->with('success', 'Data nilai berhasil disimpan!');
    }
    public function simpanNilaimatpel(Request $request, $datamengajar_id)
    {
        if (!empty($request->siswa_id)) {
            foreach ($request->siswa_id as $key => $siswa_id) {
                $nilai = SiswaMengajar::where('siswa_id', $siswa_id)
                    ->where('datamengajar_id', $datamengajar_id)
                    ->first();
                if ($nilai) {
                    $nilai->update([
                        'nilaitugas1' => $request->nilaitugas1[$key],
                        'nilaitugas2' => $request->nilaitugas2[$key],
                        'nilaitugas3' => $request->nilaitugas3[$key],
                        'nilaitugas4' => $request->nilaitugas4[$key],
                        'nilaitugas5' => $request->nilaitugas5[$key],
                        'nilaitugas' => $request->nilaitugas[$key],
                        'nilaiuts' => $request->nilaiuts[$key],
                        'nilaiuas' => $request->nilaiuas[$key],
                        'nilaikeaktifan' => $request->nilaikeaktifan[$key],
                        'nilaitotal' => $request->nilaitotal[$key],
                        'keterangan' => $request->keterangan[$key],
                    ]);
                }
            }
        }
        return redirect()->back()->with('success', 'Data nilai berhasil disimpan!');
    }

    public function indexsiswa(Request $request)
    {

      
        $user = Auth::user();

        // Mengambil siswa_id dari user yang sedang login
        $siswaId = $user->siswa_id;

        $siswa = SiswaMengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
            ->where('siswa_id', $siswaId)
            ->first();
        $hakakses = tbguru::where('TugasMengajar', 'Kepala Sekolah')->pluck('guru_id');
        if (!$siswa) {
            return redirect()->route('inputnilaiguru.index')->with('error', 'Siswa tidak ditemukan.');
        }
        $datamengajars = SiswaMengajar::where('siswa_id', $siswaId)->get();
        $datamengajar_ids = [];
        foreach ($datamengajars as $datamengajar) {
            $datamengajar_ids[$datamengajar->datamengajar_id] = [
                'datamengajar_id' => $datamengajar->datamengajar_id,
                'MataPelajaran' => $datamengajar->datamengajar->matpel->MataPelajaran,
                'KKM' => $datamengajar->datamengajar->matpel->KKM,
                'nilaitugas1' => $datamengajar->nilaitugas1,
                'nilaitugas2' => $datamengajar->nilaitugas2,
                'nilaitugas3' => $datamengajar->nilaitugas3,
                'nilaitugas4' => $datamengajar->nilaitugas4,
                'nilaitugas5' => $datamengajar->nilaitugas5,
                'nilaitugas' => $datamengajar->nilaitugas,
                'nilaiuts' => $datamengajar->nilaiuts,
                'nilaiuas' => $datamengajar->nilaiuas,
                'nilaikeaktifan' => $datamengajar->nilaikeaktifan,
                'nilaitotal' => $datamengajar->nilaitotal,
                'keterangan' => $datamengajar->keterangan,
            ];
        }
        return view('nilai-ku.index', compact('hakakses', 'siswa', 'datamengajar_ids', 'datamengajars'));
    }
    // public function showSiswa(Request $request, $siswa_id = null)
    // {
    //     $siswa = SiswaMengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
    //         ->where('siswa_id', $siswa_id)
    //         ->first();
    //     $hakakses = tbguru::where('TugasMengajar', 'Kepala Sekolah')->pluck('guru_id');


    //     if (!$siswa) {
    //         return redirect()->route('inputnilaiguru.index')->with('error', 'Siswa tidak ditemukan.');
    //     }
    //     $datamengajars = SiswaMengajar::where('siswa_id', $siswa_id)->get();
    //     $datamengajar_ids = [];
    //     foreach ($datamengajars as $datamengajar) {
    //         if ($datamengajar->datamengajar->guru_id == Auth::id()) {
    //             $datamengajar_ids[$datamengajar->datamengajar_id] = [
    //                 'datamengajar_id' => $datamengajar->datamengajar_id,
    //                 'MataPelajaran' => $datamengajar->datamengajar->matpel->MataPelajaran,
    //                 'nilaitugas1' => $datamengajar->nilaitugas1,
    //                 'nilaitugas2' => $datamengajar->nilaitugas2,
    //                 'nilaitugas3' => $datamengajar->nilaitugas3,
    //                 'nilaitugas4' => $datamengajar->nilaitugas4,
    //                 'nilaitugas5' => $datamengajar->nilaitugas5,
    //                 'nilaitugas' => $datamengajar->nilaitugas,
    //                 'nilaiuts' => $datamengajar->nilaiuts,
    //                 'nilaiuas' => $datamengajar->nilaiuas,
    //                 'nilaikeaktifan' => $datamengajar->nilaikeaktifan,
    //                 'nilaitotal' => $datamengajar->nilaitotal,
    //                 'keterangan' => $datamengajar->keterangan,
    //             ];
    //         }
    //     }
    //     $ekstragurus = SiswaEkstraGuru::with(['ekstraguru.ekskul'])->where('siswa_id', $siswa_id)->get();
    //     $ekstra_guru_ids = [];
    //     foreach ($ekstragurus as $ekstraguru) {
    //         if ($ekstraguru->ekstraguru->guru_id == Auth::id()) {
    //             $ekstra_guru_ids[$ekstraguru->ekstra_guru_id] = [
    //                 'ekstra_guru_id' => $ekstraguru->ekstra_guru_id,
    //                 'namaekskul' => $ekstraguru->ekstraguru->ekskul->namaekskul,
    //                 'predikat' => $ekstraguru->predikat,
    //                 'keterangann' => $ekstraguru->keterangann,
    //             ];
    //         }
    //     }
    //     $guruId = Auth::id();
    //     $tbsiswas = Tbsiswa::whereHas('kelas', function ($query) use ($guruId) {
    //         $query->whereHas('datakelas', function ($subquery) use ($guruId) {
    //             $subquery->where('guru_id', $guruId);
    //         });
    //     })
    //         ->where('siswa_id', $siswa_id)
    //         ->get();
    //     $siswa_ids = $tbsiswas->mapWithKeys(function ($tbsiswa) {
    //         return [
    //             $tbsiswa->siswa_id => [
    //                 'izin' => $tbsiswa->izin,
    //                 'sakit' => $tbsiswa->sakit,
    //                 'tk' => $tbsiswa->tk,
    //                 'catatan' => $tbsiswa->catatan,
    //             ]
    //         ];
    //     });
    //     $prestasis = prestasi::where('siswa_id', $siswa_id)->get();
    //     $prestasiData = [];
    //     foreach ($prestasis as $prestasi) {
    //         $prestasiData[] = [
    //             'prestasi' => $prestasi->prestasi,
    //             'keterangan' => $prestasi->keterangan
    //         ];
    //     }
    //     return view('inputnilaiall.index', compact('hakakses', 'siswa', 'ekstra_guru_ids', 'siswa_ids', 'tbsiswas', 'datamengajar_ids', 'ekstragurus', 'prestasis', 'prestasiData', 'datamengajars'));
    // }


    public function viewSiswaByDatamengajar(Request $request)
    {
        $encodedId = $request->encodedId;
        $datamengajar_id = base64_decode($encodedId);

        if (!$datamengajar_id) {
            // Handle error if decoding fails
            return redirect()->back()->with('error', 'Invalid data');
        }

        // Mengambil data mengajar dengan relasi yang diperlukan
        $datamengajar = SiswaMengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
            ->where('datamengajar_id', $datamengajar_id)
            ->first();

        if (!$datamengajar) {
            // Handle error if no data found
            return redirect()->back()->with('error', 'Data not found');
        }

        // Mengambil semua data mengajar terkait dengan datamengajar_id
        $datamengajars = SiswaMengajar::where('datamengajar_id', $datamengajar_id)->get();

        $siswa_ids = [];
        foreach ($datamengajars as $datamengajar) {
            $siswa_ids[$datamengajar->siswa_id] = [
                'siswa_id' => $datamengajar->siswa_id,
                'NamaLengkap' => $datamengajar->siswa->NamaLengkap,
                'nilaitugas1' => $datamengajar->nilaitugas1,
                'nilaitugas2' => $datamengajar->nilaitugas2,
                'nilaitugas3' => $datamengajar->nilaitugas3,
                'nilaitugas4' => $datamengajar->nilaitugas4,
                'nilaitugas5' => $datamengajar->nilaitugas5,
                'nilaitugas' => $datamengajar->nilaitugas,
                'nilaiuts' => $datamengajar->nilaiuts,
                'nilaiuas' => $datamengajar->nilaiuas,
                'nilaikeaktifan' => $datamengajar->nilaikeaktifan,
                'nilaitotal' => $datamengajar->nilaitotal,
                'keterangan' => $datamengajar->keterangan,
            ];
        }

        return view('nilaisiswa.index', compact('datamengajar', 'datamengajars', 'siswa_ids'));
    }

    public function viewSiswaBySiswa(Request $request)
    {
        $encodedId = $request->encodedId;
        $siswa_id = base64_decode($encodedId);

        if (!$siswa_id) {
            // Handle error if decoding fails
            return redirect()->back()->with('error', 'Invalid data');
        }

        // Mengambil data mengajar dengan relasi yang diperlukan
        $siswa = SiswaMengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
            ->where('siswa_id', $siswa_id)
            ->first();

        if (!$siswa) {
            // Handle error if no data found
            return redirect()->back()->with('error', 'Data not found');
        }

        // Mengambil semua data mengajar terkait dengan datamengajar_id
        $siswas = SiswaMengajar::where('siswa_id', $siswa_id)->get();

        $datamengajar_ids = [];
        foreach ($siswas as $siswa) {
            $datamengajar_ids[$siswa->datamengajar_id] = [
                'datamengajar_id' => $siswa->datamengajar_id,
                'MataPelajaran' => $siswa->datamengajar->matpel->MataPelajaran,
                'KKM' => $siswa->datamengajar->matpel->KKM,
                'nilaitugas1' => $siswa->nilaitugas1,
                'nilaitugas2' => $siswa->nilaitugas2,
                'nilaitugas3' => $siswa->nilaitugas3,
                'nilaitugas4' => $siswa->nilaitugas4,
                'nilaitugas5' => $siswa->nilaitugas5,
                'nilaitugas' => $siswa->nilaitugas,
                'nilaiuts' => $siswa->nilaiuts,
                'nilaiuas' => $siswa->nilaiuas,
                'nilaikeaktifan' => $siswa->nilaikeaktifan,
                'nilaitotal' => $siswa->nilaitotal,
                'keterangan' => $siswa->keterangan,
            ];
        }
        $ekstragurus = SiswaEkstraGuru::with(['ekstraguru.ekskul'])->where('siswa_id', $siswa_id)->get();
        $ekstra_guru_ids = [];
        foreach ($ekstragurus as $ekstraguru) {
            $ekstra_guru_ids[$ekstraguru->ekstra_guru_id] = [
                'ekstra_guru_id' => $ekstraguru->ekstra_guru_id,
                'namaekskul' => $ekstraguru->ekstraguru->ekskul->namaekskul,
                'predikat' => $ekstraguru->predikat,
                'keterangann' => $ekstraguru->keterangann,
            ];
        }
        $tbsiswas = tbsiswa::where('siswa_id', $siswa_id)->get();
        $siswa_ids = [];
        foreach ($tbsiswas as $tbsiswa) {
            $siswa_ids[$tbsiswa->siswa_id] = [
                'siswa_id' => $tbsiswa->siswa_id,
                'NamaLengkap' => $tbsiswa->NamaLengkap,
                'izin' => $tbsiswa->izin,
                'sakit' => $tbsiswa->sakit,
                'tk' => $tbsiswa->tk,
                'catatan' => $tbsiswa->catatan,
            ];
        }
        $prestasis = prestasi::where('siswa_id', $siswa_id)->get();
        $prestasiData = [];
        foreach ($prestasis as $prestasi) {
            $prestasiData[] = [
                'prestasi' => $prestasi->prestasi,
                'keterangan' => $prestasi->keterangan
            ];
        }

        return view('inputnilaiall.index', compact('siswa', 'siswas', 'datamengajar_ids','ekstra_guru_ids', 'siswa_ids', 'tbsiswas', 'ekstragurus', 'prestasis', 'prestasiData'));
    }
    // public function showSiswa1($siswa_id)
    // {
    //     $siswa = SiswaMengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
    //         ->where('siswa_id', $siswa_id)
    //         ->first();
    //     if (!$siswa) {
    //         return redirect()->route('inputnilaispc.index')->with('error', 'Siswa tidak ditemukan.');
    //     }
    //     $datamengajars = SiswaMengajar::where('siswa_id', $siswa_id)->get();
    //     $datamengajar_ids = [];
    //     foreach ($datamengajars as $datamengajar) {
    //         $datamengajar_ids[$datamengajar->datamengajar_id] = [
    //             'datamengajar_id' => $datamengajar->datamengajar_id,
    //             'MataPelajaran' => $datamengajar->datamengajar->matpel->MataPelajaran,
    //             'nilaitugas1' => $datamengajar->nilaitugas1,
    //             'nilaitugas2' => $datamengajar->nilaitugas2,
    //             'nilaitugas3' => $datamengajar->nilaitugas3,
    //             'nilaitugas4' => $datamengajar->nilaitugas4,
    //             'nilaitugas5' => $datamengajar->nilaitugas5,
    //             'nilaitugas' => $datamengajar->nilaitugas,
    //             'nilaiuts' => $datamengajar->nilaiuts,
    //             'nilaiuas' => $datamengajar->nilaiuas,
    //             'nilaikeaktifan' => $datamengajar->nilaikeaktifan,
    //             'nilaitotal' => $datamengajar->nilaitotal,
    //             'keterangan' => $datamengajar->keterangan,
    //         ];
    //     }
    //     $ekstragurus = SiswaEkstraGuru::with(['ekstraguru.ekskul'])->where('siswa_id', $siswa_id)->get();
    //     $ekstra_guru_ids = [];
    //     foreach ($ekstragurus as $ekstraguru) {
    //         $ekstra_guru_ids[$ekstraguru->ekstra_guru_id] = [
    //             'ekstra_guru_id' => $ekstraguru->ekstra_guru_id,
    //             'namaekskul' => $ekstraguru->ekstraguru->ekskul->namaekskul,
    //             'predikat' => $ekstraguru->predikat,
    //             'keterangann' => $ekstraguru->keterangann,
    //         ];
    //     }
    //     $tbsiswas = tbsiswa::where('siswa_id', $siswa_id)->get();
    //     $siswa_ids = [];
    //     foreach ($tbsiswas as $tbsiswa) {
    //         $siswa_ids[$tbsiswa->siswa_id] = [
    //             'siswa_id' => $tbsiswa->siswa_id,
    //             'NamaLengkap' => $tbsiswa->NamaLengkap,
    //             'izin' => $tbsiswa->izin,
    //             'sakit' => $tbsiswa->sakit,
    //             'tk' => $tbsiswa->tk,
    //             'catatan' => $tbsiswa->catatan,
    //         ];
    //     }
    //     $prestasis = prestasi::where('siswa_id', $siswa_id)->get();
    //     $prestasiData = [];
    //     foreach ($prestasis as $prestasi) {
    //         $prestasiData[] = [
    //             'prestasi' => $prestasi->prestasi,
    //             'keterangan' => $prestasi->keterangan
    //         ];
    //     }
    //     return view('inputnilaiall.index', compact('datamengajar_ids', 'siswa', 'ekstra_guru_ids', 'siswa_ids', 'tbsiswas', 'ekstragurus', 'prestasis', 'prestasiData'));
       
    // }
    
    public function store(Request $request)
    {
        try {

            // dd($request->all());
            $datakelas = Datakelas::find($request->input('datakelas_id'));
            $kelasIdDatakelas = $datakelas->kelas->kelas_id;

$siswa_id = tbsiswa::whereHas('kelas', function ($query) use ($kelasIdDatakelas) {
    $query->where('kelas_id', $kelasIdDatakelas);
})->pluck('siswa_id');
            if (empty($siswa_id)) {
                return Redirect::back()->with('error', 'Tidak ada siswa terdaftar dalam kelas ini.');
            }
            $datamengajarIds = $request->input('datamengajar_id');
            if (!$datamengajarIds || !is_array($datamengajarIds) || count($datamengajarIds) == 0) {
                return Redirect::back()->with('error', 'Tidak ada mata pelajaran yang dipilih.');
            }
            DB::beginTransaction();
            try {
                foreach ($datamengajarIds as $datamengajarId) {
                    $existingEntry = DatakelasDatamengajar::where('datakelas_id', $datakelas->datakelas_id)
                        ->where('datamengajar_id', $datamengajarId)
                        ->exists();
                    if (!$existingEntry) {
                        $datakelasDatamengajar = new DatakelasDatamengajar();
                        $datakelasDatamengajar->datakelas_id = $datakelas->datakelas_id;
                        $datakelasDatamengajar->datamengajar_id = $datamengajarId;
                        $datakelasDatamengajar->save();
                        foreach ($siswa_id as $siswaId) {
                            $siswaMengajar = new SiswaMengajar();
                            $siswaMengajar->siswa_id = $siswaId;
                            $siswaMengajar->datakelas_id = $datakelas->datakelas_id;
                            $siswaMengajar->tahunakademik_id = $datakelas->tahunakademik_id;
                            $siswaMengajar->kurikulum_id = $datakelas->tahun->kurikulum->kurikulum_id;
                            $siswaMengajar->datamengajar_id = $datamengajarId;
                            $siswaMengajar->nilaitugas = 0;
                            $siswaMengajar->nilaitugas1 = 0;
                            $siswaMengajar->nilaitugas2 = 0;
                            $siswaMengajar->nilaitugas3 = 0;
                            $siswaMengajar->nilaitugas4 = 0;
                            $siswaMengajar->nilaitugas5 = 0;
                            $siswaMengajar->nilaiuts = 0;
                            $siswaMengajar->nilaiuas = 0;
                            $siswaMengajar->nilaikeaktifan = 0;
                            $siswaMengajar->nilaitotal = 0;
                            $siswaMengajar->save();
                        }
                        // foreach ($siswa_id as $siswaId) {
                        //     $siswaMengajar = new SiswaMengajar();
                        //     $siswaMengajar->siswa_id = $siswaId;
                        //     $siswaMengajar->datakelas_id = $datakelas->datakelas_id;
                        //     $siswaMengajar->tahunakademik_id = $datakelas->tahunakademik_id;
                        //     $siswaMengajar->kurikulum_id = $datakelas->tahun->kurikulum->kurikulum_id;
                        //     $siswaMengajar->datamengajar_id = $datamengajarId;
                        //     $siswaMengajar->nilaitugas = 0;
                        //     $siswaMengajar->nilaitugas1 = 0;
                        //     $siswaMengajar->nilaitugas2 = 0;
                        //     $siswaMengajar->nilaitugas3 = 0;
                        //     $siswaMengajar->nilaitugas4 = 0;
                        //     $siswaMengajar->nilaitugas5 = 0;
                        //     $siswaMengajar->nilaiuts = 0;
                        //     $siswaMengajar->nilaiuas = 0;
                        //     $siswaMengajar->nilaikeaktifan = 0;
                        //     $siswaMengajar->nilaitotal = 0;
                        //     if ($siswaMengajar->save()) {
                        //         dd('save successful');
                        //     } else {
                        //         dd('save failed');
                        //     }
                        // }
                        
                    }
                }
                DB::commit();
                return Redirect::route('datakelasadmin.index')->with('success', 'Data berhasil disimpan.');
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
            $datakelas = datakelas::findOrFail($kelasId);
            $namakelas = $datakelas->kelas->namakelas;
            $namaGuru = $datakelas->guru->Nama;
            $tahunakademik = $datakelas->tahun->tahunakademik;
            $semester = $datakelas->tahun->semester;

            $siswaIds = tbsiswa::where('kelas_id', $datakelas->kelas->kelas_id)->pluck('siswa_id')->toArray();
            $kopSuratPath = storage_path('app/public/kop/KOP[1].pdf');
            $outputPdfPath = storage_path('app/public/absensi/Absensi_Kelas' . $namakelas . '_document.pdf');
            $tempPath = storage_path('app/public/absensi/temp_kop_surat.pdf');
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
            $lebarNamaSiswa = ($lebarHalaman - $lebarNo - 70) * 0.6;
            $lebarTandaTangan = ($lebarHalaman - $lebarNo - -142) * 0.3;
            $pdf->Cell($lebarNo, $cellHeight, 'No', 1, 0, 'C');
            $pdf->Cell($lebarNamaSiswa, $cellHeight, 'Nama Siswa', 1, 0, 'C');
            $pdf->Cell($lebarTandaTangan, $cellHeight, 'Tanda Tangan', 1, 1, 'C');
            $pdf->SetFont('times', '', 12);
            $nomorUrut = 1;
            foreach ($siswaIds as $siswaId) {
                $siswa = tbsiswa::where('siswa_id', $siswaId)->first();
                $pdf->Cell($lebarNo, $cellHeight, $nomorUrut++, 1, 0, 'C');
                $pdf->Cell($lebarNamaSiswa, $cellHeight, $siswa ? $siswa->NamaLengkap : 'Nama tidak ditemukan', 1, 0, 'L');
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



    public function downloaddd($kelasId)
    {
        try {
            $datakelas = datakelas::findOrFail($kelasId);
            $namaGuru = $datakelas->guru->Nama;
            $namakelas = $datakelas->kelas->namakelas;
            $tahunakademik = $datakelas->tahun->tahunakademik;
            $semester = $datakelas->tahun->semester;
            $datamengajars = $datakelas->datamengajars()->orderBy('hari')->orderBy('time_start')->get();
            $kopSuratPath = storage_path('app/public/kop/KOP[1].pdf');
            $outputPdfPath = storage_path('app/public/jadwalkelas/Jadwal_Kelas' . $namakelas . '_document.pdf');
            $tempPath = storage_path('app/public/jadwalkelas/temp_kop_surat.pdf');
            copy($kopSuratPath, $tempPath);
            $pdf = new Fpdi();
            $pdf->setSourceFile($tempPath);
            $tplIdx = $pdf->importPage(1);
            $pdf->addPage('L'); // Lanskap
            $pdf->useTemplate($tplIdx, 38, 0);
            $pdf->SetFont('times', 'B', 14);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(20, 10);
            $pdf->Cell(0, 110, 'DAFTAR JADWAL PELAJARAN', 0, 1, 'C');
            $pdf->SetFont('times', '', 10);
            $pdf->SetXY(20, 60);
            $pdf->Cell(0, 10, 'Wali Kelas: ' . $namaGuru, 0, 1);
            $pdf->SetX(20);
            $pdf->Cell(0, 10, 'Kelas: ' . $namakelas, 0, 1);
            $pdf->SetXY(245, 60);
            $pdf->Cell(0, 10, 'Tahun Akademik: ' . $tahunakademik, 0, 1);
            $pdf->SetXY(245, 70);
            $pdf->Cell(0, 10, 'Semester: ' . $semester, 0, 1);
            $pdf->SetX(20);
            $pdf->SetFont('times', 'B', 10);
            $pdf->Cell(10, 10, 'No', 1, 0, 'C');
            $pdf->Cell(15, 10, 'Hari', 1, 0, 'C');
            $pdf->Cell(60, 10, 'Mata Pelajaran', 1, 0, 'C');
            $pdf->Cell(55, 10, 'Guru', 1, 0, 'C');
            $pdf->Cell(30, 10, 'Awal Pelajaran', 1, 0, 'C');
            $pdf->Cell(30, 10, 'Akhir Pelajaran', 1, 0, 'C');
            $pdf->Cell(30, 10, 'Awal Istirahat', 1, 0, 'C');
            $pdf->Cell(30, 10, 'Akhir Istirahat', 1, 1, 'C');
            $pdf->SetFont('times', '', 8);
            $no = 1;
            $cellHeight = 10;
            $y = $pdf->GetY();
            foreach ($datamengajars as $datamengajar) {
                $pdf->SetX(20);
                $pdf->Cell(10, $cellHeight, $no, 1, 0, 'C');
                // Isi tabel dengan data dari $datamengajar
                $pdf->Cell(15, $cellHeight, $datamengajar->hari, 1, 0, 'C');
                $pdf->Cell(60, $cellHeight, $datamengajar->matpel->MataPelajaran, 1, 0, 'C');
                $pdf->Cell(55, $cellHeight, $datamengajar->guru->Nama, 1, 0, 'C');
                $pdf->Cell(30, $cellHeight, $datamengajar->time_start, 1, 0, 'C');
                $pdf->Cell(30, $cellHeight, $datamengajar->time_end, 1, 0, 'C');
                $pdf->Cell(30, $cellHeight, $datamengajar->time_start1, 1, 0, 'C');
                $pdf->Cell(30, $cellHeight, $datamengajar->time_end1, 1, 1, 'C');
                $no++;
            }
            $marginLeft = 10;
            $pdf->SetFont('times', '', 10);
            $pdf->SetX($pdf->GetX() + $marginLeft);
            $pdf->Cell(0, $cellHeight, 'Mataram, ' . date('d-m-Y'), 0, 1, 'L');
            $marginTop = -5;
            $marginLeft = 10;
            $pdf->SetY($pdf->GetY() + $marginTop);
            $pdf->SetX($pdf->GetX() + $marginLeft);
            $pdf->Cell(0, $cellHeight, 'Wali Kelas', 0, 1, 'L');
            $marginBottom = 15;
            $marginLeft = 10;
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
            return redirect('/datakelasadmin')->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
}
