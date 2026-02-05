@extends('layouts.app')

@section('content')

<!-- NAVBAR -->
<nav class="fixed top-0 left-0 w-full bg-white shadow z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-blue-700">
            Kantin CF
        </div>
        <div class="space-x-6">
            <a href="#about" class="text-gray-700 hover:text-blue-600">Tentang</a>
            <a href="#gallery" class="text-gray-700 hover:text-blue-600">Galeri</a>
            <a href="#contact" class="text-gray-700 hover:text-blue-600">Kontak</a>
            {{-- <a href="{{ route('login') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Login
            </a> --}}
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="relative pt-20 overflow-hidden">
    <div id="slider" class="flex transition-transform duration-700">
        <img src="/assets/images/kantin.jpg" class="w-full h-[500px] object-cover">
        <img src="/assets/images/kantin2.jpg" class="w-full h-[500px] object-cover">
        <img src="/assets/images/kantin3.jpg" class="w-full h-[500px] object-cover">
    </div>

    <div class="absolute inset-0 bg-black/50 flex items-center pointer-events-none">
        <div class="max-w-7xl mx-auto px-6 text-white">
            <h1 class="text-4xl font-bold mb-4">
                Sistem Kasir Kantin CF
            </h1>
            <p class="mb-6 text-lg">
                Solusi kasir modern, cepat, dan akurat untuk CV. Ciwidey Food
            </p>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section id="about" class="max-w-7xl mx-auto px-6 py-20">
    <h2 class="text-3xl font-bold mb-6">Tentang Kantin</h2>
    <p class="text-gray-600 leading-relaxed">
        Kantin CF merupakan unit usaha milik CV. Ciwidey Food yang menyediakan
        berbagai makanan dan minuman berkualitas dengan sistem pelayanan berbasis
        teknologi informasi guna meningkatkan efisiensi, akurasi transaksi,
        serta transparansi laporan penjualan.
    </p>
</section>

<!-- GALLERY -->
<section id="gallery" class="bg-gray-100 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold mb-8 text-center">Galeri Kantin</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <img src="/assets/images/kantin.jpg" class="rounded-lg shadow">
            <img src="/assets/images/kantin2.jpg" class="rounded-lg shadow">
            <img src="/assets/images/kantin3.jpg" class="rounded-lg shadow">
        </div>
    </div>
</section>

<!-- VIDEO -->
<section class="py-20">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-6">Profil Kantin</h2>
        <video controls class="rounded-xl shadow mx-auto w-full">
            <source src="/assets/videos/kantin.mp4" type="video/mp4">
        </video>
    </div>
</section>

<!-- CONTACT -->
<section id="contact" class="bg-gray-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-4">Kontak</h2>
        <p class="text-gray-300">
            CV. Ciwidey Food <br>
            Email: info@ciwideyfood.co.id <br>
            Telepon: 08xx-xxxx-xxxx
        </p>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-black text-white text-center py-6">
    © {{ date('Y') }} CV. Ciwidey Food. All rights reserved.
</footer>

@endsection
