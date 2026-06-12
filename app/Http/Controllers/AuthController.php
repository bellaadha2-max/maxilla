<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $loginInput = $request->input('email');
        
        // Tentukan apakah input adalah email atau nomor HP (no_wa)
        $loginField = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_wa';
        
        // Gabungkan field login yang sesuai ke dalam request untuk divalidasi
        $request->merge([$loginField => $loginInput]);

        $credentials = $request->validate([
            $loginField => ['required', 'string'],
            'password' => ['required'],
        ]);

        $authCredentials = [
            $loginField => $credentials[$loginField],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($authCredentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);

            if ($user->role === 'superadmin') {
                return redirect()->intended('/superadmin/dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'dokter') {
                return redirect()->intended('/dokter/dashboard');
            } elseif ($user->role === 'apoteker') {
                return redirect()->intended('/apoteker/dashboard');
            } elseif ($user->role === 'kasir') {
                return redirect()->intended('/kasir/dashboard');
            } elseif ($user->role === 'pasien') {
                return redirect()->intended('/pasien/dashboard');
            }

            // Default redirect for normal patients
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email/Nomor HP atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Handle registration request for new patients.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'size:16', 'unique:users,nik'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'nik.unique' => 'Nomor e-KTP (NIK) ini sudah terdaftar sebelumnya.',
            'email.unique' => 'Alamat email ini sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nik.size' => 'NIK harus tepat 16 digit.',
            'password.min' => 'Password minimal harus 8 karakter.',
        ]);

        $user = \App\Models\User::create([
            'nama' => $validated['name'],
            'nik' => $validated['nik'],
            'email' => $validated['email'],
            'no_wa' => $validated['phone'],
            'password' => bcrypt($validated['password']),
            'role' => 'pasien',
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect('/pasien/dashboard');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
