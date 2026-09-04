<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS - Kalkulasi Gaji</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans">
    <div class="flex h-screen">
        
        <!-- SIDEBAR -->
        <aside class="w-64 bg-white border-r border-slate-200 p-5 flex flex-col gap-2">
            <div class="text-xl font-bold text-slate-800 mb-6 px-2">HRIS Dashboard</div>
            <a href="/" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                Dashboard
            </a>
            <a href="/karyawan" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                Data Karyawan
            </a>
            <a href="/kehadiran" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                Rekap Kehadiran
            </a>
            <a href="/slip-gaji/kalkulasi" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-700 rounded-xl font-medium transition-colors">
                Kalkulasi Gaji
            </a>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-slate-800">Kalkulasi & Cetak Slip Gaji</h1>
                <p class="text-slate-500 text-sm mt-1">Pilih karyawan di bawah ini untuk memproses hitungan payroll dan mencetak dokumen PDF.</p>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-600 text-sm border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 font-semibold">NIP</th>
                            <th class="px-6 py-4 font-semibold">Nama Karyawan</th>
                            <th class="px-6 py-4 font-semibold">Jabatan</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700">
                        @foreach($karyawan as $k)
                        <tr class="border-b border-slate-100 even:bg-slate-50 hover:bg-slate-100 transition-colors">
                            <td class="px-6 py-4">{{ $k->id_karyawan }}</td>
                            <td class="px-6 py-4 font-medium">{{ $k->nama_lengkap }}</td>
                            <td class="px-6 py-4">{{ $k->jabatan }}</td>
                            <td class="px-6 py-4 text-right">
                                <!-- Tombol Cetak PDF -->
                                <a target="_blank" href="/slip-gaji/cetak/{{ $k->id_karyawan }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium transition-colors shadow-sm">
                                    🖨️ Cetak Slip PDF
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>