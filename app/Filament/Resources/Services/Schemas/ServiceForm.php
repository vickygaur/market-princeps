<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Service')->tabs([
                Tab::make('Details')->schema([
                    Select::make('service_category_id')
                        ->relationship('category', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),
                    TextInput::make('name')->required()->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set, $get) => $get('slug') ?: $set('slug', str($state)->slug())),
                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Public URL: /services/{slug}'),
                    TextInput::make('short_description')->maxLength(255),
                    Textarea::make('description')->rows(4),
                    TextInput::make('icon')->helperText('Material symbol name, e.g. travel_explore'),
                    TextInput::make('url')
                        ->label('Custom URL override')
                        ->helperText('Leave blank to use /services/{slug}. Only set if linking elsewhere.'),
                    TextInput::make('sort_order')->numeric()->default(0),
                    Toggle::make('is_active')->default(true),
                    Toggle::make('show_in_nav')->default(true),
                    Toggle::make('show_in_footer')->default(true),
                ]),

                Tab::make('Hero')->schema([
                    Section::make('Hero')->schema([
                        TextInput::make('page_content.hero.badge')->label('Badge'),
                        TextInput::make('page_content.hero.title_before')->label('Title before highlight'),
                        TextInput::make('page_content.hero.title_highlight')->label('Highlighted word'),
                        TextInput::make('page_content.hero.title_after')->label('Title after highlight'),
                        Textarea::make('page_content.hero.body')->label('Body')->rows(4)->columnSpanFull(),
                        TextInput::make('page_content.hero.primary_cta')->label('Primary CTA label'),
                        TextInput::make('page_content.hero.secondary_cta')->label('Secondary CTA label'),
                        TextInput::make('page_content.hero.trust_line')->label('Trust line')->columnSpanFull(),
                        TextInput::make('page_content.hero.radar.title')->label('Radar title'),
                        TextInput::make('page_content.hero.radar.footer')->label('Radar footer'),
                        Repeater::make('page_content.hero.radar.items')
                            ->label('Radar items')
                            ->schema([
                                TextInput::make('label')->required(),
                                TextInput::make('hint'),
                                TextInput::make('icon')->helperText('Material symbol'),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->columnSpanFull(),
                    ])->columns(2),
                ]),

                Tab::make('Difference')->schema([
                    Section::make('Section intro')->schema([
                        TextInput::make('page_content.difference.badge')->label('Badge'),
                        TextInput::make('page_content.difference.heading')->label('Heading')->columnSpanFull(),
                        Textarea::make('page_content.difference.intro')->label('Intro')->rows(3)->columnSpanFull(),
                    ]),
                    Section::make('Negative card (problem)')->schema([
                        TextInput::make('page_content.difference.negative.label')->label('Label'),
                        TextInput::make('page_content.difference.negative.title')->label('Title')->columnSpanFull(),
                        Textarea::make('page_content.difference.negative.body')->label('Body')->rows(3)->columnSpanFull(),
                        TagsInput::make('page_content.difference.negative.points')->label('Points')->columnSpanFull(),
                        TextInput::make('page_content.difference.negative.footer')->label('Footer')->columnSpanFull(),
                    ])->columns(2)->collapsed(),
                    Section::make('Positive card (approach)')->schema([
                        TextInput::make('page_content.difference.positive.label')->label('Label'),
                        TextInput::make('page_content.difference.positive.title')->label('Title')->columnSpanFull(),
                        Textarea::make('page_content.difference.positive.body')->label('Body')->rows(3)->columnSpanFull(),
                        TagsInput::make('page_content.difference.positive.points')->label('Points')->columnSpanFull(),
                        TextInput::make('page_content.difference.positive.footer')->label('Footer')->columnSpanFull(),
                    ])->columns(2)->collapsed(),
                    Section::make('Inline CTA')->schema([
                        TextInput::make('page_content.difference.cta.badge')->label('Badge'),
                        TextInput::make('page_content.difference.cta.heading')->label('Heading')->columnSpanFull(),
                        Textarea::make('page_content.difference.cta.body')->label('Body')->rows(3)->columnSpanFull(),
                    ])->collapsed(),
                ]),

                Tab::make('Pillars')->schema([
                    Section::make('Methodology')->schema([
                        TextInput::make('page_content.pillars.badge')->label('Badge'),
                        TextInput::make('page_content.pillars.heading')->label('Heading')->columnSpanFull(),
                        Textarea::make('page_content.pillars.intro')->label('Intro')->rows(3)->columnSpanFull(),
                        Repeater::make('page_content.pillars.items')
                            ->label('Pillars')
                            ->schema([
                                TextInput::make('id')->label('ID')->helperText('e.g. pillar-1'),
                                TextInput::make('number')->label('Number')->maxLength(4),
                                TextInput::make('chip')->label('Chip'),
                                TextInput::make('tag')->label('Tag'),
                                TextInput::make('icon')->label('Icon'),
                                TextInput::make('tab_title')->label('Tab title'),
                                TextInput::make('title')->label('Title')->columnSpanFull(),
                                Textarea::make('body')->label('Body')->rows(3)->columnSpanFull(),
                                TextInput::make('target')->label('Target line')->columnSpanFull(),
                                TextInput::make('target_icon')->label('Target icon'),
                                TextInput::make('explore_label')->label('Explore CTA'),
                                Repeater::make('features')
                                    ->label('Features')
                                    ->schema([
                                        TextInput::make('title')->required(),
                                        Textarea::make('description')->rows(2),
                                    ])
                                    ->defaultItems(0)
                                    ->collapsible()
                                    ->columnSpanFull(),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['tab_title'] ?? $state['title'] ?? null)
                            ->columnSpanFull(),
                    ]),
                ]),

                Tab::make('Roadmap')->schema([
                    Section::make('Delivery roadmap')->schema([
                        TextInput::make('page_content.roadmap.badge')->label('Badge'),
                        TextInput::make('page_content.roadmap.heading')->label('Heading')->columnSpanFull(),
                        Textarea::make('page_content.roadmap.intro')->label('Intro')->rows(3)->columnSpanFull(),
                        Repeater::make('page_content.roadmap.steps')
                            ->label('Steps')
                            ->schema([
                                TextInput::make('number')->label('Number')->maxLength(4),
                                TextInput::make('phase')->label('Phase'),
                                TextInput::make('title')->label('Title')->columnSpanFull(),
                                Textarea::make('body')->label('Body')->rows(3)->columnSpanFull(),
                                Toggle::make('highlight')->label('Highlight step')->default(false),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? $state['phase'] ?? null)
                            ->columnSpanFull(),
                        TextInput::make('page_content.roadmap.cta.heading')->label('CTA heading')->columnSpanFull(),
                        Textarea::make('page_content.roadmap.cta.body')->label('CTA body')->rows(2)->columnSpanFull(),
                    ]),
                ]),

                Tab::make('FAQ')->schema([
                    Section::make('FAQ')->schema([
                        TextInput::make('page_content.faq.badge')->label('Badge'),
                        TextInput::make('page_content.faq.heading')->label('Heading')->columnSpanFull(),
                        Textarea::make('page_content.faq.intro')->label('Intro')->rows(2)->columnSpanFull(),
                        Repeater::make('page_content.faq.items')
                            ->label('Questions')
                            ->schema([
                                TextInput::make('question')->required()->columnSpanFull(),
                                Textarea::make('answer')->required()->rows(4)->columnSpanFull(),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['question'] ?? null)
                            ->columnSpanFull(),
                        TextInput::make('page_content.faq.side_cta.title')->label('Side CTA title')->columnSpanFull(),
                        Textarea::make('page_content.faq.side_cta.body')->label('Side CTA body')->rows(2)->columnSpanFull(),
                    ]),
                ]),

                Tab::make('Intake')->schema([
                    Section::make('Lead form section')->schema([
                        TextInput::make('page_content.intake.badge')->label('Badge'),
                        TextInput::make('page_content.intake.heading')->label('Heading')->columnSpanFull(),
                        Textarea::make('page_content.intake.intro')->label('Intro')->rows(3)->columnSpanFull(),
                        TextInput::make('page_content.intake.message_label')->label('Message field label'),
                        TextInput::make('page_content.intake.message_placeholder')->label('Message placeholder'),
                        TextInput::make('page_content.intake.submit_label')->label('Submit button'),
                        TextInput::make('page_content.intake.help_category')->label('Lead help category')->helperText('Stored with the lead, e.g. marketing'),
                        Textarea::make('page_content.intake.disclaimer')->label('Disclaimer')->rows(2)->columnSpanFull(),
                        TextInput::make('page_content.intake.protocol_title')->label('Protocol title')->columnSpanFull(),
                        Repeater::make('page_content.intake.protocol_steps')
                            ->label('Protocol steps')
                            ->schema([
                                TextInput::make('title')->required(),
                                Textarea::make('body')->rows(2),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->columnSpanFull(),
                    ])->columns(2),
                    Section::make('Global CTA label')->schema([
                        TextInput::make('page_content.cta.primary_label')
                            ->label('Primary CTA label used across the page')
                            ->helperText('Falls back to hero primary CTA when empty'),
                    ]),
                ]),

                Tab::make('SEO')->schema([
                    Section::make()->schema([
                        TextInput::make('meta_title')->maxLength(70),
                        Textarea::make('meta_description')->rows(3)->maxLength(160),
                        TextInput::make('meta_keywords'),
                        TextInput::make('og_title'),
                        Textarea::make('og_description')->rows(2),
                        FileUpload::make('og_image')->image()->directory('seo')->disk('public'),
                        TextInput::make('canonical_url')->url(),
                        TextInput::make('robots')->default('index, follow'),
                        Textarea::make('schema_markup')->rows(6)->helperText('JSON-LD without script tags'),
                    ]),
                ]),
            ])->columnSpanFull(),
        ]);
    }
}
