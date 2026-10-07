@php
    use App\Models\SiteSetting;

    $brandName = $settings['site_name'] ?? $settings['brand_name'] ?? SiteSetting::getValue('site_name', SiteSetting::getValue('brand_name', 'Market Princeps'));
    $brandTagline = $settings['site_tagline'] ?? $settings['brand_tagline'] ?? SiteSetting::getValue('site_tagline', SiteSetting::getValue('brand_tagline', 'Growth Architecture'));
    $siteLogo = media_url($settings['site_logo'] ?? SiteSetting::getValue('site_logo'));

    $navCategories = ($serviceCategories ?? collect())->filter(fn ($cat) => $cat->show_in_nav);

    $categoryDotClass = function ($category, int $index): string {
        if ($category->badge_color) {
            return 'w-2 h-2 rounded-full '.$category->badge_color;
        }

        return match ($index % 3) {
            0 => 'w-2 h-2 rounded-full bg-secondary-container beacon-pulse',
            1 => 'w-2 h-2 rounded-full bg-primary-container',
            default => 'w-2 h-2 rounded-full bg-on-tertiary-container',
        };
    };

    $categoryTitleClass = function ($category, int $index): string {
        $base = 'font-label-caps text-label-caps uppercase tracking-wider font-bold ';

        if ($category->badge_label && str_contains((string) $category->badge_label, 'text-')) {
            return $base.$category->badge_label;
        }

        return $base.match ($index % 3) {
            0 => 'text-secondary',
            1 => 'text-primary',
            default => 'text-on-tertiary-container',
        };
    };
@endphp
<header class="fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(22,27,51,0.06)]">
    <div class="h-20 w-full px-margin-mobile md:px-margin flex items-center justify-between gap-3 relative">
        <div class="flex items-center gap-space-md group min-w-0 flex-1 md:flex-none">
            <a class="flex items-center gap-space-md group min-w-0" href="{{ route('home') }}">
                @if ($siteLogo)
                    <img
                        src="{{ $siteLogo }}"
                        alt="{{ $brandName }}"
                        class="h-9 sm:h-10 md:h-12 w-auto max-w-[140px] sm:max-w-[180px] md:max-w-[200px] object-contain transition-transform group-hover:scale-105 shrink-0"
                    >
                @else
                    <div class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center shadow-[0_2px_8px_-2px_rgba(22,27,51,0.3)] transition-transform group-hover:scale-105">
                        <span class="material-symbols-outlined text-secondary-container text-[22px]">diamond</span>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="font-title-md text-title-md tracking-wider text-on-primary-fixed uppercase truncate">{{ $brandName }}</span>
                        <span class="font-label-caps text-label-caps uppercase text-secondary font-semibold truncate">{{ $brandTagline }}</span>
                    </div>
                @endif
            </a>
        </div>

        <nav class="hidden md:flex items-center justify-center gap-space-lg">
            <a class="font-label-md text-label-md tracking-wide text-on-surface-variant hover:text-on-surface transition-colors py-space-xs {{ request()->routeIs('about') ? 'text-secondary font-semibold' : '' }}" href="{{ route('about') }}">About</a>

            {{-- Mega menu: JS open state + delayed close so cursor can reach service links --}}
            <div class="relative" id="services-mega-menu">
                <button
                    id="services-mega-trigger"
                    class="flex items-center gap-1 font-label-md text-label-md tracking-wide text-on-surface-variant hover:text-on-surface transition-colors py-space-xs focus:outline-none {{ request()->routeIs('services.*') ? 'text-secondary font-semibold' : '' }}"
                    type="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                    aria-controls="services-mega-panel"
                >
                    <span>Services</span>
                    <span class="material-symbols-outlined text-[18px] transition-transform duration-200" id="services-mega-chevron">expand_more</span>
                </button>
                <div
                    id="services-mega-panel"
                    class="absolute left-1/2 -translate-x-1/2 top-full pt-4 w-[850px] max-w-[90vw] z-[60] opacity-0 invisible pointer-events-none transition-opacity duration-150"
                    role="menu"
                >
                    <div class="bg-surface-container-lowest rounded-2xl border border-surface-dim shadow-xl p-space-lg text-left">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
                            @forelse ($navCategories as $index => $category)
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2 pb-space-xs mb-space-sm border-b border-outline-variant/30">
                                        <span class="{{ $categoryDotClass($category, $index) }}"></span>
                                        <span class="{{ $categoryTitleClass($category, $index) }}">{{ $category->name }}</span>
                                    </div>
                                    <ul class="flex flex-col space-y-1">
                                        @foreach ($category->services->where('is_active', true)->where('show_in_nav', true) as $service)
                                            <li>
                                                <a class="block px-space-sm py-1.5 rounded-lg font-body-sm text-body-sm text-on-surface hover:text-secondary hover:bg-surface-container-low transition-colors font-medium" href="{{ $service->link() }}">{{ $service->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @empty
                                <div class="md:col-span-3 font-body-sm text-body-sm text-on-surface-variant">Services coming soon.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <a class="font-label-md text-label-md tracking-wide text-on-surface-variant hover:text-on-surface transition-colors py-space-xs {{ request()->routeIs('contact') ? 'text-secondary font-semibold' : '' }}" href="{{ route('contact') }}">Contact</a>
        </nav>

        <div class="flex shrink-0 justify-end items-center gap-space-sm">
            <button
                type="button"
                id="mobile-menu-toggle"
                class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg bg-surface-container text-on-surface hover:bg-surface-container-low transition-colors"
                aria-expanded="false"
                aria-controls="mobile-nav-panel"
                aria-label="Open menu"
            >
                <span class="material-symbols-outlined" id="mobile-menu-icon">menu</span>
            </button>
        </div>
    </div>

    <div id="mobile-nav-panel" class="hidden md:hidden border-t border-outline-variant/30 bg-surface/95 backdrop-blur-xl shadow-lg">
        <nav class="px-margin-mobile py-space-md flex flex-col gap-space-sm">
            <a class="font-label-md text-label-md py-space-sm text-on-surface-variant hover:text-on-surface" href="{{ route('about') }}" data-mobile-nav-link>About</a>
            <details class="group/mobile-services">
                <summary class="font-label-md text-label-md py-space-sm text-on-surface-variant hover:text-on-surface cursor-pointer list-none flex items-center justify-between">
                    <span>Services</span>
                    <span class="material-symbols-outlined text-[18px] transition-transform group-open/mobile-services:rotate-180">expand_more</span>
                </summary>
                <div class="pl-space-sm pb-space-sm flex flex-col gap-space-md mt-space-xs">
                    @foreach ($navCategories as $index => $category)
                        <div>
                            <div class="flex items-center gap-2 mb-space-xs">
                                <span class="{{ $categoryDotClass($category, $index) }}"></span>
                                <span class="{{ $categoryTitleClass($category, $index) }} text-[10px]">{{ $category->name }}</span>
                            </div>
                            <ul class="flex flex-col gap-1 pl-space-md">
                                @foreach ($category->services->where('is_active', true)->where('show_in_nav', true) as $service)
                                    <li>
                                        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-secondary" href="{{ $service->link() }}" data-mobile-nav-link>{{ $service->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </details>
            <a class="font-label-md text-label-md py-space-sm text-on-surface-variant hover:text-on-surface" href="{{ route('contact') }}" data-mobile-nav-link>Contact</a>
        </nav>
    </div>
</header>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Mobile menu ---
    const toggle = document.getElementById('mobile-menu-toggle');
    const panel = document.getElementById('mobile-nav-panel');
    const icon = document.getElementById('mobile-menu-icon');
    if (toggle && panel) {
        toggle.addEventListener('click', function () {
            const isOpen = !panel.classList.contains('hidden');
            panel.classList.toggle('hidden', isOpen);
            toggle.setAttribute('aria-expanded', String(!isOpen));
            toggle.setAttribute('aria-label', isOpen ? 'Open menu' : 'Close menu');
            if (icon) icon.textContent = isOpen ? 'menu' : 'close';
        });
        panel.querySelectorAll('[data-mobile-nav-link]').forEach(function (link) {
            link.addEventListener('click', function () {
                panel.classList.add('hidden');
                toggle.setAttribute('aria-expanded', 'false');
                if (icon) icon.textContent = 'menu';
            });
        });
    }

    // --- Desktop services mega menu: open immediately, close after delay ---
    const megaRoot = document.getElementById('services-mega-menu');
    const megaTrigger = document.getElementById('services-mega-trigger');
    const megaPanel = document.getElementById('services-mega-panel');
    const megaChevron = document.getElementById('services-mega-chevron');
    if (!megaRoot || !megaTrigger || !megaPanel) return;

    let closeTimer = null;
    const OPEN = ['opacity-100', 'visible', 'pointer-events-auto'];
    const CLOSED = ['opacity-0', 'invisible', 'pointer-events-none'];

    function openMega() {
        if (closeTimer) {
            clearTimeout(closeTimer);
            closeTimer = null;
        }
        CLOSED.forEach((c) => megaPanel.classList.remove(c));
        OPEN.forEach((c) => megaPanel.classList.add(c));
        megaTrigger.setAttribute('aria-expanded', 'true');
        megaTrigger.classList.add('text-on-surface');
        if (megaChevron) megaChevron.classList.add('rotate-180');
    }

    function scheduleCloseMega() {
        if (closeTimer) clearTimeout(closeTimer);
        closeTimer = setTimeout(function () {
            OPEN.forEach((c) => megaPanel.classList.remove(c));
            CLOSED.forEach((c) => megaPanel.classList.add(c));
            megaTrigger.setAttribute('aria-expanded', 'false');
            megaTrigger.classList.remove('text-on-surface');
            if (megaChevron) megaChevron.classList.remove('rotate-180');
            closeTimer = null;
        }, 280);
    }

    megaRoot.addEventListener('mouseenter', openMega);
    megaRoot.addEventListener('mouseleave', scheduleCloseMega);
    megaPanel.addEventListener('mouseenter', openMega);
    megaTrigger.addEventListener('focus', openMega);
    megaRoot.addEventListener('focusin', openMega);
    megaRoot.addEventListener('focusout', function (e) {
        if (!megaRoot.contains(e.relatedTarget)) scheduleCloseMega();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            if (closeTimer) clearTimeout(closeTimer);
            OPEN.forEach((c) => megaPanel.classList.remove(c));
            CLOSED.forEach((c) => megaPanel.classList.add(c));
            megaTrigger.setAttribute('aria-expanded', 'false');
            if (megaChevron) megaChevron.classList.remove('rotate-180');
        }
    });
});
</script>
