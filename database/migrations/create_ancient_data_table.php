<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
 
return new class extends Migration
{
    public function up()
    {
        Schema::create('ancient_data', function (Blueprint $table) {
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('nama_lengkap', 50);
            $table->integer('nim');
            $table->string('angkatan', 4);
            $table->string('email', 50)->unique();
            $table->string('id_line', 20);
            $table->string('lokasi_pilihan', 10);
            $table->string('dokumen_esai', 255);
            
            $table->index(['nim', 'email']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ancient_data');
    }
};