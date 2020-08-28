@extends('master')
@section('title', ': '.  $store->seoTags->title  )
@section('description', $store->seoTags->description  )

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


    <div class="container">

        @if(session('locale') == 'en')
            <div class="lineBreaker">
                <p>Stores / {{ strtoupper($store->name) }}</p>
            </div>
        @endif

        @if(session('locale') == 'ar')
            <div class="lineBreaker textAlignRight">
                <p>{{ trans('index.stores') }} / {{ strtoupper($store->name) }}</p>
            </div>
        @endif

            @if(session('locale') == 'en')
                <div class="row">
                    <div class="storeLeftSideBar col-sm-3">

                        <div class="storeLogo">
                            <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$store->image}}" />

                            <a class="btn btn-primary checkStoresCta" href="/catalogs" role="button">{{ trans('index.browse_catalogs') }}</a>

                        </div>

                        @foreach($store_left_sections as $advertisement)

                            @if( $advertisement->image != "undefined")
                                <div class="storeLeftAdvertisement">
                                    <a href="{{$advertisement->url}}" target="_blank">
                                        <img  src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$advertisement->image}}" >
                                    </a>
                                </div>
                            @else

                                {!! $advertisement->ad !!}
                            @endif

                        @endforeach

                    </div>

                    <div class="storeContentSection col-sm-6">

                        <h2 class="@if(session('locale') == 'ar') textAlignRight @endif">{{ strtoupper($store->name) }}</h2>

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

                    <div class="storeRightSideBar col-sm-3">

                        @foreach($store_right_sections as $advertisement)
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
            @endif

            @if(session('locale') == 'ar')
                <div class="row">
                    <div class="storeRightSideBar col-sm-3">

                        @foreach($store_right_sections as $advertisement)
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
                    <div class="storeContentSection col-sm-6">

                        <h2 class="textAlignRight">{{ strtoupper($store->name) }}</h2>

                        <div class="storeSocialIcons flexEnd margiBottom">
                            <a href="{{ $store->facebook_link }}" target="_blank">
                                <img src="/img/icons/share-icon-facebook.svg">
                            </a>
                            <a href="{{ $store->twitter_link }}" target="_blank">
                                <img src="/img/icons/share-icon-twitter.svg">
                            </a>
                        </div>

                        <div class="richTextBody">
                            <p>
                                {!! $store->about !!}
                            </p>
                        </div>


                    </div>
                    <div class="storeLeftSideBar col-sm-3">

                        <div class="storeLogo">
                            <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$store->image}}" />

                            <a class="btn btn-primary checkStoresCta" href="/catalogs" role="button">{{ trans('index.browse_catalogs') }}</a>

                        </div>

                        @foreach($store_left_sections as $advertisement)

                            @if( $advertisement->image != "undefined")
                                <div class="storeLeftAdvertisement">
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
            @endif

        {{--  ======================= Store branches ==========================  --}}
        @if(count($in_cities) > 0)
            <h2 class="lineBreaker @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.branches_and_information') }}</h2>

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
                                            <h5 class="mb-0 @if(session('locale') == 'ar') textAlignRight @endif">
{{--                                                <a href="/{{$store->slug}}/{{$branch->city->slug}}/{{$branch->slug}}">--}}
                                                <p class="content" style="font-size: 15px">
{{--                                                <button class="btn btn-link">--}}
{{--                                                        {{ ucfirst($branch->name) }}--}}
{{--                                                    </button>--}}
                                                    {{ ucfirst($branch->name) }}

                                                </p>
                                            </h5>

                                            <div id="{{$branch->slug}}" >
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.address') }}:</p>
                                                            <p class="content @if(session('locale') == 'ar') textAlignRight @endif">
                                                                {{$branch->address}}
                                                            </p>

                                                            <p class="locationInMap @if(session('locale') == 'ar') textAlignRight @endif">

                                                                @if(session('locale') == 'en')
                                                                    <span>
                                                                        <i class="material-icons">map</i>
                                                                    </span>
                                                                @endif
                                                                <a href="{{$branch->map_location}}">{{ trans('index.look_at_the_map') }}</a>
                                                                @if(session('locale') == 'ar')
                                                                    <span>
                                                                    <i class="material-icons">map</i>
                                                                </span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.phone') }}:</p>
                                                            <p class="content @if(session('locale') == 'ar') textAlignRight @endif">
                                                                {{$branch->telephone}}
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.opening_hours') }}:</p>
                                                            <p class="content @if(session('locale') == 'ar') textAlignRight @endif">
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


        <!-- advertisements -->
        @foreach($store_long_ad_1 as $advertisement)
            @if(!empty($advertisement))
                <div class="advertisement checkStores noShadow">
                    @if( $advertisement->url != "undefined")

                        <a href="{{$advertisement->url}}">
                            <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$advertisement->image}}" class="d-block w-100" alt="...">
                        </a>
                    @else
                        {!! $advertisement->ad !!}
                    @endif
                </div>
            @endif
        @endforeach
        <!-- advertisements end -->

        <!-- store catalogs -->
        @include('partials/catalogs/catalogs_of_a_store')
        <!-- store catalogs end-->

        <!-- advertisements -->
        @foreach($store_long_ad_2 as $advertisement)
            @if(!empty($advertisement))
                <div class="advertisement checkStores noShadow">
                    @if( $advertisement->url != "undefined")

                        <a href="{{$advertisement->url}}">
                            <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$advertisement->image}}" class="d-block w-100" alt="...">
                        </a>
                    @else
                        {!! $advertisement->ad !!}
                    @endif
                </div>
            @endif
        @endforeach
        <!-- advertisements end -->

        <!-- all catalogs end-->
    </div>


@endsection




