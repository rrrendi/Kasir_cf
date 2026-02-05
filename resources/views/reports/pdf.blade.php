<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Laporan Penjualan Kantin CF</h2>

<p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalIncome) }}</p>
<p><strong>Total Konsinyasi (80%):</strong> Rp {{ number_format($totalIncome * 0.8) }}</p>
<p><strong>Keuntungan (20%):</strong> Rp {{ number_format($totalIncome * 0.2) }}</p>

<h3>Detail Konsinyasi</h3>

<table>
    <thead>
        <tr>
            <th>Produk</th>
            <th>Qty</th>
            <th>Harga Jual</th>
            <th>Konsinyasi (80%)</th>
            <th>Keuntungan (20%)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $trx)
            @foreach ($trx->details as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->qty }}</td>
                <td>Rp {{ number_format($detail->subtotal) }}</td>
                <td>Rp {{ number_format($detail->subtotal * 0.8) }}</td>
                <td>Rp {{ number_format($detail->subtotal * 0.2) }}</td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

</body>
</html>
