@extends('master')

@section('title', ': Catalogs & Offers')

@section('content')

    <div class="container">
        <!-- all catalogs -->
        <h2 class="lineBreaker @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.find_your_favorite_stores_offers_on_dealzbook') }}</h2>

        {{--  -----------sorting for extra small screen-----------  --}}
        <div class="blueBorderBottom d-flex d-sm-none justify-content-space-between">
            <a href=""><span class="sortSpan">{{ trans('index.sort_by') }}</span></a>
            <a href="/catalogs?tag=newest" class="newestSort">
                <span>{{ trans('index.newest') }}</span>
                <img src="/img/icons/arrow-down-black.svg"/>
            </a>
        </div>
        <div class="d-block d-sm-none row sortingContainer">
            
            <div class="col-sm-9">
                <nav role='navigation'>
                    <ul class="sorting">
                      <li>
                        <a href="/catalogs">
                          <div>
                              {{ trans('index.all') }}
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
           
        </div>

        {{--  -----------sorting for extra small screen end -----------  --}}

        {{--  -----------sorting for screen size greater than extra small-----------  --}}
        <div class="d-none d-sm-block">
            <div class="row sortingContainer">
                <div class="col-sm-1">
                    <a href=""><span class="sortSpan">{{ trans('index.sort_by') }}</span></a>
                </div>
                <div class="col-sm-9">
                    <nav role='navigation'>
                        <ul class="sorting">
                        <li>
                            <a href="/catalogs">
                            <div>
                                {{ trans('index.all') }}
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
                        <span>{{ trans('index.newest') }}</span>
                        <img src="/img/icons/arrow-down-black.svg"/>
                    </a>
                </div>
            </div>
        </div>

        {{--  -----------sorting for screen size greater than extra small end -----------  --}}

        <div class="row">
            @foreach ($catalogs as $key=>$catalog)

                @if($key == 8)
                    <!-- advertisements -->
                    @foreach($all_catalogs_page_long_ad_1 as $advertisement)
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

                    @endif

                @if($key == 16)
                    <!-- advertisements -->
                        @foreach($all_catalogs_page_long_ad_2 as $advertisement)
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
                @endif

                <div class="col-6 col-sm-3 catalogMargin">
                    <div class="catalogBoxShadow">   
                    @foreach ($catalog->images as $image)

                        @if ($image->featured)
                            <a href="/{{session('locale')}}/catalog/{{$catalog->slug}}">
                                 <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                            </a>
                        @endif

                    @endforeach

                    <div class="row catalogDetails">
                        <div class="col-sm-12">
                            <p class="catalogName @if(session('locale') == 'ar') textAlignRight @endif">{{$catalog->name}}</p>

                            <div class="textContainer">
                                <p class="catalogDate @if(session('locale') == 'ar') textAlignRight @endif">
                                    @if(!$catalog->end_at && session('locale') == 'en')
                                        {{ \Carbon\Carbon::parse($catalog->start_at)->subMonth()->format('F') }}
                                    @endif

                                    @if($catalog->end_at && session('locale') == 'en')
                                        <span> - {{ \Carbon\Carbon::parse($catalog->end_at)->day }}
                                            {{ \Carbon\Carbon::parse($catalog->end_at)->subMonth()->format('F') }}
                                        </span>
                                    @else
                                        {{ $catalog->end_at}}
                                    @endif
                                </p>
                                <a class="blackColor" href="/{{session('locale')}}/store/{{$catalog->store->slug}}">
                                    <p class="@if(session('locale') == 'ar') textAlignRight @endif">
                                        {{ trans('index.store') }} {{$catalog->store->name}}
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
            <div class="col-sm-12 catalogNavigation  @if(session('locale') == 'ar') justify-content-start @endif">
                <span class="pages">{{ trans('index.pages') }} </span> {{ $catalogs->links() }}
            </div>
        </div>


        <!-- advertisements -->
        @foreach($all_catalogs_page_long_ad_3 as $advertisement)
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

        <!-- all catalogs end-->
    </div>


@endsection




