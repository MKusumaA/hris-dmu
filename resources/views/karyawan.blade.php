@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Karyawan</h2>
        <a href="{{ route('karyawan.tambah') }}" class="bg-blue-800 text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-blue-700 transition">
            + Tambah Data
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-sm">
                    <th class="p-4 font-semibold">ID</th>
                    <th class="p-4 font-semibold">Nama Lengkap</th>
                    <th class="p-4 font-semibold">Divisi</th>
                    <th class="p-4 font-semibold">Jabatan</th>
                    <th class="p-4 font-semibold">Status</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($data_karyawan as $k)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="p-4 text-gray-900 font-medium">{{ $k->id_karyawan }}</td>
                    <td class="p-4 text-gray-700">{{ $k->nama_lengkap }}</td>
                    <td class="p-4 text-gray-700">{{ $k->divisi }}</td>
                    <td class="p-4 text-gray-700">{{ $k->jabatan }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $k->status_kerja == 'Tetap' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                            {{ $k->status_kerja }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection