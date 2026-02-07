<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $transaction->invoice_code }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;600&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto Mono', monospace;
        }
        
        body {
            background: #f3f4f6;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .receipt {
            width: 300px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            position: relative;
        }
        
        .receipt::before {
            content: '';
            position: absolute;
            top: 0;
            left: 20px;
            right: 20px;
            height: 5px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            border-radius: 0 0 2px 2px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px dashed #e5e7eb;
        }
        
        .store-name {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 4px;
        }
        
        .store-address {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 8px;
        }
        
        .transaction-info {
            margin-bottom: 15px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
            font-size: 12px;
        }
        
        .info-label {
            color: #6b7280;
        }
        
        .info-value {
            font-weight: 500;
            color: #1f2937;
        }
        
        .items {
            margin-bottom: 15px;
        }
        
        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            padding-bottom: 6px;
            border-bottom: 1px dashed #e5e7eb;
        }
        
        .item-name {
            flex: 1;
            font-size: 12px;
            color: #1f2937;
        }
        
        .item-qty {
            width: 40px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
        
        .item-price {
            width: 80px;
            text-align: right;
            font-size: 12px;
            font-weight: 500;
            color: #1f2937;
        }
        
        .total-section {
            background: #f9fafb;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .total-label {
            color: #6b7280;
            font-size: 13px;
        }
        
        .total-value {
            font-weight: 600;
            color: #1f2937;
            font-size: 13px;
        }
        
        .grand-total {
            border-top: 2px solid #e5e7eb;
            padding-top: 10px;
            margin-top: 10px;
        }
        
        .payment-method {
            background: #eff6ff;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 15px;
        }
        
        .payment-label {
            font-size: 11px;
            color: #3b82f6;
            margin-bottom: 4px;
        }
        
        .payment-value {
            font-size: 13px;
            font-weight: 600;
            color: #1e40af;
        }
        
        .footer {
            text-align: center;
            padding-top: 15px;
            border-top: 2px dashed #e5e7eb;
        }
        
        .thank-you {
            font-size: 13px;
            color: #3b82f6;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .message {
            font-size: 11px;
            color: #6b7280;
            line-height: 1.4;
        }
        
        .barcode {
            margin: 15px auto;
            text-align: center;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .receipt {
                box-shadow: none;
                width: 100%;
                max-width: 300px;
                margin: 0;
            }
            
            .no-print {
                display: none !important;
            }
        }
        
        .print-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            justify-content: center;
        }
        
        .print-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .print-btn-primary {
            background: #3b82f6;
            color: white;
        }
        
        .print-btn-secondary {
            background: #6b7280;
            color: white;
        }
    </style>
</head>
<body>
    <div>
        <!-- Struk -->
        <div class="receipt" id="receipt">
            <div class="header">
                <div class="store-name">TOKO KITA</div>
                <div class="store-address">Jl. Contoh No. 123, Kota Anda</div>
                <div class="store-address">Telp: 0812-3456-7890</div>
            </div>
            
            <div class="transaction-info">
                <div class="info-row">
                    <span class="info-label">No. Transaksi</span>
                    <span class="info-value">{{ $transaction->invoice_code }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal</span>
                    <span class="info-value">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Kasir</span>
                    <span class="info-value">{{ $transaction->user->name }}</span>
                </div>
            </div>
            
            <div class="items">
                @foreach($transaction->details as $detail)
                <div class="item-row">
                    <div class="item-name">{{ $detail->product->name }}</div>
                    <div class="item-qty">{{ $detail->qty }}x</div>
                    <div class="item-price">Rp {{ number_format($detail->price, 0, ',', '.') }}</div>
                </div>
                @endforeach
            </div>
            
            <div class="total-section">
                <div class="total-row">
                    <span class="total-label">Total Items:</span>
                    <span class="total-value">{{ $transaction->details->sum('qty') }} item</span>
                </div>
                <div class="total-row">
                    <span class="total-label">Subtotal:</span>
                    <span class="total-value">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>
                
                <div class="total-row grand-total">
                    <span class="total-label" style="font-size: 14px;">TOTAL:</span>
                    <span class="total-value" style="font-size: 16px; color: #3b82f6;">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>
            </div>
            
            <div class="payment-method">
                <div class="payment-label">METODE PEMBAYARAN</div>
                <div class="payment-value">
                    @if($transaction->payment_method == 'cash')
                        CASH
                    @elseif($transaction->payment_method == 'qris')
                        QRIS
                    @elseif($transaction->payment_method == 'debit')
                        KARTU DEBIT
                    @elseif($transaction->payment_method == 'credit')
                        KARTU KREDIT
                    @else
                        {{ strtoupper($transaction->payment_method) }}
                    @endif
                </div>
            </div>
            
            @if($transaction->payment_method == 'cash')
            <div class="total-section">
                <div class="total-row">
                    <span class="total-label">Uang Cash:</span>
                    <span class="total-value">Rp {{ number_format($transaction->cash_amount, 0, ',', '.') }}</span>
                </div>
                <div class="total-row">
                    <span class="total-label">Kembalian:</span>
                    <span class="total-value" style="color: #10b981; font-weight: bold;">Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span>
                </div>
            </div>
            @endif
            
            <div class="barcode">
                <div style="font-size: 10px; color: #6b7280; margin-bottom: 5px;">{{ $transaction->invoice_code }}</div>
                <!-- Simple barcode using CSS -->
                <div style="height: 40px; background: repeating-linear-gradient(
                    90deg,
                    #000,
                    #000 2px,
                    transparent 2px,
                    transparent 4px
                );"></div>
            </div>
            
            <div class="footer">
                <div class="thank-you">TERIMA KASIH</div>
                <div class="message">
                    Barang yang sudah dibeli<br>
                    tidak dapat ditukar/dikembalikan
                </div>
            </div>
        </div>
        
        <!-- Tombol Print (hanya tampil di browser) -->
        <div class="print-buttons no-print">
            <button onclick="window.print()" class="print-btn print-btn-primary">
                🖨️ Cetak Struk
            </button>
            <button onclick="window.history.back()" class="print-btn print-btn-secondary">
                ← Kembali
            </button>
        </div>
    </div>
    
    <script>
        // Auto print jika diinginkan (opsional)
        window.onload = function() {
            // Uncomment baris berikut untuk auto print
            // setTimeout(() => window.print(), 1000);
        };
        
        // Shortcut keyboard untuk print
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                e.preventDefault();
                window.print();
            }
        });
    </script>
</body>
</html>