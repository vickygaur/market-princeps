<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'badge_label',
        'badge_color',
        'icon',
        'description',
        'sort_order',
        'is_active',
        'show_in_nav',
        'show_in_footer',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'robots',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'show_in_nav' => 'boolean',
            'show_in_footer' => 'boolean',
        ];
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class)->orderBy('sort_order');
    }
}
