@php
    $categoryName = $service->category?->name ?? 'Services';
    $badge = data_get($content, 'hero.badge', strtoupper($categoryName).' // '.$service->name);
    $titleBefore = data_get($content, 'hero.title_before', $service->name);
    $titleHighlight = data_get($content, 'hero.title_highlight');
    $titleAfter = data_get($content, 'hero.title_after', '');
    $body = data_get($content, 'hero.body', $service->short_description ?: 'We help businesses build visibility around what their customers actually need.');
    $trustLine = data_get($content, 'hero.trust_line', 'TECHNICAL SEO · CONTENT · SEARCH INTENT · CONVERSION');
    $radarTitle = data_get($content, 'hero.radar.title', 'WHAT ARE THEY LOOKING FOR?');
    $radarFooter = data_get($content, 'hero.radar.footer', 'SEARCH → RELEVANCE → TRUST → ACTION');
    $radarItems = data_get($content, 'hero.radar.items', [
        ['icon' => 'target', 'label' => 'Informational', 'hint' => 'Learning / researching'],
        ['icon' => 'hub', 'label' => 'Commercial', 'hint' => 'Comparing / evaluating'],
        ['icon' => 'trending_down', 'label' => 'Transactional', 'hint' => 'Ready to act'],
    ]);
    $primaryCtaUrl = filled(data_get($content, 'hero.primary_cta_url'))
        ? data_get($content, 'hero.primary_cta_url')
        : '#intakeTerminal';
    $secondaryCtaUrl = filled(data_get($content, 'hero.secondary_cta_url'))
        ? data_get($content, 'hero.secondary_cta_url')
        : '#four-pillars';
@endphp
<section class="w-full px-6 md:px-margin py-16 md:py-24 relative overflow-hidden bg-background">
    <div class="absolute -top-32 right-10 w-96 h-96 rounded-full bg-secondary-container/10 blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute bottom-0 -left-20 w-80 h-80 rounded-full bg-primary-container/5 blur-3xl pointer-events-none -z-10"></div>
    <div class="max-w-7xl mx-auto flex flex-col gap-8 md:gap-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-12 items-center">
            <div class="lg:col-span-7 flex flex-col gap-6">
                <div class="w-fit inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold tracking-wider uppercase bg-amber-500/10 text-amber-800 border border-amber-500/20">
                    <span class="w-2 h-2 rounded-full bg-secondary animate-ping"></span>
                    <span class="font-label-caps uppercase font-bold tracking-widest">{{ $badge }}</span>
                </div>
                <h1 class="font-display-hero text-display-hero-mobile md:text-display-hero text-slate-900 tracking-tight leading-tight md:leading-[1.15] font-bold">
                    {{ $titleBefore }}@if ($titleHighlight)<span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 via-orange-500 to-amber-600 text-glow-shimmer font-bold">{{ $titleHighlight }}</span>@endif{{ $titleAfter }}
                </h1>
                <p class="font-body-md text-slate-600 text-base md:text-lg max-w-xl leading-relaxed">{{ $body }}</p>
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-primary-container text-on-primary font-title-md text-sm font-semibold tracking-wider uppercase hover:bg-primary shadow-sm hover:shadow transition-all duration-200 group" href="{{ $primaryCtaUrl }}">
                        <span>{{ $primaryCta }}</span>
                        <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform text-secondary-container">arrow_forward</span>
                    </a>
                    <a class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-surface-container-lowest text-on-surface font-title-md text-sm font-semibold tracking-wider uppercase hover:bg-surface-container transition-all duration-200 shadow-sm border border-outline-variant/30" href="{{ $secondaryCtaUrl }}">
                        <span>{{ $secondaryCta }}</span>
                        <span class="material-symbols-outlined text-[18px] text-secondary">south</span>
                    </a>
                </div>
                @if ($trustLine)
                    <div class="flex items-center gap-3 pt-2 text-slate-500 text-xs md:text-sm font-medium tracking-wide">
                        <div class="w-7 h-7 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary shrink-0">
                            <span class="material-symbols-outlined text-[16px]">verified</span>
                        </div>
                        <span class="font-body-sm text-xs md:text-sm font-medium text-slate-500">{{ $trustLine }}</span>
                    </div>
                @endif
            </div>
            <div class="lg:col-span-5">
                <div class="rounded-2xl bg-primary-container text-on-primary p-6 md:p-8 shadow-xl relative overflow-hidden border border-white/10">
                    <div class="flex items-center justify-between border-b border-white/10 pb-4 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-secondary-container animate-pulse"></span>
                            <span class="font-label-caps text-xs uppercase tracking-wider text-secondary-container font-bold">{{ $radarTitle }}</span>
                        </div>
                    </div>
                    <div class="space-y-3 pt-1">
                        @foreach ($radarItems as $item)
                            <div class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 border border-white/10">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-secondary-container text-[22px]">{{ $item['icon'] ?? 'circle' }}</span>
                                    <div class="text-sm font-bold text-on-primary">{{ $item['label'] ?? '' }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[11px] text-surface-container-highest/70">{{ $item['hint'] ?? '' }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($radarFooter)
                        <div class="mt-5 pt-3 border-t border-white/10 flex items-center justify-between text-xs text-surface-container-highest/70">
                            <span class="text-secondary-container font-semibold tracking-wider">{{ $radarFooter }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
