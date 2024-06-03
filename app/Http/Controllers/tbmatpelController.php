<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\tbmatpel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class tbmatpelController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = tbmatpel::select(
                'matpel_id',
                'MataPelajaran',
                'status',
                'KKM',
                'keterangan'
            )->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->matpel_id . ');" class="btn btn-primary">Edit</button>';

                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$matpel_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('mata.index');
    }

    function removeall(Request $request)
    {
        $matpel_id_array = $request->input('matpel_id');
        $data = tbmatpel::whereIn('matpel_id', $matpel_id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
    public function edit($id)
    {
        $data = tbmatpel::find($id);
        if ($data) {
            
            $MataPelajaran = $data->MataPelajaran;
            $status = $data->status;
            $KKM = $data->KKM;
            $keterangan = $data->keterangan;
            
            return response()->json([
            
                "MataPelajaran" => $MataPelajaran,
                "status" => $status,
                "KKM" => $KKM,
                "keterangan" => $keterangan
            ]);
        }
        return response()->json(null, 404);
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        if ($request->txt_id <> '0') {
            tbmatpel::where('matpel_id', '=', $request->txt_id)->update([ // Ganti 'id' dengan 'jurusan_id'
            
                "MataPelajaran" => $request->MataPelajaran,
                "status" => $request->status,
                "KKM" => $request->KKM,
                "keterangan" => $request->keterangan,
                
            ]);
        } else {
            
            $val["MataPelajaran"] = $request->MataPelajaran;
            $val["status"] = $request->status;
            $val["KKM"] = $request->KKM;
            $val["keterangan"] = $request->keterangan;
            
            tbmatpel::create($val);
        }
        DB::commit();
        return redirect('/mata')->with('success', 'jurusan Berhasil Ditambahkan!');
    }
}
