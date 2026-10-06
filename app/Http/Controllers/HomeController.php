<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfigPpdbModel;
use App\Models\ConfigJenjangModel;
use App\Models\ConfigJalurModel;
use App\Models\Faq;
use App\Models\Pengumuman;
use App\Models\LandingAlur;

class HomeController extends Controller
{
    public function index()
    {
        $config = ConfigPpdbModel::first();
        if (!$config) {
            $config = new ConfigPpdbModel([
                'nama_sekolah' => 'SMPIT & SMAIT Insan Mulia Boarding School',
                'tahun_ajaran' => '2026/2027',
                'gelombang' => 'Gelombang 1',
                'status' => 1,
                'no_wa_humas' => '082371877887',
                'alamat_sekolah' => 'Jl. Hiu Latsitarda Dusun Krakatau RT/RW 007/001 Margakaya, Pringsewu, Lampung',
                'video_profil_url' => 'https://www.youtube.com/watch?v=fv_Oogwy_8s',
                'email_sekolah' => 'psb@imbos.sch.id',
                'nama_bank_penerima' => 'Bank Syariah Indonesia (BSI)',
                'nomor_rekening_penerima' => '7086012132',
                'atas_nama' => 'Dian Zunia Ningrum',
                'biaya_pendaftaran_default' => 350000,
            ]);
        }

        $jenjangs = ConfigJenjangModel::where('status', 1)->get();
        $jalurs = ConfigJalurModel::where('status', 1)->get();
        $faqs = Faq::where('status', 1)->orderBy('urutan', 'asc')->get();
        $pengumumans = Pengumuman::active()->latest()->take(3)->get();
        $alurs = LandingAlur::where('status', true)->orderBy('urutan', 'asc')->get();

        return view('home', compact('config', 'jenjangs', 'jalurs', 'faqs', 'pengumumans', 'alurs'));
    }
}