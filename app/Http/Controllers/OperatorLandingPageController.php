<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfigPpdbModel;
use App\Models\ConfigJalurModel;
use App\Models\ConfigJenjangModel;
use App\Models\LandingAlur;
use App\Models\LandingSlider;
use App\Models\Faq;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class OperatorLandingPageController extends Controller
{
    /**
     * =========================================================================
     * 1. KONTEN LANDING PAGE (Hero, Kalam Quran, Jam Kerja, Maps, Footer)
     * =========================================================================
     */
    public function konten()
    {
        $config = ConfigPpdbModel::first();
        if (!$config) {
            $config = new ConfigPpdbModel();
            $config->save();
        }

        return view('operator.landing.konten', compact('config'));
    }

    public function updateKonten(Request $request)
    {
        $config = ConfigPpdbModel::first();
        if (!$config) {
            $config = new ConfigPpdbModel();
        }

        // Hero Section
        $config->hero_tag = $request->input('hero_tag', 'PSB Online');
        $config->hero_title = $request->input('hero_title', 'SMP/SMA IT Insan Mulia');
        $config->hero_subtitle = $request->input('hero_subtitle', 'Boarding School Pringsewu 2027-2028');
        $config->hero_desc = $request->input('hero_desc');

        // Hero Image Upload
        if ($request->hasFile('hero_image')) {
            $request->validate([
                'hero_image' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);
            $file = $request->file('hero_image');
            $filename = 'hero_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/landing');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $config->hero_image = 'uploads/landing/' . $filename;
        }

        // Kalam Quran Box
        $config->quran_surah = $request->input('quran_surah', "QS. Ar-Ra'd: 11");
        $config->quran_arabic = $request->input('quran_arabic');
        $config->quran_translation = $request->input('quran_translation');

        // Kontak Tambahan & Running Text
        $config->jam_kerja = $request->input('jam_kerja', 'Senin - Sabtu: 08.00 - 16.00 WIB');
        $config->maps_embed_url = $request->input('maps_embed_url');
        $config->running_text = $request->input('running_text');

        // Footer Section
        $config->footer_title = $request->input('footer_title');
        $config->footer_subtitle = $request->input('footer_subtitle');
        $config->footer_desc = $request->input('footer_desc');

        $config->save();

        Alert::success('Berhasil', 'Konten Landing Page berhasil diperbarui!');
        return redirect()->back();
    }

    /**
     * =========================================================================
     * 2. SLIDER AUTH (LOGIN & REGISTER)
     * =========================================================================
     */
    public function slider()
    {
        $sliders = LandingSlider::where('type', 'auth')->orderBy('urutan', 'asc')->get();
        return view('operator.landing.slider', compact('sliders'));
    }

    public function storeSlider(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pill_tag' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer',
        ]);

        $file = $request->file('image');
        $filename = 'auth_slide_' . time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/landing');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $file->move($destinationPath, $filename);

        LandingSlider::create([
            'type' => 'auth',
            'image' => 'uploads/landing/' . $filename,
            'pill_tag' => $request->pill_tag,
            'title' => $request->title,
            'description' => $request->description,
            'urutan' => $request->input('urutan', LandingSlider::where('type', 'auth')->count() + 1),
            'status' => $request->has('status') ? 1 : 0,
        ]);

        Alert::success('Berhasil', 'Slide gambar login/register baru berhasil ditambahkan!');
        return redirect()->back();
    }

    public function updateSlider(Request $request, $id)
    {
        $slider = LandingSlider::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pill_tag' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'auth_slide_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/landing');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $slider->image = 'uploads/landing/' . $filename;
        }

        $slider->pill_tag = $request->pill_tag;
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->urutan = $request->input('urutan', $slider->urutan);
        $slider->status = $request->has('status') ? 1 : 0;
        $slider->save();

        Alert::success('Berhasil', 'Slide gambar berhasil diperbarui!');
        return redirect()->back();
    }

    public function destroySlider($id)
    {
        $slider = LandingSlider::findOrFail($id);
        $slider->delete();

        Alert::success('Berhasil', 'Slide gambar berhasil dihapus!');
        return redirect()->back();
    }

    /**
     * =========================================================================
     * 3. ALUR PENDAFTARAN & SELEKSI
     * =========================================================================
     */
    public function alur()
    {
        $alurs = LandingAlur::orderBy('urutan', 'asc')->get();
        return view('operator.landing.alur', compact('alurs'));
    }

    public function storeAlur(Request $request)
    {
        $request->validate([
            'step_number' => 'required|string|max:10',
            'step_tag' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:100',
            'urutan' => 'nullable|integer',
        ]);

        LandingAlur::create([
            'step_number' => $request->step_number,
            'step_tag' => $request->step_tag,
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
            'urutan' => $request->input('urutan', LandingAlur::count() + 1),
            'status' => $request->has('status') ? 1 : 0,
        ]);

        Alert::success('Berhasil', 'Tahap alur seleksi baru berhasil ditambahkan!');
        return redirect()->back();
    }

    public function updateAlur(Request $request, $id)
    {
        $alur = LandingAlur::findOrFail($id);

        $request->validate([
            'step_number' => 'required|string|max:10',
            'step_tag' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:100',
            'urutan' => 'nullable|integer',
        ]);

        $alur->step_number = $request->step_number;
        $alur->step_tag = $request->step_tag;
        $alur->title = $request->title;
        $alur->description = $request->description;
        $alur->icon = $request->icon;
        $alur->urutan = $request->input('urutan', $alur->urutan);
        $alur->status = $request->has('status') ? 1 : 0;
        $alur->save();

        Alert::success('Berhasil', 'Tahap alur seleksi berhasil diperbarui!');
        return redirect()->back();
    }

    public function destroyAlur($id)
    {
        $alur = LandingAlur::findOrFail($id);
        $alur->delete();

        Alert::success('Berhasil', 'Tahap alur seleksi berhasil dihapus!');
        return redirect()->back();
    }

    /**
     * =========================================================================
     * 4. PENGATURAN UMUM & REKENING PSB
     * =========================================================================
     */
    public function pengaturan()
    {
        $config = ConfigPpdbModel::first();
        if (!$config) {
            $config = ConfigPpdbModel::create([
                'nama_sekolah' => 'SMPIT & SMAIT Insan Mulia Boarding School',
                'tahun_ajaran' => '2026/2027',
                'gelombang' => 'Gelombang 1',
                'status' => 1,
            ]);
        }

        return view('operator.landing.pengaturan', compact('config'));
    }

    public function updatePengaturan(Request $request)
    {
        $config = ConfigPpdbModel::first();
        if (!$config) {
            $config = new ConfigPpdbModel();
        }

        $config->nama_sekolah = $request->input('nama_sekolah');
        $config->tahun_ajaran = $request->input('tahun_ajaran');
        $config->gelombang = $request->input('gelombang');
        $config->status = $request->has('status') ? 1 : 0;
        $config->no_wa_humas = $request->input('no_wa_humas');
        $config->email_sekolah = $request->input('email_sekolah');
        $config->alamat_sekolah = $request->input('alamat_sekolah');
        $config->video_profil_url = $request->input('video_profil_url');
        
        $config->nama_bank_penerima = $request->input('nama_bank_penerima');
        $config->nomor_rekening_penerima = $request->input('nomor_rekening_penerima');
        $config->atas_nama = $request->input('atas_nama');
        $config->biaya_pendaftaran_default = $request->input('biaya_pendaftaran_default', 350000);

        $config->link_facebook = $request->input('link_facebook');
        $config->link_instagram = $request->input('link_instagram');
        $config->link_youtube = $request->input('link_youtube');
        $config->link_group_smp = $request->input('link_group_smp');
        $config->link_group_sma = $request->input('link_group_sma');

        $config->save();

        Alert::success('Berhasil', 'Pengaturan PSB & Landing Page berhasil diperbarui!');
        return redirect()->back();
    }

    /**
     * =========================================================================
     * 5. JALUR PENDAFTARAN
     * =========================================================================
     */
    public function jalur()
    {
        $jalurs = ConfigJalurModel::all();
        return view('operator.landing.jalur', compact('jalurs'));
    }

    public function updateJalur(Request $request, $id)
    {
        $jalur = ConfigJalurModel::findOrFail($id);
        $jalur->nama_jalur = $request->input('nama_jalur');
        $jalur->deskripsi_jalur = $request->input('deskripsi_jalur');
        $jalur->biaya = $request->input('biaya', 350000);
        $jalur->persyaratan = $request->input('persyaratan');
        $jalur->kelebihan = $request->input('kelebihan');
        $jalur->status = $request->has('status') ? 1 : 0;
        $jalur->save();

        Alert::success('Berhasil', "Jalur {$jalur->nama_jalur} berhasil diperbarui!");
        return redirect()->back();
    }

    /**
     * =========================================================================
     * 6. JENJANG PENDIDIKAN
     * =========================================================================
     */
    public function jenjang()
    {
        $jenjangs = ConfigJenjangModel::all();
        return view('operator.landing.jenjang', compact('jenjangs'));
    }

    public function updateJenjang(Request $request, $id)
    {
        $jenjang = ConfigJenjangModel::findOrFail($id);
        $jenjang->nama_jenjang = $request->input('nama_jenjang');
        $jenjang->tingkat_jenjang = $request->input('tingkat_jenjang');
        $jenjang->deskripsi_jenjang = $request->input('deskripsi_jenjang');
        $jenjang->tag_lokasi = $request->input('tag_lokasi');
        $jenjang->poin_keunggulan = $request->input('poin_keunggulan');

        if ($request->hasFile('photo_cover')) {
            $request->validate([
                'photo_cover' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);
            $file = $request->file('photo_cover');
            $filename = 'jenjang_' . strtolower($jenjang->tingkat_jenjang) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/landing');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $jenjang->photo_cover = 'uploads/landing/' . $filename;
        }

        $jenjang->status = $request->has('status') ? 1 : 0;
        $jenjang->save();

        Alert::success('Berhasil', "Jenjang {$jenjang->nama_jenjang} berhasil diperbarui!");
        return redirect()->back();
    }

    /**
     * =========================================================================
     * 7. FAQ (PERTANYAAN UMUM)
     * =========================================================================
     */
    public function faq()
    {
        $faqs = Faq::orderBy('urutan', 'asc')->get();
        return view('operator.landing.faq', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
        ]);

        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'urutan' => $request->input('urutan', Faq::count() + 1),
            'status' => $request->has('status') ? 1 : 0,
        ]);

        Alert::success('Berhasil', 'Pertanyaan FAQ baru berhasil ditambahkan!');
        return redirect()->back();
    }

    public function updateFaq(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->pertanyaan = $request->input('pertanyaan');
        $faq->jawaban = $request->input('jawaban');
        $faq->urutan = $request->input('urutan', 0);
        $faq->status = $request->has('status') ? 1 : 0;
        $faq->save();

        Alert::success('Berhasil', 'Pertanyaan FAQ berhasil diperbarui!');
        return redirect()->back();
    }

    public function destroyFaq($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        Alert::success('Berhasil', 'FAQ berhasil dihapus!');
        return redirect()->back();
    }
}
