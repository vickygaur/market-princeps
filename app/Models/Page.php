<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'template',
        'is_published',
        'published_at',
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
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    public function section(string $key): ?PageSection
    {
        return $this->sections->firstWhere('key', $key);
    }

    public function sectionContent(string $key, array $default = []): array
    {
        $section = $this->section($key);

        return $section?->content ?? $default;
    }

    public function seoTitle(): string
    {
        return $this->meta_title ?: $this->title;
    }

    public function seoDescription(): ?string
    {
        return $this->meta_description;
    }
}
