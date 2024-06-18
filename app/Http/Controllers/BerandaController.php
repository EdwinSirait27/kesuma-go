<?php
namespace App\Http\Controllers;
use App\Models\tbguru;
use App\Models\tbsiswa;
use App\Models\tbadmin;
use App\Models\tahunakademik;
use App\Models\buttonosis;
use App\Models\User;
use App\Models\listakunsiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
class BerandaController extends Controller
{
    public function index(Request $request)
    {
        $totalUser = User::all()->count();
        $totalUserAdminGuru = User::whereIn('hakakses', ['Admin', 'Guru'])->count();
        $totalUserSiswa = User::where('hakakses', 'Siswa')->count();
        $tahunAkademikAktif = tahunakademik::where('statusaktif', 'Aktif')->get();
    if ($tahunAkademikAktif->isEmpty()) {
        $pesan = 'Data';
    } else {
        $pesan = ''; 
    }
        $tahunAkademikAktiff = tahunakademik::where('statusaktif', 'Aktif')->pluck('semester');
    if ($tahunAkademikAktif->isEmpty()) {
        $pesan = 'Kosong';
    } else {
        $pesan = '';
    }
        $totalUsersiswa = User::all()->count();
        $totalLakiLaki = tbsiswa::where('status','Aktif')->where('JenisKelamin', 'Laki-Laki')->count();
    //     $availableYears = listakunsiswa::when($request->tahundaftar, function ($query) use ($request) {
    //         return $query->where('tahundaftar', $request->tahundaftar);
    //     })
    //     ->whereNotNull('tahundaftar')
    //     ->distinct()
    //     ->pluck('tahundaftar');
    
    // // Inisialisasi query untuk tbsiswa
    // $query = tbsiswa::query();

    // // Memfilter berdasarkan tahun daftar jika ada
    // if ($request->filled('tahundaftar')) {
    //     $query->whereHas('listakunsiswa', function ($query) use ($request) {
    //         $query->where('hakakses', 'NonSiswa')
    //               ->where('tahundaftar', $request->tahundaftar);
    //     });
    // } else {
    //     $query->whereHas('listakunsiswa', function ($query) {
    //         $query->where('hakakses', 'NonSiswa');
    //     });
    // }
    $availableYears = listakunsiswa::distinct()->whereNotNull('tahundaftar')->pluck('tahundaftar');
    
    // Inisialisasi query untuk tbsiswa
    $query = tbsiswa::query();
    
    // Filter berdasarkan tahun daftar jika ada
    if ($request->filled('tahundaftar')) {
        $query->whereHas('listakunsiswa', function ($query) use ($request) {
            $query->where('hakakses', 'NonSiswa')
                  ->where('tahundaftar', $request->tahundaftar);
        });

        $totalnon = listakunsiswa::where('hakakses', 'NonSiswa')
            ->where('tahundaftar', $request->tahundaftar)
            ->count();
    } else {
        $query->whereHas('listakunsiswa', function ($query) {
            $query->where('hakakses', 'NonSiswa');
        });

        $totalnon = listakunsiswa::where('hakakses', 'NonSiswa')->count();
    }
    $totallak = (clone $query)->where('JenisKelamin', 'Laki-laki')->count();
    $totalper = (clone $query)->where('JenisKelamin', 'Perempuan')->count();
    $totalkat = (clone $query)->where('Agama', 'Katolik')->count();
    $totalkris = (clone $query)->where('Agama', 'Kristen Protestan')->count();
    $totalbud = (clone $query)->where('Agama', 'Buddha')->count();
    $totalhin = (clone $query)->where('Agama', 'Hindu')->count();
    $totalko = (clone $query)->where('Agama', 'Konghucu')->count();
    $totalis = (clone $query)->where('Agama', 'Islam')->count();

        $totalPerempuan = tbsiswa::where('status','Aktif')->where('JenisKelamin', 'Perempuan')->count();
        $totalGuru = tbguru::count();
        $totalAgamaKatolik = tbsiswa::where('status','Aktif')->where('Agama', 'Katolik')->count();
        $totalAgamaKristenProtestan = tbsiswa::where('status','Aktif')->where('Agama', 'Kristen Protestan')->count();
        $totalAgamaIslam = tbsiswa::where('status','Aktif')->where('Agama', 'Islam')->count();
        $totalAgamaBuddha = tbsiswa::where('status','Aktif')->where('Agama', 'Buddha')->count();
        $totalAgamaHindu = tbsiswa::where('status','Aktif')->where('Agama', 'Hindu')->count();
        $totalAgamaKonghucu = tbsiswa::where('status','Aktif')->where('Agama', 'Konghucu')->count();
        $totalSiswa = $totalAgamaKatolik + $totalAgamaKristenProtestan + $totalAgamaIslam + $totalAgamaBuddha + $totalAgamaHindu + $totalAgamaKonghucu;
        $persentaseAgamaKatolik = round(($totalAgamaKatolik / $totalSiswa) * 100);
        $persentaseAgamaKristenProtestan = round(($totalAgamaKristenProtestan / $totalSiswa) * 100);
        $persentaseAgamaIslam = round(($totalAgamaIslam / $totalSiswa) * 100);
        $persentaseAgamaBuddha = round(($totalAgamaBuddha / $totalSiswa) * 100);
        $persentaseAgamaHindu = round(($totalAgamaHindu / $totalSiswa) * 100);
        $persentaseAgamaKonghucu = round(($totalAgamaKonghucu / $totalSiswa) * 100);
        $count = 0;
        if ($request->ajax()) {
            return response()->json([
                'totalnon' => $totalnon,
                'totallak' => $totallak,
                'totalper' => $totalper,
                'totalkat' => $totalkat,
                'totalkris' => $totalkris,
                'totalbud' => $totalbud,
                'totalhin' => $totalhin,
                'totalis' => $totalis,
                'totalko' => $totalko,
            ]);
        }
    
        $data = tbadmin::query();
        $data = $data->get();
        $isEmpty = $data->isEmpty();
        $buttonosis = buttonosis::where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->get();
               return view(
            'AdminBeranda.beranda',
            compact(
                'totalUser',
                'totalUserAdminGuru',
                'totalUserSiswa',
                'totalnon',
                'totallak',
                'totalper',
                'totalkat',
                'totalkris',
                'totalbud',
                'totalis',
                'totalhin',
                'totalko',
                'totalLakiLaki',
                'totalPerempuan',
                'totalGuru',
                'totalAgamaKatolik',
                'totalAgamaKristenProtestan',
                'totalAgamaIslam',
                'totalAgamaBuddha',
                'totalAgamaHindu',
                'totalAgamaKonghucu',
                'totalSiswa',
                'persentaseAgamaKatolik',
                'persentaseAgamaKristenProtestan',
                'persentaseAgamaIslam',
                'persentaseAgamaBuddha',
                'persentaseAgamaHindu',
                'persentaseAgamaKonghucu',
                'tahunAkademikAktif',
                'tahunAkademikAktiff',
                'data',
                'buttonosis',
                'isEmpty',
                'availableYears',
                'request' 
            )
        );
    }
    // public function index(Request $request)
    // {
    //     $totalUser = User::all()->count();
       

    //     $totalUserAdminGuru = User::whereIn('hakakses', ['Admin', 'Guru'])->count();
    //     $totalUserSiswa = User::where('hakakses', 'Siswa')->count();
    //     $tahunAkademikAktif = tahunakademik::where('statusaktif', 'Aktif')->get();
    // if ($tahunAkademikAktif->isEmpty()) {
    //     $pesan = 'Data';
    // } else {
    //     $pesan = ''; 
    // }
    //     $tahunAkademikAktiff = tahunakademik::where('statusaktif', 'Aktif')->pluck('semester');
    //      // Jika tidak ada tahun akademik yang aktif, berikan pesan 'anjay'
    // if ($tahunAkademikAktif->isEmpty()) {
    //     $pesan = 'Kosong';
    // } else {
    //     $pesan = ''; // Tidak perlu pesan jika ada tahun akademik aktif
    // }
    //     $totalUsersiswa = User::all()->count();
    //     $totalLakiLaki = tbsiswa::where('status','Aktif')->where('JenisKelamin', 'Laki-Laki')->count();
    //     $totalnon = listakunsiswa::where('hakakses','NonSiswa')->count();
    //     $query = tbsiswa::whereHas('listakunsiswa', function ($query) use ($request) {
    //         $query->where('hakakses', 'NonSiswa');
    //         if ($request->filled('tahundaftar')) {
    //             $query->where('tahundaftar', $request->tahundaftar);
    //         }
    //     });
    //     $totallak = tbsiswa::where('JenisKelamin', 'Laki_laki')
    //     ->whereHas('listakunsiswa', function ($query) {
    //         $query->where('hakakses', 'NonSiswa');
    //     })
    //     ->count();
    //     $totalper = tbsiswa::where('JenisKelamin', 'Perempuan')
    //     ->whereHas('listakunsiswa', function ($query) {
    //         $query->where('hakakses', 'NonSiswa');
    //     })
    //     ->count();
    //     $totalkat = tbsiswa::where('Agama', 'Katolik')
    //     ->whereHas('listakunsiswa', function ($query) {
    //         $query->where('hakakses', 'NonSiswa');
    //     })
    //     ->count();
    //     $totalkris = tbsiswa::where('Agama', 'Kristen Protestan')
    //     ->whereHas('listakunsiswa', function ($query) {
    //         $query->where('hakakses', 'NonSiswa');
    //     })
    //     ->count();
    //     $totalbud = tbsiswa::where('Agama', 'Buddha')
    //     ->whereHas('listakunsiswa', function ($query) {
    //         $query->where('hakakses', 'NonSiswa');
    //     })
    //     ->count();
    //     $totalhin = tbsiswa::where('Agama', 'Hindu')
    //     ->whereHas('listakunsiswa', function ($query) {
    //         $query->where('hakakses', 'NonSiswa');
    //     })
    //     ->count();
    //     $totalko = tbsiswa::where('Agama', 'Konghucu')
    //     ->whereHas('listakunsiswa', function ($query) {
    //         $query->where('hakakses', 'NonSiswa');
    //     })
    //     ->count();
       
    //     $totalis = tbsiswa::where('Agama', 'Islam')
    //     ->whereHas('listakunsiswa', function ($query) {
    //         $query->where('hakakses', 'NonSiswa');
    //     })
    //     ->count();
       
    
    //     $totalPerempuan = tbsiswa::where('status','Aktif')->where('JenisKelamin', 'Perempuan')->count();
    //     $totalGuru = tbguru::count();
    //     $totalAgamaKatolik = tbsiswa::where('status','Aktif')->where('Agama', 'Katolik')->count();
    //     $totalAgamaKristenProtestan = tbsiswa::where('status','Aktif')->where('Agama', 'Kristen Protestan')->count();
    //     $totalAgamaIslam = tbsiswa::where('status','Aktif')->where('Agama', 'Islam')->count();
    //     $totalAgamaBuddha = tbsiswa::where('status','Aktif')->where('Agama', 'Buddha')->count();
    //     $totalAgamaHindu = tbsiswa::where('status','Aktif')->where('Agama', 'Hindu')->count();
    //     $totalAgamaKonghucu = tbsiswa::where('status','Aktif')->where('Agama', 'Konghucu')->count();
    //     $totalSiswa = $totalAgamaKatolik + $totalAgamaKristenProtestan + $totalAgamaIslam + $totalAgamaBuddha + $totalAgamaHindu + $totalAgamaKonghucu;
    //     $persentaseAgamaKatolik = round(($totalAgamaKatolik / $totalSiswa) * 100);
    //     $persentaseAgamaKristenProtestan = round(($totalAgamaKristenProtestan / $totalSiswa) * 100);
    //     $persentaseAgamaIslam = round(($totalAgamaIslam / $totalSiswa) * 100);
    //     $persentaseAgamaBuddha = round(($totalAgamaBuddha / $totalSiswa) * 100);
    //     $persentaseAgamaHindu = round(($totalAgamaHindu / $totalSiswa) * 100);
    //     $persentaseAgamaKonghucu = round(($totalAgamaKonghucu / $totalSiswa) * 100);
    //     $count = 0;
    //     $data = tbadmin::query();
    //     $data = $data->get();
    //     $isEmpty = $data->isEmpty();
    //     $buttonosis = buttonosis::where('start_date', '<=', now())
    //     ->where('end_date', '>=', now())
    //     ->get();
    //            return view(
    //         'AdminBeranda.beranda',
    //         compact(
    //             'totalUser',
    //             'totalUserAdminGuru',
    //             'totalUserSiswa',
    //             'totalnon',
    //             'totallak',
    //             'totalper',
    //             'totalkat',
    //             'totalkris',
    //             'totalbud',
    //             'totalis',
    //             'totalhin',
    //             'totalko',
    //             'totalLakiLaki',
    //             'totalPerempuan',
    //             'totalGuru',
    //             'totalAgamaKatolik',
    //             'totalAgamaKristenProtestan',
    //             'totalAgamaIslam',
    //             'totalAgamaBuddha',
    //             'totalAgamaHindu',
    //             'totalAgamaKonghucu',
    //             'totalSiswa',
    //             'persentaseAgamaKatolik',
    //             'persentaseAgamaKristenProtestan',
    //             'persentaseAgamaIslam',
    //             'persentaseAgamaBuddha',
    //             'persentaseAgamaHindu',
    //             'persentaseAgamaKonghucu',
    //             'tahunAkademikAktif',
    //             'tahunAkademikAktiff',
    //             'data',
    //             'buttonosis',
    //             'isEmpty'
    //         )
    //     );
    // }
    
    public function index2(Request $request)
    {
        if ($request->ajax()) {
            // Mengambil data dari tbadmin dengan urutan created_at menurun
            $data = tbadmin::select('id', 'dokumen', 'created_at', 'oleh')
                           ->orderBy('created_at', 'desc')
                           ->get();
            
            foreach ($data as $entry) {
                $entry->formatted_created_at = Carbon::parse($entry->created_at)->format('d-m-Y H:i:s');
            }
            
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('AdminBeranda.download', $data->dokumen) . '" class="edit btn btn-primary btn-sm">Download</a>';
                    $previewButton = '';
                    if (pathinfo($data->dokumen, PATHINFO_EXTENSION) == 'jpg') {
                        $previewButton = '<button type="button" class="btn btn-secondary btn-sm btn-preview" data-dokumen="' . $data->dokumen . '">Preview</button>';
                    }
                    return $button . ' ' . $previewButton;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
    
        // Jika bukan permintaan ajax, menampilkan view dengan data terurut
        $data = tbadmin::select('id', 'dokumen', 'created_at', 'oleh')
                       ->orderBy('created_at', 'desc')
                       ->get();
        return view('AdminBeranda.beranda', compact('data'));
    }
    
        // public function index2(Request $request)
        // {
        //     if ($request->ajax()) {
        //         $data = tbadmin::select('id', 'dokumen', 'created_at','oleh')->get();
            
        //         foreach ($data as $entry) {
        //             $entry->formatted_created_at = Carbon::parse($entry->created_at)->format('d-m-Y H:i:s');
        //         }
        //         return Datatables::of($data)->addIndexColumn()
        //             ->addColumn('action', function ($data) {

        //                 $button = '<a href="' . route('AdminBeranda.download', $data->dokumen) . '" class="edit btn btn-primary btn-sm">Download</a>';
        //                 $previewButton = '';
        //                 if (pathinfo($data->dokumen, PATHINFO_EXTENSION) == 'jpg') {
        //                     $previewButton = '<button type="button" class="btn btn-secondary btn-sm btn-preview" data-dokumen="' . $data->dokumen . '">Preview</button>';

        //                 }
                        
        //                 return $button. ' ' . $previewButton;
        //             })
        //             ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id}}" />')
        //             ->rawColumns(['checkbox', 'action'])
        //             ->make(true);
        //     }

        //     return view('AdminBeranda.beranda',  compact('data'));
        // }
      

        public function preview($dokumen)
    {
        $path = storage_path('app/public/pengumuman/' . $dokumen);

        if (file_exists($path)) {
            return response()->file($path);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }
        // public function preview($dokumen)
        // {
        //     $path = storage_path('app/public/pengumuman/' . $dokumen);
        
        //     if (file_exists($path)) {
        //         $fileMimeType = mime_content_type($path);
        //         $headers = [
        //             'Content-Type' => $fileMimeType,
        //             'Content-Disposition' => 'inline; filename="' . $dokumen . '"'
        //         ];
        
        //         return response()->file($path, $headers);
        //     } else {
        //         abort(404, 'File not found');
        //     }
        // }
        
        
// public function preview($dokumen)
// {
//     // Logika untuk menangani pratinjau file, misalnya dengan mengarahkan ke halaman view khusus
//     $path = storage_path('app/public/pengumuman/' . $dokumen);

//     if (file_exists($path)) {
//         return response()->file($path);
//     } else {
//         abort(404);
//     }
// }



//         namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\tbadmin;
// use Carbon\Carbon;
// use DataTables;

// class AdminController extends Controller
// {
//     public function index2(Request $request)
//     {
//         if ($request->ajax()) {
//             $data = tbadmin::select('id', 'dokumen', 'created_at', 'oleh')->get();

//             foreach ($data as $entry) {
//                 $entry->formatted_created_at = Carbon::parse($entry->created_at)->format('d-m-Y H:i:s');
//             }

//             return Datatables::of($data)->addIndexColumn()
//                 ->addColumn('action', function ($data) {
//                     $downloadButton = '<a href="' . route('AdminBeranda.download', $data->dokumen) . '" class="edit btn btn-primary btn-sm">Download</a>';
//                     $previewButton = '<a href="' . route('AdminBeranda.preview', $data->dokumen) . '" class="edit btn btn-secondary btn-sm" target="_blank">Preview</a>';
//                     return $downloadButton . ' ' . $previewButton;
//                 })
//                 ->addColumn('checkbox', function ($data) {
//                     return '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="' . $data->id . '" />';
//                 })
//                 ->rawColumns(['checkbox', 'action'])
//                 ->make(true);
//         }

//         // View Data
//         $data = tbadmin::all()->map(function($entry) {
//             $entry->formatted_created_at = Carbon::parse($entry->created_at)->format('d-m-Y H:i:s');
//             return $entry;
//         });

//         return view('AdminBeranda.beranda', compact('data'));
//     }
// }

    public function download($dokumen)
    {
        $file = storage_path('app/public/pengumuman/' . $dokumen);
        if (file_exists($file)) {
            return response()->download($file);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
        
    }
    public function simpan(Request $request)
    {
        if (!$request->hasFile('dokumen')) {
            session()->flash('error', 'Anda harus mengunggah dokumen!');
            return redirect('/AdminBeranda');
        } else {
            $this->validate($request, [
                'dokumen' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx,jpg',
            ]);
            $dokumen = $request->file('dokumen');
            $nama_dokumen = $dokumen->getClientOriginalName();
            $dokumen->storeAs('public/pengumuman/', $nama_dokumen);
            $user = Auth::user();
            $data = new tbadmin();
            $data->dokumen = $nama_dokumen;
            $data->oleh=$user->hakakses; // Simpan ID pengguna
      
            $data->save();
            session()->flash('success', 'Dokumen berhasil diunggah.');
return redirect('/AdminBeranda');
        }
    }
    function removeall(Request $request)
    {
        $user_id_array = $request->input('id');
        $user = tbadmin::whereIn('id', $user_id_array);
        if ($user->delete()) {
            echo 'Data Deleted';
        }
    }

}


