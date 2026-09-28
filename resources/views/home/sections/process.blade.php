@php
    $s = $sections['process'] ?? [];
    $eyebrow = data_get($s, 'eyebrow', 'HOW WE WORK');
    $heading = data_get($s, 'heading', 'From business problem to practical solution.');
    $intro = data_get($s, 'intro', 'We start by understanding your business, then identify what can improve, build what you need, and keep refining it as your business grows.');
    $steps = data_get($s, 'steps', [
        ['num' => '01', 'title' => 'UNDERSTAND', 'body' => "We learn how your business works, what you're trying to achieve, and where time, money or opportunities are being lost.", 'icon' => 'visibility', 'footer' => 'UNDERSTAND THE REAL PROBLEM'],
        ['num' => '02', 'title' => 'PLAN', 'body' => 'We identify where marketing, technology or process improvements can create the most value and define what needs to change.', 'icon' => 'architecture', 'footer' => 'FOCUS ON WHAT MATTERS'],
        ['num' => '03', 'title' => 'BUILD', 'body' => 'We build, implement and connect the right tools, systems and workflows around the way your business actually operates.', 'icon' => 'code', 'footer' => 'TURN THE PLAN INTO ACTION'],
        ['num' => '04', 'title' => 'IMPROVE', 'body' => 'We measure what changes, remove new friction and improve the system as your customers, team and business evolve.', 'icon' => 'trending_up', 'footer' => 'IMPROVE AS BUSINESS GROWS'],
    ]);
    $ctaLabel = data_get($s, 'cta_label', 'START WITH YOUR BUSINESS');
    $ctaNote = data_get($s, 'cta_note', 'No fixed package. No one-size-fits-all solution.');
@endphp
<section class="w-full bg-surface px-margin-mobile md:px-margin py-space-xl">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col items-center text-center mb-space-xl">
            <span class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-semibold mb-space-xs">{{ $eyebrow }}</span>
            <h2 class="font-headline-lg text-headline-lg md:text-[38px] md:leading-tight text-on-surface max-w-2xl font-semibold">{{ $heading }}</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mt-space-sm">{{ $intro }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-md">
            @foreach ($steps as $step)
                <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between card-hover-elevate border border-outline-variant/20">
                    <div>
                        <div class="flex items-center justify-between mb-space-md">
                            <span class="font-display-hero text-headline-lg text-secondary font-bold">{{ $step['num'] }}</span>
                        </div>
                        <h4 class="font-headline-sm text-headline-sm text-on-surface mb-space-xs font-semibold">{{ $step['title'] }}</h4>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">{{ $step['body'] }}</p>
                    </div>
                    <div class="mt-space-lg pt-space-sm flex items-center gap-space-xs text-secondary font-label-caps text-label-caps uppercase font-semibold">
                        <span class="material-symbols-outlined text-[16px]">{{ $step['icon'] ?? 'check' }}</span>
                        <span>{{ $step['footer'] ?? '' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-space-xl flex flex-col sm:flex-row items-center justify-center gap-space-md">
            <a class="w-full sm:w-auto inline-flex items-center justify-center gap-space-sm px-space-xl py-4 rounded-xl bg-primary-container text-on-primary font-title-md text-title-md uppercase tracking-wider font-semibold transition-all transform hover:-translate-y-0.5 shadow-xl hover:shadow-[0_12px_28px_rgba(22,27,51,0.35)] shimmer-sweep-btn" href="#intake">
                <span>{{ $ctaLabel }}</span>
                <span class="material-symbols-outlined text-secondary-container text-lg">arrow_forward</span>
            </a>
            <span class="font-body-sm text-body-sm text-on-surface-variant font-medium">{{ $ctaNote }}</span>
        </div>
    </div>
</section>
