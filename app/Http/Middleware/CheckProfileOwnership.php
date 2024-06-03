<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BerandaController;
class CheckProfileOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mendapatkan ID pengguna yang sedang masuk
        $loggedInUserId = Auth::id();

        // Mendapatkan ID profil yang akan diedit (biasanya dari URL atau input form)
        $profileId = $request->input('guru_id'); // Ubah ini sesuai dengan nama input Anda

        // Jika ID pengguna yang sedang masuk sama dengan ID pemilik profil, lanjutkan
        if ($loggedInUserId == $profileId) {
            return $next($request);
        }

        // Jika tidak, arahkan pengguna atau berikan pesan kesalahan sesuai dengan kebijakan aplikasi Anda
        return redirect('/beranda');
    }
}
