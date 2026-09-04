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
    
    // Menghitung statistik bulan berjalan
    $periode = date('Y-m');
    $kasus_terlambat = DB::table('rekap_kehadiran')
        ->where('periode_bulan', $periode)
        ->where('kode_absensi', 'MT')
        ->sum('jumlah');
        
    $kasus_alpa = DB::table('rekap_kehadiran')
        ->where('periode_bulan', $periode)
        ->where('kode_absensi', 'TA')
        ->sum('jumlah');

    return view('karyawan', [
        'data_karyawan' => $karyawan,
        'kasus_terlambat' => $kasus_terlambat,
        'kasus_alpa' => $kasus_alpa
    ]);
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

// Jalur 7: Menyimpan Data Kehadiran ke Database (Sistem 5 Kode)
Route::post('/kehadiran/store', function (Illuminate\Http\Request $request) {
    DB::table('rekap_kehadiran')->insert([
        'karyawan_id' => $request->karyawan_id,
        'kode_absensi' => $request->kode_absensi,
        'jumlah' => $request->jumlah,
        'periode_bulan' => date('Y-m'), // TAMBAHAN BARU: Otomatis mengisi periode saat ini
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Setelah sukses menyimpan, tendang kembali user ke halaman rekap kehadiran
    return redirect()->route('kehadiran');
})->name('kehadiran.store');

// Rute untuk melihat halaman kalkulasi dan menyimpan data
Route::get('/slip-gaji', [App\Http\Controllers\SlipGajiController::class, 'index']);
Route::get('/slip-gaji/kalkulasi', [App\Http\Controllers\SlipGajiController::class, 'create']);
Route::post('/slip-gaji', [App\Http\Controllers\SlipGajiController::class, 'store']);

// Rute BARU untuk mencetak PDF
Route::get('/slip-gaji/cetak/{id}', [App\Http\Controllers\SlipGajiController::class, 'cetak_pdf']);