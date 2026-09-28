@php
    $s = $sections['doctrine'] ?? [];
    $eyebrow = data_get($s, 'eyebrow', 'HOW WE THINK // CORE CONVICTIONS');
    $title = data_get($s, 'title', 'A few principles guide every solution we build.');
    $subtitle = data_get($s, 'subtitle', "We don't believe in following a fixed formula. We believe in understanding the business, focusing on what creates value, and building solutions that make the business better over time.");
    $items = data_get($s, 'items', [
        [
            'number' => '01',
            'title' => 'Understand Before You Recommend',
            'description' => "We don't start with a service or a solution. We first understand the business, the problem and implement what success actually looks like.",
            'footer_icon' => 'filter_alt',
            'footer_label' => 'BUSINESS FIRST',
        ],
        [
            'number' => '02',
            'title' => 'Value Over Vanity Metrics',
            'description' => "More traffic, more tools or more activity don't automatically create growth. We focus on the changes that can create meaningful value for the business.",
            'footer_icon' => 'speed',
            'footer_label' => 'FOCUS ON WHAT MATTERS',
        ],
        [
            'number' => '03',
            'title' => 'Fit the Solution to the Business',
            'description' => 'Every business has different customers, processes, constraints and goals. We build around those realities instead of forcing a standard solution.',
            'footer_icon' => 'tune',
            'footer_label' => 'BUILT FOR THE BUSINESS',
        ],
        [
            'number' => '04',
            'title' => 'Improve What You Build',
            'description' => "A solution shouldn't be considered finished just because it has been delivered. We look at what changes, what works and what can be made better.",
            'footer_icon' => 'fact_check',
            'footer_label' => 'BUILT TO EVOLVE',
        ],
    ]);
    $delayClasses = ['delay-100', 'delay-200', 'delay-300', 'delay-400'];
@endphp
<section class="w-full bg-surface-container-low py-20 px-6 md:px-margin">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-12 reveal-init">
            <div class="inline-flex items-center gap-space-xs text-secondary font-label-caps text-label-caps uppercase tracking-widest font-semibold">
                <span class="w-2 h-0.5 bg-secondary"></span>
                <span>{{ $eyebrow }}</span>
                <span class="w-2 h-0.5 bg-secondary"></span>
            </div>
            <h2 class="mt-space-xs font-headline-lg text-headline-lg md:text-[38px] md:leading-tight text-on-surface font-semibold tracking-tight">{{ $title }}</h2>
            <p class="mt-space-sm font-body-md text-body-md text-on-surface-variant leading-relaxed">{{ $subtitle }}</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto items-stretch">
            @foreach ($items as $index => $item)
                <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between border border-outline-variant/20 doctrine-card reveal-init {{ $delayClasses[$index] ?? 'delay-100' }} cursor-default">
                    <div>
                        <div class="flex items-center justify-between mb-space-md">
                            <span class="font-display-hero text-headline-lg text-secondary font-bold doctrine-num">{{ data_get($item, 'number') }}</span>
                        </div>
                        <h4 class="font-headline-sm text-headline-sm text-on-surface mb-space-xs font-semibold">{{ data_get($item, 'title') }}</h4>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">{{ data_get($item, 'description') }}</p>
                    </div>
                    <div class="mt-space-lg pt-space-sm flex items-center gap-space-xs text-secondary font-label-caps text-label-caps uppercase font-semibold">
                        <span class="material-symbols-outlined text-[16px]">{{ data_get($item, 'footer_icon', 'check') }}</span>
                        <span>{{ data_get($item, 'footer_label') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
