@php
    $badge = data_get($content, 'difference.badge', 'THE MARKET PRINCEPS DIFFERENCE');
    $heading = data_get($content, 'difference.heading', 'More visibility should lead to better opportunities.');
    $intro = data_get($content, 'difference.intro', 'Rankings and traffic are useful signals, but they do not tell the whole story. We build around search intent, relevance, and the journey that follows the click.');
    $negative = data_get($content, 'difference.negative', [
        'label' => 'TRAFFIC-FIRST SEO',
        'title' => 'More visits. Not necessarily more value.',
        'body' => 'A keyword list can increase traffic without bringing the people most likely to become customers.',
        'points' => ['Low-intent traffic', 'Keyword-first content', 'Disconnected conversion', 'Reporting without context'],
        'footer' => 'MORE ACTIVITY, UNCLEAR BUSINESS VALUE',
    ]);
    $positive = data_get($content, 'difference.positive', [
        'label' => 'THE MARKET PRINCEPS APPROACH',
        'title' => 'Search built around business intent.',
        'body' => 'We connect search strategy with what your customers are looking for, what your business offers, and what happens after they find you.',
        'points' => ['Intent-led targeting', 'Useful content', 'Conversion-aware journeys', 'Business-connected measurement'],
        'footer' => 'RELEVANT VISIBILITY, BETTER OPPORTUNITIES',
    ]);
    $ctaBadge = data_get($content, 'difference.cta.badge', 'READY TO TAKE THE NEXT STEP?');
    $ctaHeading = data_get($content, 'difference.cta.heading', 'Let\'s build SEO around what matters to your business.');
    $ctaBody = data_get($content, 'difference.cta.body', 'Tell us what you\'re trying to grow, improve or fix. We\'ll look at your current search presence and help you understand where the biggest opportunities are.');
@endphp
<section class="w-full px-6 md:px-margin py-16 md:py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto flex flex-col gap-10 md:gap-14">
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <div class="font-semibold text-xs tracking-wider text-amber-700 bg-amber-50/80 px-3 py-1 rounded-full border border-amber-200/50 inline-flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                <span class="font-label-caps uppercase tracking-widest font-bold">{{ $badge }}</span>
            </div>
            <h2 class="font-headline-lg text-3xl md:text-4xl text-slate-900 font-bold tracking-tight">{{ $heading }}</h2>
            <p class="font-body-md text-slate-600 text-sm md:text-base leading-relaxed">{{ $intro }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-stretch">
            <div class="p-6 md:p-8 rounded-2xl bg-surface-container-lowest border border-error/20 flex flex-col justify-between shadow-sm">
                <div class="space-y-6">
                    <div class="flex items-center justify-between pb-3.5 border-b border-surface-container">
                        <span class="font-label-caps text-xs uppercase font-bold text-error tracking-wider">{{ $negative['label'] ?? '' }}</span>
                        <div class="w-7 h-7 rounded-full bg-red-50 flex items-center justify-center text-error"><span class="material-symbols-outlined text-[18px]">close</span></div>
                    </div>
                    <div class="space-y-1.5">
                        <h3 class="font-title-md text-lg md:text-xl font-bold text-primary">{{ $negative['title'] ?? '' }}</h3>
                        <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">{{ $negative['body'] ?? '' }}</p>
                    </div>
                    <div class="space-y-3 pt-2">
                        @foreach ($negative['points'] ?? [] as $point)
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-surface-container-low text-on-surface text-sm">
                                <span class="w-5 h-5 rounded-full bg-red-100 text-error flex items-center justify-center text-xs shrink-0 font-bold">✕</span>
                                <span class="font-medium">{{ $point }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-8 pt-4 border-t border-surface-container flex items-center justify-between text-xs text-error font-semibold">
                    <span>{{ $negative['footer'] ?? '' }}</span>
                    <span class="material-symbols-outlined text-[16px]">trending_flat</span>
                </div>
            </div>
            <div class="p-6 md:p-8 rounded-2xl bg-primary-container text-on-primary border border-secondary-container/30 flex flex-col justify-between shadow-xl relative overflow-hidden">
                <div class="absolute -right-12 -top-12 w-48 h-48 rounded-full bg-secondary-container/10 pointer-events-none"></div>
                <div class="space-y-6 relative z-10">
                    <div class="flex items-center justify-between pb-3.5 border-b border-white/10">
                        <span class="font-label-caps text-xs uppercase font-bold text-secondary-container tracking-wider">{{ $positive['label'] ?? '' }}</span>
                        <div class="w-7 h-7 rounded-full bg-amber-500/20 flex items-center justify-center text-secondary-container"><span class="material-symbols-outlined text-[18px]">check</span></div>
                    </div>
                    <div class="space-y-1.5">
                        <h3 class="font-title-md text-lg md:text-xl font-bold text-on-primary">{{ $positive['title'] ?? '' }}</h3>
                        <p class="font-body-sm text-sm text-surface-container-highest/80 leading-relaxed">{{ $positive['body'] ?? '' }}</p>
                    </div>
                    <div class="space-y-3 pt-2">
                        @foreach ($positive['points'] ?? [] as $point)
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/10 text-on-primary text-sm">
                                <span class="w-5 h-5 rounded-full bg-secondary-container/20 text-secondary-container flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span class="font-medium">{{ $point }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between text-xs text-secondary-container font-semibold relative z-10">
                    <span>{{ $positive['footer'] ?? '' }}</span>
                    <span class="material-symbols-outlined text-[16px]">trending_up</span>
                </div>
            </div>
        </div>
        <div class="rounded-2xl bg-surface-container-lowest p-6 md:p-8 border border-outline-variant/30 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 text-center md:text-left">
                <div class="font-semibold text-xs tracking-wider text-amber-700 bg-amber-50/80 px-3 py-1 rounded-full border border-amber-200/50 inline-flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    <span class="font-label-caps uppercase tracking-widest font-bold">{{ $ctaBadge }}</span>
                </div>
                <h3 class="font-headline-sm text-lg md:text-xl font-bold text-slate-900">{{ $ctaHeading }}</h3>
                <p class="font-body-sm text-sm text-slate-600">{{ $ctaBody }}</p>
            </div>
            <div class="shrink-0 w-full md:w-auto">
                <a class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-lg bg-primary-container text-on-primary font-title-md text-sm font-semibold hover:bg-primary shadow-md hover:shadow-lg transition-all group" href="#intakeTerminal">
                    <span>{{ $primaryCta }}</span>
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform text-secondary-container">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</section>
