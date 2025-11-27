<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika user tidak login, redirect ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika user punya role yang diizinkan, lanjutkan
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // Jika tidak, return 403 Forbidden
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
