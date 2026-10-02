@php
    use App\Models\SiteSetting;

    $brandName = $settings['site_name'] ?? $settings['brand_name'] ?? SiteSetting::getValue('site_name', SiteSetting::getValue('brand_name', 'Market Princeps'));
    $siteLogo = media_url($settings['site_logo'] ?? SiteSetting::getValue('site_logo'));
    $footerBlurb = $settings['site_description'] ?? $settings['footer_description'] ?? SiteSetting::getValue('site_description', SiteSetting::getValue('footer_description', 'We help businesses attract the right customers, build the technology they need, and improve the way their business works.'));
    $footerBadge = $settings['footer_badge'] ?? SiteSetting::getValue('footer_badge', 'BUILT AROUND YOUR BUSINESS');
    $contactEmail = $settings['contact_email'] ?? SiteSetting::getValue('contact_email', 'connect@marketprinceps.com');
    $contactPhone = $settings['contact_phone'] ?? SiteSetting::getValue('contact_phone', '+91-9625330200');
    $footerCategories = ($serviceCategories ?? collect())->filter(fn ($cat) => $cat->show_in_footer);
@endphp
<footer class="w-full bg-surface-container-low shadow-[0_-1px_12px_rgba(22,27,51,0.03)]">
    <div class="w-full px-margin-mobile md:px-margin py-space-xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-space-xl mb-space-xl">
            <div class="flex flex-col gap-space-md">
                <div class="flex items-center gap-space-sm">
                    @if ($siteLogo)
                        <img src="{{ $siteLogo }}" alt="{{ $brandName }}" class="h-9 w-auto max-w-[180px] object-contain shrink-0">
                    @else
                        <div class="w-8 h-8 rounded-lg bg-primary-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary-container text-[18px]">diamond</span>
                        </div>
                        <span class="font-title-md text-title-md uppercase tracking-wider text-on-primary-fixed">{{ $brandName }}</span>
                    @endif
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant max-w-xs">{{ $footerBlurb }}</p>
                <div class="inline-flex items-center gap-space-sm py-space-xs px-space-sm rounded-lg bg-surface-container w-fit">
                    <span class="w-2 h-2 rounded-full bg-secondary-container beacon-pulse"></span>
                    <span class="font-label-caps text-label-caps text-on-surface uppercase font-semibold">{{ $footerBadge }}</span>
                </div>
            </div>

            @foreach ($footerCategories as $category)
                <div class="flex flex-col gap-space-md">
                    <span class="font-label-caps text-label-caps uppercase text-secondary font-semibold">{{ $category->name }}</span>
                    <nav class="flex flex-col gap-space-sm">
                        @foreach ($category->services->where('is_active', true)->where('show_in_footer', true) as $service)
                            <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-on-surface transition-colors" href="{{ $service->link() }}">{{ $service->name }}</a>
                        @endforeach
                    </nav>
                </div>
            @endforeach

            <div class="flex flex-col gap-space-md">
                <span class="font-label-caps text-label-caps uppercase text-secondary font-semibold tracking-wider">Connect With Us</span>
                <div class="flex flex-col gap-space-sm">
                    @if ($contactEmail)
                        <a class="flex items-center gap-2 font-body-sm text-body-sm text-on-surface-variant hover:text-secondary transition-colors" href="mailto:{{ $contactEmail }}">
                            <span class="material-symbols-outlined text-[18px] text-secondary">mail</span>
                            <span>{{ $contactEmail }}</span>
                        </a>
                    @endif
                    @if ($contactPhone)
                        <a class="flex items-center gap-2 font-body-sm text-body-sm text-on-surface-variant hover:text-secondary transition-colors" href="tel:{{ preg_replace('/\s+/', '', $contactPhone) }}">
                            <span class="material-symbols-outlined text-[18px] text-secondary">call</span>
                            <span>{{ $contactPhone }}</span>
                        </a>
                    @endif
                </div>
                <div class="pt-space-xs border-t border-outline-variant/20 flex flex-col gap-space-xs">
                    <span class="font-label-caps text-label-caps uppercase text-on-surface font-semibold tracking-wider">Stay Informed</span>
                    <form id="newsletter-form" class="flex items-center gap-1.5 mt-1" action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <input class="w-full px-space-sm py-2 rounded-lg bg-surface-container-lowest border border-outline-variant/30 text-on-surface font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-secondary" name="email" placeholder="Enter your email" required type="email">
                        <button class="px-3 py-2 rounded-lg bg-primary-container text-on-primary hover:bg-secondary transition-colors flex items-center justify-center flex-shrink-0 shadow-sm" title="Subscribe" type="submit">
                            <span class="material-symbols-outlined text-[18px] text-secondary-container">arrow_forward</span>
                        </button>
                    </form>
                    <div class="hidden font-body-sm text-body-sm text-secondary font-medium" id="newsletter-feedback"></div>
                </div>
            </div>
        </div>
        <div class="pt-space-lg flex flex-col md:flex-row items-center justify-between gap-space-md">
            <p class="font-body-sm text-body-sm text-on-surface-variant">© {{ date('Y') }} {{ $brandName }} Pvt. Ltd. All rights reserved.</p>
            <div class="flex flex-wrap items-center gap-space-md font-body-sm text-body-sm text-on-surface-variant">
                <a class="hover:text-secondary transition-colors" href="#">Privacy Policy</a>
                <span class="opacity-70">·</span>
                <a class="hover:text-secondary transition-colors" href="#">Terms of Service</a>
            </div>
            <div class="flex items-center gap-space-lg">
                <a class="font-label-caps text-label-caps uppercase text-secondary hover:text-secondary-container transition-colors font-semibold" href="{{ route('contact') }}">LET'S TALK ABOUT YOUR BUSINESS</a>
            </div>
        </div>
    </div>
</footer>
