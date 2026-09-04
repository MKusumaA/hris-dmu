@extends('layouts.app')

@section('content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Kalkulasi & Validasi Slip Gaji</h1>
            <p class="text-slate-500 text-sm">Review detail pendapatan dan potongan karyawan.</p>
        </div>
        <a href="/karyawan" class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium text-slate-600 hover:bg-gray-50">Batal</a>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <!-- Kolom Kiri: Data Karyawan & Kehadiran -->
        <div class="col-span-2 space-y-6">
            <!-- Card Profil -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-slate-200 rounded-full overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($karyawan->nama_lengkap) }}" alt="Avatar">
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">{{ $karyawan->nama_lengkap }}</h2>
                        <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs font-semibold rounded-md">{{ $karyawan->id_karyawan }}</span>
                        <p class="text-sm text-slate-500 mt-1">{{ $karyawan->jabatan }} | {{ $karyawan->divisi }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Input Pendapatan -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <span class="w-2 h-5 bg-blue-600 rounded-full"></span> Konfigurasi Penerimaan
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Gaji Pokok</label>
                        <input type="text" value="Rp {{ number_format($karyawan->gaji_pokok, 0, ',', '.') }}" class="w-full p-2 bg-gray-50 border border-slate-200 rounded-lg text-sm" readonly>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Tunjangan Makan</label>
                        <input type="number" class="w-full p-2 border border-slate-200 rounded-lg text-sm" placeholder="Masukkan nominal">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Tunjangan Kehadiran</label>
                        <input type="number" class="w-full p-2 border border-slate-200 rounded-lg text-sm" value="440000">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Tunjangan Kedisiplinan</label>
                        <input type="number" class="w-full p-2 border border-slate-200 rounded-lg text-sm" placeholder="Masukkan nominal">
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Preview Ringkasan (Draft Slip) -->
        <div class="col-span-1">
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden sticky top-8">
                <div class="bg-slate-800 p-4 text-white text-center">
                    <p class="text-xs uppercase tracking-widest opacity-70">Estimasi Take Home Pay</p>
                    <h2 class="text-2xl font-bold mt-1">Rp 6.399.000</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Total Penerimaan</span>
                        <span class="font-semibold text-green-600">+ Rp 6.640.000</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Total Potongan</span>
                        <span class="font-semibold text-red-600">- Rp 241.000</span>
                    </div>
                    <hr class="border-dashed">
                    <div class="pt-2">
                        <button class="w-full py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Approve & Generate PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection