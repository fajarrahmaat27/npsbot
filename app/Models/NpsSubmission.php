<?php

namespace App\Models;

use App\Models\SurveyResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NpsSubmission extends Model
{
    protected $fillable = [
        'telegram_id',
        'name',
        'company',
        'status',
        'checkin_at', // Ditambahkan
        'checkout_at' // Ditambahkan
    ];

    protected $casts = [
        'checkin_at' => 'datetime',
        'checkout_at' => 'datetime',
    ];

    public function responses(): HasMany
    {
        return $this->hasMany(SurveyResponse::class);
    }
}
