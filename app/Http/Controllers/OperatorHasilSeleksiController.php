<?php

namespace App\Http\Controllers;
// Import HasilSeleksi model
use App\Models\HasilSeleksiModel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class OperatorHasilSeleksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'selected_pendaftar_ids' => 'required|string',
            'hasil_kelulusan' => 'required|in:1,2,3',
        ]);

        $pendaftarIds = explode(",", $request->selected_pendaftar_ids);
        $hasilKelulusan = $request->hasil_kelulusan;
        $userId = Auth::guard('operator')->user()->id; // Ambil ID user yang login

        foreach ($pendaftarIds as $pendaftarId) {
            HasilSeleksiModel::updateOrCreate(
                ['pendaftar_id' => $pendaftarId],
                [
                    'hasil_kelulusan' => $hasilKelulusan,
                    'status' => 1,
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]
            );
        }

        return redirect()->to(url()->previous())->with('success', 'Kelulusan berhasil diperbarui.');
    }
}
