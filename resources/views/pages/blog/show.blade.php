@extends('master')

@section('content')

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">


    <div class="container">

        <div class="row">
            <div class="col-sm-9">

                <div>

                    <h2>{{ strtoupper($blog->title) }}</h2>

                    <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$blog->image}}" />

                    <p>
                        {!! $blog->body !!}
                    </p>


                </div>

            </div>

            <div class="col-sm-3">

                @foreach($blog_right_sections as $advertisement)
                    @if( $advertisement->image != "undefined")
                        <div class="storeRightAdvertisement">
                            <a href="{{$advertisement->url}}" target="_blank">
                                <img  src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$advertisement->image}}" >
                            </a>
                        </div>
                    @else

                        {!! $advertisement->ad !!}
                    @endif

                @endforeach

            </div>
        </div>

        <!-- advertisements -->
        @foreach($blog_long_ad_1 as $advertisement)
            @if(!empty($advertisement))
                <div class="advertisement checkStores noShadow">
                    @if( $advertisement->url != "undefined")

                        <a href="{{$advertisement->url}}">
                            <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$advertisement->image}}"
                                 class="d-block w-100" alt="...">
                        </a>
                    @else
                        {!! $advertisement->ad !!}
                    @endif
                </div>
            @endif
        @endforeach
    <!-- advertisements end -->

        {{--        ===================== popular blog posts =================--}}
        <h2 class="lineBreaker">Popular blog posts</h2>

        <div class="row">
            @foreach($popular_blogs as $blog)
                <div class="col-sm-6">
                    <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$blog->image}}" />
                    <h3 class="fontMada">{{$blog->title}}</h3>
                    <p>{!! Str::limit($blog->body, 200, '') !!}...</p>
                </div>
            @endforeach
        </div>
    {{--        ===================== popular blog posts end =================--}}

    <!-- advertisements -->
        @foreach($blog_long_ad_2 as $advertisement)
            @if(!empty($advertisement))
                <div class="advertisement checkStores noShadow">
                    @if( $advertisement->url != "undefined")

                        <a href="{{$advertisement->url}}">
                            <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$advertisement->image}}"
                                 class="d-block w-100" alt="...">
                        </a>
                    @else
                        {!! $advertisement->ad !!}
                    @endif
                </div>
        @endif
    @endforeach
    <!-- advertisements end -->

        <!-- latest catalogs -->
        <h2 class="text-3xl mt-8">The latest catalogs</h2>
    @include('partials/catalogs/latest')
    <!-- latest catalogs end-->




    </div>


@endsection


