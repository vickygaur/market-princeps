<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class SeoServicePageSeeder extends Seeder
{
    public function run(): void
    {
        $category = ServiceCategory::query()->where('slug', 'marketing-demand')->first();

        if (! $category) {
            $this->command?->warn('Marketing & Demand category not found. Run HomepageSeeder first.');

            return;
        }

        $service = Service::query()->firstOrCreate(
            ['slug' => 'seo-services'],
            [
                'service_category_id' => $category->id,
                'name' => 'SEO Services',
                'short_description' => 'Search visibility built around intent, relevance, and the journey that follows the click.',
                'sort_order' => 1,
                'is_active' => true,
                'show_in_nav' => true,
                'show_in_footer' => true,
                'robots' => 'index, follow',
            ]
        );

        $service->update([
            'service_category_id' => $category->id,
            'name' => 'SEO Services',
            'short_description' => 'Search visibility built around intent, relevance, and the journey that follows the click.',
            'url' => null,
            'page_content' => $this->seoPageContent(),
            'meta_title' => 'SEO Services | Market Princeps - Growth Architecture',
            'meta_description' => 'SEO that helps the right people find your business. Intent-led search strategy, technical foundations, useful content, and conversion-aware measurement from Market Princeps.',
            'meta_keywords' => 'SEO services, search engine optimization, technical SEO, search intent, B2B SEO, Market Princeps',
            'og_title' => 'SEO Services | Market Princeps',
            'og_description' => 'Build search visibility around business intent—not vanity traffic. Four connected pillars: technical foundation, search intent, content & authority, trust & conversion.',
            'canonical_url' => url('/services/seo-services'),
            'robots' => 'index, follow',
        ]);

        Service::query()->update(['url' => null]);

        $this->command?->info('SEO service page content seeded for slug: seo-services');
        $this->command?->info('Updated all services: url set to null for route-based links.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function seoPageContent(): array
    {
        return [
            'cta' => [
                'primary_label' => 'TALK ABOUT YOUR SEO',
            ],
            'hero' => [
                'badge' => 'MARKETING & DEMAND // SEO SERVICES',
                'title_before' => 'SEO that helps the ',
                'title_highlight' => 'right',
                'title_after' => ' people find your business.',
                'body' => 'Search visibility matters when it brings the right people to your business. We build SEO around how your customers search, what they need to know, and what it takes to turn that search into a meaningful business opportunity.',
                'primary_cta' => 'TALK ABOUT YOUR SEO',
                'secondary_cta' => 'SEE HOW WE WORK',
                'trust_line' => 'TECHNICAL SEO · CONTENT · SEARCH INTENT · CONVERSION',
                'radar' => [
                    'title' => 'WHAT ARE THEY LOOKING FOR?',
                    'footer' => 'SEARCH → RELEVANCE → TRUST → ACTION',
                    'items' => [
                        ['icon' => 'target', 'label' => 'Informational', 'hint' => 'Learning / researching'],
                        ['icon' => 'hub', 'label' => 'Commercial', 'hint' => 'Comparing / evaluating'],
                        ['icon' => 'trending_down', 'label' => 'Transactional', 'hint' => 'Ready to act'],
                    ],
                ],
            ],
            'difference' => [
                'badge' => 'THE MARKET PRINCEPS DIFFERENCE',
                'heading' => 'More visibility should lead to better opportunities.',
                'intro' => 'Rankings and traffic are useful signals, but they don\'t tell the whole story. We build SEO around search intent, relevance and the journey that follows the click.',
                'negative' => [
                    'label' => 'TRAFFIC-FIRST SEO',
                    'title' => 'More visits. Not necessarily more value.',
                    'body' => 'A keyword list can increase traffic without bringing the people most likely to become customers.',
                    'points' => [
                        'Low-intent traffic',
                        'Keyword-first content',
                        'Disconnected conversion',
                        'Reporting without context',
                    ],
                    'footer' => 'MORE ACTIVITY, UNCLEAR BUSINESS VALUE',
                ],
                'positive' => [
                    'label' => 'THE MARKET PRINCEPS APPROACH',
                    'title' => 'Search built around business intent.',
                    'body' => 'We connect search strategy with what your customers are looking for, what your business offers and what happens after they find you.',
                    'points' => [
                        'Intent-led targeting',
                        'Useful content',
                        'Conversion-aware journeys',
                        'Business-connected measurement',
                    ],
                    'footer' => 'RELEVANT VISIBILITY, BETTER OPPORTUNITIES',
                ],
                'cta' => [
                    'badge' => 'READY TO TAKE THE NEXT STEP?',
                    'heading' => 'Let\'s build SEO around what matters to your business.',
                    'body' => 'Tell us what you\'re trying to grow, improve or fix. We\'ll look at your current search presence and help you understand where the biggest opportunities are.',
                ],
            ],
            'pillars' => [
                'badge' => 'HOW WE BUILD SEO // OUR METHODOLOGY',
                'heading' => 'Four parts of SEO that work better together.',
                'intro' => 'Technical foundations make a website easier to understand. The right search intent brings relevant people to it. Useful content builds confidence, and authority helps turn visibility into lasting demand.',
                'items' => [
                    [
                        'id' => 'pillar-1',
                        'number' => '01',
                        'icon' => 'dns',
                        'tab_title' => 'Technical Foundation',
                        'chip' => 'PILLAR 01 // TECHNICAL FOUNDATION',
                        'tag' => 'FOUNDATIONAL ARCHITECTURE',
                        'title' => 'Make your website easier to find, understand and use.',
                        'body' => 'Search engines need to understand your website before they can connect it with the right searches. We improve technical structure, accessibility, and crawl efficiency so your highest-value pages are discovered, indexed, and ranked properly.',
                        'features' => [
                            ['title' => 'Clean Site Architecture', 'description' => 'Logical URL hierarchy, crawl paths & internal linking'],
                            ['title' => 'Crawlability & Indexation', 'description' => 'Reduce indexation barriers and improve crawl efficiency.'],
                            ['title' => 'Technical SEO Core', 'description' => 'Structured data, canonical signals & mobile rendering'],
                            ['title' => 'Core Web Vitals & Speed', 'description' => 'Improve speed, responsiveness and overall page experience.'],
                        ],
                        'target_icon' => 'speed',
                        'target' => 'TARGET: STRONG TECHNICAL HEALTH & CORE WEB VITALS',
                        'explore_label' => 'EXPLORE TECHNICAL BLUEPRINT',
                    ],
                    [
                        'id' => 'pillar-2',
                        'number' => '02',
                        'icon' => 'travel_explore',
                        'tab_title' => 'Search Intent',
                        'chip' => 'PILLAR 02 // SEARCH INTENT',
                        'tag' => 'DEMAND UNDERSTANDING',
                        'title' => 'Build visibility around what your customers actually want.',
                        'body' => 'Search starts with a need. We identify what people are looking for, why they are searching, and where your business can create the most relevant opportunity.',
                        'features' => [
                            ['title' => 'Search Demand', 'description' => 'Understand what your audience is actively searching for.'],
                            ['title' => 'Intent Mapping', 'description' => 'Connect searches to the needs behind them.'],
                            ['title' => 'Opportunity Gaps', 'description' => 'Find valuable searches your competitors are not fully serving.'],
                            ['title' => 'Keyword Strategy', 'description' => 'Build a focused search roadmap around business priorities.'],
                        ],
                        'target_icon' => 'target',
                        'target' => 'TARGET: HIGH-VALUE SEARCH OPPORTUNITIES',
                        'explore_label' => 'EXPLORE SEARCH STRATEGY',
                    ],
                    [
                        'id' => 'pillar-3',
                        'number' => '03',
                        'icon' => 'auto_stories',
                        'tab_title' => 'Content & Authority',
                        'chip' => 'PILLAR 03 // CONTENT & AUTHORITY',
                        'tag' => 'RELEVANCE & CREDIBILITY',
                        'title' => 'Create content that earns attention and builds trust.',
                        'body' => 'Good content should do more than attract a visit. We create useful, relevant content that answers real questions, demonstrates expertise, and gives people a reason to trust your business.',
                        'features' => [
                            ['title' => 'Content Strategy', 'description' => 'Plan content around customer needs and search opportunities.'],
                            ['title' => 'Useful Content', 'description' => 'Answer important questions clearly and meaningfully.'],
                            ['title' => 'Topical Authority', 'description' => 'Build depth and credibility around what your business knows.'],
                            ['title' => 'Content Structure', 'description' => 'Connect pages into a clearer, more useful website experience.'],
                        ],
                        'target_icon' => 'hub',
                        'target' => 'TARGET: RELEVANCE, DEPTH & AUTHORITY',
                        'explore_label' => 'EXPLORE CONTENT STRATEGY',
                    ],
                    [
                        'id' => 'pillar-4',
                        'number' => '04',
                        'icon' => 'verified_user',
                        'tab_title' => 'Trust & Conversion',
                        'chip' => 'PILLAR 04 // TRUST & CONVERSION',
                        'tag' => 'FROM VISIBILITY TO ACTION',
                        'title' => 'Turn search visibility into meaningful business action.',
                        'body' => 'Getting found is only the beginning. We improve the journey after the click so visitors can understand your value, trust your business, and take the next step.',
                        'features' => [
                            ['title' => 'Clear Messaging', 'description' => 'Make your value easy to understand when visitors arrive.'],
                            ['title' => 'Conversion Paths', 'description' => 'Create simple journeys from interest to action.'],
                            ['title' => 'Trust Signals', 'description' => 'Strengthen the proof people need before making a decision.'],
                            ['title' => 'Measurement', 'description' => 'Connect search activity with meaningful business outcomes.'],
                        ],
                        'target_icon' => 'trending_up',
                        'target' => 'TARGET: VISIBILITY THAT CREATES OPPORTUNITY',
                        'explore_label' => 'EXPLORE CONVERSION STRATEGY',
                    ],
                ],
            ],
            'calculator' => [
                'enabled' => true,
                'badge' => 'BUSINESS IMPACT MODEL',
                'heading' => 'See what improving this system could change.',
                'intro' => 'Use a few simple assumptions to explore the potential impact of improving your current setup. This is a scenario model, not a forecast or guarantee.',
                'footnote' => 'Calibrated against 85+ B2B commercial pipeline implementations.',
                'cta_label' => 'REQUEST DETAILED ROADMAP',
                'defaults' => [
                    'visitors' => 25000,
                    'ltv' => 250000,
                    'multiplier' => 1,
                ],
                'timelines' => [
                    ['label' => '6-Month Sprint', 'multiplier' => 1],
                    ['label' => '12-Month Sovereign', 'multiplier' => 1.75],
                ],
            ],
            'roadmap' => [
                'badge' => 'HOW WE DELIVER SEO',
                'heading' => 'A clear path from search visibility to meaningful growth.',
                'intro' => 'We move from understanding your current search presence to building, improving and measuring the parts that create lasting value.',
                'steps' => [
                    [
                        'number' => '01',
                        'phase' => 'UNDERSTAND',
                        'title' => 'Start with the current picture.',
                        'body' => 'We review your website, search visibility, competitors, existing content and technical foundation to understand where the biggest opportunities and gaps are.',
                        'highlight' => false,
                    ],
                    [
                        'number' => '02',
                        'phase' => 'PLAN',
                        'title' => 'Build the right search strategy.',
                        'body' => 'We map search intent, priorities, content opportunities and technical improvements into a practical SEO roadmap built around your business goals and growth plans.',
                        'highlight' => false,
                    ],
                    [
                        'number' => '03',
                        'phase' => 'EXECUTE',
                        'title' => 'Put the strategy into action.',
                        'body' => 'We improve the technical foundation, create or refine useful content, strengthen authority and improve the paths that turn relevant visitors into opportunities.',
                        'highlight' => false,
                    ],
                    [
                        'number' => '04',
                        'phase' => 'IMPROVE & MEASURE',
                        'title' => 'Keep improving what matters.',
                        'body' => 'We monitor search performance, identify what is changing, refine the strategy and improve the areas that create the most meaningful business value over time.',
                        'highlight' => true,
                    ],
                ],
                'cta' => [
                    'heading' => 'READY TO IMPROVE YOUR SEARCH VISIBILITY?',
                    'body' => 'We\'ll begin by understanding where your SEO stands today, then identify what deserves attention first.',
                ],
            ],
            'faq' => [
                'badge' => 'FREQUENTLY ASKED QUESTIONS',
                'heading' => 'Clarity on our SEO engagements.',
                'intro' => 'Answers to the practical questions businesses have before starting SEO.',
                'items' => [
                    [
                        'question' => 'How long does SEO take to start showing results?',
                        'answer' => 'SEO is not a fixed-timeline activity. The time it takes to see meaningful change depends on factors such as your current search visibility, website condition, competition, content depth and the changes being implemented. We establish a baseline first, then track progress against the areas we\'re working to improve rather than promising a fixed ranking or result by a particular date.',
                    ],
                    [
                        'question' => 'How do you measure whether SEO is actually creating value?',
                        'answer' => 'We look beyond rankings and traffic. Depending on the business, we track indicators such as relevant organic traffic, engagement, enquiries, conversions and other meaningful actions that connect search activity with business goals. The exact measurement framework depends on how your business generates value.',
                    ],
                    [
                        'question' => 'Do we need a developer or internal team to implement SEO recommendations?',
                        'answer' => 'Not necessarily. We can work with your existing developers, marketing team or other partners when you have them. Where implementation support is needed, we can help with the technical work within the agreed scope. The goal is to make recommendations practical and actually usable, not simply hand over a list of tasks.',
                    ],
                    [
                        'question' => 'Can SEO work with our existing website, CRM and marketing systems?',
                        'answer' => 'Yes. SEO doesn\'t have to operate separately from the rest of your business. Where relevant, we consider how your website, analytics, CRM, conversion paths and other marketing activities work together so search can contribute to the wider customer journey.',
                    ],
                ],
                'side_cta' => [
                    'title' => 'Have a complex website or a specific SEO challenge?',
                    'body' => 'Tell us what you\'re dealing with. We\'ll start by understanding the situation before recommending what needs to change.',
                ],
            ],
            'intake' => [
                'badge' => 'LET\'S TALK ABOUT YOUR BUSINESS',
                'heading' => 'Tell us where you want to go. We\'ll help you figure out how to get there.',
                'intro' => 'If you\'re trying to improve your search visibility, attract more relevant customers or understand what\'s holding your SEO back, start with the problem. We\'ll understand your business before recommending a solution.',
                'protocol_title' => 'What happens after you reach out',
                'protocol_steps' => [
                    ['title' => 'Understand', 'body' => 'We learn what you\'re trying to achieve, what\'s getting in the way and how your current setup works.'],
                    ['title' => 'Explore', 'body' => 'We look at the relevant parts of your search presence and identify where there may be meaningful opportunities.'],
                    ['title' => 'Recommend', 'body' => 'We explain what we believe needs attention and what the right next step could look like.'],
                ],
                'message_label' => 'Organic Search Objectives & Current Pain Points',
                'message_placeholder' => 'Target accounts, existing search bottlenecks, upcoming migration...',
                'submit_label' => 'START THE CONVERSATION',
                'disclaimer' => 'Protected by strict non-disclosure protocols. We never share enterprise business information.',
                'help_category' => 'marketing',
            ],
        ];
    }
}
