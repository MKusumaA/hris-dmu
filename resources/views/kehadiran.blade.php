@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Rekap Kehadiran Karyawan</h2>
        <a href="{{ route('kehadiran.tambah') }}" class="bg-blue-800 text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-blue-700 transition">
            + Input Kehadiran
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-sm">
                    <th class="p-4 font-semibold">Periode</th>
                    <th class="p-4 font-semibold">Nama Karyawan</th>
                    <th class="p-4 font-semibold">Hadir (Hari)</th>
                    <th class="p-4 font-semibold">Lembur (Jam)</th>
                    <th class="p-4 font-semibold">Cuti (Hari)</th>
                    <th class="p-4 font-semibold">Terlambat</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($data_kehadiran as $k)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="p-4 text-gray-900 font-medium">{{ $k->periode_bulan }}</td>
                    <td class="p-4 text-gray-700">
                        <span class="block font-medium">{{ $k->nama_lengkap }}</span>
                        <span class="text-xs text-gray-500">{{ $k->divisi }}</span>
                    </td>
                    <td class="p-4 text-gray-700">{{ $k->hari_hadir }}</td>
                    <td class="p-4 text-gray-700">{{ $k->jam_lembur }}</td>
                    <td class="p-4 text-gray-700">{{ $k->hari_cuti }}</td>
                    <td class="p-4 text-red-600 font-medium">{{ $k->hari_terlambat }} kali</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-500">
                        Belum ada data kehadiran yang diinput untuk periode ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection