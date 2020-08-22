@extends('master')

@section('title', '- About Page')

@section('content')

<div class="container">
    <div class="accordion" id="accordionExample">

        <h2 class="@if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.faq') }}</h2>
        @foreach ($faqs as $faq)
            <div class="card">
                <div class="card-header" id="{{$faq->id}}">
                    <h2 class="mb-0 @if(session('locale') == 'ar') textAlignRight @endif">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{$faq->id}}id" aria-expanded="true" aria-controls="{{$faq->id}}id">
                            {{$faq->question}}
                        </button>
                    </h2>
                </div>

                <div id="{{$faq->id}}id" class="collapse @if($faq->id==1) show @endif" aria-labelledby="{{$faq->id}}" data-parent="#accordionExample">
                    <div class="card-body">
                        {!! $faq->answer !!}
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    @endsection
</div>

