<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConfigPpdbModel;
use App\Models\ConfigJalurModel;
use App\Models\ConfigJenjangModel;
use App\Models\LandingAlur;
use App\Models\LandingSlider;
use App\Models\Faq;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Config PPDB & Landing Page Content
        $c = ConfigPpdbModel::first();
        if (!$c) {
            $c = new ConfigPpdbModel();
        }

        $c->nama_sekolah = 'SMPIT & SMAIT Insan Mulia Boarding School';
        $c->tahun_ajaran = '2026/2027';
        $c->gelombang = 'Gelombang 1';
        $c->hero_tag = 'PSB Online';
        $c->hero_title = 'SMP/SMA IT Insan Mulia';
        $c->hero_subtitle = 'Boarding School Pringsewu 2027-2028';
        $c->hero_desc = 'Selamat datang di portal Penerimaan Santri Baru SMPIT & SMAIT Insan Mulia Boarding School. Daftarkan dirimu sekarang juga melalui tombol di bawah ini.';
        $c->hero_image = 'theme/images/hero-santri.png';
        $c->quran_surah = "QS. Ar-Ra'd: 11";
        $c->quran_arabic = 'إِنَّ اللَّهَ لَا يُغَيِّرُ مَا بِقَوْمٍ حَتَّى يُغَيِّرُوا مَا بِأَنْفُسِهِمْ';
        $c->quran_translation = 'Sesungguhnya Allah tidak akan mengubah keadaan suatu kaum sebelum mereka mengubah keadaan diri mereka sendiri.';
        $c->alamat_sekolah = 'Jl. Hiu Latsitarda Dusun Krakatau RT/RW 007/001 Margakaya, Pringsewu, Lampung';
        $c->no_wa_humas = '082371877887';
        $c->email_sekolah = 'psb@imbos.sch.id';
        $c->jam_kerja = 'Senin - Sabtu: 08.00 - 16.00 WIB';
        $c->video_profil_url = 'https://www.youtube.com/watch?v=fv_Oogwy_8s';
        $c->maps_embed_url = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.3035238136476!2d104.9698578147651!3d-5.370597696104457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4732773b51fbfd%3A0x7a90c7aa4e69d1d0!2sINSAN%20MULIA%20BOARDING%20SCHOOL%20PRINGSEWU!5e0!3m2!1sid!2sid!4v1632987004618!5m2!1sid!2sid!4v1632987004618';
        $c->link_facebook = 'https://www.facebook.com/imbospringsewu/';
        $c->link_instagram = 'https://www.instagram.com/imbospringsewu/?hl=id';
        $c->link_youtube = 'https://www.youtube.com/@imbospringsewu';
        $c->nama_bank_penerima = 'Bank Syariah Indonesia (BSI)';
        $c->nomor_rekening_penerima = '7086012132';
        $c->atas_nama = 'Dian Zunia Ningrum';
        $c->biaya_pendaftaran_default = 350000;
        $c->footer_title = 'Mencetak Generasi Cendikiawan Qurani & Berakhlak Mulia';
        $c->footer_subtitle = 'Pendidikan Terpadu SMPIT & SMAIT Berbasis Karakter Islami, Tahfizh Mutqin, & Kurikulum Global.';
        $c->footer_desc = "Pesantren Modern yang mengintegrasikan kurikulum nasional terpadu, tahfizh Al-Qur'an mutqin, bahasa internasional, dan wawasan global untuk melahirkan generasi Cendikiawan Qurani.";
        $c->status = 1;
        $c->save();

        // 2. Jenjang Pendidikan
        $smp = ConfigJenjangModel::where('tingkat_jenjang', 'SMP')->first();
        if ($smp) {
            $smp->update([
                'nama_jenjang' => 'SMP IT Insan Mulia Boarding School',
                'photo_cover' => 'theme/images/jenjang-smpit-full.jpg',
                'tag_lokasi' => 'Kampus Putra & Putri Terpisah · Pringsewu, Lampung',
                'deskripsi_jenjang' => "Pendidikan tingkat menengah pertama berbasis kepesantrenan terpadu yang memfokuskan santri pada fondasi adab islami, pembiasaan ibadah, bilingual Arab-Inggris, dan hafalan Al-Qur'an mutqin.",
                'poin_keunggulan' => "Kurikulum Terpadu: Perpaduan kurikulum nasional Kemendikbudristek & kurikulum diniyah kepesantrenan.\nHalaqah Al-Qur'an Intensif: Talaqqi makharijul huruf, kaidah tajwid bersanad, dan bimbingan tahfizh harian.\nKemandirian & Karakter: Pembinaan adab islami, kepemimpinan santri, dan pembiasaan bilingual Arab-Inggris.",
                'status' => 1
            ]);
        }

        $sma = ConfigJenjangModel::where('tingkat_jenjang', 'SMA')->first();
        if ($sma) {
            $sma->update([
                'nama_jenjang' => 'SMA IT Insan Mulia Boarding School Pringsewu',
                'photo_cover' => 'theme/images/jenjang-smait-full.jpg',
                'tag_lokasi' => 'Persiapan PTN & Studi Global · Pringsewu, Lampung',
                'deskripsi_jenjang' => "Jenjang pendidikan menengah atas dengan kurikulum terpadu yang memfokuskan santri pada kesiapan menembus PTN favorit, universitas internasional, kepemimpinan berintegritas, serta tahfizh Al-Qur'an 30 Juz.",
                'poin_keunggulan' => "Kesiapan UTBK-SNBT & Kedinasan: Pembekalan intensif, klinik bedah soal, dan pemetaan minat karier santri.\nProgram Takhassus 30 Juz: Jalur percepatan tahfizh Al-Qur'an mutqin bersanad dengan tasmi' terbuka.\nRiset & Studi Global: Pembinaan riset sains remaja, literasi teknologi informasi, dan persiapan beasiswa luar negeri.",
                'status' => 1
            ]);
        }

        // 3. Jalur Pendaftaran
        ConfigJalurModel::where('nama_jalur', 'like', '%Tahfizh%')->update([
            'biaya' => 350000,
            'persyaratan' => "Fotokopi Akta Kelahiran & Kartu Keluarga\nNISN dari sekolah asal\nScan Sertifikat Hafalan (SMP min 5 Juz, SMA min 10 Juz)\nPas foto resmi 3x4",
            'kelebihan' => 'Bebas Tes Potensi Akademik (TPA)',
            'status' => 1
        ]);

        ConfigJalurModel::where('nama_jalur', 'like', '%Prestasi%')->update([
            'biaya' => 350000,
            'persyaratan' => "Fotokopi Akta Kelahiran & Kartu Keluarga\nNISN dari sekolah asal\nScan Sertifikat Prestasi Lomba (Min. tingkat Kabupaten dinaungi Diknas)\nPas foto resmi 3x4",
            'kelebihan' => 'Bebas Tes Tertulis Akademik',
            'status' => 1
        ]);

        ConfigJalurModel::where('nama_jalur', 'like', '%Reguler%')->update([
            'biaya' => 350000,
            'persyaratan' => "Fotokopi Akta Kelahiran & Kartu Keluarga\nNISN dari sekolah asal\nPas foto resmi 3x4\nMengikuti Tes Potensi Akademik & Baca Al-Qur'an",
            'kelebihan' => 'Terbuka untuk umum seluruh calon santri',
            'status' => 1
        ]);

        ConfigJalurModel::where('nama_jalur', 'like', '%Alumni%')->update([
            'biaya' => 350000,
            'persyaratan' => "Surat Keterangan Lulus / Ijazah SMPIT IMBOS\nFotokopi Kartu Keluarga\nPas foto resmi 3x4",
            'kelebihan' => 'Jalur prioritas khusus santri alumni IMBOS',
            'status' => 1
        ]);

        // 4. Alur Pendaftaran (6 Steps)
        if (LandingAlur::count() == 0) {
            $alurSteps = [
                [
                    'step_number' => '01',
                    'step_tag' => 'Tahap Awal',
                    'title' => 'Registrasi Akun',
                    'description' => 'Calon santri atau wali mengisi formulir pendaftaran awal melalui menu Daftar Sekarang untuk memperoleh Nomor Pendaftaran & akun portal pendaftar.',
                    'icon' => 'fas fa-user-plus',
                    'urutan' => 1,
                    'status' => true,
                ],
                [
                    'step_number' => '02',
                    'step_tag' => 'Pilihan Program',
                    'title' => 'Pilih Jenjang & Jalur',
                    'description' => 'Login ke dashboard akun santri, tentukan tingkat pendidikan (SMPIT atau SMAIT), serta pilih jalur masuk yang sesuai (Tahfizh, Prestasi, Reguler, atau Alumni).',
                    'icon' => 'fas fa-sitemap',
                    'urutan' => 2,
                    'status' => true,
                ],
                [
                    'step_number' => '03',
                    'step_tag' => 'Biaya Masuk',
                    'title' => 'Pembayaran Pendaftaran',
                    'description' => 'Transfer biaya pendaftaran sebesar Rp 350.000 ke rekening resmi Bank Syariah Indonesia (BSI) lalu unggah bukti transfer.',
                    'icon' => 'fas fa-wallet',
                    'urutan' => 3,
                    'status' => true,
                ],
                [
                    'step_number' => '04',
                    'step_tag' => 'Verifikasi Berkas',
                    'title' => 'Pengisian Biodata & Dokumen',
                    'description' => 'Setelah pembayaran diverifikasi oleh panitia, lengkapi isian data diri santri, data orang tua/wali, kuesioner, dan upload dokumen berkas pendukung santri.',
                    'icon' => 'fas fa-file-alt',
                    'urutan' => 4,
                    'status' => true,
                ],
                [
                    'step_number' => '05',
                    'step_tag' => 'Tes Seleksi',
                    'title' => 'Ujian Seleksi & Wawancara',
                    'description' => 'Mengikuti jadwal tes seleksi: Tes Potensi Akademik (TPA), Tes Baca Al-Qur\'an & Hafalan, serta Wawancara calon santri dan orang tua/wali santri.',
                    'icon' => 'fas fa-user-graduate',
                    'urutan' => 5,
                    'status' => true,
                ],
                [
                    'step_number' => '06',
                    'step_tag' => 'Tahap Akhir',
                    'title' => 'Pengumuman & Daftar Ulang',
                    'description' => 'Hasil seleksi diumumkan langsung melalui portal pendaftar. Santri yang dinyatakan lulus dapat mengunduh surat keputusan kelulusan dan menyelesaikan daftar ulang.',
                    'icon' => 'fas fa-certificate',
                    'urutan' => 6,
                    'status' => true,
                ],
            ];

            foreach ($alurSteps as $step) {
                LandingAlur::create($step);
            }
        }

        // 5. Slider Auth (Login & Register)
        if (LandingSlider::where('type', 'auth')->count() == 0) {
            $sliders = [
                [
                    'type' => 'auth',
                    'image' => 'theme/images/auth-slide-1.jpg',
                    'pill_tag' => 'Kampus Representatif',
                    'title' => 'Lingkungan Asri & Terpadu',
                    'description' => 'Fasilitas modern penunjang iklim belajar dan kenyamanan santri.',
                    'urutan' => 1,
                    'status' => true,
                ],
                [
                    'type' => 'auth',
                    'image' => 'theme/images/auth-slide-2.jpg',
                    'pill_tag' => 'Karakter Qur\'ani',
                    'title' => 'Ukhuwah & Adab Mulia',
                    'description' => 'Membentuk santri berkepribadian tangguh, mandiri, dan berakhlak terpuji.',
                    'urutan' => 2,
                    'status' => true,
                ],
                [
                    'type' => 'auth',
                    'image' => 'theme/images/auth-slide-3.jpg',
                    'pill_tag' => 'Sains & Teknologi',
                    'title' => 'Integrasi IPTEK & Al-Qur\'an',
                    'description' => 'Kurikulum seimbang yang mengasah kompetensi digital dan hafalan Al-Qur\'an.',
                    'urutan' => 3,
                    'status' => true,
                ],
            ];

            foreach ($sliders as $s) {
                LandingSlider::create($s);
            }
        }

        // 6. FAQ
        if (Faq::count() == 0) {
            Faq::create([
                'pertanyaan' => 'Kapan pendaftaran santri baru SMPIT dan SMAIT IMBOS dibuka?',
                'jawaban' => 'Pendaftaran online santri baru dibuka mulai Gelombang 1 untuk Tahun Ajaran 2026/2027. Calon santri dapat mendaftar kapan saja melalui website resmi ini.',
                'urutan' => 1,
                'status' => true,
            ]);
            Faq::create([
                'pertanyaan' => 'Apa saja tahapan seleksi masuk di IMBOS?',
                'jawaban' => 'Tahapan seleksi terdiri dari Tes Potensi Akademik (TPA), Tes Membaca Al-Qur\'an & Hafalan, serta Wawancara calon santri dan orang tua/wali.',
                'urutan' => 2,
                'status' => true,
            ]);
            Faq::create([
                'pertanyaan' => 'Bagaimana cara konfirmasi pembayaran pendaftaran?',
                'jawaban' => 'Setelah transfer ke rekening resmi BSI yang tertera, silakan upload bukti struk/transfer pada menu Transaksi Pembayaran di akun pendaftar Anda. Panitia akan memverifikasi secara langsung.',
                'urutan' => 3,
                'status' => true,
            ]);
            Faq::create([
                'pertanyaan' => 'Apakah calon santri dari luar provinsi Lampung bisa mendaftar?',
                'jawaban' => 'Bisa. IMBOS menerima santri dari seluruh penjuru Indonesia dengan fasilitas asrama (boarding) modern dan pembinaan 24 jam.',
                'urutan' => 4,
                'status' => true,
            ]);
            Faq::create([
                'pertanyaan' => 'Apakah wali santri bisa survei lokasi kampus secara langsung?',
                'jawaban' => 'Sangat dipersilakan. Silakan hubungi narahubung Humas IMBOS via WhatsApp terlebih dahulu untuk konfirmasi jadwal kunjungan kampus.',
                'urutan' => 5,
                'status' => true,
            ]);
        }
    }
}
