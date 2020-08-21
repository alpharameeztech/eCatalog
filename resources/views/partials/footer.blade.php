<div class="footer">

    <div class="container">

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
                <a href="#">
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

</div>
