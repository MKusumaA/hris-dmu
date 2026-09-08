<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS & Payroll - PT Daya Matahari Utama</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 font-sans">

    <div class="flex h-screen">

        <!-- SIDEBAR NAVIGATION MODERN -->
        <aside class="w-64 bg-white border-r border-slate-200 p-5 flex flex-col gap-2">
            <div class="text-xl font-bold text-slate-800 mb-6 px-2">HRIS Dashboard</div>
            
            <!-- Menu Aktif -->
            <a href="/" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>

            <a href="/karyawan" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Karyawan
            </a>

            <a href="/kehadiran" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Rekap Kehadiran
            </a>

            <a href="/slip-gaji/kalkulasi" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Kalkulasi Gaji
            </a>
        </aside>

        <!-- AREA KONTEN UTAMA -->
        <main class="flex-1 p-8 overflow-y-auto">
            
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-slate-800">Sistem HRIS & Payroll</h1>
                <p class="text-slate-500 text-sm mt-1">PT Daya Matahari Utama - Mode Offline Berjalan</p>
            </div>

            <!-- Pesan Sambutan -->
            <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm">
                <h2 class="text-xl font-bold text-slate-800 mb-2">Selamat Datang, Admin HRD!</h2>
                <p class="text-slate-600 mb-6">Sistem ini telah dikonfigurasi untuk berjalan 100% secara luring (offline) demi menjaga kerahasiaan dan keamanan data perusahaan.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="/karyawan" class="p-4 border border-slate-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors group">
                        <div class="font-semibold text-slate-800 group-hover:text-blue-700">1. Kelola Karyawan &rarr;</div>
                        <div class="text-sm text-slate-500 mt-1">Input data master dan gaji pokok.</div>
                    </a>
                    <a href="/kehadiran" class="p-4 border border-slate-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors group">
                        <div class="font-semibold text-slate-800 group-hover:text-blue-700">2. Input Absensi &rarr;</div>
                        <div class="text-sm text-slate-500 mt-1">Rekap manual dengan sistem 5 kode.</div>
                    </a>
                    <a href="/slip-gaji/kalkulasi" class="p-4 border border-slate-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors group">
                        <div class="font-semibold text-slate-800 group-hover:text-blue-700">3. Cetak PDF &rarr;</div>
                        <div class="text-sm text-slate-500 mt-1">Kalkulasi otomatis take home pay.</div>
                    </a>
                </div>
            </div>

        </main>
    </div>
</body>
</html>