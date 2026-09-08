<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS - Edit Rekap Kehadiran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 font-sans">
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-white border-r border-slate-200 p-5 flex flex-col gap-2">
            <div class="text-xl font-bold text-slate-800 mb-6 px-2">HRIS Dashboard</div>
            <a href="/" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="/karyawan" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Karyawan
            </a>
            <a href="/kehadiran" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Rekap Kehadiran
            </a>
            <a href="/slip-gaji/kalkulasi" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Kalkulasi Gaji
            </a>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Edit Rekap Kehadiran</h1>
                    <p class="text-slate-500 text-sm mt-1">Mengubah data absensi bulanan untuk <strong>{{ $karyawan->nama_lengkap }}</strong>.</p>
                </div>
            </div>

            <div class="max-w-2xl bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden p-6">
                <form action="{{ route('kehadiran.update', $karyawan->id_karyawan) }}" method="POST">
                    @php
                        $mt = $kehadiran->where('kode_absensi', 'MT')->sum('jumlah');
                        $tmi = $kehadiran->where('kode_absensi', 'TMI')->sum('jumlah');
                        $tmdl = $kehadiran->where('kode_absensi', 'TMDL')->sum('jumlah');
                        $tmtd = $kehadiran->where('kode_absensi', 'TMTD')->sum('jumlah');
                        $ta = $kehadiran->where('kode_absensi', 'TA')->sum('jumlah');
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">MT (Terlambat)</label>
                            <input type="number" name="mt" value="{{ $mt }}" min="0" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">TMI (Sakit/Ijin)</label>
                            <input type="number" name="tmi" value="{{ $tmi }}" min="0" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">TMDL (Dinas Luar)</label>
                            <input type="number" name="tmdl" value="{{ $tmdl }}" min="0" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">TMTD (Tidak Disetujui)</label>
                            <input type="number" name="tmtd" value="{{ $tmtd }}" min="0" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">TA (Alpha)</label>
                            <input type="number" name="ta" value="{{ $ta }}" min="0" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-200">
                        <a href="{{ route('kehadiran') }}" class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors">Batal</a>
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
