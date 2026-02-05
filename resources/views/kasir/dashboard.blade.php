@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-6">Dashboard Kasir</h2>

<div class="bg-white p-6 rounded shadow">
    <p class="mb-4">
        Selamat datang, <strong>{{ auth()->user()->name }}</strong>
    </p>

    <a href="/transactions/create"
       class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
        Buat Transaksi Baru
    </a>
</div>

@endsection
