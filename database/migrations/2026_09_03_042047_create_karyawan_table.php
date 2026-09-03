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
        Schema::create('karyawan', function (Blueprint $table) {
            // Menggunakan string untuk ID Karyawan (NIK) karena bentuknya seperti EMP-045
            $table->string('id_karyawan', 20)->primary(); 
            
            // Informasi Dasar
            $table->string('nama_lengkap');
            $table->string('divisi');
            $table->string('jabatan');
            $table->enum('status_kerja', ['Tetap', 'Kontrak']);
            $table->date('tgl_bergabung');
            
            // Data Finansial & Pajak (Bisa dikosongkan/nullable jika belum ada)
            $table->string('npwp')->nullable();
            $table->string('status_ptkp', 10)->nullable();
            $table->string('no_bpjs_tk')->nullable();
            $table->string('no_bpjs_kes')->nullable();
            $table->bigInteger('gaji_pokok'); // Menggunakan bigInteger untuk nominal uang
            
            // timestamps otomatis membuat kolom 'created_at' dan 'updated_at'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};