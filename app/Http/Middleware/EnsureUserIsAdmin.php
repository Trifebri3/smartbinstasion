<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'forbidden',
                    'message' => 'Akses ditolak! Fitur ini khusus untuk Administrator SmartBin.'
                ], 403);
            }
            return redirect()->route('user.portal')->with('notice', 'Halaman tersebut khusus untuk Administrator. Anda dialihkan ke Portal Pengguna.');
        }

        return $next($request);
    }
}
