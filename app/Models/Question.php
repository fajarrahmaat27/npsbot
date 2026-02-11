<?php

namespace App\Models;

use App\Models\SurveyResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = ['text', 'is_active'];

    // Tambahkan baris ini
    public function responses(): HasMany
    {
        return $this->hasMany(SurveyResponse::class);
    }
}
