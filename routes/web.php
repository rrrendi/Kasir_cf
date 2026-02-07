<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Kasir\CategoryController;
use App\Models\Transaction;

// 1. Root: Arahkan User Sesuai Role
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::user()->role === 'kasir') {
            return redirect()->route('kasir.dashboard');
        }
    }
    return view('auth.login');
})->name('login');


// 2. Group Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Manajemen Produk (CRUD)
    Route::resource('products', ProductController::class);

    // Laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
});


// 3. Group Kasir
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    
    // Dashboard Kasir
    Route::get('/dashboard', function () {
        $salesData = Transaction::selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $dates = $salesData->pluck('date')->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M'))->toArray();
        $totals = $salesData->pluck('total')->toArray();

        return view('kasir.dashboard', compact('dates', 'totals'));
    })->name('dashboard');

    // Kategori Produk
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}/products', [CategoryController::class, 'productsByCategory'])->name('products.by_category');

    // Transaksi
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    
    // Cetak Struk
    Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])->name('transactions.print');
});


// 4. Group Profile (Bawaan Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';