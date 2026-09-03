@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <div class="mb-6 border-b border-gray-100 pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Input Data Kehadiran</h2>
        <p class="text-sm text-gray-500 mt-1">Masukkan data absensi dan lembur untuk perhitungan payroll.</p>
    </div>

    <form action="{{ route('kehadiran.store') }}" method="POST" class="space-y-6">
        @csrf 

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Pilih Karyawan -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Karyawan</label>
                <select name="karyawan_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 outline-none bg-white">
                    <option value="" disabled selected>-- Pilih Nama Karyawan --</option>
                    @foreach($data_karyawan as $k)
                        <option value="{{ $k->id_karyawan }}">{{ $k->id_karyawan }} - {{ $k->nama_lengkap }} ({{ $k->divisi }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Periode Bulan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Periode (Bulan & Tahun)</label>
                <input type="text" name="periode_bulan" placeholder="Contoh: September 2026" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 outline-none transition">
            </div>

            <!-- Hari Hadir -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Total Kehadiran (Hari)</label>
                <input type="number" name="hari_hadir" placeholder="Contoh: 22" required min="0" max="31"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 outline-none transition">
            </div>

            <!-- Jam Lembur -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Total Lembur (Jam)</label>
                <input type="number" name="jam_lembur" step="0.5" placeholder="Contoh: 10.5" required min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 outline-none transition">
            </div>

            <!-- Hari Cuti -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Total Cuti (Hari)</label>
                <input type="number" name="hari_cuti" placeholder="Contoh: 2" value="0" required min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 outline-none transition">
            </div>

            <!-- Hari Terlambat -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Total Terlambat (Kali)</label>
                <input type="number" name="hari_terlambat" placeholder="Contoh: 1" value="0" required min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 outline-none transition">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('kehadiran') }}" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 text-sm font-medium hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-5 py-2 bg-blue-800 text-white rounded-lg text-sm font-medium shadow hover:bg-blue-700 transition">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection