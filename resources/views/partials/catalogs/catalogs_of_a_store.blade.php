
<div class="storeCatalogs">

    <h2 class="text-3xl mt-8 @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.store_catalogs')}}</h2>
    <div class="row">
        @foreach ($store_catalogs as $catalog)
                <div class="col-6 col-sm-3">

                    @foreach ($catalog->images as $image)

                        @if ($image->featured)
                            <a href="/{{session('locale')}}/catalog/{{$catalog->slug}}">
                                <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                            </a>
                        @endif

                    @endforeach

                    <div class="row catalogDetails">
                        <div class="col-sm-12">
                            <p class="catalogName">{{$catalog->name}}</p>
                            <div class="textContainer">
                                <p class="catalogDate">
                                    @if(session('locale') == 'en') 
                                        {{ \Carbon\Carbon::parse($catalog->start_at)->day }}
                                    @else
                                        {{ $catalog->start_at }}
                                    @endif

                                    @if(!$catalog->end_at && session('locale') == 'en' )
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
                                <p>
                                    Store {{$catalog->store->name}}
                                    {{--  <a  href="/store/{{$catalog->store->slug}}" class="no-underline hover:underline text-blue-400">
                                        {{$catalog->store->name}}
                                    </a>  --}}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
        @endforeach

    </div>

</div>
