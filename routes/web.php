<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\DasarTugasController;
use App\Http\Controllers\DummySptController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KelasPerjadinController;
use App\Http\Controllers\PangkatGolonganController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PkaSptController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SptController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboardArfa');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    // role
    Route::resource('konfigurasi/roles', RoleController::class);
    Route::resource('master/jabatan', JabatanController::class);
    Route::resource('master/bagian', BagianController::class);
    Route::resource('master/kelas_perjadin', KelasPerjadinController::class);
    Route::resource('master/pangkat_golongan', PangkatGolonganController::class);
    Route::get('master/pegawai/loadData', [PegawaiController::class, 'loadData'])->name('pegawai.loadData');
    Route::resource('master/pegawai', PegawaiController::class);

    // pkaspt
    Route::get('dokumen/pkaspt', [PkaSptController::class, 'index'])->name('pkaspt.index');
    Route::post('dokumen/pkaspt/loadData', [PkaSptController::class, 'loadData'])->name('pkaspt.loadData');
    Route::get('dokumen/pkaspt/pemohon_spt', [PkaSptController::class, 'loadPemohonSpt'])->name('pkaspt.pemohon_spt');
    Route::get('dokumen/pkaspt/create', [PkaSptController::class, 'create'])->name('pkaspt.create');
    Route::get('dokumen/pkaspt/pka/{pka}/edit', [PkaSptController::class, 'edit'])->name('pkaspt.pka.edit');
    Route::get('dokumen/pkaspt/pka/{id}/file_pdf', [PkaSptController::class, 'filePdf'])->name('pkaspt.pka.filepdf');
    // Route::get('dokumen/pkaspt/pka/{id}/view_pdf_test', [PkaSptController::class, 'viewPdf_test'])->name('pkaspt.pka.viewpdf_2'); // tidak ada button untuk ke controller ini, hanya bisa langsung di panggil via url
    Route::post('dokumen/pkaspt/pka', [PkaSptController::class, 'store_pka'])->name('pkaspt.pka.store');
    Route::match(['PUT', 'PATCH'], 'dokumen/pkaspt/pka/{id}', [PkaSptController::class, 'update'])->name('pkaspt.pka.update');
    Route::resource('dokumen/pkaspt/spt', SptController::class);
    Route::resource('dokumen/pkaspt/spt/dasartugas', DasarTugasController::class);
    Route::get('dokumen/pkaspt/spt/dasartugas/{spt}/dasartugas_by_spt', [DasarTugasController::class, 'loadDataBySpt'])->name('pkaspt.spt.dasartugas.byspt');
    Route::resource('dokumen/pkaspt/spt/anggota', AnggotaController::class);
    Route::get('dokumen/pkaspt/spt/{spt}/anggota/anggota_by_spt', [AnggotaController::class, 'loadDataBySpt'])->name('pkaspt.spt.anggota.byspt');

    // Route::resource('dokumen/pkaspt', PkaSptController::class);
    // Route::match(['PUT', 'PATCH'], 'dokumen/pkaspt/spt/{id}', [PkaSptController::class, 'update_spt'])->name('pkaspt.spt.update');
    // Route::patch('dokumen/pkaspt/spt/{id}', [PkaSptController::class, 'update_spt'])->name('pkaspt.spt.update');

    // Route::resource('dummy/spt', DummySptController::class);
});
