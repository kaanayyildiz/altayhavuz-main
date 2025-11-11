<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeMissionVision extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagline_tr',
        'tagline_en',
        'mission_title_tr',
        'mission_title_en',
        'mission_description_tr',
        'mission_description_en',
        'vision_title_tr',
        'vision_title_en',
        'vision_description_tr',
        'vision_description_en',
    ];

    public static function singleton(): self
    {
        return static::first() ?? static::create();
    }

    protected function localizedValue(string $field): string
    {
        $locale = app()->getLocale();
        $primary = "{$field}_{$locale}";
        $fallback = $locale === 'tr' ? "{$field}_en" : "{$field}_tr";

        return $this->{$primary} ?: ($this->{$fallback} ?: '');
    }

    public function getLocalizedTaglineAttribute(): string
    {
        return $this->localizedValue('tagline');
    }

    public function getLocalizedMissionTitleAttribute(): string
    {
        return $this->localizedValue('mission_title');
    }

    public function getLocalizedMissionDescriptionAttribute(): string
    {
        return $this->localizedValue('mission_description');
    }

    public function getLocalizedVisionTitleAttribute(): string
    {
        return $this->localizedValue('vision_title');
    }

    public function getLocalizedVisionDescriptionAttribute(): string
    {
        return $this->localizedValue('vision_description');
    }
}

