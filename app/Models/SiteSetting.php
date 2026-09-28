<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'label',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $settings = Cache::rememberForever('site_settings', function () {
            return static::query()->pluck('value', 'key')->all();
        });

        return $settings[$key] ?? $default;
    }

    public static function setValue(string $key, mixed $value, string $group = 'general', string $type = 'text', ?string $label = null): self
    {
        $setting = static::query()->updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
                'label' => $label ?? $key,
            ]
        );

        Cache::forget('site_settings');

        return $setting;
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('site_settings'));
        static::deleted(fn () => Cache::forget('site_settings'));
    }
}
