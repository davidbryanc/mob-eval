<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\EnrollController;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('index');
    
    Route::get('/setting', [SettingController::class, 'index'])->name('setting');
    Route::post('/setting/change_password', [SettingController::class, 'change_password'])->name('setting.change_password');

    Route::get('/students', [AbsenController::class, 'index'])->name('students');
    Route::post('/students/get_sesi', [AbsenController::class, 'get_sesi'])->name('students.get_sesi');
    Route::post('/students/get_mhs', [AbsenController::class, 'get_mhs'])->name('students.get_mhs');
    Route::post('/students/get_modal_pelanggaran', [AbsenController::class, 'get_modal_pelanggaran'])->name('students.get_modal_pelanggaran');
    Route::post('/students/get_modal_izin', [AbsenController::class, 'get_modal_izin'])->name('students.get_modal_izin');
    Route::post('/students/set_absensi', [AbsenController::class, 'set_absensi'])->name('students.set_absensi');
    Route::post('/students/set_pelanggaran', [AbsenController::class, 'set_pelanggaran'])->name('students.set_pelanggaran');

    Route::get('/enroll', [EnrollController::class, 'index'])->name('enroll');
    Route::post('/enroll/set_kelompok', [EnrollController::class, 'set_kelompok'])->name('enroll.set_kelompok');
    Route::post('/enroll/get_student', [EnrollController::class, 'get_student'])->name('enroll.get_student');
});
