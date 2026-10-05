<?php

namespace App\Support;

use App\Models\SiteSetting;

class Typography
{
    public const SETTING_KEY = 'typography';

    /**
     * Curated Google Fonts available in admin.
     *
     * @return array<string, string>
     */
    public static function fontOptions(): array
    {
        return [
            'Inter' => 'Inter',
            'Montserrat' => 'Montserrat',
            'Plus Jakarta Sans' => 'Plus Jakarta Sans',
            'Manrope' => 'Manrope',
            'DM Sans' => 'DM Sans',
            'Outfit' => 'Outfit',
            'Space Grotesk' => 'Space Grotesk',
            'Poppins' => 'Poppins',
            'Nunito Sans' => 'Nunito Sans',
            'IBM Plex Sans' => 'IBM Plex Sans',
            'Source Sans 3' => 'Source Sans 3',
            'Work Sans' => 'Work Sans',
            'Lora' => 'Lora',
            'Playfair Display' => 'Playfair Display',
            'Source Serif 4' => 'Source Serif 4',
            'Merriweather' => 'Merriweather',
            'Libre Baskerville' => 'Libre Baskerville',
            'Roboto Mono' => 'Roboto Mono',
            'JetBrains Mono' => 'JetBrains Mono',
        ];
    }

    /**
     * @return array<string, int>
     */
    public static function weightOptions(): array
    {
        return [
            '300' => 'Light (300)',
            '400' => 'Regular (400)',
            '500' => 'Medium (500)',
            '600' => 'Semibold (600)',
            '700' => 'Bold (700)',
            '800' => 'Extra Bold (800)',
        ];
    }

    /**
     * Role metadata for admin labels and default font group.
     *
     * @return array<string, array{label: string, help: string, family: string}>
     */
    public static function roleDefinitions(): array
    {
        return [
            'display_hero' => [
                'label' => 'Display hero',
                'help' => 'Largest homepage / CTA headlines (desktop).',
                'family' => 'heading',
            ],
            'display_hero_mobile' => [
                'label' => 'Display hero (mobile)',
                'help' => 'Hero headlines on small screens.',
                'family' => 'heading',
            ],
            'headline_lg' => [
                'label' => 'Headline large',
                'help' => 'Section titles (H2).',
                'family' => 'heading',
            ],
            'headline_lg_mobile' => [
                'label' => 'Headline large (mobile)',
                'help' => 'Section titles on small screens.',
                'family' => 'heading',
            ],
            'headline_md' => [
                'label' => 'Headline medium',
                'help' => 'Card and column titles.',
                'family' => 'heading',
            ],
            'headline_sm' => [
                'label' => 'Headline small',
                'help' => 'Sub-section and feature titles.',
                'family' => 'heading',
            ],
            'title_md' => [
                'label' => 'Title medium',
                'help' => 'Buttons, nav emphasis, compact titles.',
                'family' => 'body',
            ],
            'body_lg' => [
                'label' => 'Body large',
                'help' => 'Lead paragraphs and intros.',
                'family' => 'body',
            ],
            'body_md' => [
                'label' => 'Body medium',
                'help' => 'Default paragraph and form text.',
                'family' => 'body',
            ],
            'body_sm' => [
                'label' => 'Body small',
                'help' => 'Supporting copy, captions, helper text.',
                'family' => 'body',
            ],
            'label_md' => [
                'label' => 'Label medium',
                'help' => 'UI labels and chip text.',
                'family' => 'label',
            ],
            'label_caps' => [
                'label' => 'Label caps',
                'help' => 'Eyebrows, badges, uppercase labels.',
                'family' => 'label',
            ],
        ];
    }

    /**
     * Sample copy and where each role appears on the site (for admin preview).
     *
     * @return array<string, array{sample: string, used_on: list<string>}>
     */
    public static function rolePreviewMeta(): array
    {
        return [
            'display_hero' => [
                'sample' => 'Attention gets you noticed.',
                'used_on' => ['Home hero (desktop)', 'About CTA title', 'Service hero (desktop)'],
            ],
            'display_hero_mobile' => [
                'sample' => 'Attention gets you noticed.',
                'used_on' => ['Home hero (mobile)', 'About CTA (mobile)', 'Service hero (mobile)'],
            ],
            'headline_lg' => [
                'sample' => 'How we build your growth engine',
                'used_on' => ['Home section titles', 'About section titles', 'Contact FAQ title', 'Service section titles'],
            ],
            'headline_lg_mobile' => [
                'sample' => 'How we build your growth engine',
                'used_on' => ['Section titles on small screens across all pages'],
            ],
            'headline_md' => [
                'sample' => 'Usual approach vs Market Princeps',
                'used_on' => ['Philosophy cards', 'Service pillar titles', 'Mid-size card headings'],
            ],
            'headline_sm' => [
                'sample' => 'Precision authority inflow',
                'used_on' => ['Feature cards', 'Process steps', 'About stats / codex items'],
            ],
            'title_md' => [
                'sample' => 'BUILD SOMETHING BETTER',
                'used_on' => ['Primary / secondary buttons', 'CTA labels', 'Nav emphasis'],
            ],
            'body_lg' => [
                'sample' => 'Market Princeps brings marketing, technology, and business systems together.',
                'used_on' => ['Hero subheads', 'Lead paragraphs on About / Contact'],
            ],
            'body_md' => [
                'sample' => 'We help businesses attract the right customers and build what they actually need.',
                'used_on' => ['Default paragraphs', 'Form fields', 'Section intros'],
            ],
            'body_sm' => [
                'sample' => 'Potential capacity recovered from manual work.',
                'used_on' => ['Captions', 'Helper text', 'Card descriptions', 'Simulator notes'],
            ],
            'label_md' => [
                'sample' => 'Attract · Convert · Optimize',
                'used_on' => ['Tab labels', 'UI chips', 'Toggle buttons'],
            ],
            'label_caps' => [
                'sample' => 'MARKETING · TECHNOLOGY · GROWTH',
                'used_on' => ['Eyebrows', 'Badges', 'Trust lines', 'Phase tags'],
            ],
        ];
    }

    /**
     * Normalize a draft admin form payload into a full typography config.
     *
     * @param  array<string, mixed>|null  $draft
     * @return array<string, mixed>
     */
    public static function fromDraft(?array $draft): array
    {
        $merged = array_replace_recursive(self::defaults(), is_array($draft) ? $draft : []);
        unset($merged['pages']);

        return $merged;
    }

    /**
     * Defaults matching the current Stitch / site design tokens.
     *
     * @return array<string, mixed>
     */
    public static function defaults(): array
    {
        return [
            'heading_font' => 'Inter',
            'body_font' => 'Montserrat',
            'label_font' => 'Inter',
            'base_line_height' => '1.5',
            'roles' => [
                'display_hero' => [
                    'size' => '56px',
                    'line_height' => '68px',
                    'weight' => '600',
                    'letter_spacing' => '-0.03em',
                    'family' => 'heading',
                ],
                'display_hero_mobile' => [
                    'size' => '36px',
                    'line_height' => '44px',
                    'weight' => '600',
                    'letter_spacing' => '-0.02em',
                    'family' => 'heading',
                ],
                'headline_lg' => [
                    'size' => '32px',
                    'line_height' => '40px',
                    'weight' => '600',
                    'letter_spacing' => '-0.02em',
                    'family' => 'heading',
                ],
                'headline_lg_mobile' => [
                    'size' => '26px',
                    'line_height' => '34px',
                    'weight' => '600',
                    'letter_spacing' => '-0.01em',
                    'family' => 'heading',
                ],
                'headline_md' => [
                    'size' => '24px',
                    'line_height' => '32px',
                    'weight' => '500',
                    'letter_spacing' => '-0.01em',
                    'family' => 'heading',
                ],
                'headline_sm' => [
                    'size' => '20px',
                    'line_height' => '28px',
                    'weight' => '500',
                    'letter_spacing' => '0',
                    'family' => 'heading',
                ],
                'title_md' => [
                    'size' => '16px',
                    'line_height' => '24px',
                    'weight' => '600',
                    'letter_spacing' => '0.02em',
                    'family' => 'body',
                ],
                'body_lg' => [
                    'size' => '16px',
                    'line_height' => '26px',
                    'weight' => '400',
                    'letter_spacing' => '0',
                    'family' => 'body',
                ],
                'body_md' => [
                    'size' => '14px',
                    'line_height' => '22px',
                    'weight' => '400',
                    'letter_spacing' => '0',
                    'family' => 'body',
                ],
                'body_sm' => [
                    'size' => '12px',
                    'line_height' => '18px',
                    'weight' => '400',
                    'letter_spacing' => '0',
                    'family' => 'body',
                ],
                'label_md' => [
                    'size' => '13px',
                    'line_height' => '18px',
                    'weight' => '500',
                    'letter_spacing' => '0',
                    'family' => 'label',
                ],
                'label_caps' => [
                    'size' => '11px',
                    'line_height' => '16px',
                    'weight' => '600',
                    'letter_spacing' => '0.08em',
                    'family' => 'label',
                ],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function get(): array
    {
        $raw = SiteSetting::getValue(self::SETTING_KEY);
        $stored = [];

        if (is_string($raw) && filled($raw)) {
            $decoded = json_decode($raw, true);
            $stored = is_array($decoded) ? $decoded : [];
        } elseif (is_array($raw)) {
            $stored = $raw;
        }

        $merged = array_replace_recursive(self::defaults(), $stored);
        unset($merged['pages']);

        return $merged;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function save(array $data): void
    {
        unset($data['pages']);
        $merged = array_replace_recursive(self::defaults(), $data);
        unset($merged['pages']);

        SiteSetting::setValue(
            self::SETTING_KEY,
            json_encode($merged, JSON_UNESCAPED_SLASHES),
            'typography',
            'json',
            'Typography Settings'
        );
    }

    /**
     * Resolved config for the public layout.
     *
     * @param  list<string>  $extraFonts
     * @return array{
     *     config: array<string, mixed>,
     *     google_fonts_url: string,
     *     font_family: array<string, array<int, string>>,
     *     font_size: array<string, array{0: string, 1: array<string, string>}>,
     *     css_variables: array<string, string>,
     *     utility_css: string
     * }
     */
    public static function resolved(array $extraFonts = []): array
    {
        $config = self::get();

        return [
            'config' => $config,
            'google_fonts_url' => self::googleFontsUrl($config, $extraFonts),
            'font_family' => self::fontFamilyConfig($config),
            'font_size' => self::fontSizeConfig($config),
            'css_variables' => self::cssVariables($config),
            'utility_css' => self::utilityCss(),
        ];
    }

    /**
     * @param  array<string, mixed>  $config
     * @param  list<string>  $extraFonts
     */
    public static function googleFontsUrl(array $config, array $extraFonts = []): string
    {
        $families = collect([
            $config['heading_font'] ?? 'Inter',
            $config['body_font'] ?? 'Montserrat',
            $config['label_font'] ?? 'Inter',
        ])
            ->merge(
                collect($config['roles'] ?? [])
                    ->pluck('custom_font')
                    ->filter()
            )
            ->merge($extraFonts)
            ->unique()
            ->filter(fn ($font) => is_string($font) && filled($font) && array_key_exists($font, self::fontOptions()))
            ->values();

        $query = $families
            ->map(function (string $font) {
                $family = str_replace(' ', '+', $font);

                return 'family='.$family.':wght@300;400;500;600;700;800';
            })
            ->implode('&');

        return 'https://fonts.googleapis.com/css2?'.$query.'&display=swap';
    }

    /**
     * CSS that binds utility classes to typography CSS variables.
     */
    public static function utilityCss(): string
    {
        $blocks = [];

        foreach (array_keys(self::roleDefinitions()) as $roleKey) {
            $cssKey = str_replace('_', '-', $roleKey);
            $familyGroup = self::roleDefinitions()[$roleKey]['family'];
            $fallbackFont = match ($familyGroup) {
                'body' => 'var(--font-body)',
                'label' => 'var(--font-label)',
                default => 'var(--font-heading)',
            };

            $blocks[] = ".font-{$cssKey}{font-family:var(--font-{$cssKey}, {$fallbackFont}) !important;}";
            $blocks[] = ".text-{$cssKey}{font-size:var(--type-{$cssKey}-size) !important;line-height:var(--type-{$cssKey}-leading) !important;font-weight:var(--type-{$cssKey}-weight) !important;letter-spacing:var(--type-{$cssKey}-tracking) !important;}";
        }

        return implode('', $blocks);
    }

    /**
     * @param  array<string, mixed>  $config
     * @return array<string, array<int, string>>
     */
    public static function fontFamilyConfig(array $config): array
    {
        $map = [];

        foreach (self::roleDefinitions() as $roleKey => $meta) {
            $role = $config['roles'][$roleKey] ?? [];
            $familyGroup = $role['family'] ?? $meta['family'];
            $custom = $role['custom_font'] ?? null;

            $font = filled($custom) && is_string($custom)
                ? $custom
                : match ($familyGroup) {
                    'body' => $config['body_font'] ?? 'Montserrat',
                    'label' => $config['label_font'] ?? 'Inter',
                    default => $config['heading_font'] ?? 'Inter',
                };

            $map[str_replace('_', '-', $roleKey)] = [$font];
        }

        return $map;
    }

    /**
     * @param  array<string, mixed>  $config
     * @return array<string, array{0: string, 1: array<string, string>}>
     */
    public static function fontSizeConfig(array $config): array
    {
        $map = [];

        foreach (array_keys(self::roleDefinitions()) as $roleKey) {
            $role = $config['roles'][$roleKey] ?? self::defaults()['roles'][$roleKey];
            $meta = [
                'lineHeight' => (string) ($role['line_height'] ?? '1.5'),
                'fontWeight' => (string) ($role['weight'] ?? '400'),
            ];

            $letter = trim((string) ($role['letter_spacing'] ?? '0'));
            if ($letter !== '' && $letter !== '0' && $letter !== '0em') {
                $meta['letterSpacing'] = $letter;
            }

            $map[str_replace('_', '-', $roleKey)] = [
                (string) ($role['size'] ?? '16px'),
                $meta,
            ];
        }

        return $map;
    }

    /**
     * @param  array<string, mixed>  $config
     * @return array<string, string>
     */
    public static function cssVariables(array $config): array
    {
        $vars = [
            '--font-heading' => "'".($config['heading_font'] ?? 'Inter')."', ui-sans-serif, system-ui, sans-serif",
            '--font-body' => "'".($config['body_font'] ?? 'Montserrat')."', ui-sans-serif, system-ui, sans-serif",
            '--font-label' => "'".($config['label_font'] ?? 'Inter')."', ui-sans-serif, system-ui, sans-serif",
            '--leading-base' => (string) ($config['base_line_height'] ?? '1.5'),
        ];

        $families = self::fontFamilyConfig($config);

        foreach (self::roleDefinitions() as $roleKey => $meta) {
            $role = $config['roles'][$roleKey] ?? [];
            $cssKey = str_replace('_', '-', $roleKey);
            $fontName = $families[$cssKey][0] ?? ($config['heading_font'] ?? 'Inter');
            $vars["--font-{$cssKey}"] = "'{$fontName}', ui-sans-serif, system-ui, sans-serif";
            $vars["--type-{$cssKey}-size"] = (string) ($role['size'] ?? '16px');
            $vars["--type-{$cssKey}-leading"] = (string) ($role['line_height'] ?? '1.5');
            $vars["--type-{$cssKey}-weight"] = (string) ($role['weight'] ?? '400');
            $vars["--type-{$cssKey}-tracking"] = (string) ($role['letter_spacing'] ?? '0');
        }

        return $vars;
    }
}
