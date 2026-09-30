<?php

namespace App\Support;

use Filament\Forms\Components\Select;

class MaterialIcons
{
    /**
     * Curated Material Symbols used across the site (plus common business icons).
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        $icons = [
            'account_tree',
            'ads_click',
            'analytics',
            'architecture',
            'assured_workload',
            'auto_awesome',
            'auto_stories',
            'bolt',
            'business_center',
            'cached',
            'call',
            'campaign',
            'chat',
            'check_circle',
            'cloud',
            'code',
            'construction',
            'credit_card',
            'dashboard',
            'database',
            'developer_board',
            'diamond',
            'dns',
            'domain',
            'drafts',
            'email',
            'engineering',
            'fact_check',
            'filter_alt',
            'fingerprint',
            'group',
            'group_work',
            'handshake',
            'hub',
            'insights',
            'integration_instructions',
            'language',
            'layers',
            'lock',
            'mail',
            'manage_accounts',
            'menu_book',
            'monitoring',
            'paid',
            'payments',
            'people',
            'perm_phone_msg',
            'phone_in_talk',
            'psychology',
            'query_stats',
            'rocket_launch',
            'schedule',
            'search',
            'security',
            'settings',
            'settings_suggest',
            'share',
            'shield',
            'shopping_cart',
            'smart_toy',
            'speed',
            'storage',
            'storefront',
            'support_agent',
            'sync',
            'target',
            'task_alt',
            'terminal',
            'timeline',
            'travel_explore',
            'trending_down',
            'trending_flat',
            'trending_up',
            'tune',
            'verified',
            'verified_user',
            'visibility',
            'web',
            'work',
            'workspace_premium',
        ];

        $options = [];

        foreach ($icons as $icon) {
            $options[$icon] = str($icon)->replace('_', ' ')->title()->toString().' ('.$icon.')';
        }

        return $options;
    }

    public static function select(string $name = 'icon', string $label = 'Icon'): Select
    {
        return Select::make($name)
            ->label($label)
            ->options(static::options())
            ->searchable()
            ->native(false)
            ->nullable()
            ->placeholder('Select an icon')
            ->helperText('Search and pick a Material icon for the website.');
    }
}
