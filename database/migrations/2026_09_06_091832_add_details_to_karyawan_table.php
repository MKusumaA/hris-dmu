<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            // Identitas & Pengaturan PT
            $table->string('nama_pt')->nullable();
            $table->string('nama_hrd')->nullable();

            // Finansial
            $table->integer('tunjangan_jabatan')->default(0);
            $table->integer('tunjangan_makan')->default(0);
            $table->integer('tunjangan_kehadiran')->default(0);
            $table->integer('tunjangan_kedisiplinan')->default(0);
            $table->integer('uang_lembur')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('tunjangan_transport')->default(0);

            // Potongan
            $table->integer('potongan_sakit')->default(0);
            $table->integer('potongan_ijin')->default(0);
            $table->integer('potongan_alpha')->default(0);
            $table->integer('potongan_bpjs_kesehatan')->default(0);
            $table->integer('potongan_bpjs_ketenagakerjaan')->default(0);
            $table->integer('potongan_pph21_2025')->default(0);
            $table->integer('potongan_keterlambatan')->default(0);
            $table->integer('potongan_dinas')->default(0);

            // Rekening
            $table->string('bank_tujuan')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('atas_nama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropColumn([
                'nama_pt', 'nama_hrd',
                'tunjangan_jabatan', 'tunjangan_makan', 'tunjangan_kehadiran', 'tunjangan_kedisiplinan', 'uang_lembur', 'bonus', 'tunjangan_transport',
                'potongan_sakit', 'potongan_ijin', 'potongan_alpha', 'potongan_bpjs_kesehatan', 'potongan_bpjs_ketenagakerjaan', 'potongan_pph21_2025', 'potongan_keterlambatan', 'potongan_dinas',
                'bank_tujuan', 'no_rekening', 'atas_nama'
            ]);
        });
    }
};
