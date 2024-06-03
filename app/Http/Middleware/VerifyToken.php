<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->query('token');
        $sessionToken = $request->session()->get('listkelas_token');

        if ($token !== $sessionToken) {
            return redirect('/listkelas')->with('error', 'Akses ditolak. Token tidak valid.');
        }

        return $next($request);
    }
}
