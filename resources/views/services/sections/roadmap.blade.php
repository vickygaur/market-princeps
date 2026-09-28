@php
    $badge = data_get($content, 'roadmap.badge', 'HOW WE DELIVER');
    $heading = data_get($content, 'roadmap.heading', 'A clear path from visibility to meaningful growth.');
    $intro = data_get($content, 'roadmap.intro', 'We move from understanding your current setup to building, improving, and measuring what creates lasting value.');
    $steps = data_get($content, 'roadmap.steps', [
        ['number' => '01', 'phase' => 'UNDERSTAND', 'title' => 'Start with the current picture.', 'body' => 'We review your website, visibility, competitors, and foundation to understand where the biggest opportunities are.', 'highlight' => false],
        ['number' => '02', 'phase' => 'PLAN', 'title' => 'Build the right strategy.', 'body' => 'We map priorities and practical next steps built around your business goals.', 'highlight' => false],
        ['number' => '03', 'phase' => 'EXECUTE', 'title' => 'Put the strategy into action.', 'body' => 'We improve foundations, content, and journeys that turn relevant visitors into opportunities.', 'highlight' => false],
        ['number' => '04', 'phase' => 'IMPROVE & MEASURE', 'title' => 'Keep improving what matters.', 'body' => 'We monitor performance, refine the strategy, and focus on areas that create meaningful business value.', 'highlight' => true],
    ]);
    $ctaHeading = data_get($content, 'roadmap.cta.heading', 'READY TO IMPROVE YOUR SEARCH VISIBILITY?');
    $ctaBody = data_get($content, 'roadmap.cta.body', 'We\'ll begin by understanding where things stand today, then identify what deserves attention first.');
@endphp
<section class="w-full px-6 md:px-margin py-16 md:py-24">
    <div class="max-w-7xl mx-auto flex flex-col gap-10 md:gap-14">
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <div class="font-semibold text-xs tracking-wider text-amber-700 bg-amber-50/80 px-3 py-1 rounded-full border border-amber-200/50 inline-flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                <span class="font-label-caps uppercase tracking-widest font-bold">{{ $badge }}</span>
            </div>
            <h2 class="font-headline-lg text-3xl md:text-4xl text-slate-900 font-bold tracking-tight">{{ $heading }}</h2>
            <p class="font-body-md text-slate-600 text-sm md:text-base leading-relaxed">{{ $intro }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">
            @foreach ($steps as $step)
                @php $highlight = ! empty($step['highlight']); @endphp
                <div class="p-6 rounded-2xl flex flex-col justify-between shadow-sm relative group transition-all {{ $highlight ? 'bg-primary-container text-on-primary shadow-md' : 'bg-surface-container-lowest border border-outline-variant/30 hover:border-secondary' }}">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between pb-2 border-b {{ $highlight ? 'border-white/10' : 'border-surface-container' }}">
                            <span class="font-mono text-2xl font-bold {{ $highlight ? 'text-secondary-container' : ($loop->iteration % 2 === 0 ? 'text-secondary' : 'text-secondary-container') }}">{{ $step['number'] ?? str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $highlight ? 'bg-white/10 text-secondary-container' : 'bg-surface-container text-secondary' }}">{{ $step['phase'] ?? '' }}</span>
                        </div>
                        <h3 class="font-title-md text-base md:text-lg font-bold {{ $highlight ? 'text-on-primary' : 'text-primary' }}">{{ $step['title'] ?? '' }}</h3>
                        <p class="font-body-sm text-sm leading-relaxed {{ $highlight ? 'text-surface-container-highest/80' : 'text-slate-600' }}">{{ $step['body'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="rounded-2xl bg-surface-container-low p-6 md:p-8 border border-outline-variant/30 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 text-center md:text-left">
                <h3 class="font-headline-sm text-lg md:text-xl font-bold text-slate-900">{{ $ctaHeading }}</h3>
                <p class="font-body-sm text-sm text-slate-600 max-w-2xl leading-relaxed">{{ $ctaBody }}</p>
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
