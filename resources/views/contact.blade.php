@extends('layouts.app')

@section('content')
<div class="flex flex-col w-full">
    @include('contact.sections.hero', ['sections' => $sections])
    @include('contact.sections.hub', ['sections' => $sections, 'settings' => $settings])
    @include('contact.sections.faq', ['sections' => $sections])
</div>
@endsection

@push('head')
<style>
@keyframes goldShimmer {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.gold-shimmer-text {
  background: linear-gradient(135deg, #e14e29 0%, #ea580c 25%, #f59e0b 50%, #ea580c 75%, #e14e29 100%);
  background-size: 200% auto;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  display: inline-block;
  animation: goldShimmer 4s ease-in-out infinite;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(4px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
  animation: fadeIn 0.35s ease-out forwards;
}
</style>
@endpush

@push('scripts')
    @include('contact.scripts')
@endpush
