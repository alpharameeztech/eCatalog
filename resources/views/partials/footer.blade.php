<div class="footer">

    @if(session('locale') == 'en')
        <!-- for screen greater than extra small -->
            <div class="d-none d-sm-block container">

            <nav role='navigation' class="main-nav" id="main-nav">
                <ul id="main-nav-list">
                    <li>
                        <a href="/">
                            <div>
                                {{ trans('index.home')}}
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/stores">
                            <div>
                                {{ trans('index.stores')}}
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/catalogs">
                            <div>
                                {{ trans('index.catalogs')}}
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/{{session('locale')}}/about-us">
                            <div>
                                {{ trans('index.about')}}
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/faq">
                            <div>
                                {{ trans('index.faq')}}
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/{{session('locale')}}/contact-us">
                            <div>
                                {{ trans('index.contact_us')}}
                            </div>
                        </a>
                    </li>

                </ul>
            </nav>

            <div class="row subHeading">
                <div class="col-sm-3">
                    <p class="subHeading2">{{ trans('index.stores')}}</p>

                    @foreach ($recent_stores as $store)
                        <p><a href="/store/{{$store->slug}}">{{$store->name}}</a></p>
                    @endforeach

                    <p><a href="">{{ trans('index.all_stores') }}</a></p>

                </div>
                <div class="col-sm-3">
                    <p class="subHeading2">{{ trans('index.cities') }}</p>

                    @foreach ($recent_cities as $city)

                        <p><a class="@if(!empty (request('city') && request('city') == $city->slug )) active @endif" href="/{{session('locale')}}/city/{{$city->slug}}">{{$city->name}}</a></p>

                    @endforeach

                    <p><a href="/">{{ trans('index.all_cities')}}</a></p>

                </div>
                <div class="col-sm-3">

                    <p class="subHeading2"><a href="/terms">{{ trans('index.terms') }}</a></p>

                </div>
                <div class="col-sm-3">
                    <p class="subHeading2">{{ trans('index.follow') }}</p>

                    <div class="social">
                        @if($social)
                            <a href="{{$social->facebook}}"><img src="/img/icons/facebook.svg" /></a>
                            <a href="{{$social->twitter}}"><img src="/img/icons/twitter.svg" /></a>
                            <a href="{{$social->instagram}}"><img src="/img/icons/instagram.svg" /></a>
                            <a href="{{$social->youtube}}"><img src="/img/icons/youtube.svg" /></a>
                        @endif


                    </div>
                </div>
            </div>

        </div>
        <!-- for screen greater than extra small end-->

        <!-- only for extra small -->
            <div class="d-block d-sm-none container">

                    <div class="row">
                        <div class="col-6 displayBlock navigationLinksForExtraSmallScreen">

                            <a class="displayBlock darkGray" href="/">
                                {{ trans('index.home')}}
                            </a>

                            <a class="displayBlock darkGray"  href="/stores">
                                {{ trans('index.stores')}}
                            </a>

                            <a class="displayBlock darkGray"  href="/catalogs">
                                {{ trans('index.catalogs')}}
                            </a>

                            <a class="displayBlock darkGray"  href="/{{session('locale')}}/about-us">
                                {{ trans('index.about')}}
                            </a>

                        </div>

                        <div class="col-6 navigationLinksForExtraSmallScreen">
                            <a class="darkGray displayBlock" href="/faq">
                                <div>
                                    {{ trans('index.faq')}}
                                </div>
                            </a>
                            <a class="darkGray displayBlock" href="/{{session('locale')}}/contact-us">
                                <div>
                                    {{ trans('index.contact_us')}}
                                </div>
                            </a>
                            <a class="darkGray displayBlock" href="/{{session('locale')}}/contact-us">
                                <div>
                                    {{ trans('index.terms') }}
                                </div>
                            </a>

                        </div>
                    </div>

                <div class="row subHeading">

                    <section class="accordianForExtraSmall accordion-section clearfix mt-3" aria-label="Question Accordions">

                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="borderGrayTop panel panel-default">
                                        <div class="panel-heading mb-3" role="tab" id="heading0">
                                            <h3 class="panel-title">
                                                <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" aria-controls="collapse0">
                                                    Stores
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapse0" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading0">
                                            <div class="panel-body px-3 mb-4">
                                                @foreach ($recent_stores as $store)
                                                    <p><a href="/store/{{$store->slug}}">{{$store->name}}</a></p>
                                                @endforeach

                                                <p><a href="">{{ trans('index.all_stores') }}</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="borderGrayTop borderGrayBottom panel panel-default">
                                        <div class="panel-heading  mb-3" role="tab" id="heading1">
                                            <h3 class="panel-title">
                                                <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                    Cities
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                                            <div class="panel-body px-3 mb-4">
                                                <p class="subHeading2">{{ trans('index.cities') }}</p>

                                                @foreach ($recent_cities as $city)

                                                    <p><a class="@if(!empty (request('city') && request('city') == $city->slug )) active @endif" href="/{{session('locale')}}/city/{{$city->slug}}">{{$city->name}}</a></p>

                                                @endforeach

                                                <p><a href="/">{{ trans('index.all_cities')}}</a></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </section>

                    <div class="col-sm-3">


                    </div>
                    <div class="col-sm-3">
                        <h4 class="subHeading2 textAlignCenter">{{ trans('index.follow') }}</h4>

                        <div class="social">
                            @if($social)
                                <a href="{{$social->facebook}}"><img class="width50" src="/img/icons/facebook.svg" /></a>
                                <a href="{{$social->twitter}}"><img class="width50" src="/img/icons/twitter.svg" /></a>
                                <a href="{{$social->instagram}}"><img class="width50" src="/img/icons/instagram.svg" /></a>
                                <a href="{{$social->youtube}}"><img class="width50" src="/img/icons/youtube.svg" /></a>
                            @endif


                        </div>
                    </div>
                </div>

            </div>
            <!-- only for extra small end-->
        @else
        <div class="container">

            <nav role='navigation' class="main-nav" id="main-nav">
                <ul id="main-nav-list">

                    <li>
                        <a href="#">
                            <div>
                                {{ trans('index.contact_us')}}
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/faq">
                            <div>
                                {{ trans('index.faq')}}
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/{{session('locale')}}/about-us">
                            <div>
                                {{ trans('index.about')}}
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/catalogs">
                            <div>
                                {{ trans('index.catalogs')}}
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="/stores">
                            <div>
                                {{ trans('index.stores')}}
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="/">
                            <div>
                                {{ trans('index.home')}}
                            </div>
                        </a>
                    </li>


                </ul>
            </nav>

            <div class="row subHeading">
                <div class="col-sm-3">
                    <p class="subHeading2">{{ trans('index.follow') }}</p>

                    <div class="social">
                        @if($social)
                            <a href="{{$social->facebook}}"><img src="/img/icons/facebook.svg" /></a>
                            <a href="{{$social->twitter}}"><img src="/img/icons/twitter.svg" /></a>
                            <a href="{{$social->instagram}}"><img src="/img/icons/instagram.svg" /></a>
                            <a href="{{$social->youtube}}"><img src="/img/icons/youtube.svg" /></a>
                        @endif


                    </div>
                </div>

                <div class="col-sm-3">

                    <p class="subHeading2"><a href="/terms">{{ trans('index.terms') }}</a></p>

                </div>

                <div class="col-sm-3">
                    <p class="subHeading2">{{ trans('index.cities') }}</p>

                    @foreach ($recent_cities as $city)

                        <p><a class="@if(!empty (request('city') && request('city') == $city->slug )) active @endif" href="/{{session('locale')}}/city/{{$city->slug}}">{{$city->name}}</a></p>

                    @endforeach

                    <p><a href="/">{{ trans('index.all_cities')}}</a></p>

                </div>

                <div class="col-sm-3">
                    <p class="subHeading2">{{ trans('index.stores')}}</p>

                    @foreach ($recent_stores as $store)
                        <p><a href="/store/{{$store->slug}}">{{$store->name}}</a></p>
                    @endforeach

                    <p><a href="">{{ trans('index.all_stores') }}</a></p>

                </div>


            </div>

        </div>

    @endif

</div>
