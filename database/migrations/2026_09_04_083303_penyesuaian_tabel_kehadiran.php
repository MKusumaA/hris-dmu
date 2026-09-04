<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rekap_kehadiran', function (Blueprint $table) {
            // Menambahkan kolom baru untuk sistem 5 kode
            $table->string('kode_absensi')->nullable();
            $table->integer('jumlah')->default(0);
        });
    }

    public function down()
    {
        Schema::table('rekap_kehadiran', function (Blueprint $table) {
            $table->dropColumn(['kode_absensi', 'jumlah']);
        });
    }
};