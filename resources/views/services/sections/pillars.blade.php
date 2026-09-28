@php
    $badge = data_get($content, 'pillars.badge', 'HOW WE BUILD SEO // OUR METHODOLOGY');
    $heading = data_get($content, 'pillars.heading', 'Four parts of SEO that work better together.');
    $intro = data_get($content, 'pillars.intro', 'Technical foundations, search intent, useful content, and trust work best when they are connected—not treated as separate projects.');
    $items = data_get($content, 'pillars.items', []);
    $hasPillars = count($items) > 0;
@endphp
<section class="w-full px-6 md:px-margin py-16 md:py-24" id="four-pillars">
    <div class="max-w-7xl mx-auto flex flex-col gap-10 md:gap-14">
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <div class="font-semibold text-xs tracking-wider text-amber-700 bg-amber-50/80 px-3 py-1 rounded-full border border-amber-200/50 inline-flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                <span class="font-label-caps uppercase tracking-widest font-bold">{{ $badge }}</span>
            </div>
            <h2 class="font-headline-lg text-3xl md:text-4xl text-slate-900 font-bold tracking-tight">{{ $heading }}</h2>
            <p class="font-body-md text-slate-600 text-sm md:text-base leading-relaxed">{{ $intro }}</p>
        </div>

        @if ($hasPillars)
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4" id="pillar-tab-nav">
                @foreach ($items as $index => $pillar)
                    @php
                        $targetId = $pillar['id'] ?? 'pillar-'.($index + 1);
                        $isActive = $index === 0;
                    @endphp
                    <button
                        class="pillar-btn p-4 md:p-5 rounded-2xl text-left transition-all duration-200 cursor-pointer border group {{ $isActive ? 'shadow-md border-primary-container bg-primary-container text-on-primary' : 'bg-surface-container-low hover:bg-surface-container text-on-surface border-outline-variant/30' }}"
                        data-target="{{ $targetId }}"
                        type="button"
                        @if ($isActive) aria-current="true" @endif
                    >
                        <div class="flex items-center justify-between mb-2">
                            <span class="pillar-badge text-[11px] font-mono uppercase font-bold tracking-wider {{ $isActive ? 'text-secondary-container' : 'text-secondary' }}">PILLAR {{ $pillar['number'] ?? str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform group-hover:scale-110 {{ $isActive ? 'text-secondary-container' : 'text-secondary' }}">{{ $pillar['icon'] ?? 'layers' }}</span>
                        </div>
                        <div class="font-title-md text-sm md:text-base font-bold">{{ $pillar['tab_title'] ?? $pillar['title'] ?? 'Pillar' }}</div>
                    </button>
                @endforeach
            </div>
            <div class="rounded-2xl bg-surface-container-lowest p-6 md:p-10 shadow-sm border border-outline-variant/30 min-h-[360px]" id="pillar-display-card">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-surface-container">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-secondary"></span>
                        <span class="font-label-caps text-xs uppercase font-bold tracking-wider text-secondary">METHODOLOGY BLUEPRINT</span>
                    </div>
                </div>
                @foreach ($items as $index => $pillar)
                    @php $targetId = $pillar['id'] ?? 'pillar-'.($index + 1); @endphp
                    <div class="pillar-panel flex-col gap-8 {{ $index === 0 ? 'flex' : 'hidden' }}" id="{{ $targetId }}">
                        <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-surface-container">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-secondary-container/20 text-secondary font-label-caps text-xs font-bold uppercase">
                                <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                <span>{{ $pillar['chip'] ?? $pillar['tab_title'] ?? '' }}</span>
                            </div>
                            @if (! empty($pillar['tag']))
                                <span class="font-label-caps text-xs uppercase tracking-wider text-outline font-semibold">{{ $pillar['tag'] }}</span>
                            @endif
                        </div>
                        <div class="space-y-3">
                            <h3 class="font-headline-md text-2xl md:text-3xl font-bold text-slate-900 tracking-tight">{{ $pillar['title'] ?? '' }}</h3>
                            <p class="font-body-md text-slate-600 leading-relaxed text-base md:text-lg max-w-3xl">{{ $pillar['body'] ?? '' }}</p>
                        </div>
                        @if (! empty($pillar['features']))
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                @foreach ($pillar['features'] as $feature)
                                    <div class="p-4 rounded-xl bg-surface-container-low/70 border border-outline-variant/30 flex items-start gap-3 transition-all hover:bg-surface-container-lowest hover:border-secondary/50 hover:shadow-sm">
                                        <div class="w-6 h-6 rounded-md bg-secondary-container/20 text-secondary flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">✓</div>
                                        <div class="space-y-1">
                                            <div class="font-title-md text-sm font-bold text-slate-900">{{ $feature['title'] ?? '' }}</div>
                                            <p class="font-body-sm text-xs text-slate-600 leading-relaxed">{{ $feature['description'] ?? $feature['body'] ?? '' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="pt-4 border-t border-surface-container flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            @if (! empty($pillar['target']))
                                <div class="flex items-center gap-2 text-xs text-slate-600 font-medium">
                                    <span class="material-symbols-outlined text-[18px] text-secondary">{{ $pillar['target_icon'] ?? 'flag' }}</span>
                                    <span>{{ $pillar['target'] }}</span>
                                </div>
                            @endif
                            <a class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-secondary hover:text-primary transition-colors group" href="#intakeTerminal">
                                <span>{{ $pillar['explore_label'] ?? 'EXPLORE THIS PILLAR' }}</span>
                                <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform text-secondary-container">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-2xl bg-surface-container-lowest p-8 md:p-12 shadow-sm border border-outline-variant/30 text-center">
                <p class="font-body-md text-slate-600 max-w-xl mx-auto">Our methodology connects technical health, search intent, content, and conversion. {{ $primaryCta ? 'Start a conversation to see how it applies to '.$service->name.'.' : '' }}</p>
                <a class="mt-6 inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-lg bg-primary-container text-on-primary font-title-md text-sm font-semibold hover:bg-primary shadow-md transition-all group" href="#intakeTerminal">
                    <span>{{ $primaryCta }}</span>
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform text-secondary-container">arrow_forward</span>
                </a>
            </div>
        @endif
    </div>
</section>
