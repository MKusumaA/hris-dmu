<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// Jalur 1: Halaman Utama (Dashboard)
Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

// Jalur 2: Halaman Data Karyawan
Route::get('/karyawan', function () {
    $karyawan = DB::table('karyawan')->get();
    return view('karyawan', ['data_karyawan' => $karyawan]);
})->name('karyawan');

// Jalur 3: Menampilkan Form Tambah Karyawan
Route::get('/karyawan/tambah', function () {
    return view('karyawan_tambah');
})->name('karyawan.tambah');

// Jalur 4: Menangkap Data dari Form dan Menyimpan ke Database
Route::post('/karyawan/store', function (Request $request) {
    DB::table('karyawan')->insert([
        'id_karyawan' => $request->id_karyawan,
        'nama_lengkap' => $request->nama_lengkap,
        'divisi' => $request->divisi,
        'jabatan' => $request->jabatan,
        'status_kerja' => $request->status_kerja,
        'tgl_bergabung' => $request->tgl_bergabung,
        'gaji_pokok' => $request->gaji_pokok,
        // Kolom opsional kita kosongkan dulu sesuai struktur tabel
        'npwp' => null,
        'status_ptkp' => null,
        'no_bpjs_tk' => null,
        'no_bpjs_kes' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Setelah sukses menyimpan, tendang kembali user ke halaman tabel
    return redirect()->route('karyawan');
})->name('karyawan.store');

// Jalur 5: Halaman Rekap Kehadiran
Route::get('/kehadiran', function () {
    // Menggabungkan tabel rekap_kehadiran dengan tabel karyawan
    $kehadiran = DB::table('rekap_kehadiran')
        ->join('karyawan', 'rekap_kehadiran.karyawan_id', '=', 'karyawan.id_karyawan')
        ->select('rekap_kehadiran.*', 'karyawan.nama_lengkap', 'karyawan.divisi')
        ->get();
    
    return view('kehadiran', ['data_kehadiran' => $kehadiran]);
})->name('kehadiran');

// Jalur 6: Menampilkan Form Input Kehadiran
Route::get('/kehadiran/tambah', function () {
    // Tarik data karyawan untuk mengisi pilihan di form
    $karyawan = DB::table('karyawan')->orderBy('nama_lengkap', 'asc')->get();
    return view('kehadiran_tambah', ['data_karyawan' => $karyawan]);
})->name('kehadiran.tambah');

// Jalur 7: Menyimpan Data Kehadiran ke Database
Route::post('/kehadiran/store', function (Illuminate\Http\Request $request) {
    DB::table('rekap_kehadiran')->insert([
        'karyawan_id' => $request->karyawan_id,
        'periode_bulan' => $request->periode_bulan,
        'hari_hadir' => $request->hari_hadir,
        'jam_lembur' => $request->jam_lembur,
        'hari_cuti' => $request->hari_cuti,
        'hari_terlambat' => $request->hari_terlambat,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('kehadiran');
})->name('kehadiran.store');