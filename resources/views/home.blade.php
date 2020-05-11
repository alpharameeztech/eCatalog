@extends('master')

@section('content')

    <!-- logos -->
    @include('partials/logos')
    <!-- logos end -->

    <!-- featured catalogs -->
    @include('partials/catalogs/featured')
    <!-- featured catalogs end-->

    <!-- latest catalogs -->
    <h2 class="text-3xl mt-8">Latest Catalogs</h2>
    @include('partials/catalogs/latest')
    <!-- latest catalogs end-->

    <!-- popular catalogs -->
    <h2 class="text-3xl mt-8">Popular Catalogs</h2>
    @include('partials/catalogs/popular')
    <!-- popular catalogs end-->


@endsection
