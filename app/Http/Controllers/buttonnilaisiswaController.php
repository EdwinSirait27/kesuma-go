<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\buttonnilaisiswa;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class buttonnilaisiswaController extends Controller
{
    public function index2(Request $request)
    {
        $buttons = buttonnilaisiswa::all();
        if ($request->ajax()) {
            $data = buttonnilaisiswa::select(
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
        return view('buttonnilaisiswa.index', compact('buttons'));
    }
    
    function removeall1(Request $request)
    {
        $id_array = $request->input('id');
        $data = buttonnilaisiswa::whereIn('id', $id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
    public function edit1($id)
    {
        $data = buttonnilaisiswa::find($id);
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
            buttonnilaisiswa::where('id', '=', $request->txt_id)->update([ // Ganti 'id' dengan 'jurusan_id'
            
                // "url" => $request->url,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                
            ]);
        } else {
            
            // $val["url"] = $request->url;
            $val["start_date"] = $request->start_date;
            $val["end_date"] = $request->end_date;
            
            buttonnilaisiswa::create($val);
        }
        DB::commit();
        return redirect('/buttonnilaisiswa')->with('success', 'tanggal pembukaan menu nilai Berhasil Ditambahkan!');
    }
}
