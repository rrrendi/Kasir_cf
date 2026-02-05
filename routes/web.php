<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Public Route (Root)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Cek apakah user sudah login?
    if (Auth::check()) {
        // Jika Admin, lempar ke dashboard admin
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        // Jika Kasir, lempar ke dashboard kasir
        if (Auth::user()->role === 'kasir') {
            return redirect()->route('kasir.dashboard');
        }
    }
    // Jika belum login, tampilkan form login
    return view('auth.login');
})->name('login'); // Beri nama route ini 'login'


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
// ... (lanjutkan kode route admin Anda seperti biasa di bawah sini)
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
    
    // Tambahkan route cetak struk disini jika belum ada
    Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])
        ->name('transactions.print');
});

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';