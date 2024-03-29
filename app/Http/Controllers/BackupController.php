<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Spatie\Backup\Tasks\Backup\BackupJob;
use Carbon\Carbon;


class BackupController extends Controller
{
    public function index()
    {
        $backups = collect(Storage::disk('local')->files('Laravel'))
            ->map(function ($path) {
                return pathinfo($path, PATHINFO_FILENAME);
            })
            ->toArray();
// dd($backups);
        return view('backup_db', ['backups' => $backups]);
    }

    public function runBackupDbOnly()
    {
        // Jalankan perintah backup
        // Artisan::call('backup:run --only-db');
        Artisan::call('backup:run', [
            '--filename' => 'Buku_Prestasi_DB_Only_' . Carbon::now()->translatedFormat('d-F-Y').'_Jam_'. Carbon::now()->Format('H:i:s') . '.zip',
            '--only-db' => true
        ]);

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->back()->with('success', 'Backup Berhasil');
    }

    public function runBackupFull()
    {
        // Jalankan perintah backup
        Artisan::call('backup:run', [
            '--filename' => 'Buku_Prestasi_Full_App_' . Carbon::now()->translatedFormat('d-F-Y').'_Jam_'. Carbon::now()->Format('H:i:s') . '.zip',
            '--only-db' => false
        ]);

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->back()->with('success', 'Backup Berhasil');
    }

    public function deleteBackup($name)
    {
        // Tentukan path lengkap ke file backup
        $backupPath = storage_path("app/Laravel/{$name}.zip");

        // Periksa apakah file backup ada
        if (file_exists($backupPath)) {
            // Hapus file backup menggunakan fungsi unlink
            unlink($backupPath);

            // Redirect atau berikan respons sesuai kebutuhan
            return redirect()->back()->with('success', 'Backup berhasil dihapus.');
        } else {
            // Jika file tidak ditemukan, berikan respons sesuai
            return redirect()->back()->with('error', 'Tidak ditemukan');
        }
    }

    public function downloadBackup($name)
    {
        // Tentukan path lengkap ke file backup
        $backupPath = storage_path("app/Laravel/{$name}.zip");

        // Periksa apakah file backup ada
        if (file_exists($backupPath)) {
            // Download file backup dan hapus setelah selesai
            return response()->download($backupPath)->deleteFileAfterSend(true);
        } else {
            // Jika file tidak ditemukan, berikan respons sesuai
            return response()->json(['error' => 'Backup file not found'], 404);
        }
    }

    public function backupDB()
    {
        Artisan::call('backup:database');

        return redirect()->back()->with('success', 'Data has been moved successfully.');
    }
}
