<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('slip_gaji', function (Blueprint $table) {
            $table->id();
            $table->string('karyawan_id'); // Relasi ke ID Karyawan
            $table->string('periode'); // Contoh: "Oktober 2023"
            
            // Penerimaan
            $table->decimal('gaji_pokok', 12, 2);
            $table->decimal('tunjangan_jabatan', 12, 2)->default(0);
            $table->decimal('tunjangan_makan', 12, 2)->default(0);
            $table->decimal('tunjangan_kehadiran', 12, 2)->default(0);
            $table->decimal('tunjangan_kedisiplinan', 12, 2)->default(0);
            $table->decimal('lembur', 12, 2)->default(0);
            $table->decimal('bonus', 12, 2)->default(0);
            $table->decimal('transport', 12, 2)->default(0);
            
            // Potongan
            $table->decimal('potongan_sakit', 12, 2)->default(0);
            $table->decimal('potongan_ijin', 12, 2)->default(0);
            $table->decimal('potongan_alpha', 12, 2)->default(0);
            $table->decimal('bpjs_kesehatan', 12, 2)->default(0);
            $table->decimal('bpjs_ketenagakerjaan', 12, 2)->default(0);
            $table->decimal('pph21', 12, 2)->default(0);
            $table->decimal('potongan_terlambat', 12, 2)->default(0);
            $table->decimal('potongan_dinas', 12, 2)->default(0);

            $table->decimal('total_penerimaan', 12, 2);
            $table->decimal('total_potongan', 12, 2);
            $table->decimal('take_home_pay', 12, 2);
            
            $table->string('status_pembayaran')->default('Draft'); // Draft atau Terbayar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('slip_gaji');
    }
};