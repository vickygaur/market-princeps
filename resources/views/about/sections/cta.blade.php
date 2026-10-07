@php
    $s = $sections['cta'] ?? [];
    $badge = data_get($s, 'badge', "LET'S BUILD WHAT YOUR BUSINESS NEEDS");
    $titleHtml = data_get($s, 'title_html', 'Your business is <span class="gold-gradient-shimmer font-semibold inline">unique.</span><div class="">The <span class="gold-gradient-shimmer font-semibold inline">solution</span> should be too.</div>');
    $body = data_get($s, 'body', "Tell us what you're trying to improve, fix or grow. We'll start by understanding the business, then work out what the right solution looks like.");
    $ctaLabel = data_get($s, 'cta_label', "LET'S TALK ABOUT YOUR BUSINESS");
    $ctaUrl = data_get($s, 'cta_url', route('contact'));
    $trustItems = data_get($s, 'trust_items', [
        'BUSINESS-FIRST CONVERSATION',
        'NO ONE-SIZE-FITS-ALL SOLUTION',
        'START WITH THE PROBLEM',
    ]);
@endphp
<section class="w-full bg-surface-container-low py-space-xl px-margin-mobile md:px-margin" id="cta-section">
    <div class="max-w-6xl mx-auto">
        <div class="py-10 px-5 sm:py-16 sm:px-8 lg:p-20 rounded-2xl sm:rounded-3xl bg-primary-container text-on-primary shadow-2xl relative overflow-hidden flex flex-col items-center text-center border border-outline-variant/20 max-w-5xl mx-auto reveal-init">
            <div class="pointer-events-none absolute -top-24 -right-24 w-96 h-96 bg-secondary/20 rounded-full blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -left-24 w-96 h-96 bg-secondary-container/15 rounded-full blur-3xl"></div>
            <div class="relative z-10 max-w-3xl flex flex-col items-center">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-secondary-container/15 text-secondary-fixed font-label-caps text-label-caps uppercase shadow-sm mb-space-md border border-secondary-container/40">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary-container opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-secondary-container"></span>
                    </span>
                    <span class="tracking-wider font-semibold">{{ $badge }}</span>
                </div>
                <h2 class="font-display-hero text-headline-lg-mobile md:text-display-hero text-on-primary tracking-tight font-semibold mb-space-sm">{!! $titleHtml !!}</h2>
                <p class="mt-space-md font-body-lg text-body-lg text-on-primary-container leading-relaxed max-w-2xl">{{ $body }}</p>
                <div class="mt-space-xl flex flex-col sm:flex-row items-center gap-space-md w-full sm:w-auto">
                    <a class="w-full sm:w-auto inline-flex items-center justify-center gap-space-sm px-space-xl py-4 rounded-xl bg-secondary-container text-on-secondary-fixed font-title-md text-title-md uppercase tracking-wider font-bold transition-all hover:bg-secondary-fixed hover:shadow-xl hover:-translate-y-0.5 shadow-lg group" href="{{ $ctaUrl }}">
                        <span class="text-on-secondary-fixed font-bold tracking-wider">{{ $ctaLabel }}</span>
                        <span class="material-symbols-outlined text-[20px] text-on-secondary-fixed transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </a>
                </div>
                <div class="mt-space-lg flex flex-wrap items-center justify-center gap-space-lg font-label-caps text-label-caps text-secondary-fixed uppercase tracking-wider">
                    @foreach ($trustItems as $trustItem)
                        <div class="flex items-center gap-space-xs">
                            <span class="material-symbols-outlined text-[16px] text-secondary-container">check_circle</span>
                            <span>{{ $trustItem }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
