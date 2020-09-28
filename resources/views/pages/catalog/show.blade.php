@extends('master')

@section('title', ': '.  $catalog->seoTags->title  )
@section('description', $catalog->seoTags->description  )

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
    <div class="flip-book-container solid-container" src="/books/FoxitPdfSdk.pdf">

    </div>
    
    @if(session('locale') == 'en')
    <div class="container">


        <div class="lineBreaker @if(session('locale') == 'ar') textAlignRight @endif">
            <p>{{ trans('index.catalogs') }} / {{ strtoupper($store->name) }} / {{ strtoupper($catalog->name) }}</p>
        </div>


{{--        ================================== catalog has image =========================--}}
        @if(count($catalog->images))
        <div class="catalogParentDiv">
            <div class="row catalogHeaderOne">
                <div class="storeLeftSideBar col-sm-6">

                    <div class="storeLogo">

                        <h2 class="@if(session('locale') == 'ar') textAlignRight @endif">{{ strtoupper($catalog->name) }}</h2>

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
                            <div class="col-6 col-sm-8">

                                <p class="fontMada">
                                    {{ $store->name }}
                                </p>
                            </div>

                            <div class="col-6 col-sm-4">
                                <p>
                                    {{ count($catalog->images) }}
                                </p>
                                <span class="darkGray">Pages</span>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-6 col-sm-4">

                                <p class="catalogDate">
                                    {{ \Carbon\Carbon::parse($catalog->created_at)->day }}
                                    {{ \Carbon\Carbon::parse($catalog->created_at)->subMonth()->format('F') }}
                                    {{ \Carbon\Carbon::parse($catalog->created_at)->subYear()->format('Y') }}
                                </p>
                                <p class="darkGray">
                                    Added On
                                </p>
                            </div>

                            <div class="col-6 col-sm-4">

                                <p class="catalogDate">
                                    @if(session('locale') == 'en')
                                    {{ \Carbon\Carbon::parse($catalog->start_at)->day }}
                                    {{ \Carbon\Carbon::parse($catalog->start_at)->subMonth()->format('F') }}
                                    {{ \Carbon\Carbon::parse($catalog->start_at)->subYear()->format('Y') }} 
                                    @else
                                        {{ $catalog->start_at }}
                                    @endif
                                
                                </p>
                                <p class="darkGray">
                                    Start Date
                                </p>
                            </div>

                            <div class="col-6 col-sm-4">
                                <p class="catalogDate">
                                    @if ($catalog->end_at && session('locale') == 'en')
                                        {{ \Carbon\Carbon::parse($catalog->end_at)->day }}
                                        {{ \Carbon\Carbon::parse($catalog->end_at)->subMonth()->format('F') }}
                                        {{ \Carbon\Carbon::parse($catalog->end_at)->subYear()->format('Y') }}
                                    @else
                                        {{ $catalog->end_at }}
                                    @endif
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

                <div class="row">

                    <div class="col-sm-6">

                        @foreach ($catalog->images as $image)

                            @if ($image->featured)
                                <div class="card">

                                    <img id="image" class="w-full"
                                         src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}"
                                         alt="Sunset in the mountains">

                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="col-sm-6">

                        <div class="row" id="images">
                            @foreach ($catalog_images as $image)
                                <div class="col-6 col-sm-4 catalogImages"><img
                                        src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}"
                                        alt="Picture 1"></div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-sm-12 catalogNavigation">
                                <span class="pages">Pages </span> {{ $catalog_images->links() }}
                            </div>
                        </div>

                    </div>


                </div>

            </div>
        </div>
        @endif
{{--        ================================== catalog has image end =========================--}}

        {{--        ================================== catalog has pdf =========================--}}
        @if(count($catalog->pdfs))
            <div class="catalogParentDiv">
                <div class="row catalogHeaderOne">
                    <div class="storeLeftSideBar col-sm-12">

                        <div class="storeLogo">

                            <h2>{{ strtoupper($catalog->name) }}</h2>

                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-6">
                        @foreach ($catalog->images as $image)

                            @if ($image->featured)
                                <div class="card">

                                    @foreach($catalog->pdfs as $pdf)
                                    <div class="flip-book-container" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$pdf->pdf}}"></div>
                                        {{-- <td colspan="2">
                                            <a target="_blanck" href="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$pdf->pdf}}">
                                                <img id="image" class="w-full"
                                                     src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}"
                                                     alt="Sunset in the mountains">
                                            </a>
                                        </td> --}}


                                    @endforeach


                                </div>

                                <p class="textCenter">
                                    @foreach($catalog->pdfs as $pdf)
                                    <div class="flip-book-container" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$pdf->pdf}}"></div>
                                     
                                        <a target="_blank" href="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$pdf->pdf}}">Click here to view</a>
                                    @endforeach
                                </p>


                            @endif
                        @endforeach
                    </div>
                    <div class="col-sm-6">

                        <div class="row catalogInfo">

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
                                    @if(session('locale') == 'en')
                                    {{ \Carbon\Carbon::parse($catalog->start_at)->day }}
                                    {{ \Carbon\Carbon::parse($catalog->start_at)->subMonth()->format('F') }}
                                    {{ \Carbon\Carbon::parse($catalog->start_at)->subYear()->format('Y') }} 
                                    @else
                                        {{ $catalog->start_at }}
                                    @endif
                               
                                </p>
                                <p class="darkGray">
                                    Start Date
                                </p>
                            </div>

                            <div class="col-sm-4">
                                <p class="catalogDate">
                                @if ($catalog->end_at && session('locale') == 'en')
                                    {{ \Carbon\Carbon::parse($catalog->end_at)->day }}
                                    {{ \Carbon\Carbon::parse($catalog->end_at)->subMonth()->format('F') }}
                                    {{ \Carbon\Carbon::parse($catalog->end_at)->subYear()->format('Y') }}
                                @else
                                    {{ $catalog->end_at }}
                                @endif
                                </p>
                                <p class="darkGray">
                                    End Date
                                </p>
                            </div>
                        </div>

                        <div class="storeContentSection catalogHeaderTwo">

                            <div class="storeSocialIcons">
                                <a href="{{ $store->facebook_link }}" target="_blank">
                                    <img src="/img/icons/share-icon-facebook.svg">
                                </a>
                                <a href="{{ $store->twitter_link }}" target="_blank">
                                    <img src="/img/icons/share-icon-twitter.svg">
                                </a>
                            </div>

                        </div>

                        <div class="storeContentSection" style="margin-top: 5%">

                            {!! $catalog->description !!}

                        </div>

                    </div>
                </div>
            </div>
        @endif
        {{--        ================================== catalog has pdf end =========================--}}


        {{-- ================================= advertisement =====================--}}
        <div class="row">

            <div class="col-sm-3">
                @foreach($catalog_small_sections as $advertisement)
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

            <div class="col-sm-9">
                @foreach($catalog_large_sections as $advertisement)
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
        {{-- ================================= advertisement ends=================--}}

    <!-- advertisements -->
        @foreach($catalog_large_ad_1 as $advertisement)
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

        {{--  ======================= Store branches ==========================  --}}
        @if(count($in_cities) > 0)
            <h2 class="lineBreaker @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.branches_and_information') }}</h2>

            <div class="container storeInCities">
                <div class="accordion " id="accordionExample">
                    @foreach ($in_cities as $city)

                        <div class="card">
                            <div class="card-header">
                                <h2 class="mb-0 @if(session('locale') == 'ar') textAlignRight @endif">
                                    <button class="btn btn-link collapsed " type="button" data-toggle="collapse"
                                            data-target="#p__detail" aria-expanded="true" aria-controls="p__detail">
                                        {{ucfirst($city->name)}}
                                    </button>
                                </h2>
                            </div>

                            @foreach($store->branches as $branch)
                                @if($branch->city_id == $city->id)

                                    <div id="p__detail" class="collapse " data-parent="#accordionExample">
                                        <div class="card-body">
                                            <h5 class="mb-0 @if(session('locale') == 'ar') textAlignRight @endif">
                                                <a href="/{{$store->slug}}/{{$branch->city->slug}}/{{$branch->slug}}">
                                                    <button class="btn btn-link">
                                                        {{ ucfirst($branch->name) }}
                                                    </button>
                                                </a>
                                            </h5>

                                            <div id="{{$branch->slug}}">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading @if(session('locale') == 'ar') textAlignRight @endif">Address:</p>
                                                            <p class="content @if(session('locale') == 'ar') textAlignRight @endif">
                                                                {{$branch->address}}
                                                            </p>

                                                            <p class="locationInMap @if(session('locale') == 'ar') textAlignRight @endif">
                                                            <span>
                                                                <i class="material-icons">map</i>
                                                            </span>
                                                                <a href="{{$branch->map_location}}"> Look at the map</a>
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading @if(session('locale') == 'ar') textAlignRight @endif">Phone:</p>
                                                            <p class="content @if(session('locale') == 'ar') textAlignRight @endif">
                                                                {{$branch->telephone}}
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading @if(session('locale') == 'ar') textAlignRight @endif">Opening hours:</p>
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


                    @endforeach
                    @endif

                    {{--  ============================ Store branches end==================  --}}


                </div>
            </div>


{{--        ========================= tags =========================--}}
        <div class="row catalogInfo">

            @foreach($catalog->tags as $tag)
                <a href="/catalogs?tag={{$tag->slug}}" class="tag">{{ $tag->name }}</a>
            @endforeach
        </div>
{{--        ========================= tags end =====================--}}


        <!-- latest catalogs -->
        <h2 class="text-3xl mt-8 @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.the_latest_catalogs') }}</h2>
        @include('partials/catalogs/latest')
        <!-- latest catalogs end-->

    </div>

{{-- ====================================================== arabic version ======================================== --}}
    @else

    <div class="container">


        <div class="lineBreaker @if(session('locale') == 'ar') textAlignRight @endif">
            <p>{{ trans('index.catalogs') }} / {{ strtoupper($store->name) }} / {{ strtoupper($catalog->name) }}</p>
        </div>


{{--        ================================== catalog has image =========================--}}
        @if(count($catalog->images))
        <div class="catalogParentDiv">
            <div class="row catalogHeaderOne">
                <div class="storeContentSection col-sm-6 catalogHeaderTwo">

                    <div class="storeSocialIcons flexEnd">
                        <a href="{{ $store->facebook_link }}" target="_blank">
                            <img src="/img/icons/share-icon-facebook.svg">
                        </a>
                        <a href="{{ $store->twitter_link }}" target="_blank">
                            <img src="/img/icons/share-icon-twitter.svg">
                        </a>
                    </div>

                </div>
                <div class="storeLeftSideBar col-sm-6">

                    <div class="storeLogo">

                        <h2 class="@if(session('locale') == 'ar') textAlignRight @endif">{{ strtoupper($catalog->name) }}</h2>

                    </div>

                </div>
            </div>

            <div class="row catalogContainer">

                <div class="storeContentSection col-sm-6">

                    {!! $catalog->description !!}

                </div>

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
                                    @if(session('locale') == 'en')
                                        {{ \Carbon\Carbon::parse($catalog->start_at)->day }}
                                        {{ \Carbon\Carbon::parse($catalog->start_at)->subMonth()->format('F') }}
                                        {{ \Carbon\Carbon::parse($catalog->start_at)->subYear()->format('Y') }} 
                                    @else
                                        {{ $catalog->start_at }}
                                    @endif
                                    
                                </p>
                                <p class="darkGray">
                                    Start Date
                                </p>
                            </div>

                            <div class="col-sm-4">
                                <p class="catalogDate">
                                    @if ($catalog->end_at && session('locale') == 'en')
                                        {{ \Carbon\Carbon::parse($catalog->end_at)->day }}
                                        {{ \Carbon\Carbon::parse($catalog->end_at)->subMonth()->format('F') }}
                                        {{ \Carbon\Carbon::parse($catalog->end_at)->subYear()->format('Y') }}
                                    @else
                                        {{ $catalog->end_at }}
                                    @endif
                                </p>
                                <p class="darkGray">
                                    End Date
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

                
                <div class="row">

                    <div class="col-sm-6">

                        <div class="row" id="images">
                            @foreach ($catalog_images as $image)
                                <div class="col-sm-4 catalogImages"><img
                                        src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}"
                                        alt="Picture 1"></div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-sm-12 catalogNavigation">
                                <span class="pages">Pages </span> {{ $catalog_images->links() }}
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-6">

                        @foreach ($catalog->images as $image)

                            @if ($image->featured)
                                <div class="card">

                                    <img id="image" class="w-full"
                                         src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}"
                                         alt="Sunset in the mountains">

                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
        @endif
{{--        ================================== catalog has image end =========================--}}

        {{--        ================================== catalog has pdf =========================--}}
        @if(count($catalog->pdfs))
            <div class="catalogParentDiv">
                <div class="row catalogHeaderOne">
                    <div class="storeLeftSideBar col-sm-12">

                        <div class="storeLogo textAlignRight">

                            <h2>{{ strtoupper($catalog->name) }}</h2>

                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-6">

                        <div class="row catalogInfo">

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
                                    @if(session('locale') == 'en')
                                        {{ \Carbon\Carbon::parse($catalog->start_at)->day }}
                                        {{ \Carbon\Carbon::parse($catalog->start_at)->subMonth()->format('F') }}
                                        {{ \Carbon\Carbon::parse($catalog->start_at)->subYear()->format('Y') }} 
                                    @else
                                        {{ $catalog->start_at }}
                                    @endif
                                   
                                </p>
                                <p class="darkGray">
                                    Start Date
                                </p>
                            </div>

                            <div class="col-sm-4">
                                <p class="catalogDate">
                                    @if ($catalog->end_at && session('locale') == 'en')
                                    {{ \Carbon\Carbon::parse($catalog->end_at)->day }}
                                    {{ \Carbon\Carbon::parse($catalog->end_at)->subMonth()->format('F') }}
                                    {{ \Carbon\Carbon::parse($catalog->end_at)->subYear()->format('Y') }}
                                @else
                                    {{ $catalog->end_at }}
                                @endif
                                </p>
                                <p class="darkGray">
                                    End Date
                                </p>
                            </div>
                        </div>

                        <div class="storeContentSection catalogHeaderTwo">

                            <div class="storeSocialIcons flexEnd">
                                <a href="{{ $store->facebook_link }}" target="_blank">
                                    <img src="/img/icons/share-icon-facebook.svg">
                                </a>
                                <a href="{{ $store->twitter_link }}" target="_blank">
                                    <img src="/img/icons/share-icon-twitter.svg">
                                </a>
                            </div>

                        </div>

                        <div class="storeContentSection" style="margin-top: 5%">

                            {!! $catalog->description !!}

                        </div>

                    </div>
                    <div class="col-sm-6">
                        @foreach ($catalog->images as $image)

                            @if ($image->featured)
                                <div class="card">

                                    @foreach($catalog->pdfs as $pdf)
                                        <td colspan="2">
                                            <a target="_blanck" href="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$pdf->pdf}}">
                                                <img id="image" class="w-full"
                                                     src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}"
                                                     alt="Sunset in the mountains">
                                            </a>
                                        </td>


                                    @endforeach


                                </div>

                                <p class="textCenter">
                                    @foreach($catalog->pdfs as $pdf)
                                    <div class="flip-book-container" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$pdf->pdf}}"></div>

                                        <a target="_blank" href="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$pdf->pdf}}">Click here to view</a>
                                    @endforeach
                                </p>


                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        {{--        ================================== catalog has pdf end =========================--}}


        {{-- ================================= advertisement =====================--}}
        <div class="row">

            <div class="col-sm-9">
                @foreach($catalog_large_sections as $advertisement)
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
            <div class="col-sm-3">
                @foreach($catalog_small_sections as $advertisement)
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
        {{-- ================================= advertisement ends=================--}}

    <!-- advertisements -->
        @foreach($catalog_large_ad_1 as $advertisement)
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

        {{--  ======================= Store branches ==========================  --}}
        @if(count($in_cities) > 0)
            <h2 class="lineBreaker @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.branches_and_information') }}</h2>

            <div class="container storeInCities">
                <div class="accordion " id="accordionExample">
                    @foreach ($in_cities as $city)

                        <div class="card">
                            <div class="card-header">
                                <h2 class="mb-0 @if(session('locale') == 'ar') textAlignRight @endif">
                                    <button class="btn btn-link collapsed " type="button" data-toggle="collapse"
                                            data-target="#p__detail" aria-expanded="true" aria-controls="p__detail">
                                        {{ucfirst($city->name)}}
                                    </button>
                                </h2>
                            </div>

                            @foreach($store->branches as $branch)
                                @if($branch->city_id == $city->id)

                                    <div id="p__detail" class="collapse " data-parent="#accordionExample">
                                        <div class="card-body">
                                            <h5 class="mb-0 @if(session('locale') == 'ar') textAlignRight @endif">
                                                <a href="/{{$store->slug}}/{{$branch->city->slug}}/{{$branch->slug}}">
                                                    <button class="btn btn-link">
                                                        {{ ucfirst($branch->name) }}
                                                    </button>
                                                </a>
                                            </h5>

                                            <div id="{{$branch->slug}}">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading @if(session('locale') == 'ar') textAlignRight @endif">Address:</p>
                                                            <p class="content @if(session('locale') == 'ar') textAlignRight @endif">
                                                                {{$branch->address}}
                                                            </p>

                                                            <p class="locationInMap @if(session('locale') == 'ar') textAlignRight @endif">
                                                            <span>
                                                                <i class="material-icons">map</i>
                                                            </span>
                                                                <a href="{{$branch->map_location}}"> Look at the map</a>
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading @if(session('locale') == 'ar') textAlignRight @endif">Phone:</p>
                                                            <p class="content @if(session('locale') == 'ar') textAlignRight @endif">
                                                                {{$branch->telephone}}
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-4 subSection">
                                                            <p class="subHeading @if(session('locale') == 'ar') textAlignRight @endif">Opening hours:</p>
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


                    @endforeach
                    @endif

                    {{--  ============================ Store branches end==================  --}}


                </div>
            </div>


{{--        ========================= tags =========================--}}
        <div class="row catalogInfo flexEnd">

            @foreach($catalog->tags as $tag)
                <a href="/catalogs?tag={{$tag->slug}}" class="tag">{{ $tag->name }}</a>
            @endforeach
        </div>
{{--        ========================= tags end =====================--}}


        <!-- latest catalogs -->
        <h2 class="text-3xl mt-8 @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.the_latest_catalogs') }}</h2>
        @include('partials/catalogs/latest')
        <!-- latest catalogs end-->

    </div>


    
    @endif

   
@endsection

<link href="{{ asset('css/viewer.css') }}" rel="stylesheet">

<script src="{{ asset('js/viewer.js') }}" defer></script>


