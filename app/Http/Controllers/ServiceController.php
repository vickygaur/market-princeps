<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function show(Service $service): View
    {
        abort_unless($service->is_active, 404);

        $service->load('category');

        $content = $service->page_content ?? [];

        $page = new Page([
            'title' => $service->name,
            'slug' => $service->slug,
            'meta_title' => $service->meta_title ?: ($service->name.' | Market Princeps'),
            'meta_description' => $service->meta_description ?: $service->short_description,
            'meta_keywords' => $service->meta_keywords,
            'og_title' => $service->og_title ?: $service->meta_title,
            'og_description' => $service->og_description ?: $service->meta_description,
            'og_image' => $service->og_image,
            'canonical_url' => $service->canonical_url ?: route('services.show', $service->slug),
            'robots' => $service->robots ?: 'index, follow',
            'schema_markup' => $service->schema_markup,
        ]);

        $serviceCategories = ServiceCategory::query()
            ->where('is_active', true)
            ->where(function ($q) {
                $q->where('show_in_nav', true)->orWhere('show_in_footer', true);
            })
            ->orderBy('sort_order')
            ->with(['services' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->get();

        $settings = SiteSetting::query()->pluck('value', 'key')->all();

        return view('services.show', compact('service', 'content', 'page', 'serviceCategories', 'settings'));
    }
}
