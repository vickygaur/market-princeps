@php
    $s = $sections['philosophy'] ?? [];
    $eyebrow = data_get($s, 'eyebrow', '✦ SYSTEM PHILOSOPHY');
    $heading = data_get($s, 'heading', 'What changes when everything works together?');
    $intro = data_get($s, 'intro', 'Most agencies solve one problem at a time. We look at how the whole business works, then build the right pieces to help it grow.');
    $usualLabel = data_get($s, 'usual_label', 'THE USUAL APPROACH');
    $usualTitle = data_get($s, 'usual_title', 'Growth in Pieces');
    $usualBody = data_get($s, 'usual_body', 'Marketing, technology and operations are often handled separately. That can mean more leads without better systems, more tools without better processes, and more activity without meaningful growth.');
    $usualItems = data_get($s, 'usual_items', [
        'More leads, but no system to handle them.',
        'More tools, but more work to manage them.',
        'More activity, but no clear link to revenue.',
    ]);
    $mpLabel = data_get($s, 'mp_label', 'THE MARKET PRINCEPS APPROACH');
    $mpTitle = data_get($s, 'mp_title', 'Everything Works Together');
    $mpBody = data_get($s, 'mp_body', 'We connect marketing, technology and business processes around one goal: helping your business attract better opportunities, convert them, and operate more efficiently.');
    $mpItems = data_get($s, 'mp_items', [
        'Marketing that brings the right opportunities to your door.',
        'Technology that turns opportunities into action.',
        'Systems that help your business grow without complexity.',
    ]);
    $ctaLabel = data_get($s, 'cta_label', "LET'S FIND YOUR NEXT GROWTH OPPORTUNITY");
@endphp
<section class="w-full bg-surface px-margin-mobile md:px-margin py-space-xl" id="philosophy">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col items-center text-center mb-space-xl">
            <span class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-semibold mb-space-xs">{{ $eyebrow }}</span>
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface max-w-2xl font-semibold">{{ $heading }}</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mt-space-sm">{{ $intro }}</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-space-lg">
            <div class="rounded-2xl p-space-lg md:p-space-xl bg-surface-container-high shadow-sm relative overflow-hidden card-hover-elevate">
                <div class="flex items-center gap-space-sm mb-space-md">
                    <span class="w-3 h-3 rounded-full bg-on-tertiary-container"></span>
                    <span class="font-label-caps text-label-caps uppercase tracking-wider text-on-tertiary-container font-bold">{{ $usualLabel }}</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-surface mb-space-md font-semibold">{{ $usualTitle }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant mb-space-lg leading-relaxed">{{ $usualBody }}</p>
                <ul class="space-y-space-md">
                    @foreach ($usualItems as $item)
                        <li class="flex items-start gap-space-sm">
                            <span class="material-symbols-outlined text-on-tertiary-container text-lg mt-0.5">close</span>
                            <span class="font-body-md text-body-md text-on-surface">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="rounded-2xl p-space-lg md:p-space-xl bg-primary-container text-on-primary shadow-xl relative overflow-hidden card-hover-elevate">
                <div class="flex items-center gap-space-sm mb-space-md">
                    <span class="w-3 h-3 rounded-full bg-secondary-container beacon-pulse"></span>
                    <span class="font-label-caps text-label-caps uppercase tracking-wider text-secondary-container font-bold">{{ $mpLabel }}</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-primary mb-space-md font-semibold">{{ $mpTitle }}</h3>
                <p class="font-body-md text-body-md text-on-primary-container mb-space-lg leading-relaxed">{{ $mpBody }}</p>
                <ul class="space-y-space-md">
                    @foreach ($mpItems as $item)
                        <li class="flex items-start gap-space-sm">
                            <span class="material-symbols-outlined text-secondary-container text-lg mt-0.5">check_circle</span>
                            <span class="font-body-md text-body-md text-on-primary">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mt-space-xl flex justify-center px-0">
            <a class="w-full sm:w-auto inline-flex items-center justify-center gap-space-sm px-space-lg sm:px-space-xl py-3.5 rounded-xl bg-primary-container text-on-primary font-title-md text-sm sm:text-title-md tracking-wider uppercase transition-all transform hover:-translate-y-0.5 shadow-lg hover:shadow-[0_12px_28px_rgba(22,27,51,0.35)] shimmer-sweep-btn text-center" href="#intake">
                <span class="leading-snug">{{ $ctaLabel }}</span>
                <span class="material-symbols-outlined text-secondary-container text-lg shrink-0">arrow_forward</span>
            </a>
        </div>
    </div>
</section>
