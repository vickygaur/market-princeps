@php
    $s = $sections['hero'] ?? [];
    $titleHtml = data_get($s, 'title_html', '<span class="inline">Built to put </span><span class="gold-gradient-shimmer font-semibold inline">your business first.</span>');
    $paragraphs = data_get($s, 'paragraphs', [
        'Market Princeps comes from the Latin <em><b>Princeps</b></em>, meaning "first" or "leading." For us, it represents a simple belief: good solutions start with understanding the business behind the problem.',
        'We bring marketing, technology and business optimization together to help businesses attract the right customers, work more efficiently and build for what comes next.',
    ]);
    $ctaPrimaryLabel = data_get($s, 'cta_primary_label', 'OUR APPROACH');
    $ctaPrimaryUrl = data_get($s, 'cta_primary_url', '#triad');
    $ctaSecondaryLabel = data_get($s, 'cta_secondary_label', 'SPEAK WITH OUR TEAM');
    $ctaSecondaryUrl = data_get($s, 'cta_secondary_url', '#cta-section');
    $shapedLabel = data_get($s, 'shaped_label', 'WHAT SHAPED MARKET PRINCEPS');
    $shapedText = data_get($s, 'shaped_text', 'Experience across businesses, industries and disciplines has shaped the way we work today.');
    $stats = data_get($s, 'stats', [
        [
            'icon' => 'menu_book',
            'value' => 'Since 2020',
            'title' => 'Built through experience',
            'description' => 'Working with businesses since 2020 has taught us that every business needs its own solution.',
            'value_class' => 'text-on-surface',
            'icon_wrapper_class' => 'bg-primary-container text-secondary-container',
        ],
        [
            'icon' => 'domain',
            'value' => '15+ Sectors',
            'title' => 'Broad industry experience',
            'description' => 'From schools and real estate to e-commerce, retail, restaurants, green energy and more.',
            'value_class' => 'text-secondary',
            'icon_wrapper_class' => 'bg-surface-container text-secondary',
        ],
        [
            'icon' => 'hub',
            'value' => '360° view',
            'title' => 'We look beyond marketing',
            'description' => 'We look at marketing, technology, sales and operations to understand what drives growth.',
            'value_class' => 'text-on-surface',
            'icon_wrapper_class' => 'bg-primary-container text-on-primary',
        ],
        [
            'icon' => 'language',
            'value' => 'One Approach',
            'title' => 'Built around your business',
            'description' => "We don't force businesses into ready-made packages. We build what their business actually needs.",
            'value_class' => 'text-on-surface',
            'icon_wrapper_class' => 'bg-surface-container text-on-tertiary-container',
        ],
    ]);
    $delayClasses = ['delay-100', 'delay-200', 'delay-300', 'delay-400'];
@endphp
<section class="relative w-full px-6 md:px-margin pt-16 md:pt-20 pb-16 overflow-hidden bg-gradient-to-b from-surface via-surface-container-lowest/40 to-surface hero-ambient-grid">
    <div class="absolute -top-32 right-10 w-[620px] h-[620px] rounded-full bg-gradient-to-br from-secondary/15 via-secondary-container/12 to-transparent blur-3xl pointer-events-none animate-pulse-glow"></div>
    <div class="absolute top-1/3 -left-28 w-[520px] h-[520px] rounded-full bg-gradient-to-tr from-secondary-fixed/30 via-primary-container/6 to-transparent blur-3xl pointer-events-none animate-pulse-glow"></div>
    <canvas class="absolute inset-0 pointer-events-none opacity-40 z-0" id="hero-particle-canvas" width="1280" height="871"></canvas>
    <div class="relative max-w-7xl mx-auto flex flex-col items-center text-center z-10">
        <h1 class="font-headline-lg font-medium text-headline-lg md:text-[48px] lg:text-display-hero text-[#2A3042] max-w-5xl tracking-tight leading-tight mb-6">
            {!! $titleHtml !!}
        </h1>
        <div class="max-w-3xl mx-auto mb-8 text-center space-y-3">
            @foreach ($paragraphs as $paragraph)
                <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">{!! $paragraph !!}</p>
            @endforeach
        </div>
        <div class="flex flex-wrap items-center justify-center gap-4 w-full mb-16">
            <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-space-xl py-4 rounded-xl bg-primary-container text-on-primary font-title-md text-title-md tracking-wider uppercase transition-all duration-200 transform hover:-translate-y-0.5 hover:opacity-90 shadow-md hover:shadow-lg" href="{{ $ctaPrimaryUrl }}">
                <span>{{ $ctaPrimaryLabel }}</span>
                <span class="material-symbols-outlined text-secondary-container text-lg">arrow_downward</span>
            </a>
            <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-space-xl py-4 rounded-xl bg-surface-container-lowest text-on-primary-fixed font-title-md text-title-md tracking-wider uppercase transition-all duration-200 shadow-sm hover:shadow-md hover:bg-surface-container-low border border-outline-variant/30" href="{{ $ctaSecondaryUrl }}">
                <span class="material-symbols-outlined text-secondary text-lg">north_east</span>
                <span>{{ $ctaSecondaryLabel }}</span>
            </a>
        </div>
        <div class="w-full max-w-2xl mx-auto text-center mb-8">
            <div class="inline-flex items-center gap-space-xs text-secondary font-label-caps text-label-caps uppercase tracking-widest font-semibold">
                <span class="w-2 h-0.5 bg-secondary"></span>
                <span>{{ $shapedLabel }}</span>
                <span class="w-2 h-0.5 bg-secondary"></span>
            </div>
            <p class="mt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">{{ $shapedText }}</p>
        </div>
        <div class="w-full max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-left items-stretch">
            @foreach ($stats as $index => $stat)
                <div class="p-6 rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between stat-interactive-card border border-outline-variant/30 reveal-init {{ $delayClasses[$index] ?? 'delay-100' }} cursor-default">
                    <div class="mb-space-md">
                        <div class="w-10 h-10 rounded-lg {{ data_get($stat, 'icon_wrapper_class', 'bg-primary-container text-secondary-container') }} flex items-center justify-center mb-space-md shadow-sm stat-icon-wrapper">
                            <span class="material-symbols-outlined text-[22px]">{{ data_get($stat, 'icon', 'star') }}</span>
                        </div>
                        <div class="font-headline-lg text-headline-lg font-bold {{ data_get($stat, 'value_class', 'text-on-surface') }} mb-1">{{ data_get($stat, 'value') }}</div>
                        <div class="font-headline-sm text-title-md text-on-surface font-semibold tracking-tight">{{ data_get($stat, 'title') }}</div>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">{{ data_get($stat, 'description') }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
