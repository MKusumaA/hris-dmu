<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS & Payroll - PT Daya Matahari Utama</title>
    
    <!-- Ini kode wajib untuk memanggil Tailwind dari Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased flex h-screen overflow-hidden">

    <!-- SIDEBAR (Warna Biru Gelap) -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex">
        <div class="h-16 flex items-center justify-center border-b border-slate-700">
            <h1 class="text-xl font-bold tracking-wider">DMU HRIS</h1>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg bg-blue-800 text-white font-medium shadow">
                Dashboard
            </a>
            <a href="{{ route('karyawan') }}" class="block px-4 py-2 rounded-lg hover:bg-slate-800 transition-colors">
                Data Karyawan
            </a>
            <a href="{{ route('kehadiran') }}" class="block px-4 py-2 rounded-lg hover:bg-slate-800 transition-colors">
                Rekap Kehadiran
            </a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-slate-800 transition-colors">
                Kalkulasi Gaji
            </a>
        </nav>
    </aside>

    <!-- AREA KANAN (Topbar & Konten Utama) -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <!-- TOPBAR -->
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10">
            <div class="font-semibold text-gray-600">
                Sistem Manajemen & Payroll
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium">Halo, Admin</span>
                <div class="w-8 h-8 rounded-full bg-blue-100 border border-blue-300"></div>
            </div>
        </header>

        <!-- KONTEN UTAMA YANG BISA BERUBAH-UBAH -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            @yield('content')
        </main>
        
    </div>

</body>
</html>