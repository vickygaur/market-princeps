@extends('layouts.app')

@php
    $content = $content ?? ($service->page_content ?? []);
    $primaryCta = data_get($content, 'cta.primary_label', data_get($content, 'hero.primary_cta', 'GET IN TOUCH'));
    $secondaryCta = data_get($content, 'hero.secondary_cta', 'SEE HOW WE WORK');
@endphp

@section('content')
<div class="flex flex-col w-full bg-background">
    @include('services.sections.hero', compact('service', 'content', 'primaryCta', 'secondaryCta'))
    @include('services.sections.difference', compact('service', 'content', 'primaryCta'))
    @include('services.sections.pillars', compact('service', 'content', 'primaryCta'))
    @include('services.sections.roadmap', compact('service', 'content', 'primaryCta'))
    @include('services.sections.faq', compact('service', 'content', 'primaryCta'))
    @include('services.sections.intake', compact('service', 'content', 'primaryCta'))
</div>
@endsection

@push('head')
<style>
@keyframes brandShimmer {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}
.traffic-glow,
.text-glow-shimmer {
  background-size: 200% auto;
  animation: brandShimmer 3.5s ease infinite;
}
</style>
@endpush

@push('scripts')
    @include('services.scripts', compact('service', 'content'))
@endpush
