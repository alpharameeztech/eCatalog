@extends('master')

@section('content')

    <!-- banner -->
    @include('partials/banner')
    <!-- banner end -->

    <div class="container mx-auto">
        <!-- logos -->
        @include('partials/logos')
        <!-- logos end -->

        <!-- advertisements -->
        @include('partials/advertisements')
        <!-- advertisements end -->

        <!-- featured catalogs -->
        {{--  @include('partials/catalogs/featured')  --}}
        <!-- featured catalogs end-->

        <!-- latest catalogs -->
        <h2 class="text-3xl mt-8">Latest Catalogs</h2>
        @include('partials/catalogs/latest')
        <!-- latest catalogs end-->

        <!-- popular catalogs -->
        <h2 class="text-3xl mt-8">Popular Catalogs</h2>
        @include('partials/catalogs/popular')
        <!-- popular catalogs end-->
    </div>

@endsection
