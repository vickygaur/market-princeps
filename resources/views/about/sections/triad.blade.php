@php
    $s = $sections['triad'] ?? [];
    $eyebrow = data_get($s, 'eyebrow', 'WHY THESE THREE WORK TOGETHER');
    $title = data_get($s, 'title', 'Growth rarely stops at one problem.');
    $subtitle = data_get($s, 'subtitle', 'A business may need better marketing to create opportunities, better technology to turn those opportunities into action, or better processes to handle growth efficiently. Often, the real opportunity sits between them.');
    $footerNote = data_get($s, 'footer_note', "The point isn't to use all three. It's to know which one your business actually needs.");
    $pillars = data_get($s, 'pillars', [
        [
            'icon' => 'ads_click',
            'title' => 'Create Opportunity',
            'badge' => 'Marketing & Demand',
            'description' => 'Reach the right people, communicate your value clearly and turn attention into business opportunities.',
            'points' => ['Reach the right audience', 'Make your value clear', 'Create qualified opportunities'],
            'cta_label' => 'CREATE DEMAND',
            'cta_url' => url('/#triad-content'),
        ],
        [
            'icon' => 'terminal',
            'title' => 'Move Opportunity Forward',
            'badge' => 'Custom Technology',
            'description' => 'Build the tools, platforms and systems your business needs to turn opportunities into results.',
            'points' => ['Build around your processes', 'Connect your systems', 'Make work easier to manage'],
            'cta_label' => 'BUILD WHAT YOU NEED',
            'cta_url' => url('/#triad-content'),
        ],
        [
            'icon' => 'cached',
            'title' => 'Make Growth Easier',
            'badge' => 'Business Optimization',
            'description' => 'Improve processes, remove unnecessary work and create systems that help your business handle growth.',
            'points' => ['Remove unnecessary friction', 'Automate repetitive work', 'Improve operational efficiency'],
            'cta_label' => 'IMPROVE HOW YOU WORK',
            'cta_url' => url('/#triad-content'),
        ],
    ]);
    $delayClasses = ['delay-100', 'delay-200', 'delay-300'];
@endphp
<section class="w-full bg-surface py-20 px-6 md:px-margin scroll-mt-20" id="triad">
    <div class="max-w-7xl mx-auto flex flex-col">
        <div class="flex flex-col items-center text-center max-w-3xl mx-auto mb-12 reveal-init">
            <div class="inline-flex items-center gap-space-xs text-secondary font-label-caps text-label-caps uppercase tracking-widest font-semibold mb-3">
                <span class="w-2 h-0.5 bg-secondary"></span>
                <span>{{ $eyebrow }}</span>
                <span class="w-2 h-0.5 bg-secondary"></span>
            </div>
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface font-semibold tracking-tight mb-4">{{ $title }}</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed max-w-2xl mx-auto">{{ $subtitle }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto items-stretch">
            @foreach ($pillars as $index => $pillar)
                <div class="flex flex-col justify-between h-full p-5 sm:p-8 rounded-2xl bg-surface-container-lowest border border-outline-variant/30 shadow-sm hover:shadow-md transition-all duration-300 reveal-init {{ $delayClasses[$index] ?? 'delay-100' }}">
                    <div class="flex flex-col flex-grow">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-secondary-container/15 text-secondary mb-6 flex-shrink-0">
                            <span class="material-symbols-outlined text-[24px]">{{ data_get($pillar, 'icon') }}</span>
                        </div>
                        <h3 class="md:min-h-[3rem] flex items-center text-xl font-bold text-on-surface leading-snug">{{ data_get($pillar, 'title') }}</h3>
                        <div class="my-4 inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold tracking-wide border border-outline-variant/30 bg-surface-container-low text-secondary self-start min-h-[26px]">{{ data_get($pillar, 'badge') }}</div>
                        <p class="text-sm leading-relaxed text-on-surface-variant mb-6 md:min-h-[4.5rem]">{{ data_get($pillar, 'description') }}</p>
                        <div class="space-y-3 py-6 border-t border-outline-variant/20 flex-grow">
                            @foreach (data_get($pillar, 'points', []) as $point)
                                <div class="flex items-center gap-2.5 text-xs text-on-surface font-medium">
                                    <svg class="w-4 h-4 text-secondary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>{{ $point }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-auto pt-4 border-t border-outline-variant/20">
                        <a class="text-xs font-bold tracking-wider text-secondary hover:text-primary uppercase flex items-center gap-1.5 transition-colors group" href="{{ data_get($pillar, 'cta_url', url('/#triad-content')) }}">
                            <span class="underline">{{ data_get($pillar, 'cta_label') }}</span>
                            <span class="material-symbols-outlined text-[16px] transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-10 text-center max-w-2xl mx-auto">
            <p class="font-body-lg text-body-lg text-on-surface-variant font-medium leading-relaxed">{{ $footerNote }}</p>
        </div>
    </div>
</section>
