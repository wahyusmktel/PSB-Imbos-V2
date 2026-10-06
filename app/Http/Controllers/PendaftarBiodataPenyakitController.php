<?php

namespace App\Http\Controllers;

use App\Models\BiodataPenyakitModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;

class PendaftarBiodataPenyakitController extends Controller
{
    // Method untuk menampilkan form riwayat penyakit
    public function index()
    {
        // Mengambil data riwayat penyakit berdasarkan id pendaftar
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;
        $riwayat_penyakit = BiodataPenyakitModel::where('pendaftar_id', $pendaftar_id)->first();

        return view('pendaftar.riwayat_penyakit.index', compact('riwayat_penyakit'));
    }

    // Method untuk menyimpan data baru
    public function store(Request $request)
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_penyakit' => 'nullable|string|max:255',
            'sejak_kapan' => 'nullable|date',
            'status_kesembuhan' => 'nullable|string|max:255',
            'penanganan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Insert data riwayat penyakit
            BiodataPenyakitModel::create([
                'pendaftar_id' => $pendaftar_id,
                'nama_penyakit' => $request->nama_penyakit,
                'sejak_kapan' => $request->sejak_kapan,
                'status_kesembuhan' => $request->status_kesembuhan,
                'penanganan' => $request->penanganan,
                'status' => true,
                'created_by' => $pendaftar_id,
            ]);

            Alert::success('Success', 'Data riwayat penyakit berhasil disimpan.');
            return redirect()->route('pendaftar.data_diri.index');
        } catch (QueryException $e) {
            Alert::error('Database Error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // Method untuk memperbarui data yang sudah ada
    public function update(Request $request, $id)
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_penyakit' => 'nullable|string|max:255',
            'sejak_kapan' => 'nullable|date',
            'status_kesembuhan' => 'nullable|string|max:255',
            'penanganan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Cari riwayat penyakit berdasarkan id
            $riwayat = BiodataPenyakitModel::where('pendaftar_id', $pendaftar_id)->findOrFail($id);

            // Update data riwayat penyakit
            $riwayat->update([
                'nama_penyakit' => $request->nama_penyakit,
                'sejak_kapan' => $request->sejak_kapan,
                'status_kesembuhan' => $request->status_kesembuhan,
                'penanganan' => $request->penanganan,
                'updated_by' => $pendaftar_id,
            ]);

            Alert::success('Success', 'Data riwayat penyakit berhasil diperbarui.');
            return redirect()->route('pendaftar.data_diri.index');
        } catch (QueryException $e) {
            Alert::error('Database Error', 'Terjadi kesalahan saat memperbarui data.');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
