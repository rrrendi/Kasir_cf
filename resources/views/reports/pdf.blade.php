<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; color: #666; }
        
        .summary-box { width: 100%; margin-bottom: 20px; }
        .summary-table { width: 100%; border-collapse: collapse; }
        .summary-table td { padding: 8px; border: 1px solid #ddd; background: #f9f9f9; }
        .label { font-weight: bold; width: 40%; }
        .value { text-align: right; font-family: 'Courier New', monospace; font-weight: bold; }

        table.data { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.data th, table.data td { border: 1px solid #000; padding: 6px 8px; }
        table.data th { background-color: #eee; text-align: left; font-weight: bold; }
        table.data td { text-align: left; }
        .text-right { text-align: right !important; }
        .text-center { text-align: center !important; }
        
        .footer { margin-top: 30px; text-align: right; font-size: 10px; color: #888; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Penjualan Harian</h1>
        <p>Kantin CF - Sistem Point of Sales</p>
        <p>Tanggal Cetak: {{ now()->format('d F Y, H:i') }}</p>
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

    <h3>Rincian Transaksi</h3>

    <table class="data">
        <thead>
            <tr>
                <th>Produk</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Subtotal</th>
                <th class="text-right">Profit (20%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $trx)
                @foreach ($trx->details as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td class="text-center">{{ $detail->qty }}</td>
                    <td class="text-right">{{ number_format($detail->product->price, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($detail->subtotal * 0.2, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right" style="font-weight: bold;">TOTAL</td>
                <td class="text-right" style="font-weight: bold;">Rp {{ number_format($totalIncome, 0, ',', '.') }}</td>
                <td class="text-right" style="font-weight: bold;">Rp {{ number_format($totalIncome * 0.2, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dicetak oleh: {{ auth()->user()->name ?? 'Administrator' }}
    </div>

</body>
</html>