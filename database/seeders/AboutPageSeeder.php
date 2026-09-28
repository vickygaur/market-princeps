<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::query()->updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Us',
                'template' => 'about',
                'is_published' => true,
                'published_at' => now(),
                'meta_title' => 'About Market Princeps | Our Ideology & Approach',
                'meta_description' => 'Market Princeps comes from the Latin Princeps — first or leading. We put your business first by uniting marketing, technology and business optimization.',
                'meta_keywords' => 'about market princeps, princeps meaning, growth architecture, marketing technology, business optimization, core convictions',
                'og_title' => 'About Market Princeps | Built to Put Your Business First',
                'og_description' => 'First in understanding. First in responsibility. Learn how Market Princeps brings marketing, technology and business optimization together.',
                'og_image' => null,
                'canonical_url' => url('/about'),
                'robots' => 'index, follow',
                'schema_markup' => json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'AboutPage',
                    'name' => 'About Market Princeps',
                    'url' => url('/about'),
                    'description' => 'Market Princeps comes from the Latin Princeps — first or leading. We put your business first.',
                    'mainEntity' => [
                        '@type' => 'Organization',
                        'name' => 'Market Princeps',
                        'url' => url('/'),
                    ],
                ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
            ]
        );

        $this->seedPageSections($page);
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
                'key' => 'origin',
                'name' => 'Origin & Codex',
                'sort_order' => 2,
                'content' => $this->originContent(),
            ],
            [
                'key' => 'triad',
                'name' => 'Three Pillars',
                'sort_order' => 3,
                'content' => $this->triadContent(),
            ],
            [
                'key' => 'doctrine',
                'name' => 'Core Convictions',
                'sort_order' => 4,
                'content' => $this->doctrineContent(),
            ],
            [
                'key' => 'existence',
                'name' => 'Why We Exist',
                'sort_order' => 5,
                'content' => $this->existenceContent(),
            ],
            [
                'key' => 'cta',
                'name' => 'Call to Action',
                'sort_order' => 6,
                'content' => $this->ctaContent(),
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
        return [
            'title_html' => '<span class="inline">Built to put </span><span class="gold-gradient-shimmer font-semibold inline">your business first.</span>',
            'paragraphs' => [
                'Market Princeps comes from the Latin <em><b>Princeps</b></em>, meaning "first" or "leading." For us, it represents a simple belief: good solutions start with understanding the business behind the problem.',
                'We bring marketing, technology and business optimization together to help businesses attract the right customers, work more efficiently and build for what comes next.',
            ],
            'cta_primary_label' => 'OUR APPROACH',
            'cta_primary_url' => '#triad',
            'cta_secondary_label' => 'SPEAK WITH OUR TEAM',
            'cta_secondary_url' => '#cta-section',
            'shaped_label' => 'WHAT SHAPED MARKET PRINCEPS',
            'shaped_text' => 'Experience across businesses, industries and disciplines has shaped the way we work today.',
            'stats' => [
                [
                    'icon' => 'menu_book',
                    'value' => 'Since 2020',
                    'title' => 'Built through experience',
                    'description' => 'Working with businesses since 2020 has taught us that every business needs its own solution.',
                    'value_class' => 'text-on-surface',
                    'icon_wrapper_class' => 'bg-primary-container text-secondary-container',
                ],
                [
                    'icon' => 'domain',
                    'value' => '15+ Sectors',
                    'title' => 'Broad industry experience',
                    'description' => 'From schools and real estate to e-commerce, retail, restaurants, green energy and more.',
                    'value_class' => 'text-secondary',
                    'icon_wrapper_class' => 'bg-surface-container text-secondary',
                ],
                [
                    'icon' => 'hub',
                    'value' => '360° view',
                    'title' => 'We look beyond marketing',
                    'description' => 'We look at marketing, technology, sales and operations to understand what drives growth.',
                    'value_class' => 'text-on-surface',
                    'icon_wrapper_class' => 'bg-primary-container text-on-primary',
                ],
                [
                    'icon' => 'language',
                    'value' => 'One Approach',
                    'title' => 'Built around your business',
                    'description' => "We don't force businesses into ready-made packages. We build what their business actually needs.",
                    'value_class' => 'text-on-surface',
                    'icon_wrapper_class' => 'bg-surface-container text-on-tertiary-container',
                ],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function originContent(): array
    {
        return [
            'eyebrow' => 'THE MEANING OF PRINCEPS // THE STANDARD WE FOLLOW',
            'title_html' => 'First in understanding.<br>First in responsibility.',
            'paragraphs' => [
                '<em class="font-semibold">Princeps</em> is a Latin word associated with being first, foremost or leading. We took that idea and made it practical: before we recommend a solution, we believe we should understand the business behind the problem.',
                'That means looking beyond individual services. A marketing problem may begin with visibility but end with a weak sales process. A technology problem may start with a missing tool but actually be caused by a broken workflow. The right answer begins with understanding how the pieces work together.',
            ],
            'standard' => [
                'title' => 'The Market Princeps Standard',
                'badge' => 'UNDERSTAND BEFORE YOU BUILD',
                'body' => "We don't start with a service. We start with the business, the problem and the outcome that matters. Then we build the solution around what the business actually needs.",
            ],
            'codex' => [
                'title' => 'How we approach every problem',
                'subtitle' => 'Three principles guide how we understand, build and improve.',
                'footer_left' => 'BUSINESS FIRST',
                'footer_right' => 'BUILT TO EVOLVE',
                'items' => [
                    [
                        'num' => '01',
                        'title' => 'Understand first',
                        'desc' => 'We learn how the business works before deciding what needs to change.',
                        'active' => true,
                    ],
                    [
                        'num' => '02',
                        'title' => 'Connect the pieces',
                        'desc' => 'Marketing, technology and processes should work together when the business needs them to.',
                        'active' => false,
                    ],
                    [
                        'num' => '03',
                        'title' => "Build for what's next",
                        'desc' => "Good solutions should solve today's problem without creating tomorrow's limitation.",
                        'active' => false,
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function triadContent(): array
    {
        $triadUrl = url('/#triad-content');

        return [
            'eyebrow' => 'WHY THESE THREE WORK TOGETHER',
            'title' => 'Growth rarely stops at one problem.',
            'subtitle' => 'A business may need better marketing to create opportunities, better technology to turn those opportunities into action, or better processes to handle growth efficiently. Often, the real opportunity sits between them.',
            'footer_note' => "The point isn't to use all three. It's to know which one your business actually needs.",
            'pillars' => [
                [
                    'icon' => 'ads_click',
                    'title' => 'Create Opportunity',
                    'badge' => 'Marketing & Demand',
                    'description' => 'Reach the right people, communicate your value clearly and turn attention into business opportunities.',
                    'points' => [
                        'Reach the right audience',
                        'Make your value clear',
                        'Create qualified opportunities',
                    ],
                    'cta_label' => 'CREATE DEMAND',
                    'cta_url' => $triadUrl,
                ],
                [
                    'icon' => 'terminal',
                    'title' => 'Move Opportunity Forward',
                    'badge' => 'Custom Technology',
                    'description' => 'Build the tools, platforms and systems your business needs to turn opportunities into results.',
                    'points' => [
                        'Build around your processes',
                        'Connect your systems',
                        'Make work easier to manage',
                    ],
                    'cta_label' => 'BUILD WHAT YOU NEED',
                    'cta_url' => $triadUrl,
                ],
                [
                    'icon' => 'cached',
                    'title' => 'Make Growth Easier',
                    'badge' => 'Business Optimization',
                    'description' => 'Improve processes, remove unnecessary work and create systems that help your business handle growth.',
                    'points' => [
                        'Remove unnecessary friction',
                        'Automate repetitive work',
                        'Improve operational efficiency',
                    ],
                    'cta_label' => 'IMPROVE HOW YOU WORK',
                    'cta_url' => $triadUrl,
                ],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function doctrineContent(): array
    {
        return [
            'eyebrow' => 'HOW WE THINK // CORE CONVICTIONS',
            'title' => 'A few principles guide every solution we build.',
            'subtitle' => "We don't believe in following a fixed formula. We believe in understanding the business, focusing on what creates value, and building solutions that make the business better over time.",
            'items' => [
                [
                    'number' => '01',
                    'title' => 'Understand Before You Recommend',
                    'description' => "We don't start with a service or a solution. We first understand the business, the problem and implement what success actually looks like.",
                    'footer_icon' => 'filter_alt',
                    'footer_label' => 'BUSINESS FIRST',
                ],
                [
                    'number' => '02',
                    'title' => 'Value Over Vanity Metrics',
                    'description' => "More traffic, more tools or more activity don't automatically create growth. We focus on the changes that can create meaningful value for the business.",
                    'footer_icon' => 'speed',
                    'footer_label' => 'FOCUS ON WHAT MATTERS',
                ],
                [
                    'number' => '03',
                    'title' => 'Fit the Solution to the Business',
                    'description' => 'Every business has different customers, processes, constraints and goals. We build around those realities instead of forcing a standard solution.',
                    'footer_icon' => 'tune',
                    'footer_label' => 'BUILT FOR THE BUSINESS',
                ],
                [
                    'number' => '04',
                    'title' => 'Improve What You Build',
                    'description' => "A solution shouldn't be considered finished just because it has been delivered. We look at what changes, what works and what can be made better.",
                    'footer_icon' => 'fact_check',
                    'footer_label' => 'BUILT TO EVOLVE',
                ],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function existenceContent(): array
    {
        return [
            'eyebrow' => 'WHY MARKET PRINCEPS EXISTS // THE IDEA BEHIND THE BUSINESS',
            'title' => "Businesses don't always need another service. They need someone to understand the problem first.",
            'paragraphs' => [
                'Market Princeps came from seeing businesses solve growth problems in pieces. Marketing was handled by one team, technology by another, and processes somewhere else. Each solved a part of the problem, but the business was still left to connect everything together.',
                'We wanted to build a different kind of business: one that starts with understanding what is actually getting in the way, then brings the right pieces together to solve it.',
            ],
            'highlight' => 'The goal was never to offer more services. It was to make the right solution easier to find.',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDe4qHgso6APMNGyOxPZzQwdbn76Ym0HW4BPtwOHjrW1gk5lijoFH46RAoUXCeAWC6mzYanZvViRN8sxrkEmmwMaEHQLJJGGqN1RYNdD1NctalotXTnBspnWv7iceKcVw6legkrvq4ZuHlGkWLTgQeWHM_1Q9cvn1aJNOHfA0Mxuhr11aI7rwxvJomHAGFSnLuxcgoiGzkkJkONnnE4Q7wfl5r6sRnH7Ijn0zaxNxrV2XbdA1JqIYznWQ',
            'image_alt' => 'A dignified, high-end corporate executive conference room with an Indian female strategic leader standing and presenting to an executive leadership team around a polished teak boardroom table.',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function ctaContent(): array
    {
        return [
            'badge' => "LET'S BUILD WHAT YOUR BUSINESS NEEDS",
            'title_html' => 'Your business is <span class="gold-gradient-shimmer font-semibold inline">unique.</span><div class="">The <span class="gold-gradient-shimmer font-semibold inline">solution</span> should be too.</div>',
            'body' => "Tell us what you're trying to improve, fix or grow. We'll start by understanding the business, then work out what the right solution looks like.",
            'cta_label' => "LET'S TALK ABOUT YOUR BUSINESS",
            'cta_url' => url('/#intake'),
            'trust_items' => [
                'BUSINESS-FIRST CONVERSATION',
                'NO ONE-SIZE-FITS-ALL SOLUTION',
                'START WITH THE PROBLEM',
            ],
        ];
    }
}
