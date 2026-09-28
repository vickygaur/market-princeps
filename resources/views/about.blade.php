@extends('layouts.app')

@section('content')
<div class="flex flex-col w-full">
    @include('about.sections.hero', ['sections' => $sections])
    @include('about.sections.origin', ['sections' => $sections])
    @include('about.sections.triad', ['sections' => $sections])
    @include('about.sections.doctrine', ['sections' => $sections])
    @include('about.sections.existence', ['sections' => $sections])
    @include('about.sections.cta', ['sections' => $sections])
</div>
@endsection

@push('head')
<style>
@keyframes goldShimmer {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.gold-gradient-shimmer {
  background: linear-gradient(135deg, #904d00 0%, #fe932c 25%, #ffb77d 50%, #fe932c 75%, #904d00 100%);
  background-size: 250% auto;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  animation: goldShimmer 5s ease infinite;
  display: inline-block;
}

.gold-glow-text {
  text-shadow: 0 0 25px rgba(254, 147, 44, 0.25);
}

@keyframes pulseGlowSlow {
  0%, 100% { opacity: 0.35; transform: scale(1); }
  50% { opacity: 0.65; transform: scale(1.04); }
}
.animate-pulse-glow { animation: pulseGlowSlow 6s ease-in-out infinite; }

.hero-ambient-grid {
  background-image: radial-gradient(rgba(144, 77, 0, 0.08) 1px, transparent 1px);
  background-size: 28px 28px;
}

.reveal-init {
  opacity: 0;
  transform: translateY(24px);
  transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
  will-change: opacity, transform;
}
.reveal-visible {
  opacity: 1;
  transform: translateY(0);
}

.delay-100 { transition-delay: 100ms; }
.delay-200 { transition-delay: 200ms; }
.delay-300 { transition-delay: 300ms; }
.delay-400 { transition-delay: 400ms; }

.stat-interactive-card {
  transition: transform 0.3s cubic-bezier(0.2, 0, 0, 1), box-shadow 0.3s ease, border-color 0.3s ease;
}
.stat-interactive-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 28px -6px rgba(144, 77, 0, 0.12);
  border-color: rgba(254, 147, 44, 0.45);
}
.stat-interactive-card:hover .stat-icon-wrapper {
  transform: scale(1.08) rotate(3deg);
}
.stat-icon-wrapper {
  transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.doctrine-card {
  transition: transform 0.28s cubic-bezier(0.2, 0, 0, 1), box-shadow 0.28s ease, border-color 0.28s ease;
}
.doctrine-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 24px -6px rgba(22, 27, 51, 0.08);
  border-color: rgba(254, 147, 44, 0.35);
}
.doctrine-card:hover .doctrine-num {
  transform: scale(1.06);
  color: #fe932c;
}
.doctrine-num {
  transition: transform 0.25s ease, color 0.25s ease;
}

.codex-active {
  background-color: rgba(235, 232, 227, 0.14) !important;
  border-color: rgba(254, 147, 44, 0.6) !important;
  box-shadow: 0 0 20px -3px rgba(254, 147, 44, 0.15) !important;
}

@keyframes indicatorBreathe {
  0%, 100% { opacity: 0.9; transform: scale(1); }
  50% { opacity: 0.5; transform: scale(0.95); }
}
.status-indicator-glow {
  animation: indicatorBreathe 3s ease-in-out infinite;
}

@media (prefers-reduced-motion: reduce) {
  *, ::before, ::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
  .reveal-init {
    opacity: 1 !important;
    transform: none !important;
  }
}
</style>
@endpush

@push('scripts')
    @include('about.scripts')
@endpush
