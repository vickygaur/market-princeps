@php
    use App\Models\SiteSetting;

    $s = $sections['hub'] ?? [];
    $settings = $settings ?? [];

    $defaultPhone = $settings['contact_phone'] ?? SiteSetting::getValue('contact_phone', '+91-9625330200');
    $defaultPhoneHref = $settings['contact_phone_href'] ?? SiteSetting::getValue('contact_phone_href', '+919625330200');
    $defaultEmail = $settings['contact_email'] ?? SiteSetting::getValue('contact_email', 'connect@marketprinceps.com');

    $call = data_get($s, 'call', []);
    $callLabel = data_get($call, 'label', 'CALL NOW');
    $callPhone = data_get($call, 'phone', $defaultPhone);
    $callPhoneHref = data_get($call, 'phone_href', $defaultPhoneHref);
    $callHours = data_get($call, 'hours', 'Mon–FRI, 10:00 AM – 7:00 PM IST');
    $callBody = data_get($call, 'body', 'Prefer to talk directly? Give us a call');
    $callBtnLabel = data_get($call, 'call_label', 'CALL NOW');
    $whatsappLabel = data_get($call, 'whatsapp_label', 'WHATSAPP US');
    $whatsappUrl = data_get($call, 'whatsapp_url', 'https://wa.me/919625330200?text=Hello%20Market%20Princeps%20Strategy%20Desk');

    $email = data_get($s, 'email', []);
    $emailLabel = data_get($email, 'label', 'EMAIL US');
    $emailAddress = data_get($email, 'address', $defaultEmail);
    $emailBody = data_get($email, 'body', "Send us your question, business requirement or project details. We'll take it from there.");

    $protocol = data_get($s, 'protocol', []);
    $protocolTitle = data_get($protocol, 'title', 'What happens after you reach out?');
    $protocolSteps = data_get($protocol, 'steps', [
        ['num' => '01', 'title' => 'UNDERSTAND', 'body' => "We learn about your business, what you're trying to achieve and where you're facing a challenge."],
        ['num' => '02', 'title' => 'EXPLORE', 'body' => 'We look at the problem and identify where marketing, technology or business improvement could help.'],
        ['num' => '03', 'title' => 'RECOMMEND', 'body' => "If there's a fit, we'll suggest a practical way forward based on what your business actually needs."],
    ]);

    $form = data_get($s, 'form', []);
    $formEyebrow = data_get($form, 'eyebrow', 'START WITH THE PROBLEM');
    $formTitle = data_get($form, 'title', 'Tell us where you want to go.');
    $formIntro = data_get($form, 'intro', "We'll help you understand what could get you there. Start with what you're trying to improve, fix or grow, and give us enough context to understand the business.");
    $categoryLabel = data_get($form, 'category_label', 'What can we help you with?');
    $categories = data_get($form, 'categories', [
        ['value' => 'marketing', 'label' => 'Marketing & Demand'],
        ['value' => 'technology', 'label' => 'Custom Technology'],
        ['value' => 'optimization', 'label' => 'Business Optimization'],
        ['value' => 'combination', 'label' => 'A combination of all'],
        ['value' => 'need_help', 'label' => 'Not sure / Need guidance'],
    ]);
    $submitLabel = data_get($form, 'submit_label', 'START THE CONVERSATION');
    $successTitle = data_get($form, 'success_title', 'Diagnostic Inquiry Received');
    $successBody = data_get($form, 'success_body', 'A Practice Director is currently evaluating your dossier. We will reach out within 4 hours.');
    $trustBadges = data_get($form, 'trust_badges', [
        ['icon' => 'verified', 'label' => 'BUSINESS-FIRST'],
        ['icon' => 'psychology', 'label' => 'NO ONE-SIZE-FITS-ALL'],
        ['icon' => 'hub', 'label' => 'PRACTICAL NEXT STEPS'],
    ]);

    $topCategories = array_slice($categories, 0, 3);
    $bottomCategories = array_slice($categories, 3);
    $telHref = str_starts_with($callPhoneHref, 'tel:') ? $callPhoneHref : 'tel:'.$callPhoneHref;
@endphp
<section class="w-full px-gutter md:px-margin pb-space-xl">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
        <div class="lg:col-span-5 flex flex-col space-y-space-lg">
            <div class="relative overflow-hidden rounded-xl bg-surface-container-lowest p-space-xl shadow-sm transition-all duration-300 hover:shadow-md flex flex-col justify-between space-y-space-md">
                <div class="flex items-start justify-between gap-space-sm">
                    <div class="flex items-center gap-space-sm">
                        <div class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-secondary shrink-0">
                            <span class="material-symbols-outlined text-[24px]">perm_phone_msg</span>
                        </div>
                        <div>
                            <span class="font-label-caps text-label-caps uppercase text-secondary font-bold tracking-wider block">{{ $callLabel }}</span>
                            <h3 class="font-title-md text-title-md text-primary font-bold">{{ $callPhone }}</h3>
                        </div>
                    </div>
                    <span class="px-space-xs py-0.5 rounded text-[10px] font-label-caps uppercase tracking-wider bg-surface-container text-on-surface-variant font-medium shrink-0">{{ $callHours }}</span>
                </div>
                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">{{ $callBody }}</p>
                <div class="grid grid-cols-2 gap-space-sm pt-space-xs">
                    <a class="h-10 inline-flex items-center justify-center gap-space-xs px-space-md rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-all shadow-sm" href="{{ $telHref }}">
                        <span class="material-symbols-outlined text-[18px] text-secondary-container">call</span>
                        <span>{{ $callBtnLabel }}</span>
                    </a>
                    <a class="h-10 inline-flex items-center justify-center gap-space-xs px-space-md rounded-lg bg-surface-container text-primary font-label-md text-label-md hover:bg-secondary-fixed transition-all" href="{{ $whatsappUrl }}" rel="noopener noreferrer" target="_blank">
                        <span class="material-symbols-outlined text-[18px] text-secondary">chat</span>
                        <span>{{ $whatsappLabel }}</span>
                    </a>
                </div>
            </div>

            <div class="rounded-xl bg-surface-container-lowest p-space-xl shadow-sm transition-all duration-300 hover:shadow-md flex flex-col justify-between space-y-space-md">
                <div class="flex items-center justify-between gap-space-sm">
                    <div class="flex items-center gap-space-sm">
                        <div class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-secondary shrink-0">
                            <span class="material-symbols-outlined text-[24px]">drafts</span>
                        </div>
                        <div>
                            <span class="font-label-caps text-label-caps uppercase text-secondary font-bold tracking-wider block">{{ $emailLabel }}</span>
                            <p class="font-title-md text-title-md text-primary font-bold">
                                <a class="hover:text-secondary transition-colors" href="mailto:{{ $emailAddress }}">{{ $emailAddress }}</a>
                            </p>
                        </div>
                    </div>
                </div>
                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">{{ $emailBody }}</p>
            </div>

            <div class="rounded-xl bg-surface-container-low p-space-xl shadow-sm flex flex-col space-y-space-md">
                <div class="flex items-center gap-space-xs">
                    <span class="material-symbols-outlined text-secondary text-[22px]">account_tree</span>
                    <h4 class="font-title-md text-title-md text-primary font-bold">{{ $protocolTitle }}</h4>
                </div>
                <div class="space-y-space-lg pt-space-xs">
                    @foreach ($protocolSteps as $step)
                        <div class="flex items-start gap-space-md">
                            <div class="w-8 h-8 rounded-lg bg-primary-container text-on-primary flex items-center justify-center font-label-caps text-label-caps font-bold shrink-0">{{ data_get($step, 'num') }}</div>
                            <div class="space-y-space-xs">
                                <h5 class="font-label-md text-label-md text-primary font-bold">{{ data_get($step, 'title') }}</h5>
                                <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">{{ data_get($step, 'body') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="lg:col-span-7">
            <div class="rounded-xl bg-surface-container-lowest p-space-lg md:p-space-xl shadow-md relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-secondary via-secondary-container to-secondary"></div>
                <div class="mb-space-lg">
                    <span class="font-label-caps text-label-caps uppercase tracking-[0.18em] text-secondary font-bold">{{ $formEyebrow }}</span>
                    <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-space-xs mb-space-xs font-bold">{{ $formTitle }}</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">{{ $formIntro }}</p>
                </div>

                <form class="flex flex-col space-y-space-lg" id="contact-lead-form" action="{{ route('leads.store') }}" method="POST" novalidate>
                    @csrf
                    <input type="hidden" name="source" value="contact">

                    <div>
                        <label class="block font-label-caps text-label-caps uppercase tracking-wider text-primary font-bold mb-space-sm">{{ $categoryLabel }}</label>
                        <div class="flex flex-col gap-2 w-full" id="categoryRadioGroup">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 w-full">
                                @foreach ($topCategories as $index => $category)
                                    @php
                                        $value = data_get($category, 'value');
                                        $label = data_get($category, 'label');
                                        $isFirst = $index === 0;
                                    @endphp
                                    <label class="flex items-center justify-center text-center min-h-10 px-2 py-2 rounded-lg cursor-pointer transition-colors {{ $isFirst ? 'bg-primary-container text-on-primary shadow-sm' : 'bg-surface-container text-on-surface hover:bg-surface-container-high' }} font-medium text-xs select-none">
                                        <input class="hidden" name="help_category" type="radio" value="{{ $value }}" @checked($isFirst) onchange="updateCategoryRadios(this)">
                                        <span>{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @if (count($bottomCategories) > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 w-full">
                                    @foreach ($bottomCategories as $category)
                                        <label class="flex items-center justify-center text-center min-h-10 px-2 py-2 rounded-lg cursor-pointer transition-colors bg-surface-container text-on-surface hover:bg-surface-container-high font-medium text-xs select-none">
                                            <input class="hidden" name="help_category" type="radio" value="{{ data_get($category, 'value') }}" onchange="updateCategoryRadios(this)">
                                            <span>{{ data_get($category, 'label') }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                        <div class="flex flex-col space-y-space-xs">
                            <label class="font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant font-semibold" for="contact-full-name">Full Name *</label>
                            <input class="h-10 w-full bg-surface-container-low focus:bg-surface-container-lowest text-on-surface px-space-md rounded-lg outline-none shadow-sm transition-all focus:shadow-md" id="contact-full-name" name="name" placeholder="e.g. Vikramaditya Sharma" required type="text">
                        </div>
                        <div class="flex flex-col space-y-space-xs">
                            <label class="font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant font-semibold" for="contact-work-email">Work Email *</label>
                            <input class="h-10 w-full bg-surface-container-low focus:bg-surface-container-lowest text-on-surface px-space-md rounded-lg outline-none shadow-sm transition-all focus:shadow-md" id="contact-work-email" name="email" placeholder="v.sharma@enterprise.com" required type="email">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                        <div class="flex flex-col space-y-space-xs">
                            <label class="font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant font-semibold" for="contact-phone">Phone Number *</label>
                            <input class="h-10 w-full bg-surface-container-low focus:bg-surface-container-lowest text-on-surface px-space-md rounded-lg outline-none shadow-sm transition-all focus:shadow-md" id="contact-phone" name="phone" placeholder="+91 98100 00000" required type="tel">
                        </div>
                        <div class="flex flex-col space-y-space-xs">
                            <label class="font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant font-semibold" for="contact-company">Company Name</label>
                            <input class="h-10 w-full bg-surface-container-low focus:bg-surface-container-lowest text-on-surface px-space-md rounded-lg outline-none shadow-sm transition-all focus:shadow-md" id="contact-company" name="company" placeholder="Acme Enterprises" type="text">
                        </div>
                    </div>

                    <div class="flex flex-col space-y-space-xs">
                        <div class="flex items-center justify-between gap-space-sm flex-wrap">
                            <label class="font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant font-semibold" for="contact-message">WHAT ARE YOU TRYING TO IMPROVE?</label>
                            <span class="font-body-sm text-body-sm text-outline">Provide detailed context</span>
                        </div>
                        <textarea class="w-full bg-surface-container-low focus:bg-surface-container-lowest text-on-surface p-space-md rounded-lg outline-none shadow-sm transition-all resize-none" id="contact-message" name="message" placeholder="What are you trying to improve, fix or grow? Tell us what's getting in the way, what you've tried, or what you're hoping to achieve." rows="4"></textarea>
                    </div>

                    <div class="p-space-md rounded-lg bg-surface-container-low grid grid-cols-1 sm:grid-cols-3 gap-space-sm items-center text-center">
                        @foreach ($trustBadges as $badge)
                            <div class="flex items-center justify-center gap-space-xs">
                                <span class="material-symbols-outlined text-secondary text-[18px]">{{ data_get($badge, 'icon', 'verified') }}</span>
                                <span class="font-body-sm text-body-sm text-primary font-medium">{{ data_get($badge, 'label') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <p id="contact-form-error" class="hidden font-body-sm text-body-sm text-error font-medium" role="alert"></p>

                    <button class="group relative w-full min-h-10 py-space-md px-space-xl rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-bold tracking-wider uppercase transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5 overflow-hidden flex items-center justify-center" type="submit" id="contact-submit-btn">
                        <div class="absolute inset-0 bg-gradient-to-r from-secondary-container/20 via-transparent to-secondary-container/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative flex items-center justify-center gap-space-sm">
                            <span id="contact-submit-label">{{ $submitLabel }}</span>
                            <span class="material-symbols-outlined text-[20px] transition-transform duration-300 group-hover:translate-x-1 text-secondary-container">arrow_forward</span>
                        </div>
                    </button>

                    <div class="hidden p-space-md rounded-lg bg-primary-container text-on-primary shadow-lg animate-fade-in flex items-center justify-between gap-space-md" id="successToast">
                        <div class="flex items-center gap-space-sm">
                            <span class="material-symbols-outlined text-secondary-container text-[24px]">task_alt</span>
                            <div>
                                <h6 class="font-label-md text-label-md font-bold">{{ $successTitle }}</h6>
                                <p class="font-body-sm text-body-sm text-on-primary-container">{{ $successBody }}</p>
                            </div>
                        </div>
                        <button class="text-on-primary-container hover:text-on-primary shrink-0" type="button" onclick="document.getElementById('successToast').classList.add('hidden')" aria-label="Dismiss">
                            <span class="material-symbols-outlined text-[18px]">close</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
