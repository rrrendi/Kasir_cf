@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Laporan Penjualan</h1>
            <p class="text-gray-500 mt-1">Rekapitulasi transaksi dan keuntungan harian.</p>
        </div>
        
        <form method="GET" class="flex items-center gap-3 bg-white p-2 rounded-lg shadow-sm border border-gray-200">
            <label class="text-gray-600 font-medium text-sm">Pilih Tanggal:</label>
            <input type="date" name="date" value="{{ $date }}" 
                   class="border-gray-300 rounded text-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold transition">
                Filter
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-indigo-500 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-indigo-500 uppercase tracking-wider">Produk Terjual</p>
                    <p class="text-gray-400 text-xs mt-1">Hari ini</p>
                </div>
                <div class="p-2 bg-indigo-50 rounded-lg">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mt-4">{{ number_format($totalQty) }} <span class="text-sm font-normal text-gray-500">Unit</span></h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-blue-500 uppercase tracking-wider">Total Pendapatan</p>
                    <p class="text-gray-400 text-xs mt-1">Omzet Kotor</p>
                </div>
                <div class="p-2 bg-blue-50 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mt-4">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-yellow-500 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-yellow-500 uppercase tracking-wider">Konsinyasi (80%)</p>
                    <p class="text-gray-400 text-xs mt-1">Hak Milik Supplier</p>
                </div>
                <div class="p-2 bg-yellow-50 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mt-4">Rp {{ number_format($totalConsignment, 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-green-500 uppercase tracking-wider">Profit Bersih (20%)</p>
                    <p class="text-gray-400 text-xs mt-1">Hak Milik Kantin</p>
                </div>
                <div class="p-2 bg-green-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-green-600 mt-4">Rp {{ number_format($totalProfit, 0, ',', '.') }}</h3>
        </div>
    </div>

    <div class="flex justify-end mb-4">
        <a href="{{ route('reports.pdf') }}" 
           class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg shadow-md flex items-center gap-2 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Download Laporan PDF
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-8">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-bold text-gray-700">Detail Item Terjual</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-sm uppercase">
                        <th class="py-3 px-6 border-b">Nama Produk</th>
                        <th class="py-3 px-6 border-b text-center">Qty</th>
                        <th class="py-3 px-6 border-b text-right">Total Penjualan</th>
                        <th class="py-3 px-6 border-b text-right text-yellow-600">Konsinyasi (80%)</th>
                        <th class="py-3 px-6 border-b text-right text-green-600">Profit (20%)</th>
                        <th class="py-3 px-6 border-b text-center">Waktu</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @forelse ($transactions as $trx)
                        @foreach ($trx->details as $detail)
                        <tr class="hover:bg-blue-50 transition border-b border-gray-100">
                            <td class="py-3 px-6 font-medium">{{ $detail->product->name }}</td>
                            <td class="py-3 px-6 text-center">{{ $detail->qty }}</td>
                            <td class="py-3 px-6 text-right font-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-right text-yellow-600">Rp {{ number_format($detail->subtotal * 0.8, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-right text-green-600 font-bold">Rp {{ number_format($detail->subtotal * 0.2, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-center text-gray-500 text-xs">
                                {{ $trx->created_at->format('H:i') }}
                            </td>
                        </tr>
                        @endforeach
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400 italic">
                            Belum ada transaksi pada tanggal ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection