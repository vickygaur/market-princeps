<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSiteSettings();
        $this->seedServiceCategories();
        $this->seedAdminUser();

        $page = Page::query()->updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home',
                'template' => 'home',
                'is_published' => true,
                'published_at' => now(),
                'meta_title' => 'Market Princeps | Growth Architecture',
                'meta_description' => 'Market Princeps brings marketing, technology, and business systems together to turn attention into customers, inefficiencies into opportunities, and ideas into scalable growth.',
                'meta_keywords' => 'marketing agency, custom software, business optimization, growth architecture, SEO, performance marketing, ERP development, digital transformation',
                'og_title' => 'Market Princeps | Growth Architecture',
                'og_description' => 'Marketing, technology, and business growth in one place. Built around your business—not a one-size-fits-all package.',
                'og_image' => null,
                'canonical_url' => url('/'),
                'robots' => 'index, follow',
                'schema_markup' => json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'Organization',
                    'name' => 'Market Princeps',
                    'url' => url('/'),
                    'email' => 'connect@marketprinceps.com',
                    'telephone' => '+91-9625330200',
                    'description' => 'Market Princeps brings marketing, technology, and business systems together to turn attention into customers and scalable growth.',
                ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
            ]
        );

        $this->seedPageSections($page);
    }

    protected function seedSiteSettings(): void
    {
        $settings = [
            ['group' => 'brand', 'key' => 'site_name', 'value' => 'Market Princeps', 'type' => 'text', 'label' => 'Site Name'],
            ['group' => 'brand', 'key' => 'brand_name', 'value' => 'Market Princeps', 'type' => 'text', 'label' => 'Brand Name'],
            ['group' => 'brand', 'key' => 'brand_tagline', 'value' => 'Growth Architecture', 'type' => 'text', 'label' => 'Brand Tagline'],
            ['group' => 'contact', 'key' => 'contact_email', 'value' => 'connect@marketprinceps.com', 'type' => 'text', 'label' => 'Contact Email'],
            ['group' => 'contact', 'key' => 'contact_phone', 'value' => '+91-9625330200', 'type' => 'text', 'label' => 'Contact Phone'],
            ['group' => 'footer', 'key' => 'footer_description', 'value' => 'We help businesses attract the right customers, build the technology they need, and improve the way their business works.', 'type' => 'textarea', 'label' => 'Footer Description'],
            ['group' => 'seo', 'key' => 'meta_title', 'value' => 'Market Princeps | Growth Architecture', 'type' => 'text', 'label' => 'Default Meta Title'],
            ['group' => 'seo', 'key' => 'meta_description', 'value' => 'Market Princeps brings marketing, technology, and business systems together to turn attention into customers, inefficiencies into opportunities, and ideas into scalable growth.', 'type' => 'textarea', 'label' => 'Default Meta Description'],
            ['group' => 'seo', 'key' => 'meta_keywords', 'value' => 'marketing, technology, business optimization, growth architecture, SEO, custom software, digital transformation', 'type' => 'text', 'label' => 'Default Meta Keywords'],
            ['group' => 'seo', 'key' => 'og_title', 'value' => 'Market Princeps | Growth Architecture', 'type' => 'text', 'label' => 'Default OG Title'],
            ['group' => 'seo', 'key' => 'og_description', 'value' => 'Marketing. Technology. Business growth. One place.', 'type' => 'textarea', 'label' => 'Default OG Description'],
            ['group' => 'seo', 'key' => 'robots', 'value' => 'index, follow', 'type' => 'text', 'label' => 'Default Robots'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::query()->updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }

    protected function seedServiceCategories(): void
    {
        $categories = [
            [
                'name' => 'Marketing & Demand',
                'slug' => 'marketing-demand',
                'badge_label' => 'text-secondary',
                'badge_color' => 'bg-secondary-container beacon-pulse',
                'icon' => 'ads_click',
                'sort_order' => 1,
                'services' => [
                    'SEO Services',
                    'Performance Marketing',
                    'Social Media Marketing',
                    'Content Marketing',
                    'Email Marketing & Automation',
                    'Website & CRO',
                ],
            ],
            [
                'name' => 'Custom Technology',
                'slug' => 'custom-technology',
                'badge_label' => 'text-primary',
                'badge_color' => 'bg-primary-container',
                'icon' => 'terminal',
                'sort_order' => 2,
                'services' => [
                    'Custom Software Development',
                    'ERP Development',
                    'Business Platform Development',
                    'Web Application Development',
                    'Business Automation',
                    'Systems Integration',
                ],
            ],
            [
                'name' => 'Business Optimization',
                'slug' => 'business-optimization',
                'badge_label' => 'text-on-tertiary-container',
                'badge_color' => 'bg-on-tertiary-container',
                'icon' => 'cached',
                'sort_order' => 3,
                'services' => [
                    'Business Optimization',
                    'CRM Optimization & Automation',
                    'Digital Transformation',
                ],
            ],
        ];

        foreach ($categories as $index => $categoryData) {
            $services = $categoryData['services'];
            unset($categoryData['services']);

            $category = ServiceCategory::query()->updateOrCreate(
                ['slug' => $categoryData['slug']],
                array_merge($categoryData, [
                    'description' => null,
                    'is_active' => true,
                    'show_in_nav' => true,
                    'show_in_footer' => true,
                    'meta_title' => $categoryData['name'].' | Market Princeps',
                    'meta_description' => 'Explore '.$categoryData['name'].' capabilities from Market Princeps—built around your business.',
                    'robots' => 'index, follow',
                ])
            );

            foreach ($services as $sortOrder => $serviceName) {
                Service::query()->updateOrCreate(
                    [
                        'service_category_id' => $category->id,
                        'slug' => Str::slug($serviceName),
                    ],
                    [
                        'name' => $serviceName,
                        'short_description' => null,
                        'description' => null,
                        'icon' => null,
                        'url' => '#triad-content',
                        'sort_order' => $sortOrder + 1,
                        'is_active' => true,
                        'show_in_nav' => true,
                        'show_in_footer' => true,
                        'robots' => 'index, follow',
                    ]
                );
            }
        }
    }

    protected function seedAdminUser(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@marketprinceps.com'],
            [
                'name' => 'Market Princeps Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }

    protected function seedPageSections(Page $page): void
    {
        $sections = [
            [
                'key' => 'hero',
                'name' => 'Hero',
                'sort_order' => 1,
                'content' => $this->heroContent(),
            ],
            [
                'key' => 'metrics',
                'name' => 'Metrics',
                'sort_order' => 2,
                'content' => $this->metricsContent(),
            ],
            [
                'key' => 'philosophy',
                'name' => 'Philosophy',
                'sort_order' => 3,
                'content' => $this->philosophyContent(),
            ],
            [
                'key' => 'triad',
                'name' => 'Triad Capabilities',
                'sort_order' => 4,
                'content' => $this->triadContent(),
            ],
            [
                'key' => 'simulator',
                'name' => 'Team Capacity Simulator',
                'sort_order' => 5,
                'content' => $this->simulatorContent(),
            ],
            [
                'key' => 'process',
                'name' => 'Process',
                'sort_order' => 6,
                'content' => $this->processContent(),
            ],
            [
                'key' => 'intake',
                'name' => 'Contact Intake',
                'sort_order' => 7,
                'content' => $this->intakeContent(),
            ],
        ];

        foreach ($sections as $section) {
            PageSection::query()->updateOrCreate(
                [
                    'page_id' => $page->id,
                    'key' => $section['key'],
                ],
                [
                    'name' => $section['name'],
                    'content' => $section['content'],
                    'sort_order' => $section['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function heroContent(): array
    {
        $modes = [
            'attract' => [
                'subhead' => 'STAGE 01 // DEMAND & MARKET CAPTURE',
                'status' => 'ATTRACTING ELITE DEMAND // AWARENESS → ENGAGEMENT → QUALIFIED PIPELINE',
                'cards' => [
                    ['tag' => 'REACH', 'title' => 'Precision Authority Inflow', 'desc' => 'Target high-intent institutional buyers through verified executive distribution.'],
                    ['tag' => 'POSITIONING', 'title' => 'Irrefutable Strategic Framing', 'desc' => 'Command immediate distinction from generic agencies and commodity services.'],
                    ['tag' => 'TOUCHPOINTS', 'title' => 'Diagnostic Interactive Portals', 'desc' => 'Engage buyers through proprietary diagnostic tools and custom assessments.'],
                    ['tag' => 'DEMAND', 'title' => 'Pre-Vetted Inbound Mesh', 'desc' => 'Systematically filter unqualified noise; deliver ready-to-close dossiers.'],
                ],
            ],
            'convert' => [
                'subhead' => 'STAGE 02 // VELOCITY & COMMERCIAL CONVERSION',
                'status' => 'FRICTIONLESS CONVERSION // VERIFICATION → VELOCITY → CONTRACTED CAPITAL',
                'cards' => [
                    ['tag' => 'VELOCITY', 'title' => 'Automated Executive Briefings', 'desc' => 'Eliminate sales friction with real-time, customized executive dossiers.'],
                    ['tag' => 'PROOF', 'title' => 'Institutional ROI Telemetry', 'desc' => 'Demonstrate operational math and clear net-margin expansion before signing.'],
                    ['tag' => 'GOVERNANCE', 'title' => 'Frictionless Onboarding', 'desc' => 'Automate mutual NDAs, master agreements, and secure client payment portals.'],
                    ['tag' => 'CAPITAL', 'title' => 'Accelerated Contract Value', 'desc' => 'Compress enterprise sales cycles from months to days with high-trust systems.'],
                ],
            ],
            'optimize' => [
                'subhead' => 'STAGE 03 // EBITDA MULTIPLIER & COMPOUNDING SCALE',
                'status' => 'COMPOUNDING SCALE // RETENTION → MARGIN EXPANSION → ENTERPRISE EQUITY',
                'cards' => [
                    ['tag' => 'INTEGRATION', 'title' => 'Custom Middleware & ERP Sync', 'desc' => 'Connect CRM, delivery pipelines, and client portals with zero manual drag.'],
                    ['tag' => 'MARGIN', 'title' => 'Headcount Overhead Elimination', 'desc' => 'Scale client volume 3x without hiring additional account managers or coordinators.'],
                    ['tag' => 'EXPANSION', 'title' => 'Algorithmic Account Retention', 'desc' => 'Automate SLA monitoring, predictive renewals, and organic expansion triggers.'],
                    ['tag' => 'SOVEREIGNTY', 'title' => 'Enterprise Valuation Multiplier', 'desc' => 'Build compounding enterprise value backed by proprietary technological assets.'],
                ],
            ],
        ];

        return [
            'headline' => [
                'line1_emphasis' => 'Attention',
                'line1_rest' => ' gets you noticed.',
                'line2_prefix' => 'What you build after that makes you ',
                'line2_emphasis' => 'grow.',
            ],
            'title_html' => '<span class="shimmer-text-glow font-semibold">Attention</span> gets you noticed.<br>What you build after that makes you <span class="shimmer-text-glow font-semibold">grow.</span>',
            'subhead' => 'Market Princeps brings marketing, technology, and business systems together to turn attention into customers, inefficiencies into opportunities, and ideas into scalable growth.',
            'cta_primary_label' => 'build something better',
            'cta_primary_url' => '#intake',
            'cta_secondary_label' => 'Explore our approach',
            'cta_secondary_url' => '#simulator',
            'trust_note' => 'Marketing. Technology. Business growth. One place.',
            'console_title' => 'HOW WE BUILD YOUR GROWTH ENGINE',
            'modes' => $modes,
            'console_modes' => $modes,
            'hero_subhead_default' => $modes['attract']['subhead'],
            'hero_status_default' => $modes['attract']['status'],
            'nodes_default' => $modes['attract']['cards'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function metricsContent(): array
    {
        $items = [
            [
                'icon' => 'developer_board',
                'value' => 'Since 2020',
                'title' => 'Built through experience',
                'description' => 'Working with businesses since 2020 has taught us that every business needs its own solution.',
            ],
            [
                'icon' => 'assured_workload',
                'value' => '15+ Sectors',
                'title' => 'Broad industry experience',
                'description' => 'From schools and real estate to e-commerce, retail, restaurants, green energy and more.',
                'accent' => 'secondary',
            ],
            [
                'icon' => 'group_work',
                'value' => '360° view',
                'title' => 'We look beyond marketing',
                'description' => 'We look at marketing, technology, sales and operations to understand what drives growth.',
            ],
            [
                'icon' => 'language',
                'value' => 'One Approach',
                'title' => 'Built around your business',
                'description' => "We don't force businesses into ready-made packages. We build what their business actually needs.",
            ],
        ];

        return [
            'items' => $items,
            'cards' => [
                [
                    'icon' => 'developer_board',
                    'icon_bg' => 'bg-primary-container text-secondary-container',
                    'stat' => 'Since 2020',
                    'title' => 'Built through experience',
                    'body' => 'Working with businesses since 2020 has taught us that every business needs its own solution.',
                    'float' => 'float-slow',
                ],
                [
                    'icon' => 'assured_workload',
                    'icon_bg' => 'bg-surface-container text-secondary',
                    'stat' => '15+ Sectors',
                    'stat_class' => 'text-secondary',
                    'title' => 'Broad industry experience',
                    'body' => 'From schools and real estate to e-commerce, retail, restaurants, green energy and more.',
                    'float' => 'float-delayed',
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
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function philosophyContent(): array
    {
        $left = [
            'badge' => 'THE USUAL APPROACH',
            'title' => 'Growth in Pieces',
            'body' => 'Marketing, technology and operations are often handled separately. That can mean more leads without better systems, more tools without better processes, and more activity without meaningful growth.',
            'items' => [
                'More leads, but no system to handle them.',
                'More tools, but more work to manage them.',
                'More activity, but no clear link to revenue.',
            ],
        ];

        $right = [
            'badge' => 'THE MARKET PRINCEPS APPROACH',
            'title' => 'Everything Works Together',
            'body' => 'We connect marketing, technology and business processes around one goal: helping your business attract better opportunities, convert them, and operate more efficiently.',
            'items' => [
                'Marketing that brings the right opportunities to your door.',
                'Technology that turns opportunities into action.',
                'Systems that help your business grow without complexity.',
            ],
        ];

        return [
            'eyebrow' => '✦ SYSTEM PHILOSOPHY',
            'title' => 'What changes when everything works together?',
            'subtitle' => 'Most agencies solve one problem at a time. We look at how the whole business works, then build the right pieces to help it grow.',
            'left' => $left,
            'right' => $right,
            'cta_label' => "LET'S FIND YOUR NEXT GROWTH OPPORTUNITY",
            'cta_url' => '#intake',
            'heading' => 'What changes when everything works together?',
            'intro' => 'Most agencies solve one problem at a time. We look at how the whole business works, then build the right pieces to help it grow.',
            'usual_label' => $left['badge'],
            'usual_title' => $left['title'],
            'usual_body' => $left['body'],
            'usual_items' => $left['items'],
            'mp_label' => $right['badge'],
            'mp_title' => $right['title'],
            'mp_body' => $right['body'],
            'mp_items' => $right['items'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function triadContent(): array
    {
        $pillars = [
            'p1' => [
                'button_label' => 'MARKETING & DEMAND',
                'button_icon' => 'ads_click',
                'badge' => 'PILLAR 01 // PRECISION ACQUISITION MESH',
                'title' => 'Attracting high-value institutional buyers while systematically eliminating unqualified noise.',
                'desc' => 'We construct custom intent-scoring scrapers, private executive briefings, and automated gating mechanisms. Leads are not dumped into a chaotic mailbox; they are algorithmic dossiers delivered directly to your senior decision-makers ready to close.',
                'm1_label' => 'focus',
                'm1_val' => '92.4% Institutional',
                'm2_label' => 'goal',
                'm2_val' => '-41.8% Net Spend',
                'telemetry' => 'Telemetry 28.4% Conv',
                'flow_label' => 'marketing flow',
                'cta_label' => 'EXPLORE MARKETING',
                'stages' => [
                    ['n' => '1', 'name' => 'Category Authority Gateway', 'val' => '8,400 Imp'],
                    ['n' => '2', 'name' => 'Diagnostic Intake & Dossier', 'val' => '412 Submits'],
                    ['n' => '3', 'name' => 'Sovereign Partner Briefing', 'val' => '64 Closed'],
                ],
                'm1Val' => '92.4% Institutional',
                'm2Val' => '-41.8% Net Spend',
                'flowLabel' => 'marketing flow',
                'cta' => 'EXPLORE MARKETING',
            ],
            'p2' => [
                'button_label' => 'CUSTOM TECHNOLOGY',
                'button_icon' => 'terminal',
                'badge' => 'PILLAR 02 // BUSINESS TECH & CUSTOM ERP',
                'title' => 'Replacing 8 scattered SaaS subscriptions with one singular, ultra-responsive operational command center.',
                'desc' => 'Custom engineered web portals and database schemas tailored specifically to your exact service delivery rules. Eliminate human data-entry bottlenecks, automate partner reporting, and establish total system auditability.',
                'm1_label' => 'focus',
                'm1_val' => '100% In-House Code',
                'm2_label' => 'goal',
                'm2_val' => '76% Zero-Touch',
                'telemetry' => 'System SLA 99.99%',
                'flow_label' => 'technology flow',
                'cta_label' => 'EXPLORE TECHNOLOGY',
                'stages' => [
                    ['n' => '1', 'name' => 'Unified Relational Database', 'val' => '0 Redundancies'],
                    ['n' => '2', 'name' => 'Automated Account Provisioning', 'val' => '0.8s Execution'],
                    ['n' => '3', 'name' => 'Real-Time Financial Ledger', 'val' => 'Live Sync'],
                ],
                'm1Val' => '100% In-House Code',
                'm2Val' => '76% Zero-Touch',
                'flowLabel' => 'technology flow',
                'cta' => 'EXPLORE TECHNOLOGY',
            ],
            'p3' => [
                'button_label' => 'BUSINESS OPTIMIZATION',
                'button_icon' => 'cached',
                'badge' => 'PILLAR 03 // OPERATIONAL MULTIPLIER',
                'title' => 'Decoupling revenue expansion from linear operator hiring, safeguarding net margins.',
                'desc' => 'When delivery processes run through engineered pipelines rather than memory and spreadsheets, 10x volume requires 0x additional administrative heads. Net margin flows directly to retained enterprise value.',
                'm1_label' => 'focus',
                'm1_val' => '+44.2% EBITDA',
                'm2_label' => 'goal',
                'm2_val' => '< 0.05% Error Mesh',
                'telemetry' => 'Scale Velocity 4.2x',
                'flow_label' => 'optimization flow',
                'cta_label' => 'EXPLORE OPTIMIZATION',
                'stages' => [
                    ['n' => '1', 'name' => 'Automated SLA Routing', 'val' => 'Instant'],
                    ['n' => '2', 'name' => 'Vendor & Resource Dispatch', 'val' => 'Dynamic AI'],
                    ['n' => '3', 'name' => 'Capital Retention Matrix', 'val' => '+38% Margin'],
                ],
                'm1Val' => '+44.2% EBITDA',
                'm2Val' => '< 0.05% Error Mesh',
                'flowLabel' => 'optimization flow',
                'cta' => 'EXPLORE OPTIMIZATION',
            ],
        ];

        $p1 = $pillars['p1'];

        return [
            'eyebrow' => 'OUR CAPABILITIES',
            'title' => 'Three ways we help your business grow',
            'subtitle' => 'Marketing brings the right opportunities. Technology helps you convert them. Better systems help you scale them.',
            'pillars' => $pillars,
            'heading' => 'Three ways we help your business grow',
            'intro' => 'Marketing brings the right opportunities. Technology helps you convert them. Better systems help you scale them.',
            'tab1_label' => $pillars['p1']['button_label'],
            'tab2_label' => $pillars['p2']['button_label'],
            'tab3_label' => $pillars['p3']['button_label'],
            'default_badge' => $p1['badge'],
            'default_title' => $p1['title'],
            'default_desc' => $p1['desc'],
            'default_metric_1' => $p1['m1_val'],
            'default_metric_2' => $p1['m2_val'],
            'default_telemetry' => $p1['telemetry'],
            'flow_label' => $p1['flow_label'],
            'cta_label' => $p1['cta_label'],
            'default_stages' => $p1['stages'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function simulatorContent(): array
    {
        return [
            'eyebrow' => 'TEAM CAPACITY CHECK',
            'title' => 'What could your team do with more time?',
            'subtitle' => 'See how much productive capacity you could unlock by reducing the manual work your skilled team handles every month.',
            'defaults' => [
                'employees' => 7,
                'manual' => 20,
                'revenue_work' => 80,
                'team_cost' => 50000,
                'monthly_revenue' => 1000000,
            ],
            'labels' => [
                'employees' => 'RELEVANT TEAM SIZE',
                'employees_hint' => 'How many skilled team members are involved in manual tasks?',
                'manual' => 'MANUAL WORK',
                'manual_hint' => "How much of your team's time goes into manual work?",
                'revenue_work' => 'REVENUE-FOCUSED WORK',
                'revenue_work_hint' => 'How much of their time goes toward work that directly supports revenue and growth?',
                'team_cost' => 'AVERAGE RESOURCE COST',
                'team_cost_hint' => 'What is the average monthly salary of these team members?',
                'monthly_revenue' => 'MONTHLY REVENUE',
                'monthly_revenue_hint' => 'What is your average monthly business revenue?',
            ],
            'result_labels' => [
                'scenario_title' => 'WHAT IF MANUAL WORK DROPPED BY 50%?',
                'scenario_desc' => 'See what happens when half of your current manual workload becomes available for higher-value work.',
                'productive_time' => 'PRODUCTIVE TIME UNLOCKED',
                'productive_time_hint' => 'Potential capacity recovered from manual work.',
                'revenue_capacity' => 'REVENUE CAPACITY POTENTIAL',
                'revenue_capacity_hint' => 'Potential increase in revenue-focused capacity if recovered time is redirected toward growth.',
                'modeled_revenue' => 'MODELED REVENUE CAPACITY',
                'disclaimer' => 'NOT A REVENUE GUARANTEE.',
                'disclaimer_body' => 'This is a scenario based on the information you provide. Actual results depend on how your team uses the recovered capacity.',
            ],
            'cta' => 'SEE HOW WE CAN UNLOCK IT',
            'heading' => 'What could your team do with more time?',
            'intro' => 'See how much productive capacity you could unlock by reducing the manual work your skilled team handles every month.',
            'output_title' => 'WHAT IF MANUAL WORK DROPPED BY 50%?',
            'output_desc' => 'See what happens when half of your current manual workload becomes available for higher-value work.',
            'cta_label' => 'SEE HOW WE CAN UNLOCK IT',
            'default_employees' => 7,
            'default_manual_percent' => 20,
            'default_revenue_percent' => 80,
            'default_salary' => 50000,
            'default_monthly_revenue' => 1000000,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function processContent(): array
    {
        $steps = [
            [
                'number' => '01',
                'num' => '01',
                'title' => 'UNDERSTAND',
                'description' => "We learn how your business works, what you're trying to achieve, and where time, money or opportunities are being lost.",
                'body' => "We learn how your business works, what you're trying to achieve, and where time, money or opportunities are being lost.",
                'footer_icon' => 'visibility',
                'icon' => 'visibility',
                'footer_label' => 'UNDERSTAND THE REAL PROBLEM',
                'footer' => 'UNDERSTAND THE REAL PROBLEM',
            ],
            [
                'number' => '02',
                'num' => '02',
                'title' => 'PLAN',
                'description' => 'We identify where marketing, technology or process improvements can create the most value and define what needs to change.',
                'body' => 'We identify where marketing, technology or process improvements can create the most value and define what needs to change.',
                'footer_icon' => 'architecture',
                'icon' => 'architecture',
                'footer_label' => 'FOCUS ON WHAT MATTERS',
                'footer' => 'FOCUS ON WHAT MATTERS',
            ],
            [
                'number' => '03',
                'num' => '03',
                'title' => 'BUILD',
                'description' => 'We build, implement and connect the right tools, systems and workflows around the way your business actually operates.',
                'body' => 'We build, implement and connect the right tools, systems and workflows around the way your business actually operates.',
                'footer_icon' => 'code',
                'icon' => 'code',
                'footer_label' => 'TURN THE PLAN INTO ACTION',
                'footer' => 'TURN THE PLAN INTO ACTION',
            ],
            [
                'number' => '04',
                'num' => '04',
                'title' => 'IMPROVE',
                'description' => 'We measure what changes, remove new friction and improve the system as your customers, team and business evolve.',
                'body' => 'We measure what changes, remove new friction and improve the system as your customers, team and business evolve.',
                'footer_icon' => 'trending_up',
                'icon' => 'trending_up',
                'footer_label' => 'IMPROVE AS BUSINESS GROWS',
                'footer' => 'IMPROVE AS BUSINESS GROWS',
            ],
        ];

        return [
            'eyebrow' => 'HOW WE WORK',
            'title' => 'From business problem to practical solution.',
            'subtitle' => 'We start by understanding your business, then identify what can improve, build what you need, and keep refining it as your business grows.',
            'steps' => $steps,
            'cta_label' => 'START WITH YOUR BUSINESS',
            'cta_note' => 'No fixed package. No one-size-fits-all solution.',
            'heading' => 'From business problem to practical solution.',
            'intro' => 'We start by understanding your business, then identify what can improve, build what you need, and keep refining it as your business grows.',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function intakeContent(): array
    {
        $features = [
            [
                'icon' => 'diamond',
                'title' => 'NO ONE-SIZE-FITS-ALL PACKAGES',
                'description' => "We don't force your business into a predefined service. We build around what you actually need.",
            ],
            [
                'icon' => 'shield',
                'title' => 'BUSINESS-FIRST CONVERSATION',
                'description' => "We'll first understand your goals, challenges and current setup before suggesting anything.",
            ],
            [
                'icon' => 'layers',
                'title' => 'ONE PLACE FOR THE BIGGER PICTURE',
                'description' => 'Marketing, technology and business optimization can work together when your business needs more than one solution.',
            ],
        ];

        return [
            'badge' => "LET'S TALK ABOUT YOUR BUSINESS",
            'title' => "Tell us where you want to go. We'll help you figure out how to get there.",
            'body' => "Whether you need more customers, better technology, smoother processes or all three, start with the problem. We'll understand your business before recommending a solution.",
            'features' => $features,
            'tip_label' => 'NOT SURE WHAT YOU NEED?',
            'tip_text' => "That's okay. We'll help you find the right direction.",
            'form_labels' => [
                'help_category' => 'WHAT CAN WE HELP YOU WITH?',
                'help_category_hint' => '(SELECT ONE)',
                'name' => 'NAME',
                'email' => 'EMAIL',
                'phone' => 'PHONE',
                'message' => 'MESSAGE / RELEVANT DETAILS',
                'name_placeholder' => 'Enter your name',
                'email_placeholder' => 'Enter your email',
                'phone_placeholder' => 'Enter your contact number',
                'message_placeholder' => "Tell us what you're trying to improve, fix or grow.",
            ],
            'submit_label' => "LET'S TALK ABOUT YOUR BUSINESS",
            'success_message' => 'Mandate received. A Senior Partner will review your telemetry within 4 hours.',
            'heading' => "Tell us where you want to go. We'll help you figure out how to get there.",
            'intro' => "Whether you need more customers, better technology, smoother processes or all three, start with the problem. We'll understand your business before recommending a solution.",
            'highlights' => array_map(fn (array $feature) => [
                'icon' => $feature['icon'],
                'title' => $feature['title'],
                'body' => $feature['description'],
            ], $features),
            'aside_title' => 'NOT SURE WHAT YOU NEED?',
            'aside_body' => "That's okay. We'll help you find the right direction.",
        ];
    }
}
