@php
    $s = $sections['metrics'] ?? [];
    $cards = data_get($s, 'cards', [
        [
            'icon' => 'developer_board',
            'icon_bg' => 'bg-primary-container text-secondary-container',
            'stat' => 'Since 2020',
            'title' => 'Built through experience',
            'body' => 'Working with businesses since 2020 has taught us that every business needs its own solution.',
            'float' => 'float-slow',
            'delay' => null,
        ],
        [
            'icon' => 'assured_workload',
            'icon_bg' => 'bg-surface-container text-secondary',
            'stat' => '15+ Sectors',
            'stat_class' => 'text-secondary',
            'title' => 'Broad industry experience',
            'body' => 'From schools and real estate to e-commerce, retail, restaurants, green energy and more.',
            'float' => 'float-delayed',
            'delay' => null,
        ],
        [
            'icon' => 'group_work',
            'icon_bg' => 'bg-primary-container text-on-primary',
            'stat' => '360° view',
            'title' => 'We look beyond marketing',
            'body' => 'We look at marketing, technology, sales and operations to understand what drives growth.',
            'float' => 'float-slow',
            'delay' => '0.6s',
        ],
        [
            'icon' => 'language',
            'icon_bg' => 'bg-surface-container text-on-tertiary-container',
            'stat' => 'One Approach',
            'title' => 'Built around your business',
            'body' => "We don't force businesses into ready-made packages. We build what their business actually needs.",
            'float' => 'float-delayed',
            'delay' => '1.8s',
        ],
    ]);
@endphp
<section class="w-full bg-surface-container-low px-margin-mobile md:px-margin py-space-xl">
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md">
        @foreach ($cards as $card)
            <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between card-hover-elevate {{ $card['float'] ?? '' }}" @if(!empty($card['delay'])) style="animation-delay: {{ $card['delay'] }};" @endif>
                <div>
                    <div class="w-10 h-10 rounded-lg {{ $card['icon_bg'] ?? 'bg-surface-container text-secondary' }} flex items-center justify-center mb-space-md shadow-sm">
                        <span class="material-symbols-outlined text-[22px]">{{ $card['icon'] ?? 'star' }}</span>
                    </div>
                    <div class="font-display-hero text-headline-lg font-bold {{ $card['stat_class'] ?? 'text-on-surface' }} mb-1">{{ $card['stat'] ?? '' }}</div>
                    <div class="font-title-md text-title-md text-on-surface font-semibold mb-space-xs">{{ $card['title'] ?? '' }}</div>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $card['body'] ?? '' }}</p>
            </div>
        @endforeach
    </div>
</section>
