<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class editprofileControllerNonSiswa extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();
        $akunsiswa = $user->akunsiswa;
        $siswa = $user->siswa;
        $request->validate(
            [
                'foto' => 'image|mimes:jpeg|max:512', // Menambahkan ekstensi yang diperbolehkan (png, jpg, gif) dan batas maksimum ukuran (2 MB)
            ],
            [
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Format file gambar harus jpeg.',
                'foto.max' => 'Ukuran file gambar tidak boleh melebihi 512 KB.',
            ]
        );
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/fotosiswa', $fileName);
            $siswa->foto = $fileName; 
        }
        if ($request->has('password')) {
            $akunsiswa->update([
                'password' => Hash::make($request->input('password')),
                "remember_token" => Str::random(60),
            ]);
        }
        $siswa->update($request->only([
            'NamaLengkap',
            'NISN',
            'Email',
            'JenisKelamin',
            'Alamat',
            'TempatLahir',
            'TanggalLahir',
            'NomorTelephone',
            'Agama',
            'AsalSMP',
            'NamaAyah',
            'NomorTelephoneAyah',
            'cita',
          
            
        ]));
        return redirect('/editprofileNonSiswa')->with('success', 'Profil berhasil diperbarui!');
    }
    public function index()
    {
        $akunsiswa = auth::user()->akunsiswa;
        $siswa = auth::user()->siswa;
        $availableRoles = explode(',', $akunsiswa->getRawOriginal('role'));
        $kelas = $siswa->kelas->namakelas ?? 'Belum Ada Kelas';
       
        return view('editprofileNonSiswa.index', compact('siswa', 'akunsiswa', 'availableRoles'));
    }
    public function indexx()
    {
        $akunsiswa = auth()->user()->akunsiswa;
        $siswa = auth()->user()->siswa;
        
        return view('editpassnonsiswa.index', compact('siswa', 'akunsiswa'));
    }
    public function updatee(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'password' => 'required|string|min:7|max:12',
        ]);
    
        // Ambil pengguna yang sedang login
        $user = auth()->user();
        $akunsiswa = $user->akunsiswa;
    
        // Periksa apakah password baru berbeda dari yang lama
        if ($request->has('password') && !Hash::check($request->input('password'), $akunsiswa->password)) {
            // Jika password berbeda, lakukan update
            $akunsiswa->password = Hash::make($request->input('password'));
            $akunsiswa->remember_token = Str::random(60);
            $akunsiswa->save();
    
            // Berikan respon sukses
            return redirect('/editpassnonsiswa')->with('success', 'Edit Password berhasil diperbarui!');
        } else {
            // Jika password sama atau tidak ada perubahan
            return redirect('/editpassnonsiswa')->with('warning', 'Tidak ada perubahan data');
        }
    }
    // public function updatee(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'password' => 'required|string|min:7|max:12',
    //     ]);
    //     $user = auth()->user();
    //     $akunsiswa = $user->akunsiswa;
    //     if ($request->has('password') && !Hash::check($request->input('password'), $akunsiswa->password)) {
    //         // Jika password berbeda, lakukan update
    //         $akunsiswa->update([
    //             'password' => Hash::make($request->input('password')),
    //             'remember_token' => Str::random(60),
    //         ]);
    //         return redirect('/editpassnonsiswa')->with('success', 'Edit Password berhasil diperbarui!');
    //     } else {
    //         return redirect('/editpassnonsiswa')->with('warning', 'Tidak ada perubahan data');
    //     }
    // }

}
