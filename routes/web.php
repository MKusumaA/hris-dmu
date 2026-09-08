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
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('jumlah');
        
    $kasus_alpa = DB::table('rekap_kehadiran')
        ->where('periode_bulan', $periode)
        ->where('kode_absensi', 'TA')
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('jumlah');

    return view('karyawan', [
        'data_karyawan' => $karyawan,
        'kasus_terlambat' => $kasus_terlambat,
        'kasus_alpa' => $kasus_alpa
    ]);
})->name('karyawan');

// Jalur 3: Menampilkan Form Tambah Karyawan
Route::get('/karyawan/tambah', function () {
    return view('karyawan_form', ['karyawan' => null]);
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
        'npwp' => $request->npwp,
        'status_ptkp' => $request->status_ptkp,
        'no_bpjs_tk' => $request->no_bpjs_tk,
        'no_bpjs_kes' => $request->no_bpjs_kes,
        // Identitas PT
        'nama_pt' => $request->nama_pt,
        'nama_hrd' => $request->nama_hrd,
        // Finansial
        'tunjangan_jabatan' => $request->tunjangan_jabatan ?? 0,
        'tunjangan_makan' => $request->tunjangan_makan ?? 0,
        'tunjangan_kehadiran' => $request->tunjangan_kehadiran ?? 0,
        'tunjangan_kedisiplinan' => $request->tunjangan_kedisiplinan ?? 0,
        'uang_lembur' => $request->uang_lembur ?? 0,
        'bonus' => $request->bonus ?? 0,
        'tunjangan_transport' => $request->tunjangan_transport ?? 0,
        // Potongan
        'potongan_sakit' => $request->potongan_sakit ?? 0,
        'potongan_ijin' => $request->potongan_ijin ?? 0,
        'potongan_alpha' => $request->potongan_alpha ?? 0,
        'potongan_bpjs_kesehatan' => $request->potongan_bpjs_kesehatan ?? 0,
        'potongan_bpjs_ketenagakerjaan' => $request->potongan_bpjs_ketenagakerjaan ?? 0,
        'potongan_pph21_2025' => $request->potongan_pph21_2025 ?? 0,
        'potongan_keterlambatan' => $request->potongan_keterlambatan ?? 0,
        'potongan_dinas' => $request->potongan_dinas ?? 0,
        // Rekening
        'bank_tujuan' => $request->bank_tujuan,
        'no_rekening' => $request->no_rekening,
        'atas_nama' => $request->atas_nama,
        
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('karyawan');
})->name('karyawan.store');

// Edit Karyawan
Route::get('/karyawan/edit/{id}', function ($id) {
    $karyawan = DB::table('karyawan')->where('id_karyawan', $id)->first();
    return view('karyawan_form', ['karyawan' => $karyawan]);
})->name('karyawan.edit');

// Update Karyawan
Route::post('/karyawan/update/{id}', function (Request $request, $id) {
    DB::table('karyawan')->where('id_karyawan', $id)->update([
        'nama_lengkap' => $request->nama_lengkap,
        'divisi' => $request->divisi,
        'jabatan' => $request->jabatan,
        'status_kerja' => $request->status_kerja,
        'tgl_bergabung' => $request->tgl_bergabung,
        'gaji_pokok' => $request->gaji_pokok,
        'npwp' => $request->npwp,
        'status_ptkp' => $request->status_ptkp,
        'no_bpjs_tk' => $request->no_bpjs_tk,
        'no_bpjs_kes' => $request->no_bpjs_kes,
        'nama_pt' => $request->nama_pt,
        'nama_hrd' => $request->nama_hrd,
        'tunjangan_jabatan' => $request->tunjangan_jabatan ?? 0,
        'tunjangan_makan' => $request->tunjangan_makan ?? 0,
        'tunjangan_kehadiran' => $request->tunjangan_kehadiran ?? 0,
        'tunjangan_kedisiplinan' => $request->tunjangan_kedisiplinan ?? 0,
        'uang_lembur' => $request->uang_lembur ?? 0,
        'bonus' => $request->bonus ?? 0,
        'tunjangan_transport' => $request->tunjangan_transport ?? 0,
        'potongan_sakit' => $request->potongan_sakit ?? 0,
        'potongan_ijin' => $request->potongan_ijin ?? 0,
        'potongan_alpha' => $request->potongan_alpha ?? 0,
        'potongan_bpjs_kesehatan' => $request->potongan_bpjs_kesehatan ?? 0,
        'potongan_bpjs_ketenagakerjaan' => $request->potongan_bpjs_ketenagakerjaan ?? 0,
        'potongan_pph21_2025' => $request->potongan_pph21_2025 ?? 0,
        'potongan_keterlambatan' => $request->potongan_keterlambatan ?? 0,
        'potongan_dinas' => $request->potongan_dinas ?? 0,
        'bank_tujuan' => $request->bank_tujuan,
        'no_rekening' => $request->no_rekening,
        'atas_nama' => $request->atas_nama,
        'updated_at' => now(),
    ]);

    return redirect()->route('karyawan');
})->name('karyawan.update');

// Delete Karyawan
Route::get('/karyawan/delete/{id}', function ($id) {
    DB::table('karyawan')->where('id_karyawan', $id)->delete();
    // Opsional: Hapus juga rekap kehadirannya
    DB::table('rekap_kehadiran')->where('karyawan_id', $id)->delete();
    return redirect()->route('karyawan');
})->name('karyawan.delete');

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

// Kehadiran Edit
Route::get('/kehadiran/edit/{id}', function ($id) {
    $karyawan = DB::table('karyawan')->where('id_karyawan', $id)->first();
    $periode = date('Y-m');
    $kehadiran = DB::table('rekap_kehadiran')
        ->where('karyawan_id', $id)
        ->where('periode_bulan', $periode)
        ->get();
        
    return view('kehadiran_edit', [
        'karyawan' => $karyawan,
        'kehadiran' => $kehadiran,
        'periode' => $periode
    ]);
})->name('kehadiran.edit');

// Kehadiran Update
Route::post('/kehadiran/update/{id}', function (Illuminate\Http\Request $request, $id) {
    $periode = date('Y-m');
    
    // Hapus data lama bulan ini
    DB::table('rekap_kehadiran')
        ->where('karyawan_id', $id)
        ->where('periode_bulan', $periode)
        ->delete();
        
    // Insert data baru
    $kodes = ['MT', 'TMI', 'TMDL', 'TMTD', 'TA'];
    foreach ($kodes as $kode) {
        $jumlah = $request->input(strtolower($kode), 0);
        if ($jumlah > 0) {
            DB::table('rekap_kehadiran')->insert([
                'karyawan_id' => $id,
                'kode_absensi' => $kode,
                'jumlah' => $jumlah,
                'periode_bulan' => $periode,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    
    return redirect()->route('kehadiran');
})->name('kehadiran.update');

// Kehadiran Delete
Route::get('/kehadiran/delete/{id}', function ($id) {
    $periode = date('Y-m');
    DB::table('rekap_kehadiran')
        ->where('karyawan_id', $id)
        ->where('periode_bulan', $periode)
        ->delete();
    return redirect()->route('kehadiran');
})->name('kehadiran.delete');

// Rute untuk melihat halaman kalkulasi dan menyimpan data
Route::get('/slip-gaji', [App\Http\Controllers\SlipGajiController::class, 'index']);
Route::get('/slip-gaji/kalkulasi', [App\Http\Controllers\SlipGajiController::class, 'create']);
Route::post('/slip-gaji', [App\Http\Controllers\SlipGajiController::class, 'store']);

// Rute BARU untuk mencetak PDF
Route::get('/slip-gaji/cetak/{id}', [App\Http\Controllers\SlipGajiController::class, 'cetak_pdf']);