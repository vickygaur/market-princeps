@php
    $s = $sections['origin'] ?? [];
    $eyebrow = data_get($s, 'eyebrow', 'THE MEANING OF PRINCEPS // THE STANDARD WE FOLLOW');
    $titleHtml = data_get($s, 'title_html', 'First in understanding.<br>First in responsibility.');
    $paragraphs = data_get($s, 'paragraphs', [
        '<em class="font-semibold">Princeps</em> is a Latin word associated with being first, foremost or leading. We took that idea and made it practical: before we recommend a solution, we believe we should understand the business behind the problem.',
        'That means looking beyond individual services. A marketing problem may begin with visibility but end with a weak sales process. A technology problem may start with a missing tool but actually be caused by a broken workflow. The right answer begins with understanding how the pieces work together.',
    ]);
    $standardTitle = data_get($s, 'standard.title', 'The Market Princeps Standard');
    $standardBadge = data_get($s, 'standard.badge', 'UNDERSTAND BEFORE YOU BUILD');
    $standardBody = data_get($s, 'standard.body', "We don't start with a service. We start with the business, the problem and the outcome that matters. Then we build the solution around what the business actually needs.");
    $codexTitle = data_get($s, 'codex.title', 'How we approach every problem');
    $codexSubtitle = data_get($s, 'codex.subtitle', 'Three principles guide how we understand, build and improve.');
    $codexFooterLeft = data_get($s, 'codex.footer_left', 'BUSINESS FIRST');
    $codexFooterRight = data_get($s, 'codex.footer_right', 'BUILT TO EVOLVE');
    $codexItems = data_get($s, 'codex.items', [
        ['num' => '01', 'title' => 'Understand first', 'desc' => 'We learn how the business works before deciding what needs to change.', 'active' => true],
        ['num' => '02', 'title' => 'Connect the pieces', 'desc' => 'Marketing, technology and processes should work together when the business needs them to.', 'active' => false],
        ['num' => '03', 'title' => "Build for what's next", 'desc' => "Good solutions should solve today's problem without creating tomorrow's limitation.", 'active' => false],
    ]);
@endphp
<section class="w-full bg-surface-container-low py-20 px-6 md:px-margin relative overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            <div class="lg:col-span-7 flex flex-col space-y-space-md reveal-init">
                <div class="inline-flex items-start sm:items-center gap-space-xs text-secondary font-label-caps text-label-caps uppercase tracking-widest font-semibold max-w-full">
                    <span class="w-2 h-0.5 bg-secondary shrink-0 mt-2 sm:mt-0"></span>
                    <span class="leading-snug break-mobile">{{ $eyebrow }}</span>
                </div>
                <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface font-semibold tracking-tight">{!! $titleHtml !!}</h2>
                @foreach ($paragraphs as $paragraph)
                    <p class="{{ $loop->first ? 'font-body-lg text-body-lg' : 'font-body-md text-body-md' }} text-on-surface-variant leading-relaxed">{!! $paragraph !!}</p>
                @endforeach
                <div class="p-space-lg rounded-2xl bg-surface-container-lowest shadow-sm border border-outline-variant/30 flex items-start gap-space-md mt-space-sm">
                    <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-secondary shrink-0">
                        <span class="material-symbols-outlined text-[24px]">architecture</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                            <h3 class="font-headline-sm text-title-md text-on-surface font-semibold tracking-tight">{{ $standardTitle }}</h3>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-fixed/50 text-secondary text-[11px] font-bold tracking-wider uppercase border border-secondary/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-secondary-container animate-pulse"></span>
                                {{ $standardBadge }}
                            </span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">{{ $standardBody }}</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-5 flex flex-col reveal-init delay-200">
                <div class="p-5 sm:p-8 rounded-2xl bg-primary-container text-on-primary shadow-xl relative overflow-hidden border border-outline-variant/20">
                    <div class="flex items-center justify-between pb-space-sm mb-space-md border-b border-primary/60 flex-wrap gap-2">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="relative flex h-2 w-2 shrink-0">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary-container opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-secondary-container"></span>
                            </span>
                            <span class="font-label-caps text-label-caps uppercase text-secondary-container tracking-wider sm:tracking-widest font-semibold leading-snug">THE MARKET PRINCEPS STANDARD</span>
                        </div>
                        <span class="inline-flex items-center px-space-xs py-0.5 rounded bg-surface-container-high/20 text-secondary-fixed text-label-caps font-label-caps font-semibold status-indicator-glow">OUR PRINCIPLES</span>
                    </div>
                    <div class="mb-space-md">
                        <h3 class="font-headline-sm text-headline-sm text-on-primary font-semibold">{{ $codexTitle }}</h3>
                        <p class="font-body-sm text-body-sm text-on-primary-container mt-1">{{ $codexSubtitle }}</p>
                    </div>
                    <div class="space-y-space-sm" id="codex-container">
                        @foreach ($codexItems as $item)
                            @php
                                $isActive = data_get($item, 'active', $loop->first);
                            @endphp
                            <div class="codex-item p-space-md rounded-xl bg-surface-container-high/10 border shadow-sm cursor-pointer transition-all duration-300 hover:bg-surface-container-high/20 {{ $isActive ? 'codex-active border-secondary-container/40' : 'border-transparent' }}" data-codex="{{ $loop->iteration }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-space-sm">
                                        <span class="codex-num font-label-caps text-label-caps font-bold {{ $isActive ? 'text-secondary-container' : 'text-on-primary-container' }}">{{ data_get($item, 'num') }}</span>
                                        <h4 class="font-title-md text-title-md text-on-primary font-semibold">{{ data_get($item, 'title') }}</h4>
                                    </div>
                                    <span class="material-symbols-outlined text-[18px] transition-transform duration-300 codex-arrow {{ $isActive ? 'rotate-90 text-secondary-container' : 'text-on-primary-container' }}">chevron_right</span>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-primary-container mt-2 leading-relaxed codex-desc {{ $isActive ? '' : 'hidden' }}">{{ data_get($item, 'desc') }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-space-lg pt-space-md border-t border-primary/50 flex items-center justify-between font-label-caps text-label-caps text-secondary-fixed tracking-wider flex-wrap gap-2">
                        <span class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-secondary-container"></span>
                            {{ $codexFooterLeft }}
                        </span>
                        <div class="flex items-center gap-1 text-secondary-container">
                            <span class="material-symbols-outlined text-[16px]">fingerprint</span>
                            <span>{{ $codexFooterRight }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
