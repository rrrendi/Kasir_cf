<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; color: #666; }
        
        .summary-box { width: 100%; margin-bottom: 20px; }
        .summary-table { width: 100%; border-collapse: collapse; }
        .summary-table td { padding: 8px; border: 1px solid #ddd; background: #f9f9f9; }
        .label { font-weight: bold; width: 40%; }
        .value { text-align: right; font-family: monospace; font-weight: bold; }

        table.data { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.data th, table.data td { border: 1px solid #000; padding: 6px 8px; }
        table.data th { background-color: #eee; text-align: left; font-weight: bold; }
        table.data td { text-align: left; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        .footer { margin-top: 30px; text-align: right; font-size: 10px; color: #888; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Penjualan Harian</h1>
        <p>Kantin CF - Sistem Point of Sales</p>
        <p>Tanggal: {{ \Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }}</p>
    </div>

    <div class="summary-box">
        <table class="summary-table">
            <tr>
                <td class="label">Total Pendapatan (Omzet)</td>
                <td class="value">Rp {{ number_format($totalIncome, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label" style="color: #d97706;">Total Konsinyasi (Bayar ke Supplier)</td>
                <td class="value" style="color: #d97706;">Rp {{ number_format($totalIncome * 0.8, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label" style="color: #16a34a;">Keuntungan Bersih (Profit)</td>
                <td class="value" style="color: #16a34a;">Rp {{ number_format($totalIncome * 0.2, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <h3>Rekapitulasi Produk & Konsinyasi</h3>

    <table class="data">
        <thead>
            <tr>
                <th>Produk</th>
                <th class="text-center">Total Qty</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Total Subtotal</th>
                <th class="text-right">Konsinyasi (80%)</th>
                <th class="text-right">Profit (20%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td class="text-center" style="font-weight: bold;">{{ $item->total_qty }}</td>
                <td class="text-right">{{ number_format($item->product->price, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item->total_subtotal, 0, ',', '.') }}</td>
                <td class="text-right" style="color: #d97706;">{{ number_format($item->total_subtotal * 0.8, 0, ',', '.') }}</td>
                <td class="text-right" style="color: #16a34a;">{{ number_format($item->total_subtotal * 0.2, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right" style="font-weight: bold;">TOTAL AKHIR</td>
                <td class="text-right" style="font-weight: bold;">Rp {{ number_format($totalIncome, 0, ',', '.') }}</td>
                <td class="text-right" style="font-weight: bold; color: #d97706;">Rp {{ number_format($totalIncome * 0.8, 0, ',', '.') }}</td>
                <td class="text-right" style="font-weight: bold; color: #16a34a;">Rp {{ number_format($totalIncome * 0.2, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dicetak oleh: {{ auth()->user()->name ?? 'Administrator' }} | Waktu: {{ now()->format('H:i') }}
    </div>

</body>
</html>