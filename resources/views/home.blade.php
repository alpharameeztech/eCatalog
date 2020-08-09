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
        @foreach($home_long_ad_1 as $advertisement)
            @if(!empty($advertisement))
                <div class="row">
                    <div class="col-sm-12 advertisement">
                        @if( $advertisement->url != "undefined")

                            <a href="{{$advertisement->url}}">
                                <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$advertisement->image}}" class="d-block w-100" alt="...">
                            </a>
                        @else
                            {!! $advertisement->ad !!}
                        @endif
                    </div>
                </div>
            @endif
        @endforeach

        <!-- advertisements end -->

        <!-- featured catalogs -->
        {{--  @include('partials/catalogs/featured')  --}}
        <!-- featured catalogs end-->

        <!-- latest catalogs -->
        <h2 class="text-3xl mt-8">The latest catalogs</h2>
        @include('partials/catalogs/latest')
        <!-- latest catalogs end-->

        <!-- advertisements -->
        @foreach($home_long_ad_2 as $advertisement)
            @if(!empty($advertisement))
                <div class="row">
                    <div class="col-sm-12 advertisement">
                        @if( $advertisement->url != "undefined")

                            <a href="{{$advertisement->url}}">
                                <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$advertisement->image}}" class="d-block w-100" alt="...">
                            </a>
                        @else
                            {!! $advertisement->ad !!}
                        @endif
                    </div>
                </div>
            @endif
        @endforeach

        <!-- popular catalogs -->
        @include('partials/catalogs/popular')
        <!-- popular catalogs end-->

        <!-- advertisements -->
        @foreach($home_long_ad_3 as $advertisement)
            @if(!empty($advertisement))
                <div class="row">
                    <div class="col-sm-12 advertisement">
                        @if( $advertisement->url != "undefined")

                            <a href="{{$advertisement->url}}">
                                <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$advertisement->image}}" class="d-block w-100" alt="...">
                            </a>
                        @else
                            {!! $advertisement->ad !!}
                        @endif
                    </div>
                </div>
            @endif
        @endforeach


        <!-- latest blog -->
        @include('partials/latest_blog')
        <!-- latest blog end -->

        <!-- about -->
        @include('partials/about')
        <!-- about end-->

    </div>

@endsection
