<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// Jalur 1: Halaman Utama (Dashboard)
Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

// Jalur 2: Halaman Data Karyawan
Route::get('/karyawan', function () {
    $karyawan = DB::table('karyawan')->get();
    return view('karyawan', ['data_karyawan' => $karyawan]);
})->name('karyawan');