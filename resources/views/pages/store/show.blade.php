@extends('master')

@section('content')


    <div class="bannerAd">
        <img src="/img/other/banner-ad.png" />
    </div>

    <div class="container">


        <div class="lineBreaker">
            <p>Stores / {{ strtoupper($store->name) }}</p>
        </div>

        <div class="row">
            <div class="storeLeftSideBar col-sm-3">

                <div class="storeLogo">
                    <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$store->image}}" />

                    <a class="btn btn-primary checkStoresCta" href="/catalogs" role="button">Browse catalogs</a>

                </div>

            </div>

            <div class="storeContentSection col-sm-6">

                <h2>{{ strtoupper($store->name) }}</h2>

                <div class="storeSocialIcons">
                    <a href="{{ $store->facebook_link }}" target="_blank">
                        <img src="/img/icons/share-icon-facebook.svg">
                    </a>
                    <a href="{{ $store->twitter_link }}" target="_blank">
                        <img src="/img/icons/share-icon-twitter.svg">
                    </a>
                </div>

                <p>
                    {!! $store->about !!}
                </p>

            </div>

            <div class="storeRightSideBar col-sm-3"></div>
        </div>

        <!-- check all stores -->
            @include('partials/catalogs/check_all_stores')
        <!-- check all stores end-->

        <!-- all catalogs -->
        <h2 class="lineBreaker"></h2>

        <div class="row popularCatalogsContainer">

        </div>

        <div class="row">
            <div class="col-sm-12 catalogNavigation">
{{--                <span class="pages">Pages </span> {{ $stores->links() }}--}}
            </div>
        </div>


        <!-- check all stores -->
    @include('partials/browse_catalogs_banner')
    <!-- check all stores end-->

        <!-- all catalogs end-->
    </div>


@endsection




