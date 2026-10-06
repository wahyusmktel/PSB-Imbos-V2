<?php

namespace App\Http\Controllers;

use App\Models\PendaftarAlamatModel;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;

class PendaftarBiodataAlamatController extends Controller
{
    public function index()
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;
        $alamat = PendaftarAlamatModel::where('pendaftar_id', $pendaftar_id)->first();

        $provinces = Province::all();

        // Cek jika sudah ada alamat, ambil data terkait dari kabupaten, kecamatan, dan desa
        $kabupatens = $alamat ? Regency::where('province_id', $alamat->provinsi_id)->get() : collect();
        $kecamatans = $alamat ? District::where('regency_id', $alamat->kabupaten_id)->get() : collect();
        $desas = $alamat ? Village::where('district_id', $alamat->kecamatan_id)->get() : collect();

        return view('pendaftar.alamat.index', compact('alamat', 'provinces', 'kabupatens', 'kecamatans', 'desas'));
    }

    // Method untuk menyimpan data baru
    public function store(Request $request)
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Validasi input
        $validator = Validator::make($request->all(), [
            'alamat_tempat_tinggal' => 'nullable|string|max:255',
            'provinsi_id' => 'required|exists:provinces,id',
            'kabupaten_id' => 'required|exists:regencies,id',
            'kecamatan_id' => 'required|exists:districts,id',
            'desa_id' => 'required|exists:villages,id',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            PendaftarAlamatModel::create([
                'pendaftar_id' => $pendaftar_id,
                'alamat_tempat_tinggal' => $request->alamat_tempat_tinggal,
                'provinsi_id' => $request->provinsi_id,
                'kabupaten_id' => $request->kabupaten_id,
                'kecamatan_id' => $request->kecamatan_id,
                'desa_id' => $request->desa_id,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'status' => true,
                'created_by' => $pendaftar_id,
            ]);

            Alert::success('Success', 'Data alamat berhasil disimpan.');
            return redirect()->route('pendaftar.data_diri.index');
        } catch (QueryException $e) {
            Alert::error('Database Error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // Method untuk memperbarui data
    public function update(Request $request, $id)
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Validasi input
        $validator = Validator::make($request->all(), [
            'alamat_tempat_tinggal' => 'nullable|string|max:255',
            'provinsi_id' => 'required|exists:provinces,id',
            'kabupaten_id' => 'required|exists:regencies,id',
            'kecamatan_id' => 'required|exists:districts,id',
            'desa_id' => 'required|exists:villages,id',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $alamat = PendaftarAlamatModel::where('pendaftar_id', $pendaftar_id)->findOrFail($id);

            $alamat->update([
                'alamat_tempat_tinggal' => $request->alamat_tempat_tinggal,
                'provinsi_id' => $request->provinsi_id,
                'kabupaten_id' => $request->kabupaten_id,
                'kecamatan_id' => $request->kecamatan_id,
                'desa_id' => $request->desa_id,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'updated_by' => $pendaftar_id,
            ]);

            Alert::success('Success', 'Data alamat berhasil diperbarui.');
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
