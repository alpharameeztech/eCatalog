<h2 class="d-none d-sm-block @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.the_most_popular_catalogs') }}</h2>
<h2 class="d-block d-sm-none textAlignCenter @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.the_most_popular_catalogs') }}</h2>

<!-- for greater than smaller screens -->
<div class="d-none d-sm-flex row popularCatalogsContainer">
    @foreach ($popular_catalogs as $key=>$catalog)
        @if($catalog->ifExistInTheCity())


            @if($key == 0 && session('locale') == 'en')
            <div class="col-sm-6">

                <div class="row">
                    <div class="col-sm-7">
                        @foreach ($catalog->images as $image)

                            @if ($image->featured)
                                <a href="/{{session('locale')}}/catalog/{{$catalog->slug}}">
                                    <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                                </a>
                            @endif

                        @endforeach

                    </div>
                    <div class="col-sm-5 catalogDetails topPopular">
                        <div class="col-sm-12">
                            <p class="catalogName">
                                <a class="blackColor" href="/{{session('locale')}}/catalog/{{$catalog->slug}}">{{$catalog->name}}</a>
                            </p>
                            <div class="textContainer">
                                <p class="catalogDate">
                                    {{ \Carbon\Carbon::parse($catalog->start_at)->day }}
                                    @if(!$catalog->end_at)
                                        {{ \Carbon\Carbon::parse($catalog->start_at)->subMonth()->format('F') }}
                                    @endif

                                    @if($catalog->end_at && session('locale') == 'en')
                                        <span> - {{ \Carbon\Carbon::parse($catalog->end_at)->day }}
                                            {{ \Carbon\Carbon::parse($catalog->end_at)->subMonth()->format('F') }}
                                        </span>
                                    @else
                                        {{ $catalog->end_at }}
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

            @elseif($key == 2 && session('locale') == 'ar')
            <div class="col-sm-6">

                <div class="row">
                    <div class="col-sm-7">
                        @foreach ($catalog->images as $image)

                            @if ($image->featured)
                                <a href="/{{session('locale')}}/catalog/{{$catalog->slug}}">
                                    <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                                </a>
                            @endif

                        @endforeach

                    </div>
                    <div class="col-sm-5 catalogDetails topPopular">
                        <div class="col-sm-12">
                            <p class="catalogName">
                                <a class="blackColor" href="/{{session('locale')}}/catalog/{{$catalog->slug}}">{{$catalog->name}}</a>
                            </p>
                            <div class="textContainer">
                                <p class="catalogDate">
                                    {{ $catalog->start_at }}
                                    @if(!$catalog->end_at)
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

            @else
                <div class="col-sm-3 customContainers">

                    @foreach ($catalog->images as $image)

                        @if ($image->featured)
                            <a href="/{{session('locale')}}/catalog/{{$catalog->slug}}">
                                <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                            </a>
                        @endif

                    @endforeach

                    <div class="row catalogDetails">
                        <div class="col-sm-12">
                            <p class="catalogName @if(session('locale') == 'ar') textAlignRight @endif">
                                <a class="blackColor" href="/{{session('locale')}}/catalog/{{$catalog->slug}}">{{$catalog->name}}</a>
                            </p>
                            <div class="textContainer">
                                <p class="catalogDate @if(session('locale') == 'ar') textAlignRight @endif">
                                    @if(session('locale') == 'en') 
                                        {{ \Carbon\Carbon::parse($catalog->start_at)->day }}
                                    @else
                                        {{ $catalog->start_at }}
                                    @endif



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
            @endif

        @endif

    @endforeach

</div>
<!-- for greater than smaller screens end -->


<!-- for extra small screens -->
<div class="d-flex d-sm-none row ">
    @foreach ($popular_catalogs as $key=>$catalog)
        @if($catalog->ifExistInTheCity())

            <div class="col-6">

                @foreach ($catalog->images as $image)

                    @if ($image->featured)
                        <a href="/{{session('locale')}}/catalog/{{$catalog->slug}}">
                            <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                        </a>
                    @endif

                @endforeach

                <div class="row catalogDetails">
                    <div class="col-sm-12">
                        <p class="catalogName @if(session('locale') == 'ar') textAlignRight @endif">
                            <a class="blackColor" href="/{{session('locale')}}/catalog/{{$catalog->slug}}">
                                {{$catalog->name}}
                            </a>
                        </p>
                        <div class="textContainer">
                            <p class="catalogDate @if(session('locale') == 'ar') textAlignRight @endif">
                                @if(session('locale') == 'en') 
                                    {{ \Carbon\Carbon::parse($catalog->start_at)->day }}
                                    @else
                                    {{ $catalog->start_at }}
                                @endif
                                
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

        @endif

    @endforeach

</div>

<!-- for extra small screens end -->
