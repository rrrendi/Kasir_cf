<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $transaction->invoice_code }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;600&display=swap');
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Roboto Mono', monospace; }
        
        body {
            background: #fff7ed; /* Orange-50 */
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .receipt {
            width: 320px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(249, 115, 22, 0.1), 0 4px 6px -2px rgba(249, 115, 22, 0.05);
            position: relative;
            border: 1px solid #ffedd5;
        }
        
        /* Garis atas oren */
        .receipt::before {
            content: '';
            position: absolute;
            top: 0; left: 20px; right: 20px;
            height: 6px;
            background: linear-gradient(90deg, #f97316, #fb923c);
            border-radius: 0 0 4px 4px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px dashed #fed7aa;
        }
        
        .store-name { font-size: 22px; font-weight: bold; color: #c2410c; margin-bottom: 4px; }
        .store-address { font-size: 11px; color: #9a3412; margin-bottom: 4px; }
        
        .info-row { display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 12px; }
        .info-label { color: #9a3412; }
        .info-value { font-weight: 600; color: #431407; }
        
        .items { margin: 15px 0; }
        .item-row { display: flex; justify-content: space-between; margin-bottom: 8px; padding-bottom: 8px; border-bottom: 1px dashed #fed7aa; }
        .item-name { flex: 1; font-size: 12px; color: #431407; font-weight: 500; }
        .item-qty { width: 40px; text-align: center; font-size: 12px; color: #9a3412; }
        .item-price { width: 90px; text-align: right; font-size: 12px; font-weight: 600; color: #431407; }
        
        .total-section {
            background: #fff7ed;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #ffedd5;
        }
        
        .total-row { display: flex; justify-content: space-between; margin-bottom: 6px; }
        .total-label { color: #9a3412; font-size: 12px; }
        .total-value { font-weight: 600; color: #431407; font-size: 13px; }
        
        .grand-total {
            border-top: 2px dashed #fdba74;
            padding-top: 10px;
            margin-top: 10px;
        }
        
        .footer { text-align: center; margin-top: 20px; padding-top: 15px; border-top: 2px dashed #fed7aa; }
        .thank-you { font-size: 14px; color: #ea580c; font-weight: bold; margin-bottom: 5px; }
        .message { font-size: 11px; color: #9a3412; }
        
        @media print {
            body { background: white; }
            .receipt { box-shadow: none; border: none; }
            .no-print { display: none !important; }
        }

        .print-buttons { display: flex; gap: 10px; margin-top: 20px; justify-content: center; }
        .print-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            font-family: sans-serif;
            font-size: 14px;
        }
        .print-btn-primary { background: #f97316; color: white; box-shadow: 0 4px 6px rgba(249, 115, 22, 0.3); }
        .print-btn-primary:hover { background: #ea580c; transform: translateY(-1px); }
        .print-btn-secondary { background: #fed7aa; color: #7c2d12; }
        .print-btn-secondary:hover { background: #fdba74; }
    </style>
</head>
<body>
    <div>
        <div class="receipt">
            <div class="header">
                <div class="store-name">KANTIN CF</div>
                <div class="store-address">Jl. Teknologi No. 1, Bandung</div>
            </div>
            
            <div class="transaction-info">
                <div class="info-row"><span class="info-label">No.</span><span class="info-value">{{ $transaction->invoice_code }}</span></div>
                <div class="info-row"><span class="info-label">Tgl</span><span class="info-value">{{ $transaction->created_at->format('d/m/y H:i') }}</span></div>
                <div class="info-row"><span class="info-label">Kasir</span><span class="info-value">{{ $transaction->user->name }}</span></div>
            </div>
            
            <div class="items">
                @foreach($transaction->details as $detail)
                <div class="item-row">
                    <div class="item-name">{{ $detail->product->name }}</div>
                    <div class="item-qty">{{ $detail->qty }}</div>
                    <div class="item-price">{{ number_format($detail->price * $detail->qty, 0, ',', '.') }}</div>
                </div>
                @endforeach
            </div>
            
            <div class="total-section">
                <div class="total-row grand-total">
                    <span class="total-label" style="font-size: 14px; font-weight: bold;">TOTAL BAYAR</span>
                    <span class="total-value" style="font-size: 18px; color: #ea580c;">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>
            </div>
            
            <div class="footer">
                <div class="thank-you">TERIMA KASIH</div>
                <div class="message">Simpan struk ini sebagai bukti pembayaran yang sah</div>
            </div>
        </div>
        
        <div class="print-buttons no-print">
            <button onclick="window.print()" class="print-btn print-btn-primary">🖨️ Cetak</button>
            <a href="{{ route('kasir.transactions.create') }}" class="print-btn print-btn-secondary">Kembali</a>
        </div>
    </div>
</body>
</html>