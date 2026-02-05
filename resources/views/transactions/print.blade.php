<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Belanja #{{ $transaction->invoice_code }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            width: 300px; /* Ukuran kertas struk thermal */
            margin: 0 auto;
            padding: 10px;
        }
        .header { text-align: center; border-bottom: 1px dashed #000; padding-bottom: 10px; margin-bottom: 10px; }
        .footer { text-align: center; border-top: 1px dashed #000; padding-top: 10px; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 4px 0; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2 style="margin:0;">KANTIN CF</h2>
        <p style="margin:5px 0;">Jl. Teknologi No. 1, Bandung</p>
        <p style="margin:0;">Telp: 0812-3456-7890</p>
    </div>

    <table>
        <tr>
            <td>No. Inv</td>
            <td class="text-right">{{ $transaction->invoice_code }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td class="text-right">{{ $transaction->user->name }}</td>
        </tr>
        <tr>
            <td>Waktu</td>
            <td class="text-right">{{ $transaction->created_at->format('d/m/y H:i') }}</td>
        </tr>
    </table>

    <hr style="border: 0; border-top: 1px dashed #000; margin: 10px 0;">

    <table>
        @foreach($transaction->details as $detail)
        <tr>
            <td colspan="2" class="bold">{{ $detail->product->name }}</td>
        </tr>
        <tr>
            <td>{{ $detail->qty }} x {{ number_format($detail->price, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <hr style="border: 0; border-top: 1px dashed #000; margin: 10px 0;">

    <table>
        <tr class="bold" style="font-size: 14px;">
            <td>TOTAL</td>
            <td class="text-right">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Bayar</td>
            <td class="text-right">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td class="text-right">Rp 0</td>
        </tr>
    </table>

    <div class="footer">
        <p>Terima Kasih atas Kunjungan Anda</p>
        <p>Barang yang dibeli tidak dapat ditukar</p>
    </div>

    <button class="no-print" onclick="window.print()" style="width:100%; padding: 10px; margin-top: 20px; cursor: pointer;">
        Cetak Struk
    </button>
    <a href="{{ route('transactions.create') }}" class="no-print" style="display:block; text-align:center; margin-top:10px; text-decoration:none; color:blue;">
        &laquo; Kembali ke Kasir
    </a>

</body>
</html>