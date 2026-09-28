<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [
        'service_category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'page_content',
        'icon',
        'url',
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
        'schema_markup',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'show_in_nav' => 'boolean',
            'show_in_footer' => 'boolean',
            'page_content' => 'array',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function link(): string
    {
        if ($this->url) {
            return $this->url;
        }

        return route('services.show', $this->slug);
    }
}
