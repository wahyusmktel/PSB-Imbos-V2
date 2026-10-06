<?php

namespace App\Http\Controllers;

use App\Models\BiodataOrangTuaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;

class PendaftarOrangTuaController extends Controller
{
    // Method untuk menampilkan form data orang tua
    public function index()
    {
        // Mendapatkan data orang tua berdasarkan id pendaftar
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;
        $biodata_orang_tua = BiodataOrangTuaModel::where('pendaftar_id', $pendaftar_id)->first();

        return view('pendaftar.orang_tua.index', compact('biodata_orang_tua'));
    }

    // Method untuk menyimpan data baru
    public function store(Request $request)
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_ayah' => 'nullable|string|max:255',
            'tempat_lahir_ayah' => 'nullable|string|max:255',
            'agama_ayah' => 'nullable|string|max:50',
            'tgl_lahir_ayah' => 'nullable|date',
            'pendidikan_terakhir_ayah' => 'nullable|string|max:50',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'range_gaji_ayah' => 'nullable|string|max:50',
            'alamat_lengkap_ayah' => 'nullable|string|max:255',
            'telp_ayah' => 'nullable|string|max:15',
            'email_ayah' => 'nullable|email|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'tempat_lahir_ibu' => 'nullable|string|max:255',
            'tgl_lahir_ibu' => 'nullable|date',
            'agama_ibu' => 'nullable|string|max:50',
            'pendidikan_ibu' => 'nullable|string|max:50',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'range_gaji_ibu' => 'nullable|string|max:50',
            'alamat_ibu' => 'nullable|string|max:255',
            'telp_ibu' => 'nullable|string|max:15',
            'email_ibu' => 'nullable|email|max:255',
            'hubungan_santri' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Insert data orang tua
            BiodataOrangTuaModel::create([
                'pendaftar_id' => $pendaftar_id,
                'nama_ayah' => $request->nama_ayah,
                'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
                'agama_ayah' => $request->agama_ayah,
                'tgl_lahir_ayah' => $request->tgl_lahir_ayah,
                'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'range_gaji_ayah' => $request->range_gaji_ayah,
                'alamat_lengkap_ayah' => $request->alamat_lengkap_ayah,
                'telp_ayah' => $request->telp_ayah,
                'email_ayah' => $request->email_ayah,
                'nama_ibu' => $request->nama_ibu,
                'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
                'tgl_lahir_ibu' => $request->tgl_lahir_ibu,
                'agama_ibu' => $request->agama_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'range_gaji_ibu' => $request->range_gaji_ibu,
                'alamat_ibu' => $request->alamat_ibu,
                'telp_ibu' => $request->telp_ibu,
                'email_ibu' => $request->email_ibu,
                'hubungan_santri' => $request->hubungan_santri,
                'status' => true,
                'created_by' => $pendaftar_id,
            ]);

            Alert::success('Success', 'Data Orang Tua berhasil disimpan.');
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
            'nama_ayah' => 'nullable|string|max:255',
            'tempat_lahir_ayah' => 'nullable|string|max:255',
            'agama_ayah' => 'nullable|string|max:50',
            'tgl_lahir_ayah' => 'nullable|date',
            'pendidikan_terakhir_ayah' => 'nullable|string|max:50',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'range_gaji_ayah' => 'nullable|string|max:50',
            'alamat_lengkap_ayah' => 'nullable|string|max:255',
            'telp_ayah' => 'nullable|string|max:15',
            'email_ayah' => 'nullable|email|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'tempat_lahir_ibu' => 'nullable|string|max:255',
            'tgl_lahir_ibu' => 'nullable|date',
            'agama_ibu' => 'nullable|string|max:50',
            'pendidikan_ibu' => 'nullable|string|max:50',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'range_gaji_ibu' => 'nullable|string|max:50',
            'alamat_ibu' => 'nullable|string|max:255',
            'telp_ibu' => 'nullable|string|max:15',
            'email_ibu' => 'nullable|email|max:255',
            'hubungan_santri' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Cari data orang tua berdasarkan id
            $orang_tua = BiodataOrangTuaModel::where('pendaftar_id', $pendaftar_id)->findOrFail($id);

            // Update data orang tua
            $orang_tua->update([
                'nama_ayah' => $request->nama_ayah,
                'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
                'agama_ayah' => $request->agama_ayah,
                'tgl_lahir_ayah' => $request->tgl_lahir_ayah,
                'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'range_gaji_ayah' => $request->range_gaji_ayah,
                'alamat_lengkap_ayah' => $request->alamat_lengkap_ayah,
                'telp_ayah' => $request->telp_ayah,
                'email_ayah' => $request->email_ayah,
                'nama_ibu' => $request->nama_ibu,
                'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
                'tgl_lahir_ibu' => $request->tgl_lahir_ibu,
                'agama_ibu' => $request->agama_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'range_gaji_ibu' => $request->range_gaji_ibu,
                'alamat_ibu' => $request->alamat_ibu,
                'telp_ibu' => $request->telp_ibu,
                'email_ibu' => $request->email_ibu,
                'hubungan_santri' => $request->hubungan_santri,
                'updated_by' => $pendaftar_id,
            ]);

            Alert::success('Success', 'Data Orang Tua berhasil diperbarui.');
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
