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

        <h2 class="lineBreaker">Branches and information</h2>

        <div class="container storeInCities">
            <h1 class="pt-3 text-center mb-3">FAQ Accordian slider</h1>
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

                @endforeach
                <div class="card">
                    <div class="card-header" >
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#size__and__fit" aria-expanded="false" aria-controls="size__and__fit">
                                How do I register?
                            </button>
                        </h2>
                    </div>
                    <div id="size__and__fit" class="collapse"  data-parent="#accordionExample">
                        <div class="card-body">You can register yourself by clicking on this Registration Link. Once subscribed, you can enjoy regular updates and services from synergy consulting group.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" >
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#fabric__comp" aria-expanded="false" aria-controls="fabric__comp">
                                Do I have to disclose my Email & Phone Number for Registration?
                            </button>
                        </h2>
                    </div>
                    <div id="fabric__comp" class="collapse"  data-parent="#accordionExample">
                        <div class="card-body">Yes. This ensures a secure from your end.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" >
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#return__policy" aria-expanded="false" aria-controls="return__policy">
                                Is my Personal Information secure at synergy consulting group
                            </button>
                        </h2>
                    </div>
                    <div id="return__policy" class="collapse" data-parent="#accordionExample">
                        <div class="card-body">Yes. Please see our Privacy Policy to know more.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  ======================= Store branches ==========================  --}}
        @if(count($in_cities) > 0)
            <div class="row">
                <p class="text-lg col-sm-12">Branches</p>
                <div id="accordion" class="col-sm-12">

                    @foreach ($in_cities as $city)

                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn" data-toggle="collapse" data-target="#{{$city->slug}}" aria-expanded="true" aria-controls="{{$city->slug}}">
                                        {{$city->name}}
                                    </button>
                                </h5>
                            </div>

                            <div id="{{$city->slug}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">

                                    @foreach($store->branches as $branch)
                                        @if($branch->city_id == $city->id)

                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <a href="/{{$store->slug}}/{{$branch->city->slug}}/{{$branch->slug}}">
                                                            <button class="btn btn-link">
                                                                {{$branch->name}}
                                                            </button>
                                                        </a>
                                                    </h5>
                                                </div>

                                                <div id="{{$branch->slug}}" >
                                                    <div class="card-body">
                                                        <table class="table table-hover">
                                                            <thead>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row"><i class="material-icons">home</i></th>
                                                                <td>{{$branch->address}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><i class="material-icons">phone</i></th>
                                                                <td>{{$branch->telephone}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><i class="material-icons">contact_phone</i></th>
                                                                <td>{{$branch->fax}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><i class="material-icons">email</i></th>
                                                                <td>
                                                                    <a href="mailto:{{$branch->email}}">{{$branch->email}}</a>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><i class="material-icons">map</i></th>
                                                                <td>
                                                                    <a href="{{$branch->map_location}}"> Map & Directions
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><i class="material-icons">access_time</i></th>
                                                                <td>{{$branch->opening_hours}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><i class="material-icons">call_made</i></th>
                                                                <td>
                                                                    <a href="{{$branch->slug}}" target="_blank">
                                                                        View Branch Details
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>

                                        @endif

                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="alert alert-success notice" role="alert">
                    <p>
                        Above listed store information and timings are to the best of our knowledge and may change without prior notice.
                    </p>
                    <p>
                        Timings may change during Ramadan and public holidays and hence kindly check with the stores to avoid last minute disappointments.
                    </p>
                </div>


            </div>
    @endif

        {{--  ============================ Store branches end==================  --}}

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




