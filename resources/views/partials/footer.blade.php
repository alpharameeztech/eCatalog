<div class="footer">

    <div class="container">

        <nav role='navigation' class="main-nav" id="main-nav">
            <ul id="main-nav-list">
              <li>
                <a href="/">
                  <div>
                    Home
                  </div>
                </a>
              </li>
              <li>
                <a href="/stores">
                  <div>
                    Stores
                  </div>
                </a>
              </li>
              <li>
                <a href="/catalogs">
                  <div>
                    Catalogs
                  </div>
                </a>
              </li>
              <li>
                <a href="/about-us">
                  <div>
                    About Us
                  </div>
                </a>
              </li>
              <li>
                <a href="/faq">
                  <div>
                    FAQ
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div>
                    Contact Us
                  </div>
                </a>
              </li>

            </ul>
        </nav>

        <div class="row subHeading">
            <div class="col-sm-3">
                <p class="subHeading2">Stores</p>

                @foreach ($recent_stores as $store)
                    <p><a href="/store/{{$store->slug}}">{{$store->name}}</a></p>
                @endforeach

                <p><a href="">All Stores</a></p>

            </div>
            <div class="col-sm-3">
                <p class="subHeading2">Cities</p>

                @foreach ($recent_cities as $city)

                    <p><a href="/?city={{$city->slug}}">{{$city->name}}</a></p>

                @endforeach

                <p><a href="/">All Citites</a></p>

            </div>
            <div class="col-sm-3">

                <p class="subHeading2"><a href="/terms">Terms & Conditions</a></p>

            </div>
            <div class="col-sm-3">
                <p class="subHeading2">Follow Us On</p>

                <div class="social">
                    <a href="{{$social->facebook}}"><img src="/img/icons/facebook.svg" /></a>
                    <a href="{{$social->twitter}}"><img src="/img/icons/twitter.svg" /></a>
                    <a href="{{$social->instagram}}"><img src="/img/icons/instagram.svg" /></a>
                    <a href="{{$social->youtube}}"><img src="/img/icons/youtube.svg" /></a>

                </div>
            </div>
        </div>

    </div>

</div>
