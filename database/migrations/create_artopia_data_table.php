<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('artopia_data', function (Blueprint $table) {
            $table->id(); // Primary key auto increment
            $table->timestamp('timestamp')->useCurrent();
            $table->string('nama_kelompok', 20)->nullable();
            $table->string('nama_lengkap', 50);
            $table->integer('nim');
            $table->enum('angkatan', ['2022', '2023', '2024', '2025']);
            $table->string('email', 50);
            $table->string('id_line', 20);
            $table->string('instagram', 15);
            $table->string('nama_booth', 20);
            $table->string('deskripsi_booth', 100);
            $table->enum('tanggal_booth', ['29-30 September 2025', '01-02 Oktober 2025']);
            $table->string('dokumen_pendukung', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('artopia_data');
    }
};