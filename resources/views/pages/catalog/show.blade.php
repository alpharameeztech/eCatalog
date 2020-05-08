@extends('master')

@section('title', '- About Page')

@section('content')

<div class="row">

    <div class="col-sm-4">
        @foreach ($catalog->images as $image)

            @if ($image->featured)
                <div class="card">
                    <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                </div>
            @endif

        @endforeach
    </div>


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


@endsection
