<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slip_gaji', function (Blueprint $table) {
            $table->id('id_slip');
            $table->string('karyawan_id', 20);
            $table->foreign('karyawan_id')->references('id_karyawan')->on('karyawan')->onDelete('cascade');
            
            $table->string('periode_gaji', 20); // Contoh: "Oktober 2023"
            
            // Kolom Pendapatan
            $table->bigInteger('pendapatan_pokok')->default(0);
            $table->bigInteger('tunjangan_jabatan')->default(0);
            $table->bigInteger('tunjangan_makan')->default(0);
            $table->bigInteger('nominal_lembur')->default(0);
            
            // Kolom Potongan
            $table->bigInteger('potongan_pph21')->default(0);
            $table->bigInteger('potongan_bpjs')->default(0);
            $table->bigInteger('potongan_lain')->default(0); // Untuk terlambat/koperasi
            
            // Hasil Akhir
            $table->bigInteger('take_home_pay')->default(0);
            $table->enum('status_dokumen', ['Draft', 'Approved', 'Tersedia'])->default('Draft');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slip_gaji');
    }
};