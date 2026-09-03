<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('karyawan')->insert([
            [
                'id_karyawan' => 'EMP-045',
                'nama_lengkap' => 'Erlin Puspitasari',
                'divisi' => 'HR & GA',
                'jabatan' => 'General Affair Manager',
                'status_kerja' => 'Tetap',
                'tgl_bergabung' => '2010-05-01',
                'npwp' => '00.000.000.0-000.000',
                'status_ptkp' => 'TK',
                'no_bpjs_tk' => 'Terdaftar',
                'no_bpjs_kes' => 'Terdaftar',
                'gaji_pokok' => 5200000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_karyawan' => 'EMP-012',
                'nama_lengkap' => 'Budi Santoso',
                'divisi' => 'Pengadaan Alkes',
                'jabatan' => 'Procurement Staff',
                'status_kerja' => 'Tetap',
                'tgl_bergabung' => '2020-02-15',
                'npwp' => '11.111.111.1-111.111',
                'status_ptkp' => 'K/1',
                'no_bpjs_tk' => 'Terdaftar',
                'no_bpjs_kes' => 'Terdaftar',
                'gaji_pokok' => 4500000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_karyawan' => 'EMP-088',
                'nama_lengkap' => 'Siti Aminah',
                'divisi' => 'Jajanan UMKM',
                'jabatan' => 'Admin UMKM',
                'status_kerja' => 'Kontrak',
                'tgl_bergabung' => '2023-01-10',
                'npwp' => '22.222.222.2-222.222',
                'status_ptkp' => 'TK',
                'no_bpjs_tk' => 'Terdaftar',
                'no_bpjs_kes' => 'Terdaftar',
                'gaji_pokok' => 3800000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}