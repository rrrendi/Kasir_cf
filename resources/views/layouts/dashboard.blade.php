<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Kantin CF</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    
    <!-- MAIN -->
    <main class="flex-1">

        <!-- TOPBAR -->
        <header class="bg-white shadow px-6 py-4 flex justify-between">
            <h1 class="font-semibold text-lg">
                Dashboard {{ ucfirst(auth()->user()->role) }}
            </h1>
        </header>

        <!-- CONTENT -->
        <div class="p-6">
            @yield('content')
        </div>

    </main>
</div>

</body>
</html>
