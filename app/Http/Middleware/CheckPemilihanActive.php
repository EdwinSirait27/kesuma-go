<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\buttonosis;
use Carbon\Carbon;
class CheckPemilihanActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah ada ButtonOsis aktif
        $activePemilihan = ButtonOsis::whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->first();
    
        if ($activePemilihan && $activePemilihan->start_date <= Carbon::now() && $activePemilihan->end_date >= Carbon::now()) {
            // Jika ada dan kondisinya terpenuhi, izinkan akses
            return $next($request);
        } else {
            // Jika tidak, redirect ke halaman lain atau tampilkan pesan error
            abort(403, 'Pemilihan belum dimulai atau sudah berakhir.');
        }
    }
}
