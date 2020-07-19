@extends('master')

@section('content')

    <style>
        .accordion {
            border: 1px solid #002247;
        }

        .accordion h3 {
            background-color: #f3e9eb;
            color: #222;
            font-size: 16px;
            text-align: center;
            margin: 0;
            padding: 10px;
        }

        .accordion .card-header {
            padding: 0;
        }

        .accordion .card-header button {
            text-align: left;
            display: block;
            width: 100%;
            font-size: 18px;
            color: #000000;
            position: relative;
        }

        .accordion .card-header button.collapsed::after {
            position: absolute;
            width: 2px;
            height: 12px;
            content: '';
            background-color: #000;
            right: 12px;
            top: 54%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .accordion .card-header button::before {
            position: absolute;
            width: 12px;
            height: 2px;
            content: '';
            background-color: #000;
            right: 7px;
            top: 50%;
        }

        .accordion .card-header button:hover {
            text-decoration: none;
        }

        .accordion .card-header button i {
            float: right;
            margin-top: 3px;
        }

        .accordion .card-body {
            padding: 15px;
            font-size: 16px;
        }

        .accordion .card-body table {
            margin: 0;
        }

        .accordion .card-body table a {
            color: #000;
        }

        .accordion .card-body table span {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .accordion ul.occasion_list a {
            padding: 5px 15px;
            color: #222;
            font-size: 14px;
            display: inline-block;
        }

        .accordion ul.occasion_list a:hover {
            color: #002247;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <div class="bannerAd">
        <img src="/img/other/banner-ad.png" />
    </div>

    <div class="container">


        <div class="lineBreaker">
            <p>Catalogs / {{ strtoupper($store->name) }} / {{ strtoupper($catalog->name) }}</p>
        </div>

        <div class="row catalogHeaderOne">
            <div class="storeLeftSideBar col-sm-6">

                <div class="storeLogo">

                    <h2>{{ strtoupper($catalog->name) }}</h2>

                </div>

            </div>

            <div class="storeContentSection col-sm-6 catalogHeaderTwo">

                <div class="storeSocialIcons">
                    <a href="{{ $store->facebook_link }}" target="_blank">
                        <img src="/img/icons/share-icon-facebook.svg">
                    </a>
                    <a href="{{ $store->twitter_link }}" target="_blank">
                        <img src="/img/icons/share-icon-twitter.svg">
                    </a>
                </div>

            </div>

        </div>

        <div class="row catalogContainer">
            <div class="storeLeftSideBar col-sm-6">

                <div class="catalogInfo">

                    <div class="row">
                        <div class="col-sm-8">

                            <p class="fontMada">
                                {{ $store->name }}
                            </p>
                        </div>

                        <div class="col-sm-4">
                            <p>
                                {{ count($catalog->images) }}
                            </p>
                            <span class="darkGray">Pages</span>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-4">

                            <p class="catalogDate">
                                {{ \Carbon\Carbon::parse($catalog->created_at)->day }}
                                {{ \Carbon\Carbon::parse($catalog->created_at)->subMonth()->format('F') }}
                                {{ \Carbon\Carbon::parse($catalog->created_at)->subYear()->format('Y') }}
                            </p>
                            <p class="darkGray">
                                Added On
                            </p>
                        </div>

                        <div class="col-sm-4">

                            <p class="catalogDate">
                                {{ \Carbon\Carbon::parse($catalog->start_at)->day }}
                                {{ \Carbon\Carbon::parse($catalog->start_at)->subMonth()->format('F') }}
                                {{ \Carbon\Carbon::parse($catalog->start_at)->subYear()->format('Y') }}
                            </p>
                            <p class="darkGray">
                                Start Date
                            </p>
                        </div>

                        <div class="col-sm-4">
                            <p class="catalogDate">
                                {{ \Carbon\Carbon::parse($catalog->end_at)->day }}
                                {{ \Carbon\Carbon::parse($catalog->end_at)->subMonth()->format('F') }}
                                {{ \Carbon\Carbon::parse($catalog->end_at)->subYear()->format('Y') }}
                            </p>
                            <p class="darkGray">
                                End Date
                            </p>
                        </div>
                    </div>

                </div>

            </div>

            <div class="storeContentSection col-sm-6">

               {!! $catalog->description !!}

            </div>

        </div>

        {{--  ======================= Store branches ==========================  --}}
        @if(count($in_cities) > 0)
            <h2 class="lineBreaker">Branches and information</h2>

            <div class="container storeInCities">
                <div class="accordion " id="accordionExample">
                    @foreach ($in_cities as $city)

                        <div class="card">
                            <div class="card-header" >
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#p__detail" aria-expanded="true" aria-controls="p__detail">
                                        {{ucfirst($city->name)}}
                                    </button>
                                </h2>
                            </div>

                            @foreach($store->branches as $branch)
                                @if($branch->city_id == $city->id)

                                    <div id="p__detail" class="collapse "  data-parent="#accordionExample">
                                        <div class="card-body">
                                            <h5 class="mb-0">
                                                <a href="/{{$store->slug}}/{{$branch->city->slug}}/{{$branch->slug}}">
                                                    <button class="btn btn-link">
                                                        {{ ucfirst($branch->name) }}
                                                    </button>
                                                </a>
                                            </h5>

                                            <div id="{{$branch->slug}}" >
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading">Address:</p>
                                                            <p class="content">
                                                                {{$branch->address}}
                                                            </p>

                                                            <p class="locationInMap">
                                                            <span>
                                                                <i class="material-icons">map</i>
                                                            </span>
                                                                <a href="{{$branch->map_location}}"> Look at the map</a>
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading">Phone:</p>
                                                            <p class="content">
                                                                {{$branch->telephone}}
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading">Opening hours:</p>
                                                            <p class="content">
                                                                {{$branch->opening_hours}}
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                @endif

                            @endforeach

                        </div>

                        {{--                <div class="card">--}}
                        {{--                    <div class="card-header" >--}}
                        {{--                        <h2 class="mb-0">--}}
                        {{--                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#size__and__fit" aria-expanded="false" aria-controls="size__and__fit">--}}
                        {{--                                How do I register?--}}
                        {{--                            </button>--}}
                        {{--                        </h2>--}}
                        {{--                    </div>--}}
                        {{--                    <div id="size__and__fit" class="collapse"  data-parent="#accordionExample">--}}
                        {{--                        <div class="card-body">You can register yourself by clicking on this Registration Link. Once subscribed, you can enjoy regular updates and services from synergy consulting group.--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                        {{--                <div class="card">--}}
                        {{--                    <div class="card-header" >--}}
                        {{--                        <h2 class="mb-0">--}}
                        {{--                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#fabric__comp" aria-expanded="false" aria-controls="fabric__comp">--}}
                        {{--                                Do I have to disclose my Email & Phone Number for Registration?--}}
                        {{--                            </button>--}}
                        {{--                        </h2>--}}
                        {{--                    </div>--}}
                        {{--                    <div id="fabric__comp" class="collapse"  data-parent="#accordionExample">--}}
                        {{--                        <div class="card-body">Yes. This ensures a secure from your end.--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                        {{--                <div class="card">--}}
                        {{--                    <div class="card-header" >--}}
                        {{--                        <h2 class="mb-0">--}}
                        {{--                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#return__policy" aria-expanded="false" aria-controls="return__policy">--}}
                        {{--                                Is my Personal Information secure at synergy consulting group--}}
                        {{--                            </button>--}}
                        {{--                        </h2>--}}
                        {{--                    </div>--}}
                        {{--                    <div id="return__policy" class="collapse" data-parent="#accordionExample">--}}
                        {{--                        <div class="card-body">Yes. Please see our Privacy Policy to know more.--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}

                    @endforeach
                    @endif

                    {{--  ============================ Store branches end==================  --}}


                </div>
            </div>



            <!-- check all stores -->
        @include('partials/see_all_catalogs')
        <!-- check all stores end-->

            <!-- store catalogs -->
        @include('partials/catalogs/catalogs_of_a_store')
        <!-- store catalogs end-->

            <!-- check all stores -->
        @include('partials/browse_our_stores_list')
        <!-- check all stores end-->

            <!-- all catalogs end-->
    </div>


@endsection




