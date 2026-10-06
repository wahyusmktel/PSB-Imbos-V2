<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\OperatorModel;
use RealRashid\SweetAlert\Facades\Alert;

class OperatorAuthController extends Controller
{
    // Tampilkan form login operator
    public function showLoginForm()
    {
        $sliders = \App\Models\LandingSlider::where('status', true)->orderBy('urutan', 'asc')->get();
        $configPpdb = \App\Models\ConfigPpdbModel::first();
        return view('operator.auth.login', compact('sliders', 'configPpdb'));
    }

    // Proses login untuk operator
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Ambil data checkbox remember
        $remember = $request->has('remember') ? true : false;

        try {
            // Mencoba login menggunakan guard operator
            if (Auth::guard('operator')->attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
                // Login berhasil, redirect ke dashboard operator
                Alert::success('Success', 'Login Berhasil');
                return redirect()->route('operator.dashboard');
            } else {
                // Login gagal, kembali ke form login dengan pesan error
                Alert::error('Login Gagal', 'Username atau password salah');
                return redirect()->route('operator.login')->withErrors([
                    'login' => 'Username atau password salah',
                ])->withInput();
            }
        } catch (\Exception $e) {
            // Jika ada exception, kembali ke halaman login dengan pesan error
            Alert::error('Login Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('operator.login')->withInput();
        }
    }

    // Proses logout operator
    public function logout()
    {
        Auth::guard('operator')->logout();
        return redirect()->route('operator.login');
    }
}
