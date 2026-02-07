@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Laporan Penjualan</h1>
            <p class="text-gray-500 text-sm mt-1">Analisa kewangan untuk tarikh: <span class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</span></p>
        </div>
        
        <form method="GET" class="flex items-center gap-2 bg-white p-1.5 rounded-lg shadow-sm border border-gray-200">
            <input type="date" name="date" value="{{ $date }}" 
                   class="border-none text-sm text-gray-600 focus:ring-0 rounded-md bg-transparent">
            <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-md text-sm font-medium transition">
                Tapis
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Unit Terjual</p>
            <p class="text-2xl font-bold text-gray-900 mt-2">{{ number_format($totalQty) }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-xs font-bold text-blue-500 uppercase tracking-wider">Total Pendapatan</p>
            <p class="text-2xl font-bold text-gray-900 mt-2">Rp {{ number_format($totalIncome) }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-xs font-bold text-orange-500 uppercase tracking-wider">Konsinyasi (80%)</p>
            <p class="text-2xl font-bold text-orange-600 mt-2">Rp {{ number_format($totalConsignment) }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm bg-gradient-to-br from-green-50 to-white">
            <p class="text-xs font-bold text-green-600 uppercase tracking-wider">Keuntungan Bersih (20%)</p>
            <p class="text-2xl font-bold text-green-600 mt-2">Rp {{ number_format($totalProfit) }}</p>
        </div>
    </div>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.reports.pdf', ['date' => $date]) }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-lg shadow transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Muat Turun PDF
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-bold text-gray-800">Rincian Transaksi & Konsinyasi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Produk</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Qty</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Total Jual</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Konsinyasi (80%)</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Untung (20%)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($transactions as $trx)
                        @foreach ($trx->details as $detail)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $detail->product->name }}</td>
                            <td class="px-6 py-4 text-sm text-center text-gray-600">{{ $detail->qty }}</td>
                            <td class="px-6 py-4 text-sm text-right font-mono text-gray-700">Rp {{ number_format($detail->subtotal) }}</td>
                            <td class="px-6 py-4 text-sm text-right font-mono text-orange-600">Rp {{ number_format($detail->subtotal * 0.8) }}</td>
                            <td class="px-6 py-4 text-sm text-right font-mono text-green-600 font-bold">Rp {{ number_format($detail->subtotal * 0.2) }}</td>
                        </tr>
                        @endforeach
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">
                            Tiada transaksi direkodkan pada tarikh ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection