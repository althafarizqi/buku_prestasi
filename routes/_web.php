<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UkjController;
use App\Http\Controllers\DetailUkjController;
use App\Http\Controllers\PasController;
use App\Http\Controllers\DetailPasController;
use App\Http\Controllers\PtsController;
use App\Http\Controllers\TahsinController;
use App\Http\Controllers\DetailTahsinController;
use App\Http\Controllers\HafalanController;
use App\Http\Controllers\DetailHafalanController;
use App\Http\Controllers\BulananController;
use App\Http\Controllers\DetailBulananController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PengampuController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\NaikKelasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/move-all-data', [ProfileController::class, 'moveDataPenilaian'])->name('move.all.data');

// Route::get('/ukj', [KenaikanJuzController::class, 'index'])->name('kenaikanjuz.index');
// Route::post('/ambil-data-siswa', [KenaikanJuzController::class, 'ambilDataSiswa'])->name('kenaikanjuz.ambil-data-siswa');
// Route::post('/ukj', [KenaikanJuzController::class, 'store'])->name('kenaikanjuz.store');

// Route::get('/siswabykelas', [KenaikanJuzController::class, 'index'])->name('kenaikanjuz.siswabykelas');
Route::get('/naik-kelas', [NaikKelasController::class, 'index'])->name('naik-kelas.index');
Route::post('/naik-kelas', [NaikKelasController::class, 'updateKelas'])->name('naik-kelas.updateKelas');


Route::get('/ukj', [UkjController::class, 'index'])->name('ukj.index');
Route::post('/ukj', [UkjController::class, 'store'])->name('ukj.store');
Route::get('/ukjdetail/{id}/edit', [DetailUkjController::class, 'edit'])->name('ukjdetail.edit');
Route::put('/ukjdetail/{id}', [DetailUkjController::class, 'update'])->name('ukjdetail.update');
Route::delete('/ukjdetail/{id}', [DetailUkjController::class, 'destroy'])->name('ukjdetail.destroy');

Route::get('/pas', [PasController::class, 'index'])->name('pas.index');
Route::post('/pas', [PasController::class, 'store'])->name('pas.store');
Route::get('/pasdetail/{id}/edit', [DetailPasController::class, 'edit'])->name('pasdetail.edit');
Route::put('/pasdetail/{id}', [DetailPasController::class, 'update'])->name('pasdetail.update');
Route::delete('/pasdetail/{id}', [DetailPasController::class, 'destroy'])->name('pasdetail.destroy');

Route::get('/pts', [PtsController::class, 'index'])->name('pts.index');
Route::post('/pts', [PtsController::class, 'store'])->name('pts.store');

Route::get('/hafalan', [HafalanController::class, 'index'])->name('hafalan.index');
Route::post('/hafalan', [HafalanController::class, 'store'])->name('hafalan.store');
Route::get('/hafalandetail/{id}/edit', [DetailHafalanController::class, 'edit'])->name('hafalandetail.edit');
Route::put('/hafalandetail/{id}', [DetailHafalanController::class, 'update'])->name('hafalandetail.update');
Route::delete('/hafalandetail/{id}', [DetailHafalanController::class, 'destroy'])->name('hafalandetail.destroy');

Route::get('/tahsin', [TahsinController::class, 'index'])->name('tahsin.index');
Route::post('/tahsin', [TahsinController::class, 'store'])->name('tahsin.store');
Route::get('/tahsindetail/{id}/edit', [DetailTahsinController::class, 'edit'])->name('tahsindetail.edit');
Route::put('/tahsindetail/{id}', [DetailTahsinController::class, 'update'])->name('tahsindetail.update');
Route::delete('/tahsindetail/{id}', [DetailTahsinController::class, 'destroy'])->name('tahsindetail.destroy');

Route::get('/bulanan', [BulananController::class, 'index'])->name('bulanan.index');
Route::post('/bulanan', [BulananController::class, 'store'])->name('bulanan.store');
Route::get('/bulanandetail/{id}/edit', [DetailBulananController::class, 'edit'])->name('bulanandetail.edit');
Route::put('/bulanandetail/{id}', [DetailBulananController::class, 'update'])->name('bulanandetail.update');

Route::get('/raport', [RaportController::class, 'index'])->name('raport.index');
Route::get('/raport/{id}', [RaportController::class, 'cetak'])->name('raport.cetak');
// Route::get('/raport/create', [RaportController::class, 'create'])->name('raport.create');

Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');

Route::get('/pengampu', [PengampuController::class, 'index'])->name('pengampu.index');
Route::post('/pengampu', [PengampuController::class, 'store'])->name('pengampu.store');

Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');

Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/backup', [BackupController::class, 'index']);
Route::get('/download-backup/{name}', [BackupController::class, 'downloadBackup'])
    ->name('download.backup');
Route::post('/backup/dbonly', [BackupController::class, 'runBackupDbOnly'])
    ->name('backup.dbonly');
Route::post('/backup/full', [BackupController::class, 'runBackupFull'])
    ->name('backup.full');
Route::delete('/delete-backup/{name}', [BackupController::class, 'deleteBackup'])
    ->name('delete.backup');
