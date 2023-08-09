<?php

use App\Http\Controllers\BagianController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PkaSptController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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
    // pkaspt
    Route::get('dokumen/pkaspt/loadData', [PkaSptController::class, 'loadData'])->name('pkaspt.loadData');
    Route::resource('dokumen/pkaspt', PkaSptController::class);
});
