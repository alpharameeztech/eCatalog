<h2>The most popular catalogs</h2>
<div class="row popularCatalogsContainer">
    @foreach ($popular_catalogs as $key=>$catalog)

            @if($key == 0)
            <div class="col-sm-6">
               
                <div class="row">
                    <div class="col-sm-7">
                        @foreach ($catalog->images as $image)

                            @if ($image->featured)
                                <a href="/{{$catalog->store->slug}}/catalogs/{{$catalog->slug}}">
                                    <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                                </a>
                            @endif

                        @endforeach
               
                    </div>
                    <div class="col-sm-5 catalogDetails topPopular">
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
                
                
            </div>
            @endif

            <div class="col-sm-3 customContainers">
               
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
