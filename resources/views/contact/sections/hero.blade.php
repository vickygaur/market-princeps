@php
    $s = $sections['hero'] ?? [];
    $badge = data_get($s, 'badge', "LET'S TALK ABOUT YOUR BUSINESS");
    $titlePrefix = data_get($s, 'title_prefix', "Tell us what you're trying to");
    $titleShimmer = data_get($s, 'title_shimmer', 'improve.');
    $body = data_get($s, 'body', "You don't need to know exactly what solution you need. Tell us what's getting in the way, what you're trying to achieve, or where you see an opportunity. We'll start by understanding the business.");
    $trustMarkers = data_get($s, 'trust_markers', [
        ['icon' => 'bolt', 'label' => 'Business-first conversation'],
        ['icon' => 'lock', 'label' => 'No one-size-fits-all solution'],
        ['icon' => 'handshake', 'label' => 'Start with the problem'],
    ]);
@endphp
<section class="relative w-full px-gutter md:px-margin pt-space-xl pb-space-xl overflow-hidden bg-gradient-to-b from-surface-container-low/80 via-surface to-surface">
    <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[720px] h-[340px] bg-gradient-to-tr from-secondary/10 via-secondary-container/15 to-transparent blur-3xl pointer-events-none rounded-full"></div>
    <div class="relative max-w-5xl mx-auto flex flex-col items-center text-center">
        <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container-lowest shadow-sm mb-space-lg">
            <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
            <span class="font-label-caps text-label-caps uppercase tracking-[0.16em] text-secondary font-bold">{{ $badge }}</span>
        </div>
        <h1 class="font-display-hero text-display-hero text-primary-container font-bold max-w-4xl tracking-tight mb-space-md">
            {{ $titlePrefix }} <span class="gold-shimmer-text font-bold">{{ $titleShimmer }}</span>
        </h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto mb-space-xl leading-relaxed">
            {{ $body }}
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-md w-full max-w-3xl">
            @foreach ($trustMarkers as $marker)
                <div class="flex items-center justify-center gap-space-xs p-space-sm rounded-lg bg-surface-container-lowest shadow-sm">
                    <span class="material-symbols-outlined text-secondary text-[20px]">{{ data_get($marker, 'icon', 'check') }}</span>
                    <span class="font-label-md text-label-md text-primary font-semibold">{{ data_get($marker, 'label') }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
