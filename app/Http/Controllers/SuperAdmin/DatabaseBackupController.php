<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\AkunPendaftar;
use App\Models\PendaftarTransaksiModel;
use App\Models\PendaftarBerkas;

class DatabaseBackupController extends Controller
{
    /**
     * Path direktori penyimpanan backup
     */
    protected function getBackupDir(): string
    {
        $path = storage_path('app/backups');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        return $path;
    }

    /**
     * Halaman Utama Manajemen Database
     */
    public function index()
    {
        $backupDir = $this->getBackupDir();
        $files = File::files($backupDir);

        $backups = [];
        foreach ($files as $file) {
            if ($file->getExtension() === 'sql') {
                $backups[] = [
                    'filename' => $file->getFilename(),
                    'size' => $this->formatFileSize($file->getSize()),
                    'raw_size' => $file->getSize(),
                    'created_at' => date('Y-m-d H:i:s', $file->getMTime()),
                    'mtime' => $file->getMTime(),
                ];
            }
        }

        // Urutkan backup terbaru di paling atas
        usort($backups, function ($a, $b) {
            return $b['mtime'] <=> $a['mtime'];
        });

        // Statistik Database
        $dbName = DB::getDatabaseName();
        $totalTables = count(Schema::getTableListing());
        
        $dbSize = '0 MB';
        try {
            $sizeQuery = DB::select("
                SELECT table_schema AS `database`,
                SUM(data_length + index_length) / 1024 / 1024 AS `size_mb`
                FROM information_schema.TABLES 
                WHERE table_schema = ?
                GROUP BY table_schema
            ", [$dbName]);

            if (!empty($sizeQuery)) {
                $dbSize = round($sizeQuery[0]->size_mb, 2) . ' MB';
            }
        } catch (\Exception $e) {
            $dbSize = 'N/A';
        }

        $totalPendaftar = 0;
        $totalTransaksi = 0;
        $totalBerkas = 0;

        try {
            $totalPendaftar = AkunPendaftar::count();
            $totalTransaksi = PendaftarTransaksiModel::count();
            $totalBerkas = PendaftarBerkas::count();
        } catch (\Exception $e) {
            // ignore
        }

        return view('superadmin.database.index', compact(
            'backups',
            'dbName',
            'totalTables',
            'dbSize',
            'totalPendaftar',
            'totalTransaksi',
            'totalBerkas'
        ));
    }

    /**
     * Proses Pembuatan File Backup Database SQL
     */
    public function backup(Request $request)
    {
        try {
            $filename = 'backup_psb_imbos_' . date('Y_m_d_His') . '.sql';
            $filepath = $this->getBackupDir() . DIRECTORY_SEPARATOR . $filename;

            $this->dumpDatabaseToSql($filepath);

            if ($request->query('download') == '1') {
                return response()->download($filepath, $filename);
            }

            Alert::success('Backup Berhasil', 'Database berhasil dibackup ke file: ' . $filename);
            return redirect()->route('superadmin.database.index');
        } catch (\Exception $e) {
            Alert::error('Backup Gagal', 'Terjadi kesalahan saat membackup database: ' . $e->getMessage());
            return redirect()->route('superadmin.database.index');
        }
    }

    /**
     * Download File Backup Tertentu
     */
    public function download($filename)
    {
        $filename = basename($filename);
        $filepath = $this->getBackupDir() . DIRECTORY_SEPARATOR . $filename;

        if (!File::exists($filepath)) {
            Alert::error('File Tidak Ditemukan', 'File backup tidak tersedia di server.');
            return redirect()->route('superadmin.database.index');
        }

        return response()->download($filepath, $filename);
    }

    /**
     * Restore Database dari File di Server atau Upload File
     */
    public function restore(Request $request)
    {
        // 1. Cek apakah restore dari upload file
        if ($request->hasFile('sql_file')) {
            $request->validate([
                'sql_file' => 'required|file|max:51200', // max 50MB
            ]);

            $file = $request->file('sql_file');
            $ext = strtolower($file->getClientOriginalExtension());
            if ($ext !== 'sql') {
                Alert::error('Format Tidak Valid', 'Hanya file dengan ekstensi .sql yang didukung.');
                return redirect()->route('superadmin.database.index');
            }

            $sqlContent = File::get($file->getRealPath());
            return $this->executeSqlRestore($sqlContent, $file->getClientOriginalName());
        }

        // 2. Cek apakah restore dari file backup yang ada di server
        if ($request->filled('filename')) {
            $filename = basename($request->input('filename'));
            $filepath = $this->getBackupDir() . DIRECTORY_SEPARATOR . $filename;

            if (!File::exists($filepath)) {
                Alert::error('File Tidak Ditemukan', 'File backup yang dipilih tidak ada di server.');
                return redirect()->route('superadmin.database.index');
            }

            $sqlContent = File::get($filepath);
            return $this->executeSqlRestore($sqlContent, $filename);
        }

        Alert::warning('Peringatan', 'Silakan pilih file backup dari server atau unggah file .sql.');
        return redirect()->route('superadmin.database.index');
    }

    /**
     * Eksekusi Isi SQL untuk Restore
     */
    protected function executeSqlRestore(string $sqlContent, string $sourceName)
    {
        try {
            // Tingkatkan batas waktu eksekusi untuk restore database
            ini_set('max_execution_time', 300);
            ini_set('memory_limit', '512M');

            DB::beginTransaction();

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::unprepared($sqlContent);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            DB::commit();

            Alert::success('Restore Berhasil', 'Database berhasil dipulihkan dari: ' . $sourceName);
            return redirect()->route('superadmin.database.index');
        } catch (\Exception $e) {
            DB::rollBack();
            try {
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            } catch (\Exception $ex) {}

            Alert::error('Restore Gagal', 'Terjadi kesalahan saat memulihkan database: ' . $e->getMessage());
            return redirect()->route('superadmin.database.index');
        }
    }

    /**
     * Hapus File Backup
     */
    public function destroyBackup($filename)
    {
        $filename = basename($filename);
        $filepath = $this->getBackupDir() . DIRECTORY_SEPARATOR . $filename;

        if (File::exists($filepath)) {
            File::delete($filepath);
            Alert::success('Berhasil', 'File backup ' . $filename . ' berhasil dihapus.');
        } else {
            Alert::error('Gagal', 'File backup tidak ditemukan.');
        }

        return redirect()->route('superadmin.database.index');
    }

    /**
     * Kosongkan Data Transaksional & Pendaftar
     */
    public function truncateData(Request $request)
    {
        $confirmation = trim($request->input('confirm_text', ''));

        if ($confirmation !== 'KOSONGKAN DATA') {
            Alert::error('Konfirmasi Salah', 'Ketik "KOSONGKAN DATA" dengan huruf kapital untuk mengonfirmasi pengosongan data.');
            return redirect()->route('superadmin.database.index');
        }

        try {
            // STEP 1: Buat AUTO-BACKUP otomatis sebelum pengosongan agar aman
            $autoBackupName = 'auto_backup_sebelum_kosongkan_data_' . date('Y_m_d_His') . '.sql';
            $autoBackupPath = $this->getBackupDir() . DIRECTORY_SEPARATOR . $autoBackupName;
            $this->dumpDatabaseToSql($autoBackupPath);

            // STEP 2: Kosongkan tabel data pendaftar & transaksi
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $tablesToTruncate = [
                'pendaftar_transaksis',
                'pendaftar_berkas',
                'pendaftar_kuesioners',
                'pendaftar_penyakits',
                'pendaftar_alamats',
                'biodata_orang_tuas',
                'biodata_diris',
                'pendaftar_jalurs',
                'pendaftar_jenjangs',
                'hasil_seleksis',
                'akun_pendaftars',
            ];

            foreach ($tablesToTruncate as $table) {
                if (Schema::hasTable($table)) {
                    DB::table($table)->truncate();
                }
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            Alert::success('Data Dikosongkan', 'Seluruh data pendaftar dan transaksi telah berhasil dikosongkan. Backup otomatis telah disimpan sebagai: ' . $autoBackupName);
            return redirect()->route('superadmin.database.index');
        } catch (\Exception $e) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            Alert::error('Gagal Mengosongkan Data', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('superadmin.database.index');
        }
    }

    /**
     * Dump Skema dan Data Seluruh Database ke SQL Native PHP
     */
    protected function dumpDatabaseToSql(string $filepath): void
    {
        $pdo = DB::connection()->getPdo();
        $dbName = DB::getDatabaseName();
        $tables = Schema::getTableListing();

        $handle = fopen($filepath, 'w');
        if (!$handle) {
            throw new \Exception("Tidak dapat membuat file backup pada path: {$filepath}");
        }

        // Header SQL
        fwrite($handle, "-- ========================================================\n");
        fwrite($handle, "-- DATABASE BACKUP: " . $dbName . "\n");
        fwrite($handle, "-- GENERATED AT: " . date('Y-m-d H:i:s') . "\n");
        fwrite($handle, "-- APPLICATION: PSB IMBoS (Insan Mulia Boarding School)\n");
        fwrite($handle, "-- ========================================================\n\n");
        fwrite($handle, "SET FOREIGN_KEY_CHECKS=0;\n");
        fwrite($handle, "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n");
        fwrite($handle, "SET AUTOCOMMIT = 0;\n");
        fwrite($handle, "START TRANSACTION;\n");
        fwrite($handle, "SET time_zone = \"+00:00\";\n\n");

        foreach ($tables as $table) {
            // Lewati migrations / sessions / cache locks jika perlu, atau include semuanya agar lengkap
            // Kita include seluruh tabel untuk full backup
            fwrite($handle, "-- --------------------------------------------------------\n");
            fwrite($handle, "-- Table structure for table `{$table}`\n");
            fwrite($handle, "-- --------------------------------------------------------\n");
            fwrite($handle, "DROP TABLE IF EXISTS `{$table}`;\n");

            // Create table statement
            $stmt = $pdo->query("SHOW CREATE TABLE `{$table}`");
            $row = $stmt->fetch(\PDO::FETCH_NUM);
            if ($row && isset($row[1])) {
                fwrite($handle, $row[1] . ";\n\n");
            }

            // Dump data
            $countStmt = $pdo->query("SELECT COUNT(*) FROM `{$table}`");
            $totalRows = (int) $countStmt->fetchColumn();

            if ($totalRows > 0) {
                fwrite($handle, "-- Dumping data for table `{$table}`\n");

                $selectStmt = $pdo->query("SELECT * FROM `{$table}`");
                $columnCount = $selectStmt->columnCount();

                // Dapatkan nama kolom
                $columnNames = [];
                for ($i = 0; $i < $columnCount; $i++) {
                    $meta = $selectStmt->getColumnMeta($i);
                    $columnNames[] = '`' . $meta['name'] . '`';
                }
                $columnList = implode(', ', $columnNames);

                $batchValues = [];
                $batchSize = 100;
                $currentBatch = 0;

                while ($dataRow = $selectStmt->fetch(\PDO::FETCH_NUM)) {
                    $escapedValues = [];
                    foreach ($dataRow as $val) {
                        if (is_null($val)) {
                            $escapedValues[] = 'NULL';
                        } else {
                            $escapedValues[] = $pdo->quote($val);
                        }
                    }
                    $batchValues[] = '(' . implode(', ', $escapedValues) . ')';
                    $currentBatch++;

                    if ($currentBatch >= $batchSize) {
                        fwrite($handle, "INSERT INTO `{$table}` ({$columnList}) VALUES\n" . implode(",\n", $batchValues) . ";\n");
                        $batchValues = [];
                        $currentBatch = 0;
                    }
                }

                if (!empty($batchValues)) {
                    fwrite($handle, "INSERT INTO `{$table}` ({$columnList}) VALUES\n" . implode(",\n", $batchValues) . ";\n");
                }

                fwrite($handle, "\n");
            }
        }

        // Footer SQL
        fwrite($handle, "SET FOREIGN_KEY_CHECKS=1;\n");
        fwrite($handle, "COMMIT;\n");
        fclose($handle);
    }

    /**
     * Format Ukuran File ke KB / MB / GB
     */
    protected function formatFileSize($bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return '1 byte';
        } else {
            return '0 bytes';
        }
    }
}
