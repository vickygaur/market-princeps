@php
    $s = $sections['existence'] ?? [];
    $eyebrow = data_get($s, 'eyebrow', 'WHY MARKET PRINCEPS EXISTS // THE IDEA BEHIND THE BUSINESS');
    $title = data_get($s, 'title', "Businesses don't always need another service. They need someone to understand the problem first.");
    $paragraphs = data_get($s, 'paragraphs', [
        'Market Princeps came from seeing businesses solve growth problems in pieces. Marketing was handled by one team, technology by another, and processes somewhere else. Each solved a part of the problem, but the business was still left to connect everything together.',
        'We wanted to build a different kind of business: one that starts with understanding what is actually getting in the way, then brings the right pieces together to solve it.',
    ]);
    $highlight = data_get($s, 'highlight', 'The goal was never to offer more services. It was to make the right solution easier to find.');
    $imageUrl = data_get($s, 'image_url', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDe4qHgso6APMNGyOxPZzQwdbn76Ym0HW4BPtwOHjrW1gk5lijoFH46RAoUXCeAWC6mzYanZvViRN8sxrkEmmwMaEHQLJJGGqN1RYNdD1NctalotXTnBspnWv7iceKcVw6legkrvq4ZuHlGkWLTgQeWHM_1Q9cvn1aJNOHfA0Mxuhr11aI7rwxvJomHAGFSnLuxcgoiGzkkJkONnnE4Q7wfl5r6sRnH7Ijn0zaxNxrV2XbdA1JqIYznWQ');
    $imageAlt = data_get($s, 'image_alt', 'A dignified, high-end corporate executive conference room with an Indian female strategic leader standing and presenting to an executive leadership team around a polished teak boardroom table.');
@endphp
<section class="w-full bg-surface py-20 px-6 md:px-margin">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <div class="lg:col-span-6 relative group reveal-init flex flex-col justify-center my-auto">
                <div class="relative rounded-2xl overflow-hidden shadow-xl bg-primary-container border border-outline-variant/20 h-[520px]">
                    <img class="w-full h-full object-cover opacity-95 transition-transform duration-700 ease-out group-hover:scale-105" alt="{{ $imageAlt }}" src="{{ $imageUrl }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-container/80 via-transparent to-transparent pointer-events-none"></div>
                </div>
            </div>
            <div class="lg:col-span-6 flex flex-col space-y-space-md reveal-init delay-200">
                <div class="inline-flex items-center gap-space-xs text-secondary font-label-caps text-label-caps uppercase tracking-widest font-semibold">
                    <span class="w-2 h-0.5 bg-secondary"></span>
                    <span>{{ $eyebrow }}</span>
                </div>
                <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface font-semibold tracking-tight">{{ $title }}</h2>
                @foreach ($paragraphs as $paragraph)
                    <p class="{{ $loop->last ? 'font-body-md text-body-md' : 'font-body-lg text-body-lg' }} text-on-surface-variant leading-relaxed">{{ $paragraph }}</p>
                @endforeach
                <p class="font-body-md text-body-md text-primary font-semibold leading-relaxed">{{ $highlight }}</p>
            </div>
        </div>
    </div>
</section>
