<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\NpsSubmission;

class NPSController extends Controller
{
    public function handle(Request $request)
{
    $update = Telegram::getWebhookUpdate();
    $callbackQuery = $update->getCallbackQuery();
    
    // Ambil Chat ID dengan cara yang lebih aman untuk pesan maupun tombol
    $chatId = $callbackQuery 
        ? $callbackQuery->getMessage()->getChat()->getId() 
        : $update->getChat()->getId();

    $message = $update->getMessage();
    $text = $message ? $message->getText() : null;

    // 1. JIKA KLIK /START -> BUAT SESI BARU (SELALU PRIORITAS)
    if ($text == '/start') {
        NpsSubmission::create(['telegram_id' => $chatId, 'status' => 'waiting_name']);
        Telegram::sendMessage([
            'chat_id' => $chatId, 
            'text' => "Selamat datang di Survei Kunjungan NeutraDC! Mohon informasikan Nama Lengkap Anda:"
        ]);
        return response()->json(['status' => 'success']);
    }

    // 2. CARI SESI YANG SEDANG AKTIF
    $submission = NpsSubmission::where('telegram_id', $chatId)
        ->where('status', '!=', 'completed')
        ->latest()
        ->first();

    if (!$submission) return response()->json(['status' => 'ignore']);

    // 3. PRIORITAS: JIKA ADA KLIK TOMBOL (CALLBACK QUERY)
    if ($callbackQuery) {
        return $this->handleRating($callbackQuery, $submission);
    }

    // 4. JIKA ADA INPUT TEKS (NAME/COMPANY/FEEDBACK)
    if ($text) {
        if ($submission->status == 'waiting_name') {
            $submission->update(['name' => $text, 'status' => 'waiting_company']);
            Telegram::sendMessage([
                'chat_id' => $chatId, 
                'text' => "Terima kasih, $text. Dari PT/Instansi mana Anda berasal?"
            ]);
        } elseif ($submission->status == 'waiting_company') {
            $submission->update(['company' => $text, 'status' => 'answering']);
            $this->sendNextQuestion($chatId, $submission);
        }
    }

    return response()->json(['status' => 'success']);
}

    private function sendNextQuestion($chatId, $submission)
{
    // Cari pertanyaan yang belum dijawab untuk sesi visit ini
    $answeredQuestionIds = $submission->responses()->pluck('question_id');
    $nextQuestion = \App\Models\Question::where('is_active', true)
        ->whereNotIn('id', $answeredQuestionIds)
        ->orderBy('id', 'asc')
        ->first();

    if ($nextQuestion) {
        $buttons = [];
        for ($i = 1; $i <= 5; $i++) {
            $buttons[] = ['text' => (string)$i, 'callback_data' => $nextQuestion->id . ":$i"];
        }

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => $nextQuestion->text,
            'reply_markup' => json_encode(['inline_keyboard' => array_chunk($buttons, 5)])
        ]);
    } else {
        $submission->update(['status' => 'completed']);
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "Terima kasih banyak atas partisipasi Anda! Data kunjungan Anda telah tersimpan."
        ]);
    }
}

private function handleRating($callbackQuery, $submission)
{
    $chatId = $callbackQuery->getMessage()->getChat()->getId();
    $data = explode(':', $callbackQuery->getData()); // Format: question_id:rating
    $questionId = $data[0];
    $rating = $data[1];

    // Simpan ke tabel survey_responses
    \App\Models\SurveyResponse::create([
        'nps_submission_id' => $submission->id,
        'question_id' => $questionId,
        'rating' => $rating
    ]);

    Telegram::answerCallbackQuery(['callback_query_id' => $callbackQuery->getId()]);
    
    // Kirim pertanyaan berikutnya
    $this->sendNextQuestion($chatId, $submission);
}
}
