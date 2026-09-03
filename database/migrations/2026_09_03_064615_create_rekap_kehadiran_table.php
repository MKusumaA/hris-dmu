<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekap_kehadiran', function (Blueprint $table) {
            $table->id('id_kehadiran');
            // Relasi ke tabel karyawan (id_karyawan bentuknya string)
            $table->string('karyawan_id', 20);
            $table->foreign('karyawan_id')->references('id_karyawan')->on('karyawan')->onDelete('cascade');
            
            $table->string('periode_bulan', 20); // Contoh: "Oktober 2023"
            $table->integer('hari_hadir')->default(0);
            $table->decimal('jam_lembur', 5, 2)->default(0); // Memakai decimal untuk antisipasi lembur setengah jam (0.5)
            $table->integer('hari_cuti')->default(0);
            $table->integer('hari_terlambat')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekap_kehadiran');
    }
};