<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Memeriksa apakah pengguna sudah logout
        if (!Auth::check() || $request->routeIs('editprofile')|| $request->routeIs('matapelajaran') || $request->routeIs('lupapassword') || $request->routeIs('siswaall') || $request->routeIs('guruall')|| $request->routeIs('matpel')|| $request->routeIs('ekstra')||$request->routeIs('beranda'))  {
            return route('login');
        }
        return null;
    }
}
