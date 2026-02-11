<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\NpsSubmission;

class SurveyDashboard extends Component
{
    public function render()
    {
        // 1. Ambil HANYA pertanyaan yang AKTIF untuk ditampilkan grafiknya
        $questions = \App\Models\Question::where('is_active', true)->with('responses')->get();

        // 2. Siapkan data chart untuk tiap pertanyaan aktif
        $questionCharts = $questions->map(function ($q) {
            $counts = $q->responses->groupBy('rating')->map->count();
            $data = [];
            for ($i = 1; $i <= 5; $i++) {
                $data[] = $counts[$i] ?? 0;
            }
            return [
                'id' => $q->id,
                'text' => $q->text,
                'data' => $data,
                'avg' => number_format($q->responses->avg('rating'), 1)
            ];
        });

        return view('livewire.survey-dashboard', [
            'questionCharts' => $questionCharts,
            // Total kunjungan tetap dihitung dari seluruhnya agar data tidak hilang
            'totalVisits' => \App\Models\NpsSubmission::where('status', 'completed')->count(),
        ])->layout('layouts.app');
    }
}
