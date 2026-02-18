<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Gunakan CREATE karena ini adalah file migrasi awal
        Schema::create('nps_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('telegram_id')->unique();
            $table->string('name')->nullable(); // Sesuai rencana trigger otomatis
            $table->string('company')->nullable();
            
            // Kolom untuk tracking jadwal di NeutraDC
            $table->timestamp('checkin_at')->nullable();
            $table->timestamp('checkout_at')->nullable();
            
            // Status awal adalah 'waiting'
            $table->string('status')->default('waiting'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nps_submissions');
    }
};