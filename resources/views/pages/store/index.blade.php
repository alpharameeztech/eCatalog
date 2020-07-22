@extends('master')

@section('content')


    <div class="bannerAd">
        <img src="/img/other/banner-ad.png" />
    </div>

    <div class="container">

        <!-- check all stores -->
            @include('partials/catalogs/check_all_stores_without_cta')
        <!-- check all stores end-->

        <!-- all catalogs -->
        <h2 class="lineBreaker"></h2>

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




