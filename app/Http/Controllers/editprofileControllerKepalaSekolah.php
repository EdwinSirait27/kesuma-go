<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class editprofileControllerKepalaSekolah extends Controller
{
    public function index()
    {
        $akunguru = auth()->user()->akunguru;
        $guru = auth()->user()->guru;
        $availableRoles = explode(',', $akunguru->getRawOriginal('role'));
      
        return view('editprofileKepalaSekolah.index', compact('guru', 'akunguru', 'availableRoles'));
    }
    public function indexx()
    {
        $akunguru = auth()->user()->akunguru;
        $guru = auth()->user()->guru;
        $availableRoles = explode(',', $akunguru->getRawOriginal('role'));
      
        return view('editpasskepalasekolah.index', compact('guru', 'akunguru', 'availableRoles'));
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        $akunguru = $user->akunguru;
        $guru = $user->guru;
        $request->validate(
            [
                'foto' => 'image|mimes:jpeg|max:512', // Menambahkan ekstensi yang diperbolehkan (png, jpg, gif) dan batas maksimum ukuran (2 MB)
            ],
            [
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Format file gambar harus jpeg.',
                'foto.max' => 'Ukuran file gambar tidak boleh melebihi 512 KB.',
                'Email' => 'required',
                'NomorTelephone' => 'required',
                'TanggalLahir' => 'required|date_format:Y-m-d',
                'Nik' => 'required',
                'Npwp' => 'required',
                'TMT' => 'required',
                'PendidikanAkhir' => 'required',
                'TahunTamat' => 'required',
                'Jurusan' => 'required',
                'Alamat' => 'required',
            ]


        );
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/fotoguru', $fileName);
            $guru->foto = $fileName; 
        }
        if ($request->has('password')) {
            $akunguru->update([
                'password' => Hash::make($request->input('password')),
                "remember_token" => Str::random(60),
            ]);
        }
        // Update peran (role) dan hak akses (hakakses)  'TempatLahir' => 'required',
           
        $akunguru->update([
            
            'hakakses' => $request->input('role'), // Sesuaikan dengan kolom yang menyimpan hakakses
        ]);
        $guru->update($request->only([
            'Nama', 'TempatLahir', 'TanggalLahir', 'Agama', 'JenisKelamin', 'StatusPegawai', 'NipNips',
            'Nuptk', 'Nik', 'Npwp', 'NomorSertifikatPendidik', 'TahunSertifikasi', 'PangkatGolonganTerakhir', 'TMT',
            'PendidikanAkhir', 'TahunTamat', 'Jurusan', 'TugasMengajar', 'TugasTambahan', 'JamPerMinggu',
            'TahunPensiun', 'Berkala', 'Pangkat', 'Jabatan', 'NomorTelephone', 'Alamat', 'Email',
        ]));
        return redirect('/editprofileKepalaSekolah')->with('success', 'Profil berhasil diperbarui!');
    }
    public function updateee(Request $request)
    {
        $user = auth()->user();
        $akunguru = $user->akunguru;
        if ($request->has('password') && !Hash::check($request->input('password'), $akunguru->password)) {
            // Jika password berbeda, lakukan update
            $akunguru->update([
                'password' => Hash::make($request->input('password')),
                'remember_token' => Str::random(60),
            ]);
            return redirect('/editpasskepalasekolah')->with('success', 'Edit Password berhasil diperbarui!');
        } else {
            return redirect('/editpasskepalasekolah')->with('warning', 'Tidak ada perubahan data');
        }
    }
}
