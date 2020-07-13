@extends('master')

@section('content')


    <div class="bannerAd">
        <img src="/img/other/banner-ad.png" />
    </div>

    <div class="container">

        <!-- check all stores -->
            @include('partials/catalogs/check_all_stores')
        <!-- check all stores end-->

        <!-- all catalogs -->
        <h2 class="lineBreaker"></h2>

        {{--  -----------sorting -----------  --}}
        <div class="row sortingContainer">
            <div class="col-sm-1">
                <a href=""><span class="sortSpan">Sort by</span></a>
            </div>
            <div class="col-sm-9">
                <nav role='navigation'>
                    <ul class="sorting">
                        <li>
                            <a href="/catalogs">
                                <div>
                                    All
                                </div>
                            </a>
                        </li>
                        @foreach ($tags as $key=>$tag)
                            <li class="@if( request('tag') == $tag->slug) activeTag  @endif">
                                <a href="/catalogs?tag={{$tag->slug}}">
                                    {{$tag->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="col-sm-2">
                <a href="/catalogs?tag=newest" class="newestSort">
                    <span>Newest</span>
                    <img src="/img/icons/arrow-down-black.svg"/>
                </a>
            </div>
        </div>

        {{--  -----------sorting end -----------  --}}

        <div class="row popularCatalogsContainer">
        @foreach ($stores as $key=>$store)

            @if($key == 12)
                <!-- check all stores -->
                @include('partials/advertisements3')
                <!-- check all stores end-->
            @endif


                <div class="col-sm-3 customContainers bgWhite">


                    <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$store->image}}" alt="Sunset in the mountains">

                    <div class="row catalogDetails bgGray">
                        <div class="col-sm-12 storeContainerIndex">

                            <div class="textContainer">

                                <p class="alignCenter">
                                    Store {{$store->name}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-sm-12 catalogNavigation">
                <span class="pages">Pages </span> {{ $stores->links() }}
            </div>
        </div>


        <!-- check all stores -->
    @include('partials/browse_catalogs_banner')
    <!-- check all stores end-->

        <!-- all catalogs end-->
    </div>


@endsection




