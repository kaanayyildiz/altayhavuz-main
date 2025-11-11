<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_tr',
        'title_en',
        'description_tr',
        'description_en',
        'features_tr',
        'features_en',
        'icon',
        'order',
        'status',
    ];

    public const ICONS = [
        'heart' => [
            'label_tr' => 'Kalp',
            'label_en' => 'Heart',
            'paths' => [
                'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
            ],
        ],
        'building' => [
            'label_tr' => 'Bina',
            'label_en' => 'Building',
            'paths' => [
                'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
            ],
        ],
        'settings' => [
            'label_tr' => 'Ayarlar',
            'label_en' => 'Settings',
            'paths' => [
                'M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z',
            ],
        ],
        'refresh' => [
            'label_tr' => 'Yenile',
            'label_en' => 'Refresh',
            'paths' => [
                'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
            ],
        ],
        'shield' => [
            'label_tr' => 'Kalkan',
            'label_en' => 'Shield',
            'paths' => [
                'M9 12l2 2 4-4m5.618-2.016A11.955 11.955 0 0112 21 11.955 11.955 0 012.382 7.984a4.992 4.992 0 012.09-3.131L12 3l7.528 1.853a4.992 4.992 0 012.09 3.131z',
            ],
        ],
        'sparkles' => [
            'label_tr' => 'Parıltı',
            'label_en' => 'Sparkles',
            'paths' => [
                'M9.813 15.904L9 17.25l-.813-1.346a2 2 0 00-.73-.71l-1.431-.774 1.431-.774a2 2 0 00.73-.71L9 12.25l.813 1.346a2 2 0 00.73.71l1.431.774-1.431.774a2 2 0 00-.73.71z',
                'M17.813 8.904L17 10.25l-.813-1.346a2 2 0 00-.73-.71l-1.431-.774 1.431-.774a2 2 0 00.73-.71L17 4.25l.813 1.346a2 2 0 00.73.71l1.431.774-1.431.774a2 2 0 00-.73.71z',
                'M13.813 12.904L13 14.25l-.813-1.346a2 2 0 00-.73-.71l-1.431-.774 1.431-.774a2 2 0 00.73-.71L13 8.25l.813 1.346a2 2 0 00.73.71l1.431.774-1.431.774a2 2 0 00-.73.71z',
            ],
        ],
    ];

    public static function iconOptions(): array
    {
        return self::ICONS;
    }

    public function iconConfig(): array
    {
        return self::ICONS[$this->icon] ?? self::ICONS['heart'];
    }

    public function getIconConfigAttribute(): array
    {
        return $this->iconConfig();
    }

    protected function localizedValue(string $field): string
    {
        $locale = app()->getLocale();
        $primary = "{$field}_{$locale}";
        $fallback = $locale === 'tr' ? "{$field}_en" : "{$field}_tr";

        return $this->{$primary} ?: ($this->{$fallback} ?: '');
    }

    public function getLocalizedTitleAttribute(): string
    {
        return $this->localizedValue('title');
    }

    public function getLocalizedDescriptionAttribute(): string
    {
        return $this->localizedValue('description');
    }

    public function getLocalizedFeaturesAttribute(): array
    {
        $locale = app()->getLocale();
        $primary = "features_{$locale}";
        $fallback = $locale === 'tr' ? 'features_en' : 'features_tr';
        $raw = $this->{$primary} ?: ($this->{$fallback} ?: '');

        return collect(preg_split('/\r\n|\r|\n/', (string) $raw))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }
}

