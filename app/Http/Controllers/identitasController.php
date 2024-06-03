<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\identitas; // Pastikan telah mengimpor model Identitas
use Illuminate\Support\Facades\DB;

class identitasController extends Controller
{
    public function index()
    {
        $data = identitas::first(); 
        return view('identitas.index', compact('data'));
    }

    public function storeOrUpdate(Request $request)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'Nama_Sekolah' => 'required|',
            //Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Mode Edit: Perbarui data yang ada
        if ($request->filled('id')) {
            $data = identitas::findOrFail($request->id);
            $data->update([
                'Nama_sekolah' => $request->Nama_Sekolah,
                'NPSN' => $request->NPSN,
                'Alamat_Sekolah' => $request->Alamat_Sekolah,
                'Kode_Pos' => $request->Kode_Pos,
                'Nomor_Telephone' => $request->Nomor_Telephone,
                'Kelurahan' => $request->Kelurahan,
                'Kecamatan' => $request->Kecamatan,
                'Kabupaten_Kota' => $request->Kabupaten_Kota,
                'Provinsi' => $request->Provinsi,
                'Website' => $request->Website,
                'Email' => $request->Email,
                'akreditasi' => $request->akreditasi,
                //Tambahkan kolom lain sesuai kebutuhan
            ]);
        }
        // Mode Tambah: Simpan data baru
        else {
            $data = new identitas([
                'Nama_Sekolah' => $request->Nama_Sekolah,
                'NPSN' => $request->NPSN,
                'Alamat_Sekolah' => $request->Alamat_Sekolah,
                'Kode_Pos' => $request->Kode_Pos,
                'Nomor_Telephone' => $request->Nomor_Telephone,
                'Kelurahan' => $request->Kelurahan,
                'Kecamatan' => $request->Kecamatan,
                'Kabupaten_Kota' => $request->Kabupaten_Kota,
                'Provinsi' => $request->Provinsi,
                'Website' => $request->Website,
                'Email' => $request->Email,
                'akreditasi' => $request->akreditasi,
                //Tambahkan kolom lain sesuai kebutuhan
            ]);
            $data->save();
        }

        return redirect('/identitas')->with('success', 'Data berhasil disimpan');
    }
    public function update(Request $request, $id)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'Nama_Sekolah' => 'required|',
            'NPSN' => 'required|',
            'Alamat_Sekolah' => 'required|',
            'Kode_Pos' => 'required|',
            'Nomor_Telephone' => 'required|',
            'Kelurahan' => 'required|',
            'Kecamatan' => 'required|',
            'Kabupaten_Kota' => 'required|',
            'Provinsi' => 'required|',
            'Website' => 'required|',
            'Email' => 'required|',
            'akreditasi' => 'required|',
            //Tambahkan validasi lainnya sesuai kebutuhan
        ]);
    
        // Cari data berdasarkan ID
        $data = identitas::findOrFail($id);
    
        // Update data berdasarkan input dari formulir
        $data->update([
            'Nama_sekolah' => $request->Nama_Sekolah,
            'NPSN' => $request->NPSN,
            'Alamat_Sekolah' => $request->Alamat_Sekolah,
            'Kode_Pos' => $request->Kode_Pos,
            'Nomor_Telephone' => $request->Nomor_Telephone,
            'Kelurahan' => $request->Kelurahan,
            'Kecamatan' => $request->Kecamatan,
            'Kabupaten_Kota' => $request->Kabupaten_Kota,
            'Provinsi' => $request->Provinsi,
            'Website' => $request->Website,
            'Email' => $request->Email,
            'akreditasi' => $request->akreditasi,
            //Tambahkan kolom lain sesuai kebutuhan
        ]);
    
        return redirect('/identitas')->with('success', 'Data berhasil diperbarui');
    }
    
}