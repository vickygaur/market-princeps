@php
    $badge = data_get($content, 'intake.badge', 'LET\'S TALK ABOUT YOUR BUSINESS');
    $heading = data_get($content, 'intake.heading', 'Tell us where you want to go. We\'ll help you figure out how to get there.');
    $intro = data_get($content, 'intake.intro', 'Start with the problem. We\'ll understand your business before recommending a solution.');
    $protocolTitle = data_get($content, 'intake.protocol_title', 'What happens after you reach out');
    $protocolSteps = data_get($content, 'intake.protocol_steps', [
        ['title' => 'Understand', 'body' => 'We learn what you\'re trying to achieve, what\'s getting in the way, and how your current setup works.'],
        ['title' => 'Explore', 'body' => 'We look at the relevant parts of your presence and identify where there may be meaningful opportunities.'],
        ['title' => 'Recommend', 'body' => 'We explain what we believe needs attention and what the right next step could look like.'],
    ]);
    $messageLabel = data_get($content, 'intake.message_label', 'Organic Search Objectives & Current Pain Points');
    $messagePlaceholder = data_get($content, 'intake.message_placeholder', 'Target accounts, existing search bottlenecks, upcoming migration...');
    $submitLabel = data_get($content, 'intake.submit_label', 'START THE CONVERSATION');
    $disclaimer = data_get($content, 'intake.disclaimer', 'Protected by strict non-disclosure protocols. We never share enterprise business information.');
    $helpCategory = data_get($content, 'intake.help_category', 'marketing');
    $source = 'service:'.$service->slug;
@endphp
<section class="w-full px-6 md:px-margin py-16 md:py-24 bg-surface" id="intakeTerminal">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-10 md:gap-14 items-start">
        <div class="lg:col-span-5 flex flex-col gap-6">
            <div class="space-y-3">
                <div class="font-semibold text-xs tracking-wider text-amber-700 bg-amber-50/80 px-3 py-1 rounded-full border border-amber-200/50 inline-flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    <span class="font-label-caps uppercase tracking-widest font-bold">{{ $badge }}</span>
                </div>
                <h2 class="font-headline-lg text-3xl md:text-4xl text-slate-900 font-bold tracking-tight">{{ $heading }}</h2>
                <p class="font-body-md text-slate-600 text-sm md:text-base leading-relaxed">{{ $intro }}</p>
            </div>
            <div class="p-5 rounded-2xl bg-surface-container-low border border-surface-container-high space-y-3">
                <div class="font-label-caps text-xs uppercase tracking-wider text-primary font-bold">{{ $protocolTitle }}</div>
                <div class="space-y-2 text-xs text-slate-600 leading-relaxed font-body-md">
                    @foreach ($protocolSteps as $index => $step)
                        <div class="flex items-start gap-2.5">
                            <span class="text-secondary font-bold">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}.</span>
                            <span><strong>{{ $step['title'] ?? '' }}:</strong> {{ $step['body'] ?? '' }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="lg:col-span-7 rounded-2xl bg-surface-container-lowest p-6 md:p-8 shadow-xl border border-outline-variant/30">
            <form class="flex flex-col gap-5" id="service-lead-form" action="{{ route('leads.store') }}" method="POST" novalidate>
                @csrf
                <input type="hidden" name="source" value="{{ $source }}">
                <input type="hidden" name="help_category" value="{{ $helpCategory }}">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                    <div class="space-y-1">
                        <label class="font-title-md text-xs font-semibold text-primary" for="service-full-name">Full Name *</label>
                        <input class="w-full px-3.5 py-2.5 rounded-lg bg-surface-container-low font-body-sm text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/50 placeholder:text-outline-variant border border-outline-variant/30" id="service-full-name" name="name" placeholder="e.g. Vikramaditya Rathore" required type="text">
                    </div>
                    <div class="space-y-1">
                        <label class="font-title-md text-xs font-semibold text-primary" for="service-work-email">Work Email *</label>
                        <input class="w-full px-3.5 py-2.5 rounded-lg bg-surface-container-low font-body-sm text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/50 placeholder:text-outline-variant border border-outline-variant/30" id="service-work-email" name="email" placeholder="name@company.com" required type="email">
                    </div>
                    <div class="space-y-1">
                        <label class="font-title-md text-xs font-semibold text-primary" for="service-phone-number">Phone Number *</label>
                        <input class="w-full px-3.5 py-2.5 rounded-lg bg-surface-container-low font-body-sm text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/50 placeholder:text-outline-variant border border-outline-variant/30" id="service-phone-number" name="phone" placeholder="+91 98765 43210" required type="tel">
                    </div>
                    <div class="space-y-1">
                        <label class="font-title-md text-xs font-semibold text-primary" for="service-company-name">Company Name</label>
                        <input class="w-full px-3.5 py-2.5 rounded-lg bg-surface-container-low font-body-sm text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/50 placeholder:text-outline-variant border border-outline-variant/30" id="service-company-name" name="company" placeholder="e.g. Apex Industries" type="text">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="font-title-md text-xs font-semibold text-primary" for="service-project-brief">{{ $messageLabel }}</label>
                    <textarea class="w-full px-3.5 py-2.5 rounded-lg bg-surface-container-low font-body-sm text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/50 placeholder:text-outline-variant border border-outline-variant/30" id="service-project-brief" name="message" placeholder="{{ $messagePlaceholder }}" rows="3"></textarea>
                </div>
                <button class="w-full py-3.5 rounded-lg bg-primary-container text-on-primary font-title-md text-sm font-bold tracking-wider hover:bg-primary shadow-lg transition-all flex items-center justify-center gap-2 group" id="service-lead-submit" type="submit">
                    <span id="service-lead-submit-label">{{ $submitLabel }}</span>
                    <span class="material-symbols-outlined text-[18px] text-secondary-container group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
                <p class="text-xs text-center text-outline">{{ $disclaimer }}</p>
                <div class="hidden text-center p-3 rounded-lg bg-surface-container text-secondary font-body-sm text-sm" id="service-form-success"></div>
                <div class="hidden text-center p-3 rounded-lg bg-error-container text-on-error-container font-body-sm text-sm" id="service-form-error"></div>
            </form>
        </div>
    </div>
</section>
