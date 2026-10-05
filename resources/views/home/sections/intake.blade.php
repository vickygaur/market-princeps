@php
    $s = $sections['intake'] ?? [];
    $badge = data_get($s, 'badge', "LET'S TALK ABOUT YOUR BUSINESS");
    $heading = data_get($s, 'heading', "Tell us where you want to go. We'll help you figure out how to get there.");
    $intro = data_get($s, 'intro', "Whether you need more customers, better technology, smoother processes or all three, start with the problem. We'll understand your business before recommending a solution.");
    $highlights = data_get($s, 'highlights', [
        ['icon' => 'diamond', 'title' => 'NO ONE-SIZE-FITS-ALL PACKAGES', 'body' => "We don't force your business into a predefined service. We build around what you actually need."],
        ['icon' => 'shield', 'title' => 'BUSINESS-FIRST CONVERSATION', 'body' => "We'll first understand your goals, challenges and current setup before suggesting anything."],
        ['icon' => 'layers', 'title' => 'ONE PLACE FOR THE BIGGER PICTURE', 'body' => 'Marketing, technology and business optimization can work together when your business needs more than one solution.'],
    ]);
    $asideTitle = data_get($s, 'aside_title', 'NOT SURE WHAT YOU NEED?');
    $asideBody = data_get($s, 'aside_body', "That's okay. We'll help you find the right direction.");
    $submitLabel = data_get($s, 'submit_label', "LET'S TALK ABOUT YOUR BUSINESS");
    $successMessage = data_get($s, 'success_message', 'Thank you. We received your message and will be in touch soon.');
@endphp
<section class="w-full bg-surface-container-low px-margin-mobile md:px-margin py-space-xl" id="intake">
    <div class="max-w-7xl mx-auto rounded-3xl bg-surface-container-lowest p-space-lg md:p-space-xl shadow-xl border border-outline-variant/30">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl">
            <div class="lg:col-span-5 flex flex-col justify-between">
                <div>
                    <div class="inline-flex items-center gap-space-xs px-space-sm py-1 rounded bg-surface-container w-fit mb-space-md">
                        <span class="w-2 h-2 rounded-full bg-secondary-container beacon-pulse"></span>
                        <span class="font-label-caps text-label-caps uppercase text-secondary font-bold tracking-wider">{{ $badge }}</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface mb-space-md font-semibold">{{ $heading }}</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-space-lg leading-relaxed">{{ $intro }}</p>
                    <div class="space-y-space-md">
                        @foreach ($highlights as $item)
                            <div class="flex items-start gap-space-sm">
                                <span class="material-symbols-outlined text-secondary text-lg mt-0.5">{{ $item['icon'] ?? 'star' }}</span>
                                <div>
                                    <h5 class="font-title-md text-title-md text-on-surface font-semibold">{{ $item['title'] ?? '' }}</h5>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $item['body'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="p-space-md rounded-xl bg-surface-container mt-space-lg">
                    <span class="font-label-caps text-label-caps uppercase text-on-surface-variant block mb-1 tracking-wider">{{ $asideTitle }}</span>
                    <span class="font-body-sm text-body-sm text-on-surface font-medium">{{ $asideBody }}</span>
                </div>
            </div>
            <div class="lg:col-span-7 bg-surface-container-low p-space-md md:p-space-lg rounded-2xl">
                <form id="lead-form" class="space-y-space-md" action="{{ route('leads.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-caps text-label-caps uppercase text-on-surface-variant tracking-wider font-semibold">WHAT CAN WE HELP YOU WITH? <span class="text-secondary font-medium tracking-normal text-xs">(SELECT ONE)</span></label>
                        <div class="flex flex-col gap-2">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 w-full">
                                <label class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-lg bg-surface-container-lowest border border-outline-variant/30 cursor-pointer shadow-sm hover:border-secondary transition-all text-center h-10">
                                    <input checked class="w-3.5 h-3.5 text-primary focus:ring-secondary accent-secondary flex-shrink-0" name="help_category" type="radio" value="marketing">
                                    <span class="font-body-sm text-xs text-on-surface font-medium whitespace-nowrap">Marketing &amp; Demand</span>
                                </label>
                                <label class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-lg bg-surface-container-lowest border border-outline-variant/30 cursor-pointer shadow-sm hover:border-secondary transition-all text-center h-10">
                                    <input class="w-3.5 h-3.5 text-primary focus:ring-secondary accent-secondary flex-shrink-0" name="help_category" type="radio" value="technology">
                                    <span class="font-body-sm text-xs text-on-surface font-medium whitespace-nowrap">Custom Technology</span>
                                </label>
                                <label class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-lg bg-surface-container-lowest border border-outline-variant/30 cursor-pointer shadow-sm hover:border-secondary transition-all text-center h-10">
                                    <input class="w-3.5 h-3.5 text-primary focus:ring-secondary accent-secondary flex-shrink-0" name="help_category" type="radio" value="optimization">
                                    <span class="font-body-sm text-xs text-on-surface font-medium whitespace-nowrap">Business Optimization</span>
                                </label>
                            </div>
                            <div class="flex flex-col sm:flex-row justify-center items-center gap-2 w-full">
                                <label class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-lg bg-surface-container-lowest border border-outline-variant/30 cursor-pointer shadow-sm hover:border-secondary transition-all text-center h-10 w-full sm:w-[32.6%]">
                                    <input class="w-3.5 h-3.5 text-primary focus:ring-secondary accent-secondary flex-shrink-0" name="help_category" type="radio" value="combination">
                                    <span class="font-body-sm text-xs text-on-surface font-medium whitespace-nowrap">A combination of all</span>
                                </label>
                                <label class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-lg bg-surface-container-lowest border border-outline-variant/30 cursor-pointer shadow-sm hover:border-secondary transition-all text-center h-10 w-full sm:w-[32.6%]">
                                    <input class="w-3.5 h-3.5 text-primary focus:ring-secondary accent-secondary flex-shrink-0" name="help_category" type="radio" value="need_help">
                                    <span class="font-body-sm text-xs text-on-surface font-medium whitespace-nowrap">Not sure need guidance</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                        <div>
                            <label class="font-label-caps text-label-caps uppercase text-on-surface-variant block mb-space-xs font-semibold" for="client-name">NAME</label>
                            <input class="w-full px-space-md py-3 rounded-lg bg-surface-container-lowest border border-outline-variant/30 text-on-surface font-body-md text-body-md shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary" id="client-name" name="name" placeholder="Enter your name" required type="text">
                        </div>
                        <div>
                            <label class="font-label-caps text-label-caps uppercase text-on-surface-variant block mb-space-xs font-semibold" for="client-email">EMAIL</label>
                            <input class="w-full px-space-md py-3 rounded-lg bg-surface-container-lowest border border-outline-variant/30 text-on-surface font-body-md text-body-md shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary" id="client-email" name="email" placeholder="Enter your email" required type="email">
                        </div>
                    </div>
                    <div>
                        <label class="font-label-caps text-label-caps uppercase text-on-surface-variant block mb-space-xs font-semibold" for="client-phone">PHONE</label>
                        <input class="w-full px-space-md py-3 rounded-lg bg-surface-container-lowest border border-outline-variant/30 text-on-surface font-body-md text-body-md shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary" id="client-phone" name="phone" placeholder="Enter your contact number" type="tel">
                    </div>
                    <div>
                        <label class="font-label-caps text-label-caps uppercase text-on-surface-variant block mb-space-xs font-semibold" for="notes">MESSAGE / RELEVANT DETAILS</label>
                        <textarea class="w-full px-space-md py-3 rounded-lg bg-surface-container-lowest border border-outline-variant/30 text-on-surface font-body-md text-body-md shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary" id="notes" name="message" placeholder="Tell us what you're trying to improve, fix or grow." rows="3"></textarea>
                    </div>
                    <button class="w-full py-4 rounded-xl bg-primary-container text-on-primary font-title-md text-title-md uppercase tracking-wider font-semibold transition-all hover:bg-primary-fixed-dim hover:text-on-primary-fixed shadow-lg flex items-center justify-center gap-space-sm shimmer-sweep-btn" id="btn-submit-audit" type="submit">
                        <span id="btn-submit-audit-label">{{ $submitLabel }}</span>
                        <span class="material-symbols-outlined text-secondary-container text-lg">check_circle</span>
                    </button>
                    <div class="hidden text-center p-space-sm rounded bg-surface-container text-secondary font-label-caps text-label-caps uppercase font-bold" id="form-feedback" data-success-message="{{ $successMessage }}"></div>
                    <div class="hidden text-center p-space-sm rounded bg-error-container text-on-error-container font-body-sm text-body-sm" id="form-error"></div>
                </form>
            </div>
        </div>
    </div>
</section>
