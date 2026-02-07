<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Models\Transaction;
use App\Models\Product; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon; 

Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin' 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('kasir.dashboard');
    }
    return view('auth.login');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $transactions = Transaction::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total')
        )
        ->where('created_at', '>=', $startDate)
        ->groupBy('date')
        ->get()
        ->pluck('total', 'date');

        $dates = [];
        $totals = [];
        
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->subDays(6 - $i)->format('Y-m-d');
            $dates[] = Carbon::now()->subDays(6 - $i)->isoFormat('dddd');
            $totals[] = $transactions[$date] ?? 0;
        }

        return view('admin.dashboard', compact('dates', 'totals'));
    })->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
});

Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    

    Route::get('/dashboard', function () {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $transactions = Transaction::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total')
        )
        ->where('created_at', '>=', $startDate)
        ->groupBy('date')
        ->get()
        ->pluck('total', 'date');

        $dates = [];
        $totals = [];
        
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->subDays(6 - $i)->format('Y-m-d');
            $dates[] = Carbon::now()->subDays(6 - $i)->isoFormat('dddd');
            $totals[] = $transactions[$date] ?? 0;
        }

        return view('kasir.dashboard', compact('dates', 'totals'));
    })->name('dashboard');

    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])->name('transactions.print');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';