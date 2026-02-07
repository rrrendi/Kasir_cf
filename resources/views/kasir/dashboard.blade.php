@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl p-8 mb-8 text-white shadow-lg shadow-orange-200 relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold mb-2">Halo, {{ auth()->user()->name }}! 👋</h1>
                <p class="text-orange-100 opacity-90">Siap mencatat transaksi baru?</p>
            </div>
            <a href="{{ route('kasir.transactions.create') }}" class="bg-white text-orange-600 px-6 py-3 rounded-xl font-bold shadow-md hover:bg-orange-50 transition-colors flex items-center gap-2 w-fit">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Transaksi
            </a>
        </div>
        <div class="absolute right-0 bottom-0 h-32 w-32 bg-white/10 rounded-full blur-3xl -mr-10 -mb-10"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm shadow-orange-100/50 border border-orange-100 h-full flex flex-col justify-center items-center text-center">
                <div class="p-4 bg-orange-50 text-orange-600 rounded-full mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 3.666V9.111c0-.829.508-1.643 1.371-1.956 1.139-.413 2.112.597 1.371 1.956L17 10.222M12 21h9a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ \App\Models\Transaction::count() }}</h3>
                <p class="text-sm text-gray-500 uppercase tracking-wider font-bold">Total Transaksi</p>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-2xl shadow-sm shadow-orange-100/50 border border-orange-100 h-full">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        Grafik Pendapatan
                    </h3>
                    <span class="text-xs bg-orange-50 text-orange-700 px-3 py-1 rounded-full border border-orange-100 font-bold">7 Hari Terakhir</span>
                </div>
                <div class="relative h-64 w-full">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const labels = @json($dates ?? []); 
        const data = @json($totals ?? []);

        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(249, 115, 22, 0.2)');
        gradient.addColorStop(1, 'rgba(249, 115, 22, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Omzet',
                    data: data,
                    borderColor: '#f97316',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#ea580c',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { beginAtZero: true, grid: { borderDash: [5, 5] }, ticks: { callback: (v) => 'Rp ' + (v/1000) + 'k' } }, 
                    x: { grid: { display: false } } 
                }
            }
        });
    });
</script>
@endsection