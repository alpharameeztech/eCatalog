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
        <h2 class="text-3xl mt-8">The latest catalogs</h2>
        @include('partials/catalogs/latest')
        <!-- latest catalogs end-->

        <!-- find catalog banner -->
        @include('partials/find')
        <!-- find catalog banner end-->

        <!-- popular catalogs -->
        @include('partials/catalogs/popular')
        <!-- popular catalogs end-->

        <!-- advertisements2 -->
        @include('partials/advertisements2')
        <!-- advertisements2 end -->

        <!-- latest blog -->
        @include('partials/latest_blog')
        <!-- latest blog end -->

        <!-- about -->
        @include('partials/about')
        <!-- about end-->

    </div>

@endsection
