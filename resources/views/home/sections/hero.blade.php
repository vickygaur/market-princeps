@php
    $s = $sections['hero'] ?? [];
    $titleHtml = data_get($s, 'title_html');
    $subhead = data_get($s, 'subhead', 'Market Princeps brings marketing, technology, and business systems together to turn attention into customers, inefficiencies into opportunities, and ideas into scalable growth.');
    $trustNote = data_get($s, 'trust_note', 'Marketing. Technology. Business growth. One place.');
    $consoleTitle = data_get($s, 'console_title', 'HOW WE BUILD YOUR GROWTH ENGINE');
    $ctaPrimaryLabel = data_get($s, 'cta_primary_label', 'build something better');
    $ctaSecondaryLabel = data_get($s, 'cta_secondary_label', 'Explore our approach');
    $heroSubheadDefault = data_get($s, 'hero_subhead_default', 'STAGE 01 // DEMAND & MARKET CAPTURE');
    $heroStatusDefault = data_get($s, 'hero_status_default', 'ATTRACTING ELITE DEMAND // AWARENESS → ENGAGEMENT → QUALIFIED PIPELINE');
    $nodes = data_get($s, 'nodes_default', [
        ['tag' => 'REACH', 'title' => 'Precision Authority Inflow', 'desc' => 'Target high-intent institutional buyers through verified executive distribution.'],
        ['tag' => 'POSITIONING', 'title' => 'Irrefutable Strategic Framing', 'desc' => 'Command immediate distinction from generic agencies and commodity services.'],
        ['tag' => 'TOUCHPOINTS', 'title' => 'Diagnostic Interactive Portals', 'desc' => 'Engage buyers through proprietary diagnostic tools and custom assessments.'],
        ['tag' => 'DEMAND', 'title' => 'Pre-Vetted Inbound Mesh', 'desc' => 'Systematically filter unqualified noise; deliver ready-to-close dossiers.'],
    ]);
@endphp
<section class="relative w-full px-margin-mobile md:px-margin pt-space-xl pb-space-xl overflow-hidden bg-gradient-to-b from-surface via-surface-container-lowest/40 to-surface">
    <div class="absolute -top-32 right-10 w-[620px] h-[620px] rounded-full bg-gradient-to-br from-secondary/15 via-secondary-container/12 to-transparent blur-3xl pointer-events-none ambient-glow"></div>
    <div class="absolute top-1/3 -left-28 w-[520px] h-[520px] rounded-full bg-gradient-to-tr from-secondary-fixed/30 via-primary-container/6 to-transparent blur-3xl pointer-events-none ambient-glow" style="animation-delay: -3s;"></div>
    <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[780px] h-[380px] rounded-full bg-gradient-to-b from-secondary-container/10 via-surface-container-low/40 to-transparent blur-2xl pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto flex flex-col items-center text-center">
        <h1 class="font-display-hero font-medium text-display-hero-mobile md:text-display-hero text-[#2A3042] max-w-5xl tracking-normal leading-tight md:leading-[1.2] mb-space-lg">
            @if ($titleHtml)
                {!! $titleHtml !!}
            @else
                <span class="shimmer-text-glow font-semibold">Attention</span> gets you noticed.<br>What you build after that makes you <span class="shimmer-text-glow font-semibold">grow.</span>
            @endif
        </h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl leading-relaxed mb-space-xl font-normal">{{ $subhead }}</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-space-md w-full sm:w-auto mb-space-md">
            <a class="w-full sm:w-auto inline-flex items-center justify-center gap-space-sm px-space-xl py-4 rounded-xl bg-primary-container text-on-primary font-title-md text-title-md tracking-wider uppercase transition-all transform hover:-translate-y-0.5 shadow-xl hover:shadow-[0_12px_28px_rgba(22,27,51,0.35)] shimmer-sweep-btn" href="#intake">
                <span>{{ $ctaPrimaryLabel }}</span>
                <span class="material-symbols-outlined text-secondary-container text-lg">arrow_forward</span>
            </a>
            <a class="w-full sm:w-auto inline-flex items-center justify-center gap-space-sm px-space-xl py-4 rounded-xl bg-surface-container-lowest text-on-primary-fixed font-title-md text-title-md tracking-wider uppercase transition-all shadow-sm hover:shadow-md hover:bg-surface-container-low card-hover-elevate" href="#simulator">
                <span class="material-symbols-outlined text-secondary text-lg">tune</span>
                <span>{{ $ctaSecondaryLabel }}</span>
            </a>
        </div>
        <div class="flex items-center justify-center gap-space-xs text-on-surface-variant mb-space-xl">
            <span class="material-symbols-outlined text-secondary text-[16px]">verified</span>
            <span class="font-body-sm text-body-sm tracking-wide">{{ $trustNote }}</span>
        </div>
        <div class="w-full max-w-5xl rounded-2xl bg-surface-container-lowest p-space-md md:p-space-lg shadow-xl text-left transition-all border border-outline-variant/30">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-space-md mb-space-md gap-space-sm">
                <div class="flex items-center gap-space-sm">
                    <div class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-secondary text-[22px]">account_tree</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-title-md text-title-md text-on-surface block">{{ $consoleTitle }}</span>
                            <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary-container opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-secondary-container"></span></span>
                        </div>
                        <span class="font-label-caps text-label-caps uppercase text-secondary font-bold tracking-wider" id="hero-subhead">{{ $heroSubheadDefault }}</span>
                    </div>
                </div>
                <div class="flex items-center bg-surface-container p-1 rounded-lg gap-1 shadow-inner" id="hero-tabs">
                    <button class="px-space-md py-1.5 rounded text-xs font-label-md transition-all bg-primary-container text-on-primary shadow-sm font-semibold" id="tab-attract" onclick="setHeroMode('attract')" type="button">Attract</button>
                    <button class="px-space-md py-1.5 rounded text-xs font-label-md transition-all text-on-surface-variant hover:text-on-surface font-semibold" id="tab-convert" onclick="setHeroMode('convert')" type="button">Convert</button>
                    <button class="px-space-md py-1.5 rounded text-xs font-label-md transition-all text-on-surface-variant hover:text-on-surface font-semibold" id="tab-optimize" onclick="setHeroMode('optimize')" type="button">Optimize</button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-space-md mb-space-md relative" id="hero-nodes-grid">
                <div class="hidden md:block absolute top-[68px] left-[10%] right-[10%] h-[12px] pointer-events-none z-0">
                    <svg class="w-full h-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 600 12">
                        <path class="stroke-outline-variant/30" d="M 0 6 L 600 6" fill="none" stroke-width="2"></path>
                        <path class="stroke-secondary conduit-stream opacity-90" d="M 0 6 L 600 6" fill="none" stroke-width="2.5"></path>
                        <path class="stroke-secondary-container conduit-stream opacity-70" d="M 0 6 L 600 6" fill="none" stroke-width="1.5" style="animation-duration: 0.85s;"></path>
                        <circle class="ambient-glow" cx="100" cy="6" fill="#fe932c" r="3.5">
                            <animate attributeName="cx" dur="2.4s" from="0" repeatCount="indefinite" to="600"></animate>
                        </circle>
                        <circle class="ambient-glow" cx="280" cy="6" fill="#ffdcc3" r="4.5">
                            <animate attributeName="cx" begin="0.8s" dur="2.4s" from="0" repeatCount="indefinite" to="600"></animate>
                        </circle>
                        <circle cx="460" cy="6" fill="#904d00" r="3">
                            <animate attributeName="cx" begin="1.6s" dur="2.4s" from="0" repeatCount="indefinite" to="600"></animate>
                        </circle>
                    </svg>
                </div>
                @foreach ($nodes as $index => $node)
                    @php $nodeNum = $index + 1; @endphp
                    <div class="p-space-md rounded-xl {{ $nodeNum === 4 ? 'bg-primary-container text-on-primary shadow-md' : 'bg-surface-container-low hover:bg-surface-container shadow-sm' }} transition-all flex flex-col justify-between relative z-10 card-hover-elevate min-h-[160px]">
                        <div>
                            <div class="flex items-center justify-between mb-space-sm">
                                <span class="font-label-caps text-label-caps uppercase tracking-wider {{ $nodeNum === 1 ? 'text-secondary' : ($nodeNum === 2 ? 'text-primary' : ($nodeNum === 3 ? 'text-on-tertiary-container' : 'text-secondary-container')) }} font-bold" id="node{{ $nodeNum }}-tag">{{ $node['tag'] }}</span>
                                <span class="w-2.5 h-2.5 rounded-full {{ $nodeNum === 2 ? 'bg-primary-container' : ($nodeNum === 3 ? 'bg-on-tertiary-container' : 'bg-secondary-container') }} beacon-pulse"></span>
                            </div>
                            <h4 class="font-headline-sm text-[17px] leading-snug {{ $nodeNum === 4 ? 'text-on-primary' : 'text-on-surface' }} mb-1 font-semibold" id="node{{ $nodeNum }}-title">{{ $node['title'] }}</h4>
                            <p class="font-body-sm text-body-sm {{ $nodeNum === 4 ? 'text-on-primary-container' : 'text-on-surface-variant' }} leading-relaxed" id="node{{ $nodeNum }}-desc">{{ $node['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="p-space-sm rounded-lg bg-surface-container flex flex-wrap items-center justify-between gap-space-sm font-label-caps text-label-caps uppercase">
                <div class="flex items-center gap-space-sm">
                    <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary-container opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-secondary-container"></span></span>
                    <span class="text-on-surface font-semibold">ACTIVE FOCUS:</span>
                    <span class="text-secondary font-bold" id="hero-status-tag">{{ $heroStatusDefault }}</span>
                </div>
                <div class="flex items-center gap-space-lg text-on-surface-variant">
                    <span class="hidden sm:inline">EFFICIENCY → CONTROL → SCALE → GROWTH</span>
                </div>
            </div>
        </div>
    </div>
</section>
