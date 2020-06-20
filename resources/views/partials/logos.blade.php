<div class="container">

    <div class="row homeLogos">
        @foreach ($stores as $store)
        @if ($store->featured)
            <div class="col-sm-2">
                <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$store->image}}" alt="Sunset in the mountains">
            </div>
        @endif
      
    @endforeach
    </div>
   

</div>
