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
        Schema::create('nps_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('telegram_id'); // ID unik dari Telegram
            $table->string('name')->nullable(); // Nama yang diketik user
            $table->string('company')->nullable(); // Nama PT yang diketik user
            $table->string('status')->default('waiting_name'); // Mengatur alur bot
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nps_submissions');
    }
};
