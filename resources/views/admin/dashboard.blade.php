@extends('layouts.dashboard')

@section('content')
<style>
    :root {
        --bg-deep: #0a0e17; /* Background utama gelap pekat */
        --card-bg: rgba(255, 255, 255, 0.03); /* Transparansi untuk efek glass */
        --accent-blue: #4361ee;
        --accent-cyan: #4cc9f0;
        --text-bright: #ffffff;
        --text-muted: #94a3b8;
    }

    body { 
        background-color: var(--bg-deep); 
        color: var(--text-bright);
        font-family: 'Inter', sans-serif;
    }

    .dashboard-wrapper {
        min-height: 100vh;
        padding: 30px;
        background: radial-gradient(circle at top right, #1e293b, #0a0e17);
    }

    /* Floating Navigation Kanan Atas */
    .nav-container {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-bottom: 40px;
    }

    .nav-link-custom {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 10px 24px;
        border-radius: 12px;
        color: var(--text-bright);
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
        backdrop-filter: blur(10px);
    }

    .nav-link-custom:hover {
        background: var(--accent-blue);
        border-color: var(--accent-blue);
        box-shadow: 0 0 20px rgba(67, 97, 238, 0.4);
        color: white;
    }

    /* Typography */
    .header-section {
        text-align: center;
        margin-bottom: 50px;
    }

    .header-section h1 {
        font-weight: 900;
        font-size: 3rem;
        background: linear-gradient(to right, #fff, #94a3b8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Bento Grid System */
    .bento-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: auto auto;
        gap: 20px;
    }

    .bento-card {
        background: var(--card-bg);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 24px;
        padding: 30px;
        backdrop-filter: blur(20px);
        transition: transform 0.3s ease, border-color 0.3s;
    }

    .bento-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent-blue);
    }

    /* Stats Styling */
    .stat-title {
        color: var(--text-muted);
        text-transform: uppercase;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 2px;
        display: block;
        margin-bottom: 15px;
    }

    .stat-value {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--text-bright);
        line-height: 1;
    }

    /* Middle Contrast Cards */
    .highlight-blue {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.2), rgba(76, 201, 240, 0.05));
        border: 1px solid rgba(67, 97, 238, 0.3);
    }

    /* Chart Container (Full Width) */
    .chart-card {
        grid-column: span 4;
        background: rgba(15, 23, 42, 0.5);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
</style>

<div class="dashboard-wrapper">
    <div class="nav-container">
        <a href="/products" class="nav-link-custom">Data Produk</a>
        <a href="/reports" class="nav-link-custom">Laporan Detail</a>
        <form action="/logout" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-link-custom border-0" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">Logout</button>
        </form>
    </div>

    <div class="header-section">
        <h1>SISTEM ANALITIK UTAMA</h1>
        <p class="text-muted">Pantau integritas data dan performa finansial secara real-time.</p>
    </div>

    <div class="bento-container">
        
        <div class="bento-card d-flex flex-column justify-content-center text-center">
            <span class="stat-title">Total Pendapatan</span>
            <div class="stat-value" style="font-size: 1.8rem; color: var(--accent-cyan);">
                Rp {{ number_format(\App\Models\Transaction::sum('total'), 0, ',', '.') }}
            </div>
            <div class="mt-3 text-muted small">Update Terakhir: Hari Ini</div>
        </div>

        <div class="bento-card highlight-blue text-center d-flex flex-column justify-content-center">
            <span class="stat-title text-white">Total Produk Terdata</span>
            <div class="stat-value counter" data-target="{{ \App\Models\Product::count() }}">0</div>
            <div class="mt-2 text-info fw-bold small">Unit Inventori Aktif</div>
        </div>

        <div class="bento-card highlight-blue text-center d-flex flex-column justify-content-center">
            <span class="stat-title text-white">Volume Transaksi</span>
            <div class="stat-value text-white">
                {{ \App\Models\Transaction::count() }}
            </div>
            <div class="mt-2 text-info fw-bold small">Transaksi Terverifikasi</div>
        </div>

        <div class="bento-card d-flex flex-column justify-content-center text-center">
            <span class="stat-title">Status Sistem</span>
            <div class="d-flex align-items-center justify-content-center gap-2">
                <div style="width: 12px; height: 12px; border-radius: 50%; background: #10b981; box-shadow: 0 0 10px #10b981;"></div>
                <span class="fw-bold" style="color: #10b981;">OPERASIONAL</span>
            </div>
        </div>

        <div class="bento-card chart-card">
            <div class="chart-header">
                <h5 class="m-0 fw-bold">GRAFIK FLUKTUASI PENJUALAN</h5>
                <span class="badge rounded-pill bg-primary px-3">Live Data</span>
            </div>
            <div style="height: 400px;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart');
    
    // Gradient untuk Grafik yang "Menyala"
    const fillGradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
    fillGradient.addColorStop(0, 'rgba(67, 97, 238, 0.4)');
    fillGradient.addColorStop(1, 'rgba(10, 14, 23, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(\App\Models\Transaction::selectRaw('DATE(transaction_date) as date')->groupBy('date')->pluck('date')) !!},
            datasets: [{
                label: 'Penjualan',
                data: {!! json_encode(\App\Models\Transaction::selectRaw('SUM(total) as total')->groupByRaw('DATE(transaction_date)')->pluck('total')) !!},
                borderColor: '#4361ee',
                backgroundColor: fillGradient,
                fill: true,
                tension: 0.4,
                borderWidth: 4,
                pointBackgroundColor: '#4cc9f0',
                pointBorderColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    grid: { color: 'rgba(255,255,255,0.05)' },
                    ticks: { color: '#94a3b8' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8' }
                }
            }
        }
    });

    // Animasi Counter Angka
    document.querySelectorAll('.counter').forEach(counter => {
        const target = +counter.dataset.target;
        let count = 0;
        const inc = target / 40;
        const update = () => {
            count += inc;
            if (count < target) {
                counter.innerText = Math.ceil(count);
                setTimeout(update, 20);
            } else {
                counter.innerText = target;
            }
        };
        update();
    });
</script>
@endsection