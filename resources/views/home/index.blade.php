@extends('home.home_master')

@section('home')
    {{-- home --}}
    @include('home.homelayout.slider')

    <!-- features -->
    @include('home.homelayout.features')

    {{-- clarifies --}}
    @include('home.homelayout.clarifies')

    {{-- get_all --}}
    @include('home.homelayout.get_all')

    {{-- usability --}}
    @include('home.homelayout.usability')

    {{-- reviews --}}
    @include('home.homelayout.reviews')

    {{-- answers --}}
    @include('home.homelayout.answers')

    {{-- apps --}}
    @include('home.homelayout.apps')
@endsection
