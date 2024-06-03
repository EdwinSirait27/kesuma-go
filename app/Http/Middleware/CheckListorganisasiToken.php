<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckListorganisasiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pemeriksaan datakelas_id
        if ($request->filled('organisasi_guru_siswa_id')) {
            // Cek apakah datakelas_id ada di dalam sesi
            if (!$request->session()->has('organisasi_guru_siswa_id')) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            }
    
            // Ambil datakelas_id dari sesi
            $sessionOrganisasiagurusiswaId = $request->session()->get('organisasi_guru_siswa_id');
    
            // Cek apakah datakelas_id pada URL sama dengan datakelas_id di sesi
            if ($request->input('organisasi_guru_siswa_id') !== $sessionOrganisasiagurusiswaId) {
                // Jika tidak, arahkan kembali pengguna ke halaman sebelumnya
                return redirect()->back()->with('error', 'Anda tidak diperbolehkan mengubah datakelas_id secara langsung.');
            }
            
            // Simpan datakelas_id sebelumnya ke dalam sesi
            $request->session()->put('organisasi_guru_siswa_id', $request->input('organisasi_guru_siswa_id'));
        }
        
        return $next($request);
    }
}
