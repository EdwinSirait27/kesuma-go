<?php

namespace App\Http\Controllers;
use App\Models\DatakelasDatamengajar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class datakelasdatamengajarController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $data = DatakelasDatamengajar::with(['datamengajar.matpel', 'datamengajar.guru'])
            ->select('datakelas_datamengajar_id', 'datamengajar_id')
            ->paginate(10); // Mengambil 10 data per halaman
        
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    return view('tugas.index');
}

}