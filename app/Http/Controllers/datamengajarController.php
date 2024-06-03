<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\datamengajar;
use App\Models\tbguru;
use App\Models\datakelas;
use App\Models\tbmatpel;
use Yajra\DataTables\DataTables;

class datamengajarController extends Controller
{   
    public function index(Request $request)
    {
        $gurus = tbguru::all();
        $matpels = tbmatpel::all();
        $kelass = datakelas::all();
        
        if ($request->ajax()) {
            $data = datamengajar::with(['matpel','guru','kelas' ])
                ->select(
                    'datamengajar_id',
                    'matpel_id',
                    'guru_id',
                    'hari',
                    'time_start',
                    'time_end',
                    'time_start1',
                    'time_end1',
                    'keterangan',
                    'kelas_id'
                )
                ->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                // $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->datamengajar_id . ');" class="btn btn-primary">Edit</button>';
                $encodedId = base64_encode($data->datamengajar_id);
                   
                $button1 = '<a href="' . route('datamengajar.show' , ['encodedId' => $encodedId]) .  '" class="btn btn-primary">Edit </a>';


                return $button1;
            })
            
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$datamengajar_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
                
        }

        return view('datamengajar.index', compact('matpels','gurus','kelass'));
    }
   
    public function show1(Request $request)
    {
        $encodedId = $request->encodedId;
        $datamengajar_id = base64_decode($encodedId);
        $gurus = tbguru::all();
        $matpels = tbmatpel::all();
        $kelass = datakelas::all();
        
        $datamengajar = datamengajar::with('matpel','guru','kelas')->findOrFail($datamengajar_id);
        return view('datamengajar.show', compact('datamengajar','matpels','gurus','kelass'));
    }

    public function edit($id)
    {
        $data = datamengajar::find($id);

        if ($data) {
            $matpel_id = $data->matpel_id;
            $guru_id = $data->guru_id;
            $hari = $data->hari;
            $time_start = $data->time_start;
            $time_end = $data->time_end;
            $time_start1 = $data->time_start1;
            $time_end1 = $data->time_end1;
            
            $keterangan = $data->keterangan;
            $kelas_id = $data->kelas_id;
          
         

            return response()->json([
                "matpel_id" => $matpel_id,
                "guru_id" => $guru_id,
                "hari" => $hari,
                "time_start" => $time_start,
                "time_end" => $time_end,
                "time_start1" => $time_start1,
                "time_end1" => $time_end1,
                "keterangan" => $keterangan,
                "kelas_id" => $kelas_id
               
         
            ]);
        }

        return response()->json(null, 404);
    }
    public function update(Request $request)
{
    try {
        DB::beginTransaction();
        $request->validate([
            'matpel_id' => 'required',
            'guru_id' => 'required',
            'hari' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
            'time_start1' => 'required',
            'time_end1' => 'required',
            // 'kelas_id' => 'required',    
        ]);

        if ($request->txt_id != '0') {
            datamengajar::where('datamengajar_id', $request->txt_id)->update([
                "matpel_id" => $request->matpel_id,
                "guru_id" => $request->guru_id,
                "hari" => $request->hari,
                "time_start" => $request->time_start,
                "time_end" => $request->time_end,
                "time_start1" => $request->time_start1,
                "time_end1" => $request->time_end1,
                
                "keterangan" => $request->keterangan,
                "kelas_id" => $request->kelas_id,
            ]);
        } else {
            $val["matpel_id"] = $request->matpel_id;
            $val["guru_id"] = $request->guru_id;
            $val["hari"] = $request->hari;
            $val["time_start"] = $request->time_start;
            $val["time_end"] = $request->time_end;
            $val["time_start1"] = $request->time_start1;
            $val["time_end1"] = $request->time_end1;
            $val["keterangan"] = $request->keterangan;
            $val["kelas_id"] = $request->kelas_id;
            datamengajar::create($val);
        }
        DB::commit();
        return redirect('/datamengajar')->with('success', 'Data Mengajar berhasil diperbarui!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect('/datamengajar')->with('error', 'Terjadi kesalahan. Data Mengajar tidak berhasil diperbarui. Pesan Kesalahan: ' . $e->getMessage());
    }
}

    
    
    function removeall(Request $request)
    {
        $datamengajar_id_array = $request->input('datamengajar_id');
        $data = datamengajar::whereIn('datamengajar_id', $datamengajar_id_array);
        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
}