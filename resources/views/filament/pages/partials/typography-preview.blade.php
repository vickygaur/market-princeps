@php
    use App\Support\Typography;

    $config = is_array($config ?? null) ? $config : Typography::fromDraft([]);
    $fontsUrl = Typography::googleFontsUrl($config);
    $cssVariables = Typography::cssVariables($config);
    $utilityCss = Typography::utilityCss();
    $roleMeta = Typography::roleDefinitions();
    $previewMeta = Typography::rolePreviewMeta();
    $headingFont = $config['heading_font'] ?? 'Inter';
    $bodyFont = $config['body_font'] ?? 'Montserrat';
    $labelFont = $config['label_font'] ?? 'Inter';
@endphp

<div
    wire:key="typography-preview-{{ md5(json_encode($config)) }}"
    class="fi-typography-preview sticky top-20 space-y-4"
>
    <link rel="stylesheet" href="{{ $fontsUrl }}">

    <style>
        .fi-typo-scope {
            @foreach ($cssVariables as $name => $value)
                {{ $name }}: {!! $value !!};
            @endforeach
        }
        {!! $utilityCss !!}
        .fi-typo-scope {
            background: #fcf9f4;
            color: #1c1c19;
            border-radius: 0.75rem;
            border: 1px solid rgba(199, 197, 206, 0.7);
            overflow: hidden;
        }
        .fi-typo-scope .fi-typo-mock {
            padding: 1.25rem 1.35rem 1.5rem;
        }
        .fi-typo-scope .fi-typo-role {
            border-top: 1px solid rgba(199, 197, 206, 0.55);
            padding: 0.85rem 1.25rem;
        }
        .fi-typo-scope .fi-typo-role:first-of-type {
            border-top: 0;
        }
        .fi-typo-meta {
            font-size: 11px;
            line-height: 1.4;
            color: #77767e;
            margin-top: 0.35rem;
        }
        .fi-typo-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #904d00;
            background: rgba(254, 147, 44, 0.12);
            border: 1px solid rgba(254, 147, 44, 0.28);
            border-radius: 999px;
            padding: 0.2rem 0.55rem;
        }
        .fi-typo-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 0.85rem;
            padding: 0.7rem 1.1rem;
            border-radius: 0.65rem;
            background: #161b33;
            color: #ffffff;
            text-transform: uppercase;
        }
        .fi-typo-card {
            margin-top: 1rem;
            padding: 0.9rem 1rem;
            border-radius: 0.65rem;
            background: #ffffff;
            border: 1px solid rgba(199, 197, 206, 0.55);
        }
        .fi-typo-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 0.35rem;
        }
        .fi-typo-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: inherit;
        }
        .fi-typo-sub {
            font-size: 0.8rem;
            color: #77767e;
        }
        .dark .fi-typo-scope {
            background: rgba(255, 255, 255, 0.03);
            border-color: rgba(255, 255, 255, 0.1);
            color: #f3f0eb;
        }
        .dark .fi-typo-card {
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(255, 255, 255, 0.1);
        }
        .dark .fi-typo-meta,
        .dark .fi-typo-sub {
            color: rgba(243, 240, 235, 0.65);
        }
    </style>

    <div class="fi-typo-header">
        <div>
            <div class="fi-typo-title">Live preview</div>
            <div class="fi-typo-sub">Updates as you edit. Save to apply on the public site.</div>
        </div>
        <span class="fi-typo-badge">Draft</span>
    </div>

    <div class="fi-typo-scope">
        <div class="fi-typo-mock">
            <div class="font-label-caps text-label-caps" style="color:#904d00; text-transform:uppercase;">
                {{ $previewMeta['label_caps']['sample'] }}
            </div>

            <div class="font-display-hero text-display-hero" style="margin-top:0.75rem; max-width: 18ch;">
                {{ $previewMeta['display_hero']['sample'] }}
            </div>

            <div class="font-body-lg text-body-lg" style="margin-top:0.75rem; color:#46464d; max-width: 42ch;">
                {{ $previewMeta['body_lg']['sample'] }}
            </div>

            <div class="fi-typo-btn font-title-md text-title-md">
                {{ $previewMeta['title_md']['sample'] }}
            </div>

            <div class="fi-typo-card">
                <div class="font-label-md text-label-md" style="color:#904d00;">
                    {{ $previewMeta['label_md']['sample'] }}
                </div>
                <div class="font-headline-lg text-headline-lg" style="margin-top:0.45rem;">
                    {{ $previewMeta['headline_lg']['sample'] }}
                </div>
                <div class="font-body-md text-body-md" style="margin-top:0.45rem; color:#46464d;">
                    {{ $previewMeta['body_md']['sample'] }}
                </div>
                <div class="font-headline-sm text-headline-sm" style="margin-top:0.85rem;">
                    {{ $previewMeta['headline_sm']['sample'] }}
                </div>
                <div class="font-body-sm text-body-sm" style="margin-top:0.35rem; color:#46464d;">
                    {{ $previewMeta['body_sm']['sample'] }}
                </div>
            </div>

            <div class="fi-typo-meta" style="margin-top:0.9rem;">
                Fonts in use: {{ $headingFont }} (headings) · {{ $bodyFont }} (body) · {{ $labelFont }} (labels)
            </div>
        </div>

        <div style="background: rgba(22, 27, 51, 0.03);">
            @foreach ($roleMeta as $roleKey => $meta)
                @php
                    $preview = $previewMeta[$roleKey] ?? ['sample' => $meta['label'], 'used_on' => []];
                    $cssKey = str_replace('_', '-', $roleKey);
                @endphp
                <div class="fi-typo-role">
                    <div style="display:flex; justify-content:space-between; gap:0.75rem; align-items:baseline;">
                        <div style="font-size:11px; font-weight:700; letter-spacing:0.04em; text-transform:uppercase; color:#77767e;">
                            {{ $meta['label'] }}
                        </div>
                        <div style="font-size:11px; color:#77767e; white-space:nowrap;">
                            {{ data_get($config, "roles.{$roleKey}.size") }}
                            ·
                            {{ data_get($config, "roles.{$roleKey}.weight") }}
                        </div>
                    </div>
                    <div class="font-{{ $cssKey }} text-{{ $cssKey }}" style="margin-top:0.35rem;">
                        {{ $preview['sample'] }}
                    </div>
                    @if (! empty($preview['used_on']))
                        <div class="fi-typo-meta">
                            Affects: {{ implode(' · ', $preview['used_on']) }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
