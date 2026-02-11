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
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke sesi di tabel nps_submissions
            $table->foreignId('nps_submission_id')->constrained()->onDelete('cascade');
            // Menghubungkan ke pertanyaan spesifik dari CMS
            $table->foreignId('question_id')->constrained();
            $table->integer('rating'); // Skor 1-5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
