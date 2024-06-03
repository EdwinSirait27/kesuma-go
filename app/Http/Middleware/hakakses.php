<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class hakakses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @param  string[]  ...$allowedRoles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$allowedRoles)
    {
        $user = $request->user();

        $redirects = [
            'SU' => 'SUBeranda',
            'Admin' => 'AdminBeranda',
            'Siswa' => 'SiswaBeranda',
            'Guru' => 'GuruBeranda',
            'Kurikulum' => 'KurikulumBeranda',
            'KepalaSekolah' => 'KepalaSekolahBeranda',
            'NonSiswa' => 'NonSiswaBeranda',
        ];

        if ($this->userHasAccess($user, $allowedRoles)) {
            return $next($request);
        }

        return redirect()->route($redirects[$user->hakakses] ?? 'login');
    }

    /**
     * Check if the user has access based on allowed roles.
     *
     * @param  mixed  $user
     * @param  array  $allowedRoles
     * @return bool
     */
    private function userHasAccess($user, array $allowedRoles)
    {
        return in_array($user->hakakses, $allowedRoles);
    }
}
