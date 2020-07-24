@extends('master')

@section('title', '- About Page')

@section('content')

<div class="container">
    <div class="accordion" id="accordionExample">

        <h2>Terms & Conditions</h2>
        @foreach ($terms as $term)
            <div class="card">
                <div class="card-header" id="{{$term->id}}">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{$term->id}}id" aria-expanded="true" aria-controls="{{$term->id}}id">
                            {{$term->title}}
                        </button>
                    </h2>
                </div>

                <div id="{{$term->id}}id" class="collapse @if($term->id==1) show @endif" aria-labelledby="{{$term->id}}" data-parent="#accordionExample">
                    <div class="card-body">
                        {!! $term->description !!}
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    @endsection
</div>

