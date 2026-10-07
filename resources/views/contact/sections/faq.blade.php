@php
    $s = $sections['faq'] ?? [];
    $eyebrow = data_get($s, 'eyebrow', 'BEFORE YOU REACH OUT // COMMON QUESTIONS');
    $title = data_get($s, 'title', 'A few things you might be wondering.');
    $items = data_get($s, 'items', [
        [
            'question' => 'Do I need to know which service I need before contacting you?',
            'answer' => "No. That's part of the conversation. Tell us what you're trying to improve, fix or grow, and we'll first understand the business and the problem. From there, we can determine whether marketing, technology, business optimization or a combination makes sense.",
            'open' => false,
        ],
        [
            'question' => 'Do you work with businesses of all sizes?',
            'answer' => 'We work with businesses at different stages and across different industries. What matters more than size is whether there is a clear business problem or opportunity we can meaningfully help address.',
            'open' => false,
        ],
        [
            'question' => 'Are you a marketing agency, technology company or business consultancy?',
            'answer' => "Market Princeps brings all three perspectives together. We work across Marketing & Demand, Custom Technology and Business Optimization, but we don't treat them as separate solutions when the problem connects them.",
            'open' => false,
        ],
        [
            'question' => 'Do I have to use all three of your capabilities?',
            'answer' => "We'll review what you've shared and start with a conversation about your business, goals and the challenge you're facing. If there's a useful way for us to help, we'll explain the practical next steps.",
            'open' => true,
        ],
    ]);
@endphp
<section class="w-full px-gutter md:px-margin py-space-xl bg-surface-container-low/60">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-space-xl px-1">
            <span class="font-label-caps text-label-caps uppercase tracking-wider sm:tracking-[0.18em] text-secondary font-bold leading-snug">{{ $eyebrow }}</span>
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary tracking-tight font-bold mt-space-xs">
                {{ $title }}
            </h2>
        </div>
        <div class="flex flex-col space-y-space-md" id="faqAccordion">
            @foreach ($items as $item)
                @php
                    $isOpen = (bool) data_get($item, 'open', false);
                @endphp
                <div class="rounded-xl bg-surface-container-lowest p-space-md sm:p-space-lg shadow-sm transition-all">
                    <button class="w-full flex items-start sm:items-center justify-between text-left gap-space-md" onclick="toggleAccordion(this)" type="button" aria-expanded="{{ $isOpen ? 'true' : 'false' }}">
                        <span class="font-headline-sm text-base sm:text-headline-sm text-primary font-semibold leading-snug">{{ data_get($item, 'question') }}</span>
                        <div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center shrink-0 transition-transform duration-300">
                            <span class="material-symbols-outlined text-primary text-[20px]">{{ $isOpen ? 'expand_less' : 'expand_more' }}</span>
                        </div>
                    </button>
                    <div class="faq-answer mt-space-md pt-space-md text-on-surface-variant font-body-md text-body-md leading-relaxed border-t border-surface-container-high/40 {{ $isOpen ? '' : 'hidden' }}">
                        {{ data_get($item, 'answer') }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
