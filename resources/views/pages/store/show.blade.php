@extends('master')

@section('title', '- About Page')

@section('content')

<div class="row storeInfo">

    <div class="col-sm-4">

        <div class="card">
            <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$store->image}}" alt="Sunset in the mountains">
            <p class="text-gray text-base text-center">
                <a href="" class="no-underline hover:underline text-blue-500 ">Browse this store catalogs</a>
            </p>
        </div>

    </div>

    {{--  store details  --}}
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
              {{ $store->name}}
            </div>
            <div class="card-body">
              <p class="card-text">{!! $store->about !!}</p>

              <table class="table table-hover">
                <thead>
                  
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Website Link</th>
                    <td>
                        <a href="{{$store->website_link}}" target="_blank" class="no-underline hover:underline text-blue-500">{{$store->website_link}}</a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">Facebook Link</th>
                    <td>
                        <a href="{{$store->facebook_link}}" target="_blank" class="no-underline hover:underline text-blue-500">{{$store->facebook_link}}</a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">Twitter Link</th>
                    <td>
                        <a href="{{$store->twitter_link}}" target="_blank" class="no-underline hover:underline text-blue-500">{{$store->twitter_link}}</a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">Instagram Link</th>
                    <td>
                        <a href="{{$store->instagram_link}}" target="_blank" class="no-underline hover:underline text-blue-500">{{$store->instagram_link}}</a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">Youtube Link</th>
                    <td>
                        <a href="{{$store->youtube_link}}" target="_blank" class="no-underline hover:underline text-blue-500">{{$store->youtube_link}}</a>
                    </td>
                  </tr>
                </tbody>
              </table>

            </div>
        </div>
    </div>
</div>
    {{--  -- store details end  --}}

</div>


@endsection
