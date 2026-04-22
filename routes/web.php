
<?php

use App\Http\Controllers\AdminDashboard\UsersAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboard\AdminController;
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

    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

});


// ================= USER =================
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {

    Route::get('/dashboard', function () {
        return 'Dashboard User';
    })->name('user.dashboard');

});


// LOGOUT

?>