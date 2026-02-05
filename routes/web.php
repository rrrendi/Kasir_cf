<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
// Route::get('/', function () {
//     return view('public.home');
// })->name('home');

Route::get('/', function () {
    return view('auth.login');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('products', ProductController::class);

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])
        ->name('reports.pdf');
});

/*
|--------------------------------------------------------------------------
| Kasir Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/dashboard', function () {
        return view('kasir.dashboard');
    })->name('kasir.dashboard');

    Route::get('/transactions/create', [TransactionController::class, 'create'])
        ->name('transactions.create');

    Route::post('/transactions', [TransactionController::class, 'store'])
        ->name('transactions.store');
});

/*
|--------------------------------------------------------------------------
| Profile (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (WAJIB)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
