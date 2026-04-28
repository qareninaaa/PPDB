
<?php

use App\Http\Controllers\AdminDashboard\UsersAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboard\AdminController;
use App\Http\Controllers\AdminDashboard\CalonSiswaController;
use App\Http\Controllers\AdminDashboard\PendaftaranController;
use App\Http\Controllers\SiswaDashboard\PendaftaranSiswaController;
use App\Http\Controllers\SiswaDashboard\SiswaController;
use App\Http\Controllers\SiswaDashboard\ProfileController;
use App\Http\Controllers\AdminDashboard\AdminProfileController;
use App\Http\Controllers\AdminDashboard\PengumumanController;
use App\Http\Controllers\UserPage\UsersController;
use Illuminate\Support\Facades\Auth;

// AUTH
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');



// prefix itu menambahkan "/admin" didepan semua route, jdi kia ga perlu nulis /admin misalnya di depannya /dashboard -> Route::get('/dashboard',
// ================= ADMIN =================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () { 

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('datasiswa', CalonSiswaController::class );

    Route::get('/profile', [AdminProfileController::class, 'index'])->name('admin.profile');
    Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');


   // PENDAFTARAN
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::get('/pendaftaran/{id}/terima', [PendaftaranController::class, 'terima'])->name('pendaftaran.terima');
    Route::get('/pendaftaran/{id}/tolak', [PendaftaranController::class, 'tolak'])->name('pendaftaran.tolak');
    

    // DATA SISWA
    Route::get('/datasiswa', [CalonSiswaController::class, 'index'])->name('datasiswa.index');
    Route::get('/datasiswa/{id}', [CalonSiswaController::class, 'show'])->name('datasiswa.show');
    Route::get('/datasiswa/{id}/edit', [CalonSiswaController::class, 'edit'])->name('datasiswa.edit');
    Route::put('/datasiswa/{id}', [CalonSiswaController::class, 'update'])->name('datasiswa.update');
    Route::delete('/datasiswa/{id}', [CalonSiswaController::class, 'destroy'])->name('datasiswa.destroy');
    Route::get('/datasiswa/{id}/diterima', [CalonSiswaController::class, 'diterima'])->name('datasiswa.diterima');
    
    Route::get('/admin/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/admin/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
    Route::post('/admin/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::delete('/admin/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');


});


Route::middleware(['auth', 'user'])->prefix('siswa')->group(function () {

    Route::get('/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');

    Route::get('/pendaftaran/create', [PendaftaranSiswaController::class, 'create'])->name('siswa.pendaftaran.create');

    Route::post('/pendaftaran/store', [PendaftaranSiswaController::class, 'store'])->name('siswa.pendaftaran.store');

    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');

    Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');

});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');
?>