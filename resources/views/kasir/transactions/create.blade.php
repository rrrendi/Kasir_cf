{{-- <!-- Tambahkan di bagian form, setelah daftar produk -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-6">
    <h3 class="text-lg font-bold text-gray-900 mb-4">Pembayaran</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Metode Pembayaran -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" 
                    class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    onchange="toggleCashInput()">
                <option value="cash">Cash</option>
                <option value="qris">QRIS</option>
                <option value="debit">Debit Card</option>
                <option value="credit">Credit Card</option>
            </select>
        </div>

        <!-- Input Uang Tunai -->
        <div id="cash_input_container">
            <label class="block text-sm font-medium text-gray-700 mb-2">Uang Tunai (Cash)</label>
            <input type="number" 
                   name="cash_amount" 
                   id="cash_amount"
                   class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                   min="0"
                   placeholder="Masukkan jumlah uang"
                   oninput="calculateChange()">
        </div>

        <!-- Kembalian -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kembalian</label>
            <div id="change_amount_display" 
                 class="w-full border border-gray-300 rounded-lg p-2.5 bg-gray-50 text-lg font-bold text-green-600">
                Rp 0
            </div>
        </div>
    </div>

    <!-- Total & Action -->
    <div class="mt-6 pt-6 border-t border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Total Belanja</p>
                <p id="total_display" class="text-3xl font-bold text-gray-900">Rp 0</p>
                <input type="hidden" name="total" id="total" value="0">
            </div>
            
            <button type="submit" 
                    id="submit_btn"
                    class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                Proses Transaksi
            </button>
        </div>
    </div>
</div>

<script>
function toggleCashInput() {
    const method = document.getElementById('payment_method').value;
    const cashContainer = document.getElementById('cash_input_container');
    
    if (method === 'cash') {
        cashContainer.style.display = 'block';
        document.getElementById('cash_amount').required = true;
    } else {
        cashContainer.style.display = 'none';
        document.getElementById('cash_amount').required = false;
        document.getElementById('change_amount_display').innerText = 'Rp 0';
    }
}

function calculateChange() {
    const total = parseFloat(document.getElementById('total').value) || 0;
    const cash = parseFloat(document.getElementById('cash_amount').value) || 0;
    const method = document.getElementById('payment_method').value;
    
    let change = 0;
    if (method === 'cash') {
        change = cash - total;
    }
    
    const changeDisplay = document.getElementById('change_amount_display');
    const submitBtn = document.getElementById('submit_btn');
    
    if (change < 0) {
        changeDisplay.innerText = 'Uang kurang: ' + formatRupiah(Math.abs(change));
        changeDisplay.className = 'w-full border border-gray-300 rounded-lg p-2.5 bg-red-50 text-lg font-bold text-red-600';
        submitBtn.disabled = true;
    } else {
        changeDisplay.innerText = formatRupiah(change);
        changeDisplay.className = 'w-full border border-gray-300 rounded-lg p-2.5 bg-green-50 text-lg font-bold text-green-600';
        submitBtn.disabled = false;
    }
}

function formatRupiah(amount) {
    return 'Rp ' + amount.toLocaleString('id-ID');
}

// Inisialisasi
toggleCashInput();
</script> --}}

@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kasir - Transaksi Baru</h1>
                <p class="text-gray-600">Pilih produk dan jumlah yang akan dibeli</p>
            </div>
            <a href="{{ route('kasir.dashboard') }}" 
               class="text-sm text-gray-600 hover:text-gray-900">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom 1: Daftar Produk -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <!-- Search Bar -->
                <div class="p-4 border-b border-gray-200">
                    <form method="GET" action="{{ route('kasir.transactions.create') }}">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari produk..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </form>
                </div>

                <!-- List Produk -->
                <div class="p-4 max-h-[500px] overflow-y-auto">
                    @if($products->isEmpty())
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Produk tidak ditemukan</h3>
                            <p class="mt-1 text-gray-500">Coba kata kunci pencarian lain</p>
                        </div>
                    @else
                        <form id="transactionForm" action="{{ route('kasir.transactions.store') }}" method="POST">
                            @csrf
                            <div class="space-y-3">
                                @foreach($products as $product)
                                <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $product->name }}</h4>
                                        <div class="flex items-center space-x-4 mt-1">
                                            <span class="text-sm text-gray-500">
                                                Stok: <span class="font-semibold">{{ $product->stock }}</span>
                                            </span>
                                            <span class="text-sm font-bold text-blue-600">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <button type="button" 
                                                onclick="decrementQty({{ $product->id }})"
                                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100">
                                            −
                                        </button>
                                        <input type="number" 
                                               name="qty[{{ $product->id }}]"
                                               id="qty_{{ $product->id }}"
                                               value="0"
                                               min="0"
                                               max="{{ $product->stock }}"
                                               class="w-16 text-center border border-gray-300 rounded-lg py-1"
                                               onchange="updateTotal()">
                                        <button type="button" 
                                                onclick="incrementQty({{ $product->id }}, {{ $product->stock }})"
                                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100">
                                            +
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            <!-- Hidden fields untuk total -->
                            <input type="hidden" name="total_amount" id="total_amount" value="0">
                            <input type="hidden" name="change_amount" id="change_amount" value="0">
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kolom 2: Ringkasan & Pembayaran -->
        <div class="lg:col-span-1">
            <!-- Ringkasan Belanja -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Belanja</h3>
                
                <!-- Daftar item yang dipilih -->
                <div id="selectedItems" class="space-y-2 mb-4 max-h-48 overflow-y-auto">
                    <!-- Items akan muncul di sini via JavaScript -->
                </div>

                <div class="space-y-3 border-t border-gray-200 pt-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span id="subtotalDisplay" class="font-medium">Rp 0</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Items</span>
                        <span id="totalItemsDisplay" class="font-medium">0 item</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold pt-3 border-t border-gray-200">
                        <span>Total Bayar</span>
                        <span id="totalDisplay" class="text-blue-600">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Form Pembayaran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Pembayaran</h3>
                
                <!-- Metode Pembayaran -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                    <select name="payment_method" id="payment_method" 
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                            onchange="toggleCashInput()">
                        <option value="cash">Cash (Tunai)</option>
                        <option value="qris">QRIS</option>
                        <option value="debit">Kartu Debit</option>
                        <option value="credit">Kartu Kredit</option>
                    </select>
                </div>

                <!-- Input Uang Tunai -->
                <div id="cash_input_container" class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Uang Tunai (Cash)</label>
                    <input type="number" 
                           name="cash_amount" 
                           id="cash_amount"
                           class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                           min="0"
                           placeholder="Masukkan jumlah uang"
                           oninput="calculateChange()">
                </div>

                <!-- Kembalian -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kembalian</label>
                    <div id="change_amount_display" 
                         class="w-full border border-gray-300 rounded-lg p-3 bg-gray-50 text-lg font-bold text-green-600">
                        Rp 0
                    </div>
                </div>

                <!-- Button Submit -->
                <button type="submit" 
                        form="transactionForm"
                        id="submit_btn"
                        class="w-full py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                    Proses Transaksi
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Data produk untuk perhitungan
const products = @json($products->keyBy('id')->map(function($p) {
    return ['price' => $p->price, 'name' => $p->name];
}));

let selectedItems = {};

function incrementQty(productId, maxStock) {
    const input = document.getElementById('qty_' + productId);
    let current = parseInt(input.value) || 0;
    if (current < maxStock) {
        input.value = current + 1;
        input.dispatchEvent(new Event('change'));
    }
}

function decrementQty(productId) {
    const input = document.getElementById('qty_' + productId);
    let current = parseInt(input.value) || 0;
    if (current > 0) {
        input.value = current - 1;
        input.dispatchEvent(new Event('change'));
    }
}

function updateTotal() {
    let subtotal = 0;
    let totalItems = 0;
    selectedItems = {};
    
    // Hitung total dari semua input
    document.querySelectorAll('input[name^="qty["]').forEach(input => {
        const qty = parseInt(input.value) || 0;
        if (qty > 0) {
            const productId = input.name.match(/\[(\d+)\]/)[1];
            const product = products[productId];
            if (product) {
                const itemTotal = product.price * qty;
                subtotal += itemTotal;
                totalItems += qty;
                selectedItems[productId] = {
                    name: product.name,
                    qty: qty,
                    price: product.price,
                    total: itemTotal
                };
            }
        }
    });
    
    // Update display
    document.getElementById('subtotalDisplay').textContent = formatRupiah(subtotal);
    document.getElementById('totalItemsDisplay').textContent = totalItems + ' item';
    document.getElementById('totalDisplay').textContent = formatRupiah(subtotal);
    
    // Update hidden fields
    document.getElementById('total_amount').value = subtotal;
    
    // Update selected items list
    updateSelectedItemsList();
    
    // Update kembalian
    calculateChange();
}

function updateSelectedItemsList() {
    const container = document.getElementById('selectedItems');
    container.innerHTML = '';
    
    for (const [id, item] of Object.entries(selectedItems)) {
        const div = document.createElement('div');
        div.className = 'flex justify-between text-sm';
        div.innerHTML = `
            <div>
                <span class="font-medium">${item.name}</span>
                <span class="text-gray-500 ml-2">×${item.qty}</span>
            </div>
            <span class="font-medium">${formatRupiah(item.total)}</span>
        `;
        container.appendChild(div);
    }
    
    if (Object.keys(selectedItems).length === 0) {
        container.innerHTML = `
            <div class="text-center text-gray-500 py-4">
                <p>Belum ada produk dipilih</p>
            </div>
        `;
    }
}

function calculateChange() {
    const total = parseFloat(document.getElementById('total_amount').value) || 0;
    const cash = parseFloat(document.getElementById('cash_amount').value) || 0;
    const method = document.getElementById('payment_method').value;
    
    let change = 0;
    let isValid = true;
    
    if (method === 'cash') {
        change = cash - total;
        if (cash === 0) {
            isValid = false;
        } else if (change < 0) {
            isValid = false;
        }
    } else {
        // Non-cash payment
        change = 0;
        isValid = total > 0; // Valid jika ada produk
    }
    
    const changeDisplay = document.getElementById('change_amount_display');
    const submitBtn = document.getElementById('submit_btn');
    
    if (!isValid) {
        changeDisplay.textContent = method === 'cash' ? 'Uang tidak cukup' : 'Pilih produk terlebih dahulu';
        changeDisplay.className = 'w-full border border-gray-300 rounded-lg p-3 bg-red-50 text-lg font-bold text-red-600';
        submitBtn.disabled = true;
    } else {
        changeDisplay.textContent = formatRupiah(Math.max(0, change));
        changeDisplay.className = 'w-full border border-gray-300 rounded-lg p-3 bg-green-50 text-lg font-bold text-green-600';
        submitBtn.disabled = false;
    }
    
    document.getElementById('change_amount').value = Math.max(0, change);
}

function toggleCashInput() {
    const method = document.getElementById('payment_method').value;
    const cashContainer = document.getElementById('cash_input_container');
    
    if (method === 'cash') {
        cashContainer.style.display = 'block';
        document.getElementById('cash_amount').required = true;
    } else {
        cashContainer.style.display = 'none';
        document.getElementById('cash_amount').required = false;
        document.getElementById('cash_amount').value = '';
    }
    
    calculateChange();
}

function formatRupiah(amount) {
    return 'Rp ' + amount.toLocaleString('id-ID');
}

// Inisialisasi
document.addEventListener('DOMContentLoaded', function() {
    updateTotal();
    toggleCashInput();
    
    // Update total saat input berubah
    document.querySelectorAll('input[name^="qty["]').forEach(input => {
        input.addEventListener('change', updateTotal);
    });
    
    // Validasi form submit
    document.getElementById('transactionForm').addEventListener('submit', function(e) {
        const total = parseFloat(document.getElementById('total_amount').value) || 0;
        if (total === 0) {
            e.preventDefault();
            alert('Pilih minimal satu produk!');
            return false;
        }
        
        const method = document.getElementById('payment_method').value;
        const cash = parseFloat(document.getElementById('cash_amount').value) || 0;
        
        if (method === 'cash' && cash < total) {
            e.preventDefault();
            alert('Uang tunai tidak mencukupi!');
            return false;
        }
        
        return true;
    });
});
</script>

<style>
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
@endsection