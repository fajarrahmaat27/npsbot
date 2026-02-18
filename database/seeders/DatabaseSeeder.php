<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat User Admin
        \App\Models\User::factory()->create([
            'name' => 'Admin NeutraDC',
            'email' => 'admin@example.com',
        ]);

        // 2. Jalankan QuestionSeeder
        $this->call(QuestionSeeder::class);

        // 3. Jalankan Simulasi Tamu untuk Trigger NPS
        \App\Models\NpsSubmission::create([
            'telegram_id' => '5498002831', // GANTI DENGAN ID-MU UNTUK TES
            'name' => 'Tamu Simulasi NeutraDC',
            'company' => 'PT Telkom Indonesia',
            'checkin_at' => now()->subHours(2),
            'checkout_at' => '2026-02-13 11:10:00', // Dibuat lampau agar terpicu otomatis
            'status' => 'waiting',
        ]);
    }
    
}
