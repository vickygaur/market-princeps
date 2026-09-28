<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $page = Page::query()
            ->where('slug', 'contact')
            ->where('is_published', true)
            ->with(['sections' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->first();

        if (! $page) {
            $page = new Page([
                'title' => 'Contact',
                'slug' => 'contact',
                'meta_title' => 'Contact Market Princeps | Strategic Consultation',
                'meta_description' => "Tell us what you're trying to improve. We'll start by understanding your business before recommending a solution.",
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

        return view('contact', compact('page', 'sections', 'serviceCategories', 'settings'));
    }
}
