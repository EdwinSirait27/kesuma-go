<?php
namespace App\Http\Controllers;
use App\Models\tbguru;
use App\Models\tbsiswa;
use App\Models\tbadmin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\tahunakademik;
use App\Models\buttonosis;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use pdf;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
class BerandaControllerKepalaSekolah extends Controller
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
         // Jika tidak ada tahun akademik yang aktif, berikan pesan 'anjay'
    if ($tahunAkademikAktif->isEmpty()) {
        $pesan = 'Kosong';
    } else {
        $pesan = ''; // Tidak perlu pesan jika ada tahun akademik aktif
    }

        $totalUsersiswa = User::all()->count();
        $totalLakiLaki = tbsiswa::where('JenisKelamin', 'Laki-Laki')->count();
        $totalPerempuan = tbsiswa::where('JenisKelamin', 'Perempuan')->count();
        $totalGuru = tbguru::count();
        $totalAgamaKatolik = tbsiswa::where('Agama', 'Katolik')->count();
        $totalAgamaKristenProtestan = tbsiswa::where('Agama', 'Kristen Protestan')->count();
        $totalAgamaIslam = tbsiswa::where('Agama', 'Islam')->count();
        $totalAgamaBuddha = tbsiswa::where('Agama', 'Buddha')->count();
        $totalAgamaHindu = tbsiswa::where('Agama', 'Hindu')->count();
        $totalAgamaKonghucu = tbsiswa::where('Agama', 'Konghucu')->count();
        $totalSiswa = $totalAgamaKatolik + $totalAgamaKristenProtestan + $totalAgamaIslam + $totalAgamaBuddha + $totalAgamaHindu + $totalAgamaKonghucu;
        $persentaseAgamaKatolik = round(($totalAgamaKatolik / $totalSiswa) * 100);
        $persentaseAgamaKristenProtestan = round(($totalAgamaKristenProtestan / $totalSiswa) * 100);
        $persentaseAgamaIslam = round(($totalAgamaIslam / $totalSiswa) * 100);
        $persentaseAgamaBuddha = round(($totalAgamaBuddha / $totalSiswa) * 100);
        $persentaseAgamaHindu = round(($totalAgamaHindu / $totalSiswa) * 100);
        $persentaseAgamaKonghucu = round(($totalAgamaKonghucu / $totalSiswa) * 100);
        $count = 0;
        $data = tbadmin::query();
        $data = $data->get();
        $isEmpty = $data->isEmpty();
        $buttonosis = buttonosis::where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->get();

        return view(
            'KepalaSekolahBeranda.beranda',
            compact(
                'totalUser',
                'totalUserAdminGuru',
                'totalUserSiswa',
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
                'isEmpty'
            )
        );
    }
    public function index2(Request $request)
    {
        if ($request->ajax()) {
            $data = tbadmin::select('id', 'dokumen', 'created_at','oleh')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $button = '<a href="' . route('KepalaSekolahBeranda.download', $data->dokumen) . '" class="edit btn btn-primary btn-sm">Download</a>';
                    $previewButton = '';
                    if (pathinfo($data->dokumen, PATHINFO_EXTENSION) == 'jpg') {
                        // $previewButton = '<button type="button" class="btn btn-secondary btn-sm btn-preview" data-dokumen="' . $data->dokumen . '">Preview</button>';
                        $previewButton = '<button type="button" class="btn btn-secondary btn-sm btn-preview" data-dokumen="' . $data->dokumen . '">Preview</button>';

                    }
                    
                    return $button. ' ' . $previewButton;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('KepalaSekolahBeranda.beranda');
    }
    public function index3(Request $request)
    {
        if ($request->ajax()) {
            $data = tbadmin::select('id', 'dokumen', 'created_at')->get();
            foreach ($data as $entry) {
                $entry->formatted_created_at = Carbon::parse($entry->created_at)->format('d-m-Y H:i:s');
            }
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="dokumen/' . $data->dokumen . '" class="edit btn btn-primary btn-sm">Download</a>';
                    $previewButton = '';
                    if (pathinfo($data->dokumen, PATHINFO_EXTENSION) == 'jpg') {
                        // $previewButton = '<button type="button" class="btn btn-secondary btn-sm btn-preview" data-dokumen="' . $data->dokumen . '">Preview</button>';
                        $previewButton = '<button type="button" class="btn btn-secondary btn-sm btn-preview" data-dokumen="' . $data->dokumen . '">Preview</button>';

                    }
                    
                    return $button. ' ' . $previewButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('KepalaSekolahBeranda.beranda',  compact('data'));
    }
    public function download($dokumen)
    {
        
        $file = storage_path('app/public/pengumuman/' . $dokumen);
        if (file_exists($file)) {
            return response()->download($file);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
               
    }
    public function preview($dokumen)
    {
        $path = storage_path('app/public/pengumuman/' . $dokumen);

        if (file_exists($path)) {
            return response()->file($path);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }
    public function simpan(Request $request)
    {
        if (!$request->hasFile('dokumen')) {
            // Flash an error message to the session
            session()->flash('error', 'Anda harus mengunggah dokumen!');

            return redirect('/KepalaSekolahBeranda');
        } else {
            $this->validate($request, [
                'dokumen' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
            ]);

            $dokumen = $request->file('dokumen');
            $nama_dokumen = $dokumen->getClientOriginalName();
            $dokumen->storeAs('public/pengumuman/', $nama_dokumen);
            $user = Auth::user();
            $data = new tbadmin();
            $data->dokumen = $nama_dokumen;
            // $data->created_at = now();
            $data->oleh=$user->hakakses; // Simpan ID pengguna
      
            $data->save();
            session()->flash('success', 'Dokumen berhasil diunggah.');
return redirect('/KepalaSekolahBeranda');
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


