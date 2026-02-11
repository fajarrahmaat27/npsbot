<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;

class QuestionManager extends Component
{
    public $text = '';
    public $editingId = null;
    public $editText = '';

    // Menambah Pertanyaan Baru
    public function add()
    {
        $this->validate(['text' => 'required|min:5']);
        
        Question::create([
            'text' => $this->text,
            'is_active' => true 
        ]);

        $this->reset('text');
        session()->flash('success', 'Pertanyaan baru berhasil ditambahkan dan berstatus Aktif.');
    }

    // Mengaktifkan Mode Edit
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $this->editingId = $id;
        $this->editText = $question->text;
    }

    // Simpan Perubahan Teks
    public function update()
    {
        $this->validate(['editText' => 'required|min:5']);
        
        Question::findOrFail($this->editingId)->update([
            'text' => $this->editText
        ]);
        
        $this->cancelEdit();
        session()->flash('success', 'Isi pertanyaan berhasil diperbarui.');
    }

    public function cancelEdit()
    {
        $this->reset(['editingId', 'editText']);
    }

    // Fitur Toggle: Aktif / Nonaktif
    public function toggleStatus($id)
    {
        $question = Question::findOrFail($id);
        $oldStatus = $question->is_active;
        
        $question->update([
            'is_active' => !$oldStatus
        ]);

        $statusBaru = $question->is_active ? 'diaktifkan' : 'dinonaktifkan';
        session()->flash('success', "Pertanyaan berhasil {$statusBaru}.");
    }

    // Hapus Permanen (Hanya jika belum ada jawaban di database)
    public function delete($id)
    {
        $question = Question::withCount('responses')->findOrFail($id);
        
        if ($question->responses_count > 0) {
            session()->flash('error', 'Pertanyaan tidak bisa dihapus karena sudah memiliki data jawaban. Silakan nonaktifkan saja.');
            return;
        }

        $question->delete();
        session()->flash('success', 'Pertanyaan berhasil dihapus permanen dari sistem.');
    }

    public function render()
    {
        return view('livewire.question-manager', [
            'questions' => Question::orderBy('is_active', 'desc')->latest()->get()
        ])->layout('layouts.app');
    }
}