@extends('master')

@section('content')


    <div class="container">

        <!-- advertisements -->
        @if(!empty($all_stores_page_long_ad_1))
            <div class="advertisement checkStores noShadow">
                @if( $all_stores_page_long_ad_1->url != "undefined")

                    <a href="{{$all_stores_page_long_ad_1->url}}">
                        <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$all_stores_page_long_ad_1->image}}" class="d-block w-100" alt="...">
                    </a>
                @else
                    {!! $all_stores_page_long_ad_1->ad !!}
                @endif
            </div>
        @endif
        <!-- advertisements end -->

        <!-- all catalogs -->
        <h2 class="lineBreaker"></h2>

        <div class="row popularCatalogsContainer">
        @foreach ($stores as $key=>$store)

            @if($key == 12)

                <!-- advertisements -->
                    @if(!empty($all_stores_page_long_ad_2))
                        <div class="advertisement checkStores noShadow">
                            @if( $all_stores_page_long_ad_2->url != "undefined")

                                <a href="{{$all_stores_page_long_ad_2->url}}">
                                    <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$all_stores_page_long_ad_2->image}}" class="d-block w-100" alt="...">
                                </a>
                            @else
                                {!! $all_stores_page_long_ad_2->ad !!}
                            @endif
                        </div>
                    @endif
                <!-- advertisements end -->

            @endif


                <div class="col-sm-3 customContainers bgWhite">


                    <a href="/store/{{$store->slug}}">
                         <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$store->image}}" alt="Sunset in the mountains">
                    </a>
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

        <!-- advertisements -->
        @if(!empty($all_stores_page_long_ad_3))
            <div class="advertisement checkStores noShadow">
                @if( $all_stores_page_long_ad_3->url != "undefined")

                    <a href="{{$all_stores_page_long_ad_3->url}}">
                        <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$all_stores_page_long_ad_3->image}}" class="d-block w-100" alt="...">
                    </a>
                @else
                    {!! $all_stores_page_long_ad_3->ad !!}
                @endif
            </div>
        @endif
        <!-- advertisements end -->

        <!-- all catalogs end-->
    </div>


@endsection




