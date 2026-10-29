<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleAuthController extends Controller
{
    /**
     * Redirect pengguna ke halaman autentikasi Google OAuth.
     */
    public function redirectToGoogle(Request $request)
    {
        // Cek jika kredensial Google Client ID tersedia di environment
        $clientId = config('services.google.client_id');
        if (empty($clientId) || $clientId === 'YOUR_GOOGLE_CLIENT_ID') {
            // Mode Simulasi Google Login Cepat jika belum memasukkan Google API Keys
            if ($request->has('demo')) {
                return $this->handleDemoGoogleLogin();
            }
            return view('auth.google-notice');
        }

        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal menghubungkan ke Google: ' . $e->getMessage());
        }
    }

    /**
     * Handle callback dari Google OAuth.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($user) {
                // Update Google ID dan Avatar jika belum ada
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            } else {
                // Buat Akun Pengguna Baru (Peran Standar: 'user')
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => Hash::make(Str::random(24)),
                    'role' => 'user',
                    'points' => 0,
                    'qr_code_token' => 'SB-USR-' . strtoupper(Str::random(12)),
                ]);
            }

            $user->ensureQrToken();
            Auth::login($user, true);

            // Arahkan sesuai peran akun
            if ($user->isAdmin()) {
                return redirect()->intended(route('dashboard'));
            }
            return redirect()->intended(route('user.portal'));

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Autentikasi Google gagal: ' . $e->getMessage());
        }
    }

    /**
     * Simulasi Demo Google Login untuk pengujian lokal instan.
     */
    public function handleDemoGoogleLogin()
    {
        $demoUser = User::firstOrCreate(
            ['email' => 'google_tester@smartbin.myoin.id'],
            [
                'name' => 'Budi Santoso (Google Auth Demo)',
                'password' => Hash::make(Str::random(20)),
                'role' => 'user',
                'points' => 120,
                'qr_code_token' => 'SB-USR-GOOGLE' . rand(1000, 9999),
                'avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=0284c7&color=fff',
            ]
        );

        $demoUser->ensureQrToken();
        Auth::login($demoUser, true);

        return redirect()->route('user.portal')->with('success', 'Berhasil masuk melalui simulasi Akun Google!');
    }
}
