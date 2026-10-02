@extends('layouts.client.app')

@section('content')

    {{-- Sections --}}
    @include('client.about-kategorial.partials.hero')
    @include('client.about-kategorial.partials.pengantar')
    @include('client.about-kategorial.partials.carousel')
    @include('client.about-kategorial.partials.pengurus')
    @include('client.about-kategorial.partials.statistik')
    @include('client.about-kategorial.partials.galeri')

    @include('client.about-kategorial.partials.scripts')

@endsection
