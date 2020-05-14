<div class="grid grid-cols-4 gap-4 mt-4">
    @foreach ($popular_catalogs as $catalog)
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
               
                @foreach ($catalog->images as $image)

                    @if ($image->featured)
                        <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                    @endif

                @endforeach
                
                <div class="px-6 py-4">
                    <div class=" text-base mb-2">{{$catalog->name}}</div>
                  
                    <p class="font-extrabold text-gray-700 text-base">
                        {{$catalog->start_at}}
                        @if($catalog->end_at)
                            <span> - {{$catalog->end_at}}</span>
                        @endif
                    </p>
                    <p class="text-gray-700 text-base">
                        By <a  href="/store/{{$catalog->store->slug}}" class="no-underline hover:underline text-blue-400">
                            {{$catalog->store->name}}
                        </a>
                    </p>
                    <p class="text-gray text-base">
                        <a href="{{$catalog->store->slug}}/catalogs/{{$catalog->slug}}" class="no-underline hover:underline text-blue-500 ">View Details</a>
                    </p>

                    @if(!empty($catalog->end_at))
                        @if( $catalog->end_at <= date('Y-m-d'))
                            <span class="badge badge-danger">Expired</span>
                        @endif
                    @endif

                </div>
            </div>
    @endforeach
    
</div>
