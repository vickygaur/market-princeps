<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class ContactPageSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::query()->updateOrCreate(
            ['slug' => 'contact'],
            [
                'title' => 'Contact',
                'template' => 'contact',
                'is_published' => true,
                'published_at' => now(),
                'meta_title' => 'Contact Market Princeps | Strategic Consultation',
                'meta_description' => "Tell us what you're trying to improve. We'll start by understanding your business before recommending marketing, technology or optimization solutions.",
                'meta_keywords' => 'contact market princeps, business consultation, marketing technology, strategic consultation, growth architecture',
                'og_title' => 'Contact Market Princeps | Tell Us What You\'re Trying to Improve',
                'og_description' => 'Start with the problem. Share what you\'re trying to improve, fix or grow — we\'ll begin by understanding your business.',
                'og_image' => null,
                'canonical_url' => url('/contact'),
                'robots' => 'index, follow',
                'schema_markup' => json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'ContactPage',
                    'name' => 'Contact Market Princeps',
                    'url' => url('/contact'),
                    'description' => "Tell us what you're trying to improve. We'll start by understanding your business.",
                    'mainEntity' => [
                        '@type' => 'Organization',
                        'name' => 'Market Princeps',
                        'url' => url('/'),
                        'email' => 'connect@marketprinceps.com',
                        'telephone' => '+91-9625330200',
                        'contactPoint' => [
                            '@type' => 'ContactPoint',
                            'telephone' => '+91-9625330200',
                            'contactType' => 'customer service',
                            'email' => 'connect@marketprinceps.com',
                            'areaServed' => 'IN',
                            'availableLanguage' => ['English', 'Hindi'],
                            'hoursAvailable' => [
                                '@type' => 'OpeningHoursSpecification',
                                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                                'opens' => '10:00',
                                'closes' => '19:00',
                            ],
                        ],
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
                'key' => 'hub',
                'name' => 'Contact Hub',
                'sort_order' => 2,
                'content' => $this->hubContent(),
            ],
            [
                'key' => 'faq',
                'name' => 'FAQ',
                'sort_order' => 3,
                'content' => $this->faqContent(),
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
            'badge' => "LET'S TALK ABOUT YOUR BUSINESS",
            'title_prefix' => "Tell us what you're trying to",
            'title_shimmer' => 'improve.',
            'body' => "You don't need to know exactly what solution you need. Tell us what's getting in the way, what you're trying to achieve, or where you see an opportunity. We'll start by understanding the business.",
            'trust_markers' => [
                ['icon' => 'bolt', 'label' => 'Business-first conversation'],
                ['icon' => 'lock', 'label' => 'No one-size-fits-all solution'],
                ['icon' => 'handshake', 'label' => 'Start with the problem'],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function hubContent(): array
    {
        return [
            'call' => [
                'label' => 'CALL NOW',
                'phone' => '+91-9625330200',
                'phone_href' => '+919625330200',
                'hours' => 'Mon–FRI, 10:00 AM – 7:00 PM IST',
                'body' => 'Prefer to talk directly? Give us a call',
                'call_label' => 'CALL NOW',
                'whatsapp_label' => 'WHATSAPP US',
                'whatsapp_url' => 'https://wa.me/919625330200?text=Hello%20Market%20Princeps%20Strategy%20Desk',
            ],
            'email' => [
                'label' => 'EMAIL US',
                'address' => 'connect@marketprinceps.com',
                'body' => "Send us your question, business requirement or project details. We'll take it from there.",
            ],
            'protocol' => [
                'title' => 'What happens after you reach out?',
                'steps' => [
                    [
                        'num' => '01',
                        'title' => 'UNDERSTAND',
                        'body' => "We learn about your business, what you're trying to achieve and where you're facing a challenge.",
                    ],
                    [
                        'num' => '02',
                        'title' => 'EXPLORE',
                        'body' => 'We look at the problem and identify where marketing, technology or business improvement could help.',
                    ],
                    [
                        'num' => '03',
                        'title' => 'RECOMMEND',
                        'body' => "If there's a fit, we'll suggest a practical way forward based on what your business actually needs.",
                    ],
                ],
            ],
            'form' => [
                'eyebrow' => 'START WITH THE PROBLEM',
                'title' => 'Tell us where you want to go.',
                'intro' => "We'll help you understand what could get you there. Start with what you're trying to improve, fix or grow, and give us enough context to understand the business.",
                'category_label' => 'What can we help you with?',
                'categories' => [
                    ['value' => 'marketing', 'label' => 'Marketing & Demand'],
                    ['value' => 'technology', 'label' => 'Custom Technology'],
                    ['value' => 'optimization', 'label' => 'Business Optimization'],
                    ['value' => 'combination', 'label' => 'A combination of all'],
                    ['value' => 'need_help', 'label' => 'Not sure / Need guidance'],
                ],
                'submit_label' => 'START THE CONVERSATION',
                'success_title' => 'Diagnostic Inquiry Received',
                'success_body' => 'A Practice Director is currently evaluating your dossier. We will reach out within 4 hours.',
                'trust_badges' => [
                    ['icon' => 'verified', 'label' => 'BUSINESS-FIRST'],
                    ['icon' => 'psychology', 'label' => 'NO ONE-SIZE-FITS-ALL'],
                    ['icon' => 'hub', 'label' => 'PRACTICAL NEXT STEPS'],
                ],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function faqContent(): array
    {
        return [
            'eyebrow' => 'BEFORE YOU REACH OUT // COMMON QUESTIONS',
            'title' => 'A few things you might be wondering.',
            'items' => [
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
            ],
        ];
    }
}
