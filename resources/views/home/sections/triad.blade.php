@php
    $s = $sections['triad'] ?? [];
    $eyebrow = data_get($s, 'eyebrow', 'OUR CAPABILITIES');
    $heading = data_get($s, 'heading', 'Three ways we help your business grow');
    $intro = data_get($s, 'intro', 'Marketing brings the right opportunities. Technology helps you convert them. Better systems help you scale them.');
    $tab1 = data_get($s, 'tab1_label', 'MARKETING & DEMAND');
    $tab2 = data_get($s, 'tab2_label', 'CUSTOM TECHNOLOGY');
    $tab3 = data_get($s, 'tab3_label', 'BUSINESS OPTIMIZATION');
    $badge = data_get($s, 'default_badge', 'PILLAR 01 // PRECISION ACQUISITION MESH');
    $title = data_get($s, 'default_title', 'Attracting high-value institutional buyers while systematically eliminating unqualified noise.');
    $desc = data_get($s, 'default_desc', 'We construct custom intent-scoring scrapers, private executive briefings, and automated gating mechanisms. Leads are not dumped into a chaotic mailbox; they are algorithmic dossiers delivered directly to your senior decision-makers ready to close.');
    $m1 = data_get($s, 'default_metric_1', '92.4% Institutional');
    $m2 = data_get($s, 'default_metric_2', '-41.8% Net Spend');
    $telemetry = data_get($s, 'default_telemetry', 'Telemetry 28.4% Conv');
    $flowLabel = data_get($s, 'flow_label', 'marketing flow');
    $ctaLabel = data_get($s, 'cta_label', 'EXPLORE MARKETING');
    $stages = data_get($s, 'default_stages', [
        ['n' => '1', 'name' => 'Category Authority Gateway', 'val' => '8,400 Imp'],
        ['n' => '2', 'name' => 'Diagnostic Intake & Dossier', 'val' => '412 Submits'],
        ['n' => '3', 'name' => 'Sovereign Partner Briefing', 'val' => '64 Closed'],
    ]);
@endphp
<section class="w-full bg-surface-container-low px-margin-mobile md:px-margin py-space-xl">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col items-center text-center mb-space-xl">
            <span class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-semibold mb-space-xs">{{ $eyebrow }}</span>
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface max-w-2xl font-semibold">{{ $heading }}</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mt-space-sm">{{ $intro }}</p>
            <div class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center justify-center gap-1.5 sm:gap-space-sm mt-space-lg bg-surface-container p-1.5 rounded-xl shadow-inner w-full max-w-3xl" id="triad-tabs">
                <button class="w-full sm:w-auto px-space-md sm:px-space-lg py-2.5 rounded-lg text-xs sm:text-label-md font-label-md font-semibold transition-all bg-primary-container text-on-primary shadow-sm flex items-center justify-center gap-space-sm card-hover-elevate" id="btn-p1" onclick="switchTriad('p1')" type="button">
                    <span class="material-symbols-outlined text-secondary-container text-[18px] shrink-0">ads_click</span>
                    <span class="text-center leading-snug">{{ $tab1 }}</span>
                </button>
                <button class="w-full sm:w-auto px-space-md sm:px-space-lg py-2.5 rounded-lg text-xs sm:text-label-md font-label-md font-semibold transition-all text-on-surface-variant hover:text-on-surface flex items-center justify-center gap-space-sm card-hover-elevate" id="btn-p2" onclick="switchTriad('p2')" type="button">
                    <span class="material-symbols-outlined text-[18px] shrink-0">terminal</span>
                    <span class="text-center leading-snug">{{ $tab2 }}</span>
                </button>
                <button class="w-full sm:w-auto px-space-md sm:px-space-lg py-2.5 rounded-lg text-xs sm:text-label-md font-label-md font-semibold transition-all text-on-surface-variant hover:text-on-surface flex items-center justify-center gap-space-sm card-hover-elevate" id="btn-p3" onclick="switchTriad('p3')" type="button">
                    <span class="material-symbols-outlined text-[18px] shrink-0">cached</span>
                    <span class="text-center leading-snug">{{ $tab3 }}</span>
                </button>
            </div>
        </div>
        <div class="rounded-2xl bg-surface-container-lowest p-space-lg md:p-space-xl shadow-lg border border-outline-variant/30">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-center" id="triad-content">
                <div class="lg:col-span-7 flex flex-col gap-space-md" id="triad-text-panel">
                    <div class="inline-flex items-center gap-space-xs px-space-sm py-1 rounded bg-surface-container w-fit">
                        <span class="w-2 h-2 rounded-full bg-secondary-container beacon-pulse"></span>
                        <span class="font-label-caps text-label-caps uppercase text-secondary font-bold" id="triad-badge">{{ $badge }}</span>
                    </div>
                    <h3 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface font-semibold leading-snug" id="triad-title">{{ $title }}</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed" id="triad-desc">{{ $desc }}</p>
                    <div class="grid grid-cols-2 gap-space-md pt-space-sm" id="triad-specs">
                        <div class="p-space-md rounded-xl bg-surface-container-low card-hover-elevate">
                            <span class="font-label-caps text-label-caps uppercase text-on-surface-variant block mb-1">focus</span>
                            <span class="font-headline-sm text-headline-sm text-on-surface font-bold" id="triad-metric-1">{{ $m1 }}</span>
                        </div>
                        <div class="p-space-md rounded-xl bg-surface-container-low card-hover-elevate">
                            <span class="font-label-caps text-label-caps uppercase text-on-surface-variant block mb-1">goal</span>
                            <span class="font-headline-sm text-headline-sm text-secondary font-bold" id="triad-metric-2">{{ $m2 }}</span>
                        </div>
                    </div>
                    <div class="pt-space-xs">
                        <a class="inline-flex items-center gap-space-sm px-space-lg py-3 rounded-xl bg-primary-container text-on-primary font-title-md text-body-md uppercase tracking-wider font-semibold transition-all hover:bg-secondary card-hover-elevate shadow-md" href="#intake" id="triad-cta">
                            <span>{{ $ctaLabel }}</span>
                            <span class="material-symbols-outlined text-secondary-container text-lg">arrow_forward</span>
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-5 rounded-xl bg-primary-container p-space-lg text-on-primary shadow-inner" id="triad-visual-panel">
                    <div class="flex flex-wrap items-center justify-between gap-2 pb-space-sm mb-space-md">
                        <span class="font-label-caps text-label-caps uppercase text-secondary-container font-semibold" id="triad-flow-label">{{ $flowLabel }}</span>
                        <span class="font-label-caps text-label-caps uppercase text-on-primary-container" id="triad-telemetry">{{ $telemetry }}</span>
                    </div>
                    <div class="space-y-space-sm" id="triad-flow-stages">
                        @foreach ($stages as $idx => $stage)
                            <div class="p-space-sm rounded-lg {{ $idx === 2 ? 'bg-secondary-container/20' : 'bg-surface-container-high/10' }} flex flex-col sm:flex-row sm:items-center justify-between gap-2 transition-all hover:bg-surface-container-high/20">
                                <div class="flex items-center gap-space-sm min-w-0">
                                    <span class="w-6 h-6 rounded-full bg-secondary-container text-on-secondary-fixed flex items-center justify-center text-xs font-bold shrink-0">{{ $stage['n'] }}</span>
                                    <span class="font-title-md text-sm sm:text-body-md text-on-primary leading-snug {{ $idx === 2 ? 'font-semibold' : '' }}">{{ $stage['name'] }}</span>
                                </div>
                                <span class="font-label-caps text-label-caps shrink-0 pl-8 sm:pl-0 {{ $idx === 2 ? 'text-secondary-container font-bold' : 'text-secondary-fixed' }}">{{ $stage['val'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
