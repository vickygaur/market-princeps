<?php

namespace App\Filament\Concerns;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Support\Arr;

trait ManagesCmsPage
{
    abstract protected static function pageSlug(): string;

    /**
     * @return list<string>
     */
    abstract protected static function sectionKeys(): array;

    protected function cmsPage(): Page
    {
        return Page::query()
            ->where('slug', static::pageSlug())
            ->with('sections')
            ->firstOrFail();
    }

    /**
     * @return array<string, mixed>
     */
    protected function loadCmsFormData(): array
    {
        $page = $this->cmsPage();

        $data = Arr::only($page->attributesToArray(), [
            'title',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'og_title',
            'og_description',
            'og_image',
            'canonical_url',
            'robots',
            'schema_markup',
            'is_published',
        ]);

        foreach (static::sectionKeys() as $key) {
            $section = $page->sections->firstWhere('key', $key);
            $data[$key] = $section?->content ?? [];
        }

        return $this->normalizeCmsFormData($data);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function normalizeCmsFormData(array $data): array
    {
        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function prepareCmsFormDataForSave(array $data): array
    {
        return $data;
    }

    protected function saveCmsFormData(array $data): void
    {
        $data = $this->prepareCmsFormDataForSave($data);
        $page = $this->cmsPage();

        $page->update(Arr::only($data, [
            'title',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'og_title',
            'og_description',
            'og_image',
            'canonical_url',
            'robots',
            'schema_markup',
            'is_published',
        ]));

        foreach (static::sectionKeys() as $key) {
            if (! array_key_exists($key, $data)) {
                continue;
            }

            $existing = PageSection::query()
                ->where('page_id', $page->id)
                ->where('key', $key)
                ->value('content');

            $incoming = is_array($data[$key]) ? $data[$key] : [];
            $content = $this->mergeSectionContent(
                is_array($existing) ? $existing : [],
                $incoming
            );

            PageSection::query()->updateOrCreate(
                [
                    'page_id' => $page->id,
                    'key' => $key,
                ],
                [
                    'name' => str($key)->headline()->toString(),
                    'content' => $content,
                    'is_active' => true,
                ]
            );
        }
    }

    /**
     * @param  array<string, mixed>  $existing
     * @param  array<string, mixed>  $incoming
     * @return array<string, mixed>
     */
    protected function mergeSectionContent(array $existing, array $incoming): array
    {
        foreach ($incoming as $key => $value) {
            if (is_array($value) && array_is_list($value)) {
                $existing[$key] = $value;

                continue;
            }

            if (
                is_array($value)
                && isset($existing[$key])
                && is_array($existing[$key])
                && ! array_is_list($existing[$key])
            ) {
                $existing[$key] = $this->mergeSectionContent($existing[$key], $value);

                continue;
            }

            $existing[$key] = $value;
        }

        return $existing;
    }

    /**
     * @param  list<mixed>  $items
     * @return list<array{text: string}>
     */
    protected function wrapTextList(array $items): array
    {
        return collect($items)
            ->map(function ($item) {
                if (is_array($item)) {
                    return ['text' => (string) ($item['text'] ?? reset($item) ?: '')];
                }

                return ['text' => (string) $item];
            })
            ->filter(fn (array $item) => filled($item['text']))
            ->values()
            ->all();
    }

    /**
     * @param  list<mixed>|null  $items
     * @return list<string>
     */
    protected function unwrapTextList(?array $items): array
    {
        return collect($items ?? [])
            ->map(function ($item) {
                if (is_array($item)) {
                    return (string) ($item['text'] ?? reset($item) ?: '');
                }

                return (string) $item;
            })
            ->filter()
            ->values()
            ->all();
    }
}
