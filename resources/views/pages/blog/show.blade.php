@extends('master')

@section('content')

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <div class="bannerAd">
        <img src="/img/other/banner-ad.png"/>
    </div>

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

            </div>
        </div>

    <!-- see all the catalogs -->
        @include('partials/see_all_catalogs')
    <!-- see all the catalogs  end-->

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

    <!-- check all stores -->
    @include('partials/browse_our_stores_list')
    <!-- check all stores end-->

        <!-- latest catalogs -->
        <h2 class="text-3xl mt-8">The latest catalogs</h2>
    @include('partials/catalogs/latest')
    <!-- latest catalogs end-->




    </div>


@endsection


