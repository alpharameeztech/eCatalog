@extends('master')

@section('content')

    <!-- navigation -->
    @include('partials/navigation')
    <!-- navigation end -->

    <!-- logos -->
    @include('partials/logos')
    <!-- logos end -->

    <!-- catalogs -->
    <h2 class="text-3xl mt-8">Latest Catalogs</h2>
    @include('partials/catalog')
    <!-- catalogs end-->

    <!-- popular catalogs -->
    <h2 class="text-3xl mt-8">Popular Catalogs</h2>
    @include('partials/catalog')
    <!-- popular catalogs end-->

@endsection
