@extends('layouts.app')

@section('content')
<div class="flex flex-col w-full">
    @include('home.sections.hero')
    @include('home.sections.metrics')
    @include('home.sections.philosophy')
    @include('home.sections.triad')
    @include('home.sections.simulator')
    @include('home.sections.process')
    @include('home.sections.intake')
</div>
@endsection

@push('scripts')
    @include('home.scripts')
@endpush
