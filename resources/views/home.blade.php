@extends('master')

@section('content')

    <!-- banner -->
    @include('partials/banner')
    <!-- banner end -->

    <div class="container mx-auto">
        <!-- logos -->
        @include('partials/logos')
        <!-- logos end -->

        <!-- about -->
        @include('partials/search')
        <!-- about end-->

        <!-- advertisements -->
        @if(!empty($home_long_ad_1))
            <div class="row">
                <div class="col-sm-12">
                    @if( $home_long_ad_1->url != "undefined")

                        <a href="{{$home_long_ad_1->url}}">
                            <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$home_long_ad_1->image}}" class="d-block w-100" alt="...">
                        </a>
                    @else
                        {!! $home_long_ad_1->ad !!}
                    @endif
                </div>
            </div>
        @endif
        <!-- advertisements end -->

        <!-- featured catalogs -->
        {{--  @include('partials/catalogs/featured')  --}}
        <!-- featured catalogs end-->

        <!-- latest catalogs -->
        <h2 class="text-3xl mt-8">The latest catalogs</h2>
        @include('partials/catalogs/latest')
        <!-- latest catalogs end-->

        <!-- advertisements 2-->
        @if(!empty($home_long_ad_2))
            <div class="row">
                <div class="col-sm-12">
                    @if( $home_long_ad_2->url != "undefined")

                        <a href="{{$home_long_ad_2->url}}">
                            <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$home_long_ad_2->image}}" class="d-block w-100" alt="...">
                        </a>
                    @else
                        {!! $home_long_ad_2->ad !!}
                    @endif
                </div>
            </div>
        @endif
        <!-- advertisements 2 end -->

        <!-- popular catalogs -->
        @include('partials/catalogs/popular')
        <!-- popular catalogs end-->

        <!-- advertisements 3-->
        @if(!empty($home_long_ad_3))
            <div class="row">
                <div class="col-sm-12">
                    @if( $home_long_ad_3->url != "undefined")

                        <a href="{{$home_long_ad_3->url}}">
                            <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$home_long_ad_3->image}}" class="d-block w-100" alt="...">
                        </a>
                    @else
                        {!! $home_long_ad_3->ad !!}
                    @endif
                </div>
            </div>
        @endif
        <!-- advertisements 3 end -->


        <!-- latest blog -->
        @include('partials/latest_blog')
        <!-- latest blog end -->

        <!-- about -->
        @include('partials/about')
        <!-- about end-->

    </div>

@endsection
