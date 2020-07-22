@extends('master')

@section('content')

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <div class="bannerAd">
        <img src="/img/other/banner-ad.png"/>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-sm-9">

                @foreach($blogs as $blog)
                    <div>

                        <h2>{{ strtoupper($blog->title) }}</h2>

                        <p>
                            {!! Str::limit($blog->body, 400, '') !!}...
                        </p>

                        <div class="readMoreBlog">
                            <p><a href="/blog/{{$blog->slug}}">Read post</a></p>
                            <a class="arrowIcon" href="/blog/{{$blog->slug}}">
                                <img src="/img/icons/right-icon.png" />
                            </a>
                        </div>
                        <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$blog->image}}" />

                    </div>
                @endforeach

                    <div class="row">
                        <div class="col-sm-12 catalogNavigation">
                            <span class="pages">Pages </span> {{ $blogs->links() }}
                        </div>
                    </div>

            </div>

            <div class="col-sm-3">

            </div>
        </div>

{{--        ===================== latest blog posts =================--}}
        <h2 class="lineBreaker">The latest blog posts</h2>

        <div class="row latestBlogContainer">
            @foreach($latest_blogs as $blog)
                <div class="col-sm-6">
                    <a href="/blog/{{$blog->slug}}">
                        <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$blog->image}}" />
                    </a>
                    <h3 class="fontMada"><a href="/blog/{{$blog->slug}}">{{$blog->title}}</a></h3>
                    <p>{!! Str::limit($blog->body, 200, '') !!}...</p>
                </div>
            @endforeach
        </div>
        {{--        ===================== latest blog posts end =================--}}

    <!-- see all the catalogs -->
        @include('partials/see_all_catalogs')
    <!-- see all the catalogs  end-->

        {{--        ===================== popular blog posts =================--}}
        <h2 class="lineBreaker">Popular blog posts</h2>

        <div class="row popularBlogContainer">
            @foreach($popular_blogs as $blog)
                <div class="col-sm-6">
                    <a href="/blog/{{$blog->slug}}">
                        <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$blog->image}}" />
                    </a>
                    <h3 class="fontMada"><a href="/blog/{{$blog->slug}}">{{$blog->title}}</a></h3>
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


