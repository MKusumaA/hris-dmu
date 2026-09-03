@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <div class="mb-6 border-b border-gray-100 pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Data Karyawan</h2>
        <p class="text-sm text-gray-500 mt-1">Masukkan informasi detail pegawai baru di bawah ini.</p>
    </div>

    <!-- Form Action mengarah ke route untuk menyimpan data -->
    <form action="{{ route('karyawan.store') }}" method="POST" class="space-y-6">
        <!-- Token Keamanan Wajib Laravel -->
        @csrf 

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- ID Karyawan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ID Karyawan (NIP)</label>
                <input type="text" name="id_karyawan" placeholder="Contoh: EMP-099" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 outline-none transition">
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 outline-none transition">
            </div>

            <!-- Divisi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Divisi Penempatan</label>
                <select name="divisi" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 outline-none bg-white">
                    <option value="" disabled selected>Pilih Divisi</option>
                    <option value="Pengadaan Alkes">Pengadaan Alat Kesehatan</option>
                    <option value="Pengadaan Alat Sekolah">Pengadaan Perlengkapan Sekolah</option>
                    <option value="Jajanan UMKM">Unit Jajanan UMKM</option>
                    <option value="HR & GA">HR & General Affair</option>
                    <option value="Keuangan">Keuangan & Pajak</option>
                </select>
            </div>

            <!-- Jabatan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                <input type="text" name="jabatan" placeholder="Contoh: Procurement Staff" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 outline-none transition">
            </div>

            <!-- Status Kerja -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Kerja</label>
                <select name="status_kerja" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 outline-none bg-white">
                    <option value="Tetap">Karyawan Tetap</option>
                    <option value="Kontrak">Karyawan Kontrak</option>
                </select>
            </div>

            <!-- Tanggal Bergabung -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Bergabung</label>
                <input type="date" name="tgl_bergabung" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 outline-none transition">
            </div>

            <!-- Gaji Pokok -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Gaji Pokok Dasar (Rp)</label>
                <input type="number" name="gaji_pokok" placeholder="Contoh: 4500000" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800 outline-none transition">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('karyawan') }}" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 text-sm font-medium hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-5 py-2 bg-blue-800 text-white rounded-lg text-sm font-medium shadow hover:bg-blue-700 transition">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection