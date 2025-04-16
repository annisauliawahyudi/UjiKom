<?php

use App\Models\Pengaduan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;


Route::get('/', [ComentController::class, 'index'])->name('home');
Route::get('komentar/{id}', [ComentController::class, 'show'])->name('coment');
Route::post('/pengaduan/{pengaduanId}/komentar', [ComentController::class, 'store'])->name('coment.store');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.user.')->group(function(){
    Route::get('/user', [UserController::class, 'index'])->name('petugas');
    Route::get('/admin', [UserController::class, 'indexAdmin'])->name('index');
    Route::post('/admin/users', [UserController::class, 'store'])->name('store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('destroy');
    // Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::prefix('petugas')->middleware(['auth', 'role:petugas'])->name('petugas.')->group(function(){
    // Route::get('/report', [ReportController::class,'reportView'])->name('report');
    Route::get('pengaduan/{id}', [ReportController::class, 'show'])->name('coment');
    Route::put('/pengaduan/{id}/aksi', [ReportController::class, 'aksiGabungan'])->name('aksi');
    Route::delete('/pengaduan/{id}', [ReportController::class, 'destroy'])->name('destroy');
    Route::delete('/komentar/{id}', [ComentController::class, 'destroy'])->name('komentar.destroy');

});

Route::prefix('masyarakat')->middleware(['auth', 'role:masyarakat'])->name('masyarakat.')->group(function(){
    Route::get('/report', [ReportController::class, 'index'])->name('index');
    Route::get('/show-all', [ComentController::class,'indexMasyarakat'])->name('all');
    Route::post('/report/store', [ReportController::class, 'store'])->name('store');
    Route::get('/report/create', [ReportController::class, 'create'])->name('create');
    Route::put('report/edit{id}',[ReportController::class, 'update'])->name('update');
    Route::delete('report/{id}', [ReportController::class, 'destroy'])->name('destroy');
});

Route::post('/pengaduan/{id}/like', [ReportController::class, 'like'])->name('pengaduan.like');
Route::post('pengaduan/{id}/view', [ReportController::class, 'incrementViewCount'])->name('pengaduan.view');
Route::get('/export-pengaduan', [ReportController::class, 'export'])->name('export_pengaduan');



