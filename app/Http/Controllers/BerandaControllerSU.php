<?php
namespace App\Http\Controllers;
use App\Models\tbguru;
use App\Models\listakun;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
class BerandaControllerSU extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Tbguru::with('listakun')
            ->where('Nama', '!=', 'Christopher Edwin Sirait')
            ->get();

            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->guru_id . ');" class="btn btn-primary">Edit</button>';
                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$guru_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        $availableRoles = ['Admin', 'Guru', 'Kurikulum', 'KepalaSekolah'];
        // $halaman = ['AdminBeranda'];
        // $halaman = listakun::where('halaman')->get();

        return view('SUBeranda.beranda', compact('availableRoles'));
    }
    public function edit($id)
    {
        $guru = tbguru::with('listakun')->find($id);
        if ($guru) {
            $Nama = $guru->Nama;
            $listakun = $guru->listakun;
            $hakakses = $listakun ? $listakun->hakakses : null;
            $roles = $listakun ? explode(',', $listakun->role) : [];
            return response()->json([
                "txt_Nama" => $Nama,
                "hakakses" => $hakakses,
                "roles" => $roles,
                // "halaman" => $halaman,
            ]);
        }

        return response()->json(null, 404);
    }
    public function update(Request $request)
    {
        // Validasi bahwa minimal satu role dipilih
       
    
        DB::beginTransaction();
    
        if ($request->txt_id !== '0') {
            tbguru::where('guru_id', $request->txt_id)->update([
                "Nama" => $request->txt_Nama,
            ]);
    
            $guru = tbguru::find($request->txt_id);
    
            if ($guru) {
                $listakun = $guru->listakun;
    
                if ($listakun) {
                    $listakun->update([
                        "role" => implode(',', $request->input('roles', [])),
                        ]);
                }
            }
        }
    
        // Periksa apakah minimal satu role tercentang
        $selectedRoles = $request->input('roles', []);
        // $selectedHalaman = $request->input('halaman', []);
    
        if (empty($selectedRoles)) {
            // Tampilkan pesan peringatan jika tidak ada role yang tercentang
            DB::rollBack(); // Batalkan transaksi
            return redirect()->back()->with('warning', 'Pilih setidaknya satu role!');
        }
        // if (empty($selectedHalaman)) {
        //     // Tampilkan pesan peringatan jika tidak ada role yang tercentang
        //     DB::rollBack(); // Batalkan transaksi
        //     return redirect()->back()->with('warning', 'Pilih setidaknya satu Halaman!');
        // }
    
        DB::commit();
    
        return redirect()->route('SUBeranda.beranda')->with('success', 'Role Berhasil Diperbarui!');
    }
    
}
