@extends('master')

@section('content')


    <div class="bannerAd">
        <img src="/img/other/banner-ad.png" />
    </div>
    <div class="container">
        <!-- all catalogs -->
        <h2 class="lineBreaker">Find your favorite stores offers on DealzBook</h2>

        <div class="row popularCatalogsContainer">
            @foreach ($catalogs as $key=>$catalog)

                @if($key == 8)
                    <!-- check all stores -->
                    @include('partials/catalogs/check_all_stores')
                    <!-- check all stores end-->
                @endif

                @if($key == 16)
                    <!-- check all stores -->
                    @include('partials/advertisements3')
                    <!-- check all stores end-->
                @endif
        
                <div class="col-sm-3 customContainers">
                    
                    @foreach ($catalog->images as $image)
    
                        @if ($image->featured)
                            <img class="w-full" src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$image->image}}" alt="Sunset in the mountains">
                        @endif
    
                    @endforeach
                    
                    <div class="row catalogDetails">
                        <div class="col-sm-12">
                            <p class="catalogName">{{$catalog->name}}</p>
                        
                            <div class="textContainer">
                                <p class="catalogDate">
                                    {{ \Carbon\Carbon::parse($catalog->start_at)->day }}
                                    @if(!$catalog->end_at)
                                        {{ \Carbon\Carbon::parse($catalog->start_at)->subMonth()->format('F') }}
                                    @endif
    
                                    @if($catalog->end_at)
                                        <span> - {{ \Carbon\Carbon::parse($catalog->end_at_at)->day }}
                                            {{ \Carbon\Carbon::parse($catalog->end_at)->subMonth()->format('F') }}
                                        </span>
                                    @endif
                                </p>
                                <p>
                                    Store {{$catalog->store->name}}
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

        <div class="row">
            <div class="col-sm-12 catalogNavigation">
                <span class="pages">Pages </span> {{ $catalogs->links() }}
            </div>
        </div>
       

        <!-- check all stores -->
        @include('partials/browse_catalogs_banner')
        <!-- check all stores end-->
        
        <!-- all catalogs end-->
    </div>
   

@endsection




