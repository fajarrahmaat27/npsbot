<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::create(['text' => 'Bagaimana kebersihan area yang Anda kunjungi?', 'is_active' => true]);
        Question::create(['text' => 'Bagaimana keramahan staf kami saat melayani Anda?', 'is_active' => true]);
        Question::create(['text' => 'Seberapa puas Anda dengan fasilitas di kantor ini?', 'is_active' => true]);
    }
}
