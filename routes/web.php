<?php

use App\Livewire\QuestionManager;
use App\Livewire\SurveyDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Halaman utama langsung menampilkan Dashboard
Route::get('/', SurveyDashboard::class)->name('dashboard');

// Halaman untuk mengelola pertanyaan
Route::get('/cms', QuestionManager::class)->name('cms');