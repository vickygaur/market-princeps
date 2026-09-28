@php
    $badge = data_get($content, 'faq.badge', 'FREQUENTLY ASKED QUESTIONS');
    $heading = data_get($content, 'faq.heading', 'Clarity on our engagements.');
    $intro = data_get($content, 'faq.intro', 'Answers to practical questions businesses have before getting started.');
    $items = data_get($content, 'faq.items', []);
    $sideTitle = data_get($content, 'faq.side_cta.title', 'Have a complex website or a specific challenge?');
    $sideBody = data_get($content, 'faq.side_cta.body', 'Tell us what you\'re dealing with. We\'ll start by understanding the situation before recommending what needs to change.');
@endphp
<section class="w-full px-6 md:px-margin py-16 md:py-24 bg-surface-container-low">
    <div class="max-w-4xl mx-auto flex flex-col gap-10 md:gap-14">
        <div class="text-center max-w-xl mx-auto space-y-3">
            <div class="font-semibold text-xs tracking-wider text-amber-700 bg-amber-50/80 px-3 py-1 rounded-full border border-amber-200/50 inline-flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                <span class="font-label-caps uppercase tracking-widest font-bold">{{ $badge }}</span>
            </div>
            <h2 class="font-headline-lg text-3xl md:text-4xl text-slate-900 font-bold tracking-tight">{{ $heading }}</h2>
            <p class="font-body-md text-slate-600 text-sm md:text-base leading-relaxed">{{ $intro }}</p>
        </div>
        @if (count($items) > 0)
            <div class="space-y-3" id="faq-container">
                @foreach ($items as $item)
                    <div class="rounded-xl bg-surface-container-lowest border border-outline-variant/30 overflow-hidden">
                        <button class="faq-btn w-full p-4 md:p-5 text-left flex items-center justify-between gap-4 focus:outline-none" type="button">
                            <span class="font-title-md text-sm sm:text-base font-bold text-primary">{{ $item['question'] ?? '' }}</span>
                            <span class="material-symbols-outlined text-secondary text-[20px] transition-transform duration-200 faq-icon">expand_more</span>
                        </button>
                        <div class="faq-body px-4 md:px-5 pb-5 text-sm text-slate-600 leading-relaxed font-body-md hidden">
                            @if (! empty($item['answer_html']))
                                {!! $item['answer_html'] !!}
                            @else
                                <p>{{ $item['answer'] ?? '' }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="p-6 rounded-2xl bg-surface-container-lowest border border-outline-variant/30 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
            <div class="flex items-center gap-3 text-center sm:text-left">
                <div class="w-10 h-10 rounded-lg bg-primary-container text-secondary-container flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[20px]">terminal</span>
                </div>
                <div>
                    <h3 class="font-title-md text-sm font-bold text-slate-900">{{ $sideTitle }}</h3>
                    <p class="font-body-sm text-sm text-slate-600 leading-snug mt-1">{{ $sideBody }}</p>
                </div>
            </div>
            <a class="shrink-0 inline-flex items-center gap-1.5 px-5 py-2.5 rounded-lg bg-primary-container text-on-primary font-title-md text-xs font-semibold hover:bg-primary transition-all shadow-sm" href="#intakeTerminal">
                <span>{{ $primaryCta }}</span>
                <span class="material-symbols-outlined text-[14px] text-secondary-container">arrow_forward</span>
            </a>
        </div>
    </div>
</section>
