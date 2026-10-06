<?php

namespace App\Http\Controllers;

use App\Models\PendaftarJenjangModel;
use App\Models\AkunPendaftar;
use App\Models\ConfigJenjangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;

class PendaftarJenjangController extends Controller
{

    /**
     * Display the list of available jenjangs for the pendaftar to choose.
     */
    public function index()
    {
        $jenjangs = ConfigJenjangModel::where('status', true)->get();
        $pendaftarId = Auth::guard('pendaftar')->user()->id;
        $selectedJenjang = PendaftarJenjangModel::where('pendaftar_id', $pendaftarId)->first();

        return view('pendaftar.jenjang.index', compact('jenjangs', 'selectedJenjang'));
    }

    /**
     * Update the selected jenjang for the pendaftar.
     */
    public function update(Request $request)
    {
        $request->validate([
            'jenjang_id' => 'required|uuid|exists:config_jenjangs,id',
        ], [
            'jenjang_id.required' => 'Jenjang wajib dipilih.',
            'jenjang_id.exists' => 'Jenjang tidak valid.',
        ]);

        $pendaftarId = Auth::guard('pendaftar')->user()->id;

        try {
            $selectedJenjang = PendaftarJenjangModel::where('pendaftar_id', $pendaftarId)->first();

            // Jika sudah ada jenjang yang dipilih, lakukan update
            if ($selectedJenjang) {
                $selectedJenjang->update([
                    'jenjang_id' => $request->jenjang_id,
                    'updated_by' => $pendaftarId,
                ]);
                // Menampilkan alert sukses untuk update
                Alert::success('Sukses', 'Jenjang berhasil diperbarui.');
                return redirect()->route('pendaftar.jenjang.index');
            } else {
                // Jika belum ada jenjang yang dipilih, insert baru
                PendaftarJenjangModel::create([
                    'pendaftar_id' => $pendaftarId,
                    'jenjang_id' => $request->jenjang_id,
                    'status' => true,
                    'created_by' => $pendaftarId,
                ]);
                // Menampilkan alert sukses untuk insert baru
                Alert::success('Sukses', 'Jenjang berhasil dipilih.');
                return redirect()->route('pendaftar.jalur.index');
            }

        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    
    /**
     * Store a newly created pendaftar jenjang in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input untuk keamanan
        $request->validate([
            'pendaftar_id' => 'required|uuid|exists:akun_pendaftars,id',
            'jenjang_id' => 'required|uuid|exists:config_jenjangs,id',
        ], [
            'pendaftar_id.required' => 'Pendaftar wajib dipilih.',
            'pendaftar_id.uuid' => 'ID Pendaftar tidak valid.',
            'pendaftar_id.exists' => 'Pendaftar tidak ditemukan.',
            'jenjang_id.required' => 'Jenjang wajib dipilih.',
            'jenjang_id.uuid' => 'ID Jenjang tidak valid.',
            'jenjang_id.exists' => 'Jenjang tidak ditemukan.',
        ]);

        try {
            // Pastikan user yang sedang login benar-benar ada dan aman
            $pendaftarId = Auth::guard('pendaftar')->user()->id;

            // Insert data ke dalam tabel pendaftar_jenjangs
            PendaftarJenjangModel::create([
                'pendaftar_id' => $pendaftarId,
                'jenjang_id' => $request->jenjang_id,
                'status' => true, // Set default status to true
                'created_by' => $pendaftarId,
                'updated_by' => null,
            ]);

            // Jika berhasil, tampilkan alert success
            Alert::success('Berhasil', 'Data jenjang pendaftar berhasil disimpan.');
            return redirect()->route('pendaftar.jalur.index');

        } catch (QueryException $e) {
            // Jika ada error database, tampilkan alert error
            Alert::error('Database Error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            // Jika terjadi error lainnya, tampilkan alert error
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
