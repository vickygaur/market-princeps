@php
    $s = $sections['simulator'] ?? [];
    $eyebrow = data_get($s, 'eyebrow', 'TEAM CAPACITY CHECK');
    $heading = data_get($s, 'heading', 'What could your team do with more time?');
    $intro = data_get($s, 'intro', 'See how much productive capacity you could unlock by reducing the manual work your skilled team handles every month.');
    $outputTitle = data_get($s, 'output_title', 'WHAT IF MANUAL WORK DROPPED BY 50%?');
    $outputDesc = data_get($s, 'output_desc', 'See what happens when half of your current manual workload becomes available for higher-value work.');
    $ctaLabel = data_get($s, 'cta_label', 'SEE HOW WE CAN UNLOCK IT');
    $defaultEmployees = data_get($s, 'default_employees', 7);
    $defaultManual = data_get($s, 'default_manual_percent', 20);
    $defaultRevenueWork = data_get($s, 'default_revenue_percent', 80);
    $defaultSalary = data_get($s, 'default_salary', 50000);
    $defaultRevenue = data_get($s, 'default_monthly_revenue', 1000000);
@endphp
<section class="w-full bg-surface-container-low px-margin-mobile md:px-margin py-space-xl" id="simulator">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col items-center text-center mb-space-xl">
            <span class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-semibold mb-space-xs">{{ $eyebrow }}</span>
            <h2 class="font-headline-lg text-headline-lg md:text-[38px] md:leading-tight text-on-surface max-w-2xl font-semibold">{{ $heading }}</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mt-space-sm">{{ $intro }}</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-center">
            <div class="lg:col-span-7 bg-surface-container-lowest p-space-lg md:p-space-xl rounded-2xl shadow-md flex flex-col gap-space-lg border border-outline-variant/30">
                <div>
                    <div class="flex items-center justify-between mb-space-xs">
                        <label class="font-title-md text-title-md text-on-surface" for="employees-range">RELEVANT TEAM SIZE</label>
                        <span class="font-title-md text-title-md text-secondary font-bold transition-all" id="employees-display">{{ $defaultEmployees }} team members</span>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-sm">How many skilled team members are involved in manual tasks?</p>
                    <div class="relative flex items-center">
                        <input class="w-full px-space-md py-3 rounded-lg bg-surface-container-low border border-outline-variant/30 text-on-surface font-title-md text-title-md focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-secondary transition-all" id="employees-range" max="10000" min="1" onchange="calculateSimulator()" oninput="calculateSimulator()" step="1" type="number" value="{{ $defaultEmployees }}">
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-space-xs">
                        <label class="font-title-md text-title-md text-on-surface" for="spend-range">MANUAL WORK</label>
                        <span class="font-title-md text-title-md text-secondary font-bold transition-all" id="spend-display">{{ $defaultManual }}%</span>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-sm">How much of your team's time goes into manual work?</p>
                    <input class="w-full h-2 bg-surface-container rounded-lg appearance-none cursor-pointer accent-secondary transition-all" id="spend-range" max="100" min="0" onchange="syncManualToRevenue(this.value)" oninput="syncManualToRevenue(this.value)" step="5" type="range" value="{{ $defaultManual }}">
                </div>
                <div>
                    <div class="flex items-center justify-between mb-space-xs">
                        <label class="font-title-md text-title-md text-on-surface" for="tools-range">REVENUE-FOCUSED WORK</label>
                        <span class="font-title-md text-title-md text-secondary font-bold transition-all" id="tools-display">{{ $defaultRevenueWork }}%</span>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-sm">How much of their time goes toward work that directly supports revenue and growth?</p>
                    <input class="w-full h-2 bg-surface-container rounded-lg appearance-none cursor-pointer accent-secondary transition-all" id="tools-range" max="100" min="0" onchange="syncRevenueToManual(this.value)" oninput="syncRevenueToManual(this.value)" step="5" type="range" value="{{ $defaultRevenueWork }}">
                </div>
                <div>
                    <div class="flex items-center justify-between mb-space-xs">
                        <label class="font-title-md text-title-md text-on-surface" for="team-range">AVERAGE RESOURCE COST</label>
                        <span class="font-title-md text-title-md text-secondary font-bold transition-all" id="team-display">₹{{ number_format($defaultSalary, 0, '.', ',') }}</span>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-sm">What is the average monthly salary of these team members?</p>
                    <input class="w-full h-2 bg-surface-container rounded-lg appearance-none cursor-pointer accent-secondary transition-all" id="team-range" max="300000" min="10000" onchange="calculateSimulator()" oninput="calculateSimulator()" step="5000" type="range" value="{{ $defaultSalary }}">
                </div>
                <div class="pt-space-xs border-t border-outline-variant/20">
                    <div class="flex items-center justify-between mb-space-xs">
                        <label class="font-title-md text-title-md text-on-surface" for="revenue-input">MONTHLY REVENUE</label>
                        <span class="font-title-md text-title-md text-secondary font-bold transition-all" id="revenue-display">₹{{ number_format($defaultRevenue, 0, '.', ',') }} / mo</span>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-sm">What is your average monthly business revenue?</p>
                    <div class="relative flex items-center">
                        <span class="absolute left-3.5 text-secondary font-bold font-title-md text-title-md pointer-events-none">₹</span>
                        <input class="w-full pl-8 pr-space-md py-3 rounded-lg bg-surface-container-low border border-outline-variant/30 text-on-surface font-title-md text-title-md focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-secondary transition-all" id="revenue-input" max="100000000" min="50000" onchange="calculateSimulator()" oninput="calculateSimulator()" step="50000" type="number" value="{{ $defaultRevenue }}">
                    </div>
                </div>
            </div>
            <div class="lg:col-span-5 bg-primary-container text-on-primary p-space-lg md:p-space-xl rounded-2xl shadow-xl flex flex-col justify-between card-hover-elevate relative overflow-hidden">
                <div>
                    <div class="pb-space-sm mb-space-md">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-label-caps text-label-caps uppercase text-secondary-container font-semibold tracking-wider">{{ $outputTitle }}</span>
                            <span class="w-2.5 h-2.5 rounded-full bg-secondary-container beacon-pulse"></span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-primary-container leading-relaxed">{{ $outputDesc }}</p>
                    </div>
                    <div class="mb-space-md">
                        <span class="font-label-caps text-label-caps uppercase text-on-primary-container block mb-1 tracking-wider">PRODUCTIVE TIME UNLOCKED</span>
                        <div class="font-display-hero text-headline-lg font-bold text-on-primary transition-all duration-300" id="sim-hours">112 hrs / month</div>
                        <p class="font-body-sm text-body-sm text-on-primary-container mt-1">Potential capacity recovered from manual work.</p>
                    </div>
                    <div class="mb-space-md">
                        <span class="font-label-caps text-label-caps uppercase text-on-primary-container block mb-1 tracking-wider">REVENUE CAPACITY POTENTIAL</span>
                        <div class="font-display-hero text-headline-lg font-bold text-secondary-container transition-all duration-300" id="sim-capacity">+12.5%</div>
                        <p class="font-body-sm text-body-sm text-on-primary-container mt-1">Potential increase in revenue-focused capacity if recovered time is redirected toward growth.</p>
                    </div>
                    <div class="p-space-md rounded-xl bg-surface-container-high/10 mb-space-md border border-secondary-container/20">
                        <span class="font-label-caps text-label-caps uppercase text-secondary-fixed block mb-1 tracking-wider">MODELED REVENUE CAPACITY</span>
                        <div class="font-display-hero text-headline-md font-bold text-on-primary transition-all duration-300" id="sim-modeled">₹11,25,000 / month</div>
                    </div>
                    <div class="mb-space-lg p-space-sm rounded-lg bg-surface-container-high/10 border border-outline-variant/20">
                        <p class="font-body-sm text-body-sm text-on-primary-container leading-relaxed opacity-90">
                            <span class="font-bold text-secondary-fixed">NOT A REVENUE GUARANTEE.</span> This is a scenario based on the information you provide. Actual results depend on how your team uses the recovered capacity.
                        </p>
                    </div>
                </div>
                <a class="w-full inline-flex items-center justify-center gap-space-sm px-space-lg py-3.5 rounded-xl bg-secondary-container text-on-secondary-fixed font-title-md text-title-md uppercase tracking-wider font-semibold transition-all hover:bg-secondary-fixed shadow-md shimmer-sweep-btn" href="#intake">
                    <span>{{ $ctaLabel }}</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</section>
