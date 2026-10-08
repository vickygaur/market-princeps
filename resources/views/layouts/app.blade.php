@php
    use App\Models\SiteSetting;
    use App\Support\Typography;

    $siteName = $settings['site_name'] ?? SiteSetting::getValue('site_name', 'Market Princeps');
    $metaTitle = $page->meta_title ?? $page->seoTitle() ?? $siteName;
    $metaDescription = $page->meta_description ?? SiteSetting::getValue('meta_description');
    $metaKeywords = $page->meta_keywords ?? SiteSetting::getValue('meta_keywords');
    $ogTitle = $page->og_title ?? $metaTitle;
    $ogDescription = $page->og_description ?? $metaDescription;
    $ogImage = media_url($page->og_image ?? SiteSetting::getValue('default_og_image', SiteSetting::getValue('og_image')));
    $robots = $page->robots ?? SiteSetting::getValue('robots', 'index, follow');
    $canonical = $page->canonical_url ?? url()->current();
    $favicon = media_url($settings['site_favicon'] ?? SiteSetting::getValue('site_favicon'));
    $typography = Typography::resolved();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle }}</title>
    @if ($favicon)
        <link rel="icon" href="{{ $favicon }}">
        <link rel="apple-touch-icon" href="{{ $favicon }}">
    @endif
    @if ($metaDescription)
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    @if ($metaKeywords)
        <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    <meta name="robots" content="{{ $robots }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $ogTitle }}">
    @if ($ogDescription)
        <meta property="og:description" content="{{ $ogDescription }}">
    @endif
    <meta property="og:url" content="{{ $canonical }}">
    @if ($ogImage)
        <meta property="og:image" content="{{ $ogImage }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    @if ($ogDescription)
        <meta name="twitter:description" content="{{ $ogDescription }}">
    @endif
    @if ($ogImage)
        <meta name="twitter:image" content="{{ $ogImage }}">
    @endif
    @if (! empty($page->schema_markup))
        @php
            $schema = trim($page->schema_markup);
            $isWrapped = str_contains(strtolower($schema), '<script');
        @endphp
        @if ($isWrapped)
            {!! $schema !!}
        @else
            <script type="application/ld+json">{!! $schema !!}</script>
        @endif
    @endif
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="{{ $typography['google_fonts_url'] }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
:root {
@foreach ($typography['css_variables'] as $name => $value)
  {{ $name }}: {!! $value !!};
@endforeach
}
@layer base{html,body{margin:0;padding:0;height:auto;min-height:100%;overflow-x:visible;overflow-y:visible;}body{overscroll-behavior-y:auto;font-family:var(--font-body);line-height:var(--leading-base);-webkit-overflow-scrolling:touch;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}img,video{max-width:100%;height:auto;}@media (max-width:639px){.break-mobile{overflow-wrap:anywhere;word-break:break-word;}}}
::-webkit-scrollbar{display:none;}

@keyframes conduitFlow {
  0% { stroke-dashoffset: 48; }
  100% { stroke-dashoffset: 0; }
}

@keyframes signalPulse {
  0% { transform: scale(0.95); opacity: 0.6; }
  50% { transform: scale(1.15); opacity: 1; filter: drop-shadow(0 0 6px rgba(254,147,44,0.9)); }
  100% { transform: scale(0.95); opacity: 0.6; }
}

@keyframes shimmerGleam {
  0% { background-position: -200% 0; }
  100% { background-position: 200% 0; }
}

@keyframes subtleFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-5px); }
}

@keyframes beaconPing {
  0% { transform: scale(1); opacity: 0.9; }
  70% { transform: scale(2.4); opacity: 0; }
  100% { transform: scale(2.4); opacity: 0; }
}

@keyframes ambientAura {
  0%, 100% { opacity: 0.45; transform: scale(1); }
  50% { opacity: 0.75; transform: scale(1.08); }
}

.conduit-stream {
  stroke-dasharray: 8, 12;
  animation: conduitFlow 1.1s linear infinite;
}

.beacon-pulse {
  position: relative;
}
.beacon-pulse::after {
  content: '';
  position: absolute;
  inset: -3px;
  border-radius: 9999px;
  background: radial-gradient(circle, rgba(254,147,44,0.6) 0%, rgba(254,147,44,0) 70%);
  animation: beaconPing 2s cubic-bezier(0, 0, 0.2, 1) infinite;
  pointer-events: none;
}

.beacon-pulse-emerald::after {
  content: '';
  position: absolute;
  inset: -3px;
  border-radius: 9999px;
  background: radial-gradient(circle, rgba(46,204,113,0.7) 0%, rgba(46,204,113,0) 70%);
  animation: beaconPing 2.2s cubic-bezier(0, 0, 0.2, 1) infinite;
  pointer-events: none;
}

.shimmer-sweep-btn {
  position: relative;
  overflow: hidden;
}
.shimmer-sweep-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -150%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.22), rgba(254,147,44,0.35), transparent);
  transform: skewX(-20deg);
  animation: shimmerGleam 3.5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
}

.shimmer-text-glow {
  background: linear-gradient(90deg, #904d00 0%, #fe932c 30%, #ffdcc3 50%, #fe932c 70%, #904d00 100%);
  background-size: 200% auto;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: shimmerGleam 4s linear infinite;
}

.card-hover-elevate {
  transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.28s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.28s ease;
}
.card-hover-elevate:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 32px -8px rgba(144, 77, 0, 0.12), 0 4px 12px rgba(22, 27, 51, 0.05);
}

.float-slow {
  animation: subtleFloat 4.8s ease-in-out infinite;
}
.float-delayed {
  animation: subtleFloat 5.2s ease-in-out 1.2s infinite;
}

.ambient-glow {
  animation: ambientAura 6s ease-in-out infinite;
}

.tab-transition-fade {
  transition: opacity 0.25s ease, transform 0.25s ease;
}

#mobile-nav-panel:not(.hidden) {
  animation: mobileNavSlide 0.25s ease-out;
}
@keyframes mobileNavSlide {
  from { opacity: 0; transform: translateY(-8px); }
  to { opacity: 1; transform: translateY(0); }
}
    </style>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {"on-tertiary":"#ffffff","tertiary":"#090000","surface-container-high":"#ebe8e3","on-primary-fixed":"#151a32","on-tertiary-fixed":"#410002","inverse-on-surface":"#f3f0eb","on-primary":"#ffffff","on-secondary-fixed":"#2f1500","surface-container-low":"#f6f3ee","surface-container-highest":"#e5e2dd","background":"#fcf9f4","inverse-surface":"#31302d","on-tertiary-container":"#e5534a","tertiary-container":"#430003","on-error-container":"#93000a","tertiary-fixed-dim":"#ffb4ac","surface":"#fcf9f4","secondary":"#904d00","secondary-fixed":"#ffdcc3","on-secondary-fixed-variant":"#6e3900","primary-fixed-dim":"#c1c5e5","secondary-fixed-dim":"#ffb77d","on-background":"#1c1c19","primary-container":"#161b33","tertiary-fixed":"#ffdad6","surface-variant":"#e5e2dd","on-surface-variant":"#46464d","primary-fixed":"#dde1ff","surface-bright":"#fcf9f4","on-surface":"#1c1c19","on-secondary":"#ffffff","error":"#ba1a1a","primary":"#00010f","error-container":"#ffdad6","outline":"#77767e","on-secondary-container":"#663500","on-primary-container":"#7e83a0","secondary-container":"#fe932c","on-primary-fixed-variant":"#404560","on-tertiary-fixed-variant":"#8e1214","surface-container-lowest":"#ffffff","on-error":"#ffffff","surface-container":"#f0ede9","inverse-primary":"#c1c5e5","outline-variant":"#c7c5ce","surface-dim":"#dcdad5","surface-tint":"#585d78"},
                    borderRadius: {"DEFAULT":"0.125rem","lg":"0.25rem","xl":"0.5rem","full":"0.75rem"},
                    spacing: {"space-xs":"0.25rem","space-lg":"1.5rem","gutter":"1.5rem","gutter-mobile":"1rem","space-xl":"2.5rem","margin":"3rem","space-sm":"0.5rem","space-md":"1rem","margin-mobile":"1.25rem"},
                    fontFamily: @json($typography['font_family']),
                    fontSize: @json($typography['font_size'])
                }
            }
        };
    </script>
    <style id="typography-utilities">{!! $typography['utility_css'] !!}</style>
    @stack('head')
</head>
<body class="bg-surface font-body-md text-on-surface antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed">
    @include('partials.header')

    <main class="w-full pt-20 bg-surface">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
