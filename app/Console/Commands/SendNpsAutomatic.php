<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NpsSubmission;
use App\Models\Question;
use Telegram\Bot\Laravel\Facades\Telegram;

class SendNpsAutomatic extends Command
{
    protected $signature = 'app:send-nps';

    public function handle()
    {
        // Cari tamu yang sudah checkout tapi belum dikirimi survey
        $targets = NpsSubmission::where('status', 'waiting')
            ->where('checkout_at', '<=', now()) 
            ->get();

        foreach ($targets as $guest) {
            // Ambil pertanyaan pertama yang aktif
            $firstQuestion = Question::where('is_active', true)->orderBy('id', 'asc')->first();

            if ($firstQuestion) {
                // Kirim sapaan dan pertanyaan pertama sekaligus (Push Message)
                Telegram::sendMessage([
                    'chat_id' => $guest->telegram_id,
                    'text' => "Halo {$guest->name} dari {$guest->company}. Terima kasih atas kunjungan Anda. Mohon bantuannya untuk mengisi survey singkat ini."
                ]);

                // Kirim pertanyaan dengan tombol 1-5
                $buttons = [];
                for ($i = 1; $i <= 5; $i++) {
                    $buttons[] = ['text' => (string)$i, 'callback_data' => $firstQuestion->id . ":$i"];
                }

                Telegram::sendMessage([
                    'chat_id' => $guest->telegram_id,
                    'text' => "Pertanyaan 1: " . $firstQuestion->text,
                    'reply_markup' => json_encode(['inline_keyboard' => array_chunk($buttons, 5)])
                ]);

                // Update status ke 'answering' agar sistem tahu tamu sedang mengisi
                $guest->update(['status' => 'answering']);
            }
        }
    }
}
