<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Cek apakah ada Bearer Token (untuk API)
        if ($request->bearerToken()) {
            $token = $request->bearerToken();
            $accessToken = PersonalAccessToken::findToken($token);

            // Jika token ditemukan dan valid
            if ($accessToken) {
                // PERBAIKAN: Metode 'isExpired()' tidak ada di model PersonalAccessToken.
                // Kita harus cek manual kolom 'expires_at'.
                if ($accessToken->expires_at && $accessToken->expires_at->isPast()) {
                    // Jika token ada tapi sudah kedaluwarsa, kirim respon JSON (khas API)
                    return response()->json(['message' => 'Token expired'], 401);
                }
                
                // Jika token valid, login-kan pengguna yang terkait dengan token ini
                // Ini akan membuat Auth::check() lolos setelah ini
                if ($accessToken->tokenable) {
                    Auth::login($accessToken->tokenable);
                }
            }
        }

        // 2. Cek Autentikasi (Sekarang bisa dari Session WEB atau dari Token API di atas)
        if (!Auth::check()) {
            // 3. GAGAL: Tentukan cara merespon
            // Jika request MENGHARAPKAN JSON (ini adalah request API) -> kirim JSON
            // Jika tidak (ini adalah request WEB) -> redirect ke halaman 'signin' Anda
            return $request->expectsJson()
                        ? response()->json(['message' => 'Unauthorized'], 401)
                        : redirect()->route('signin');
        }

        // 4. SUKSES: Lanjutkan request
        return $next($request);
    }
}