<div class="row">
    @foreach ($latest_catalogs as $catalog)

    @if($catalog->ifExistInTheCity())

            <div class="col-sm-3">

                @foreach ($catalog->images as $image)

                    @if ($image->featured)
                        <a href="/{{$catalog->store->slug}}/catalogs/{{$catalog->slug}}">
                            <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                        </a>
                    @endif

                @endforeach

                <div class="row catalogDetails">
                    <div class="col-sm-12">
                        <p class="catalogName @if(session('locale') == 'ar') textAlignRight @endif">{{$catalog->name}}</p>
                        <div class="textContainer">
                            <p class="catalogDate @if(session('locale') == 'ar') textAlignRight @endif">
                                {{ \Carbon\Carbon::parse($catalog->start_at)->day }}
                                @if(!$catalog->end_at)
                                    {{ \Carbon\Carbon::parse($catalog->start_at)->subMonth()->format('F') }}
                                @endif

                                @if($catalog->end_at)
                                    <span> - {{ \Carbon\Carbon::parse($catalog->end_at_at)->day }}
                                        {{ \Carbon\Carbon::parse($catalog->end_at)->subMonth()->format('F') }}
                                    </span>
                                @endif
                            </p>
                            <p class="@if(session('locale') == 'ar') textAlignRight @endif">
                                {{ trans('index.store') }} {{$catalog->store->name}}
                                {{--  <a  href="/store/{{$catalog->store->slug}}" class="no-underline hover:underline text-blue-400">
                                    {{$catalog->store->name}}
                                </a>  --}}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
    @endif

    @endforeach

</div>
