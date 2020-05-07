<div class="grid grid-cols-6 gap-4 mt-8">

    @foreach ($stores as $store)
        @if ($store->featured)
            <div>
                <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$store->image}}" alt="Sunset in the mountains">
            </div>
        @endif
      
    @endforeach

</div>
