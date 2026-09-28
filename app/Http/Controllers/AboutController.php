<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $page = Page::query()
            ->where('slug', 'about')
            ->where('is_published', true)
            ->with(['sections' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->first();

        if (! $page) {
            $page = new Page([
                'title' => 'About Us',
                'slug' => 'about',
                'meta_title' => 'About Market Princeps | Our Ideology & Approach',
                'meta_description' => 'Market Princeps comes from the Latin Princeps — first or leading. We put your business first by uniting marketing, technology and business optimization.',
                'robots' => 'index, follow',
            ]);
        }

        $sections = $page->relationLoaded('sections')
            ? $page->sections->keyBy('key')->map(fn ($section) => $section->content ?? [])->all()
            : [];

        $serviceCategories = ServiceCategory::query()
            ->where('is_active', true)
            ->where(function ($q) {
                $q->where('show_in_nav', true)->orWhere('show_in_footer', true);
            })
            ->orderBy('sort_order')
            ->with(['services' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->get();

        $settings = SiteSetting::query()->pluck('value', 'key')->all();

        return view('about', compact('page', 'sections', 'serviceCategories', 'settings'));
    }
}
