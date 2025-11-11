<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_tr',
        'question_en',
        'answer_tr',
        'answer_en',
        'order',
        'status',
    ];

    protected function localizedValue(string $field): string
    {
        $locale = app()->getLocale();
        $primary = "{$field}_{$locale}";
        $fallback = $locale === 'tr' ? "{$field}_en" : "{$field}_tr";

        return $this->{$primary} ?: ($this->{$fallback} ?: '');
    }

    public function getLocalizedQuestionAttribute(): string
    {
        return $this->localizedValue('question');
    }

    public function getLocalizedAnswerAttribute(): string
    {
        return $this->localizedValue('answer');
    }
}

