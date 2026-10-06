<?php

namespace App\Http\Controllers;

use App\Models\AkunPendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use App\Models\ConfigPpdbModel; // Import model

class AkunPendaftarController extends Controller
{
    public function showRegistrationForm()
    {
        // Mengambil data dari tabel config_ppdbs
        $configPpdb = ConfigPpdbModel::first(); // Ambil data pertama dari tabel config_ppdbs

        return view('pendaftar.akun.register', compact('configPpdb'));
    }

    public function register(Request $request)
    {
        // Validasi input dengan pengecekan validasi manual
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|max:255|unique:akun_pendaftars',
            'asal_sekolah' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
        ], [
            'nisn.unique' => 'NISN sudah digunakan, silakan masukkan NISN lain.',
            'nisn.required' => 'NISN wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
        ]);

        if ($validator->fails()) {
            // Ambil semua pesan error dan gabungkan menjadi string
            $messages = implode('<br>', $validator->errors()->all());

            // Tampilkan pesan error dalam SweetAlert
            Alert::error('Validasi Gagal', $messages);

            // Redirect kembali dengan inputan yang sudah diisi
            return redirect()->back()->withInput();
        }

        try {
            // Generate No Pendaftaran
            $lastPendaftar = AkunPendaftar::orderBy('created_at', 'desc')->first();
            $lastNumber = $lastPendaftar ? intval(substr($lastPendaftar->no_pendaftaran, -3)) : 0;
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            $noPendaftaran = "PSB-IMBOS-" . $nextNumber;

            // Create new AkunPendaftar
            $akun = AkunPendaftar::create([
                'nama_lengkap' => $request->nama_lengkap,
                'nisn' => $request->nisn,
                'asal_sekolah' => $request->asal_sekolah,
                'no_hp' => $request->no_hp,
                'username' => $noPendaftaran,
                'password' => Hash::make($request->nisn),
                'no_pendaftaran' => $noPendaftaran,
            ]);

            // Arahkan ke halaman konfirmasi dengan membawa data akun
            return view('pendaftar.akun.konfirmasi', compact('akun'));

        } catch (QueryException $e) {
            // SweetAlert for database error
            Alert::error('Database Error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');

            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            // SweetAlert for any other error
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());

            return redirect()->back()->withInput();
        }
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        // Mengambil data dari tabel config_ppdbs
        $configPpdb = ConfigPpdbModel::first(); // Ambil data pertama dari tabel config_ppdbs

        return view('pendaftar.akun.login', compact('configPpdb'));
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Ambil data checkbox remember
        $remember = $request->has('remember') ? true : false;

        try {
            // Mencoba login menggunakan guard pendaftar
            if (Auth::guard('pendaftar')->attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
                // Login berhasil, redirect ke dashboard
                Alert::success('Success', 'Login Berhasil');
                return redirect()->route('pendaftar.dashboard');
            } else {
                // Login gagal, kembali ke form login dengan pesan error
                Alert::error('Login Gagal', 'Username atau password salah');
                return redirect()->route('pendaftar.login')->withErrors([
                    'login' => 'Username atau password salah',
                ])->withInput();
            }
        } catch (\Exception $e) {
            // Jika ada exception, kembali ke halaman login dengan pesan error
            Alert::error('Login Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('pendaftar.login')->withInput();
        }
    }

    public function autoLogin(Request $request)
    {
        $akun = AkunPendaftar::findOrFail($request->id);

        // Proses login otomatis
        Auth::guard('pendaftar')->login($akun);

        return redirect()->route('pendaftar.dashboard');
    }

    public function downloadKartuAkun($id)
    {
        $akun = AkunPendaftar::findOrFail($id);

        // Membuat PDF dari view kartu akun
        $pdf = PDF::loadView('pendaftar.akun.kartu', compact('akun'));

        // Download PDF dengan nama file
        return $pdf->download('Kartu_Akun_' . $akun->no_pendaftaran . '.pdf');
    }

    // Method untuk logout pendaftar
    public function logout(Request $request)
    {
        // Menggunakan guard 'pendaftar' untuk logout
        Auth::guard('pendaftar')->logout();

        // Hapus sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Tampilkan pesan sukses dan redirect ke halaman login
        Alert::success('Success', 'Anda telah berhasil logout.');
        return redirect()->route('pendaftar.login');
    }

}
