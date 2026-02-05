@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl p-8 mb-8 text-white shadow-xl relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-3xl font-bold mb-2">Halo, {{ auth()->user()->name }}! 👋</h1>
            <p class="text-blue-100 text-lg opacity-90">Semangat mencatat transaksi hari ini.</p>
        </div>
        <div class="absolute right-0 top-0 h-full w-1/3 bg-white/10 skew-x-12 transform translate-x-12"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-1 space-y-6">
            <a href="{{ route('transactions.create') }}" class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:border-blue-200 transition-all duration-300 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-300">
                    <svg class="w-8 h-8 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition-colors">Buat Transaksi Baru</h3>
                <p class="text-gray-500 text-sm">Masuk ke mesin kasir.</p>
            </a>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h4 class="text-gray-500 text-sm font-semibold uppercase mb-4">Total Produk</h4>
                <div class="flex items-center justify-between">
                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Product::count() }}</p>
                    <span class="p-2 bg-green-50 text-green-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-full">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg">Grafik Penjualan</h3>
                        <p class="text-sm text-gray-500">Omzet 7 hari terakhir</p>
                    </div>
                    <span class="bg-blue-50 text-blue-600 text-xs font-bold px-3 py-1 rounded-full">Weekly</span>
                </div>
                
                <div class="relative h-64 md:h-80 w-full">
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
        
        // Data dari Laravel Controller
        const labels = @json($dates);
        const data = @json($totals);

        new Chart(ctx, {
            type: 'line', // Jenis grafik: Line (Garis) atau Bar (Batang)
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: data,
                    borderColor: '#2563eb', // Warna Garis (Blue-600)
                    backgroundColor: 'rgba(37, 99, 235, 0.1)', // Warna Arsiran bawah
                    borderWidth: 2,
                    tension: 0.4, // Kelengkungan garis (0 = lurus)
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2563eb',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Sembunyikan legend agar bersih
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    // Format Rupiah di Tooltip
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        },
                        ticks: {
                            // Format Rupiah di Sumbu Y (Kependekan, misal 1jt)
                            callback: function(value) {
                                return 'Rp ' + (value / 1000).toLocaleString('id-ID') + 'k';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection