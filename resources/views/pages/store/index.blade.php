@extends('master')

@section('title', ': Stores')

@section('content')


    <div class="container">

        <!-- advertisements -->
        @foreach ($all_stores_page_long_ad_1 as $advertisement)
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

        <!-- all catalogs -->
        <h2 class="lineBreaker"></h2>

        <div class="row">
        @foreach ($stores as $key=>$store)

            @if($key == 12)

                    @foreach ($all_stores_page_long_ad_2 as $advertisement)
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


                @endif


                <div class="col-6 col-sm-3">
                    <div class=" backgroundStoreContainer">
                        <a href="/store/{{$store->slug}}">
                            <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$store->image}}" alt="Sunset in the mountains">
                       </a>
                       <div class=" catalogDetails bgGray">
                           <div class=" storeContainerIndex">
   
                               <div class="textContainer">
                                    <a class="blackColor" href="/{{session('locale')}}/store/{{$store->slug}}">
                                        <p class="alignCenter">
                                            Store {{$store->name}}
                                        </p>
                                    </a>
                               </div>
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
        @foreach ($all_stores_page_long_ad_3 as $advertisement)
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




