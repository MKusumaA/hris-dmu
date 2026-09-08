<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS - Rekap Kehadiran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 font-sans">
    <div class="flex h-screen">
        <!-- SIDEBAR BARU -->
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
            <!-- MENU AKTIF -->
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
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Rekap Kehadiran</h1>
                    <p class="text-slate-500 text-sm mt-1">Data absensi bulanan dengan 5 kode HRD.</p>
                </div>
                <a href="/kehadiran/tambah" class="px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Input Kehadiran
                </a>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-600 text-sm border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Nama Karyawan</th>
                            <th class="px-6 py-4 font-semibold">MT</th>
                            <th class="px-6 py-4 font-semibold">TMI</th>
                            <th class="px-6 py-4 font-semibold">TMDL</th>
                            <th class="px-6 py-4 font-semibold">TMTD</th>
                            <th class="px-6 py-4 font-semibold">TA</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700">
                                @forelse(collect($data_kehadiran)->groupBy('karyawan_id') as $id_karyawan => $records)
                                    @php
                                        // Sistem akan otomatis mengelompokkan data berdasarkan karyawan
                                        $nama = $records->first()->nama_lengkap;
                                        $mt = $records->where('kode_absensi', 'MT')->sum('jumlah');
                                        $tmi = $records->where('kode_absensi', 'TMI')->sum('jumlah');
                                        $tmdl = $records->where('kode_absensi', 'TMDL')->sum('jumlah');
                                        $tmtd = $records->where('kode_absensi', 'TMTD')->sum('jumlah');
                                        $ta = $records->where('kode_absensi', 'TA')->sum('jumlah');
                                    @endphp
                                    <tr class="border-b border-slate-100 even:bg-slate-50 hover:bg-slate-100 transition-colors">
                                        <td class="px-6 py-4 font-medium">{{ $nama }}</td>
                                        <td class="px-6 py-4">{{ $mt > 0 ? $mt : '-' }}</td>
                                        <td class="px-6 py-4">{{ $tmi > 0 ? $tmi : '-' }}</td>
                                        <td class="px-6 py-4">{{ $tmdl > 0 ? $tmdl : '-' }}</td>
                                        <td class="px-6 py-4">{{ $tmtd > 0 ? $tmtd : '-' }}</td>
                                        <td class="px-6 py-4 text-red-600 font-semibold">{{ $ta > 0 ? $ta : '-' }}</td>
                                        <td class="px-6 py-4 flex justify-end gap-2">
                                            <a href="{{ route('kehadiran.edit', $id_karyawan) }}" class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <a href="{{ route('kehadiran.delete', $id_karyawan) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data rekap ini?')" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                                            Belum ada data kehadiran yang diinput untuk periode ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>