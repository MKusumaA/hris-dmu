<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS - Input Rekap Kehadiran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans p-8">

    <div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm p-8">
        
        <div class="mb-6 border-b border-slate-100 pb-4">
            <h1 class="text-2xl font-bold text-slate-800">Form Input Rekap Kehadiran</h1>
            <p class="text-slate-500 text-sm mt-1">Input manual data absensi bulanan berdasarkan 5 kode resmi perusahaan.</p>
        </div>

        <form action="/kehadiran/store" method="POST" class="space-y-6">
            @csrf
            
            <!-- Pilih Karyawan (Data Asli dari Database) -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Karyawan</label>
                <select name="karyawan_id" required class="w-full border border-slate-300 rounded-lg p-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach($data_karyawan as $k)
                        <option value="{{ $k->id_karyawan }}">{{ $k->id_karyawan }} - {{ $k->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Kode Absensi -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Kode Absensi (Wajib)</label>
                <select name="kode_absensi" required class="w-full border border-slate-300 rounded-lg p-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <option value="">-- Pilih Kode Absensi --</option>
                    <option value="MT">MT - Masuk Terlambat</option>
                    <option value="TMI">TMI - Tidak Masuk Izin</option>
                    <option value="TMDL">TMDL - Tidak Masuk Dinas Luar</option>
                    <option value="TMTD">TMTD - Tidak Masuk Tanpa Dokumen</option>
                    <option value="TA">TA - Tidak Masuk Alpa</option>
                </select>
            </div>

            <!-- Jumlah Hari/Kali -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Jumlah (Hari / Kali Terlambat)</label>
                <input type="number" name="jumlah" min="1" required class="w-full border border-slate-300 rounded-lg p-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: 2">
            </div>

            <!-- Tombol Simpan -->
            <div class="pt-4 flex gap-3">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    Simpan Data Kehadiran
                </button>
                <a href="/kehadiran" class="px-6 py-3 bg-slate-100 text-slate-700 font-medium rounded-lg hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>

    </div>

</body>
</html>