<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseUsItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_tr',
        'title_en',
        'description_tr',
        'description_en',
        'icon',
        'order',
        'status',
    ];

    public const ICONS = [
        'building' => [
            'label_tr' => 'Bina',
            'label_en' => 'Building',
            'paths' => [
                'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
            ],
        ],
        'shield-check' => [
            'label_tr' => 'Kalkan',
            'label_en' => 'Shield',
            'paths' => [
                'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
            ],
        ],
        'users' => [
            'label_tr' => 'Ekip',
            'label_en' => 'Team',
            'paths' => [
                'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0z',
            ],
        ],
        'cog' => [
            'label_tr' => 'Ayar',
            'label_en' => 'Settings',
            'paths' => [
                'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
                'M15 12a3 3 0 11-6 0 3 3 0 016 0z',
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
        'document' => [
            'label_tr' => 'Belge',
            'label_en' => 'Document',
            'paths' => [
                'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
            ],
        ],
    ];

    public static function iconOptions(): array
    {
        return self::ICONS;
    }

    public function iconConfig(): array
    {
        return self::ICONS[$this->icon] ?? self::ICONS['building'];
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
}

