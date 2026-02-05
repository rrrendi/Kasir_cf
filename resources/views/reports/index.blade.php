<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
</head>
<body>

<h1>Laporan Penjualan</h1>

<form method="GET">
    <label>Pilih Tanggal:</label>
    <input type="date" name="date" value="{{ $date }}">
    <button type="submit">Filter</button>
</form>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Produk Terjual</p>
        <p class="text-2xl font-bold">{{ $totalQty }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Total Pendapatan</p>
        <p class="text-2xl font-bold">
            Rp {{ number_format($totalIncome) }}
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Total Konsinyasi (80%)</p>
        <p class="text-2xl font-bold text-blue-600">
            Rp {{ number_format($totalConsignment) }}
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Keuntungan (20%)</p>
        <p class="text-2xl font-bold text-green-600">
            Rp {{ number_format($totalProfit) }}
        </p>
    </div>
</div>

<br>

<a href="{{ route('reports.pdf') }}"
   class="bg-brand text-white px-4 py-2 rounded hover:bg-brandDark">
   Export PDF
</a>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Laporan Penjualan</h1>

    <a href="{{ route('reports.pdf') }}"
       class="bg-brand text-white px-4 py-2 rounded hover:bg-brandDark transition">
        Export PDF
    </a>
</div>

<table border="1" cellpadding="5">
<table class="w-full border-collapse bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="p-3 text-left">Tanggal</th>
            <th class="p-3 text-left">Kasir</th>
            <th class="p-3 text-left">Total</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($transactions as $trx)
        <tr class="hover:bg-gray-100 transition">
            <td class="p-3">{{ $trx->transaction_date }}</td>
            <td class="p-3">{{ $trx->user->name }}</td>
            <td class="p-3">
                <span class="px-3 py-1 rounded text-white bg-green-600">
                    Rp {{ number_format($trx->total) }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="p-4 text-center text-gray-500">
                Tidak ada transaksi
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<h2 class="text-xl font-bold mt-10 mb-4">Detail Konsinyasi</h2>

<table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="p-3 text-left">Produk</th>
            <th class="p-3 text-left">Qty</th>
            <th class="p-3 text-left">Harga Jual</th>
            <th class="p-3 text-left">Konsinyasi (80%)</th>
            <th class="p-3 text-left">Keuntungan (20%)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $trx)
            @foreach ($trx->details as $detail)
            <tr class="hover:bg-gray-100 transition">
                <td class="p-3">{{ $detail->product->name }}</td>
                <td class="p-3">{{ $detail->qty }}</td>
                <td class="p-3">
                    Rp {{ number_format($detail->subtotal) }}
                </td>
                <td class="p-3 text-blue-600">
                    Rp {{ number_format($detail->subtotal * 0.8) }}
                </td>
                <td class="p-3 text-green-600">
                    Rp {{ number_format($detail->subtotal * 0.2) }}
                </td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

<h3>Total Pendapatan: {{ $totalIncome }}</h3>

</body>
</html>
