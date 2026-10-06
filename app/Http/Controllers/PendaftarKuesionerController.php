<?php

namespace App\Http\Controllers;

use App\Models\KuesionerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;

class PendaftarKuesionerController extends Controller
{
    // Method untuk menampilkan form kuesioner
    public function index()
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;
        $kuesioner = KuesionerModel::where('pendaftar_id', $pendaftar_id)->first();

        return view('pendaftar.kuesioner.index', compact('kuesioner'));
    }

    // Method untuk menyimpan data baru
    public function store(Request $request)
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Validasi input
        $validator = Validator::make($request->all(), [
            'masuk_insan_mulia' => 'required|string|max:255',
            'dari_mana' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Insert data kuesioner baru
            KuesionerModel::create([
                'pendaftar_id' => $pendaftar_id,
                'masuk_insan_mulia' => $request->masuk_insan_mulia,
                'dari_mana' => $request->dari_mana,
                'status' => true,
                'created_by' => $pendaftar_id,
            ]);

            Alert::success('Success', 'Data kuesioner berhasil disimpan.');
            return redirect()->route('pendaftar.data_diri.index');
        } catch (QueryException $e) {
            Alert::error('Database Error', 'Terjadi kesalahan saat menyimpan data.');
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
            'masuk_insan_mulia' => 'required|string|max:255',
            'dari_mana' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Cari kuesioner berdasarkan id
            $kuesioner = KuesionerModel::where('pendaftar_id', $pendaftar_id)->findOrFail($id);

            // Update data kuesioner
            $kuesioner->update([
                'masuk_insan_mulia' => $request->masuk_insan_mulia,
                'dari_mana' => $request->dari_mana,
                'updated_by' => $pendaftar_id,
            ]);

            Alert::success('Success', 'Data kuesioner berhasil diperbarui.');
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
