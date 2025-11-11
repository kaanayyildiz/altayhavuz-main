<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'text_tr',
        'text_en',
        'order',
        'status',
    ];

    protected function localizedValue(): string
    {
        $locale = app()->getLocale();
        $primary = "text_{$locale}";
        $fallback = $locale === 'tr' ? 'text_en' : 'text_tr';

        return $this->{$primary} ?: ($this->{$fallback} ?: '');
    }

    public function getLocalizedTextAttribute(): string
    {
        return $this->localizedValue();
    }
}

