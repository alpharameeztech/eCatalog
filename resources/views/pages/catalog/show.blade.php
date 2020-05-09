@extends('master')

@section('title', '- About Page')

@section('content')

<div class="row">

    <div class="col-sm-4">
        @foreach ($catalog->images as $image)

            @if ($image->featured)
                <div class="card">
                    <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                    <p class="text-gray text-base text-center">
                        <a href="" class="no-underline hover:underline text-blue-500 ">View Catalog</a>
                    </p>
                </div>
            @endif

        @endforeach
    </div>

    {{--  catalog details  --}}
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
              {{ $catalog->name}}
            </div>
            <div class="card-body">
              <p class="card-text">{{$catalog->description}}.</p>
              <p>By: <a href="{{$catalog->store->name}}">{{$catalog->store->name}}</a></p>

              <table class="table table-hover">
                <thead>
                  
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Start Date</th>
                    <td>{{$catalog->start_at}}</td>
                  </tr>
                  <tr>
                    <th scope="row">End Date</th>
                    <td>{{$catalog->end_at}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Pages#</th>
                    <td colspan="2">{{count($catalog->images)}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Total Views</th>
                    <td colspan="2">{{$catalog->total_views}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Added On</th>
                    <td colspan="2">{{$catalog->created_at}}</td>
                  </tr>
                </tbody>
              </table>

            </div>
        </div>
    </div>
</div>
    {{--  -- Catalog details end  --}}

    {{--  ======================= catalog availability ==========================  --}}

    <div class="row">
        <p class="text-lg">Available In</p>
        <div id="accordion" class="col-sm-12">

            @foreach ($catalog_cities as $city)

                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#{{$city->slug}}" aria-expanded="true" aria-controls="{{$city->slug}}">
                        {{$city->name}}
                        </button>
                        </h5>
                    </div>

                    <div id="{{$city->slug}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                         
                            @foreach($catalog->branches as $branch)
                                @if($branch->city_id == $city->id)

                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                            <button class="btn btn-link">
                                            {{$branch->name}}
                                            </button>
                                            </h5>
                                        </div>
                        
                                        <div id="{{$branch->slug}}" >
                                            <div class="card-body">
                                                <table class="table table-hover">
                                                    <thead>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row"><i class="material-icons">home</i></th>
                                                        <td>{{$branch->address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><i class="material-icons">phone</i></th>
                                                        <td>{{$branch->telephone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><i class="material-icons">contact_phone</i></th>
                                                        <td>{{$branch->fax}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><i class="material-icons">email</i></th>
                                                        <td>
                                                            <a href="mailto:{{$branch->email}}">{{$branch->email}}</a>
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><i class="material-icons">map</i></th>
                                                        <td>
                                                            <a href="{{$branch->map_location}}"> Map & Directions
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><i class="material-icons">access_time</i></th>
                                                        <td>{{$branch->opening_hours}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><i class="material-icons">call_made</i></th>
                                                        <td>
                                                            <a href="{{$branch->slug}}" target="_blank">
                                                                View Branch Details
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                    
                                            </div>
                                        </div>
                                    </div>

                                @endif

                            @endforeach
                
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>

        <div class="alert alert-success" role="alert" style="width: 100%">
            <p>
                Above listed store information and timings are to the best of our knowledge and may change without prior notice.
            </p>
            <p>
                Timings may change during Ramadan and public holidays and hence kindly check with the stores to avoid last minute disappointments.
            </p>
        </div>


    </div>
    {{--  ============================ catalog availability end==================  --}}
</div>


@endsection
