<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->enum('program_type', ['artopia', 'ancient']);
            $table->enum('status_type', ['accepted', 'rejected', 'pending']);
            $table->string('subject');
            $table->text('message');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Unique constraint untuk program_type dan status_type
            $table->unique(['program_type', 'status_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_templates');
    }
};