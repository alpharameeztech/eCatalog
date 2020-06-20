<div class="row">
    @foreach ($latest_catalogs as $catalog)
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
                        <p class="catalogName">{{$catalog->name}}</p>
                        <div class="textContainer">
                            <p>
                                {{$catalog->start_at}}
                                @if($catalog->end_at)
                                    <span> - {{$catalog->end_at}}</span>
                                @endif
                            </p>
                            <p>
                                {{$catalog->store->name}}
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
