<div class="about">
    <h2>About</h2>
    <div class="container">
        @foreach ($latest_blog as $blog)
        <div class="row">
            
            <div class="col-sm-6 aboutContent">
                <p>
                    DealzBook provides you will all the latest sales and deals in your favorite stores near you.
                    VIew all offers in one place with only a few clocks, from the comfort of your own home.
                </p>

            </div>
            <div class="col-sm-6">
                <img src="/img/main-page/about.png" />
            </div>
            
        </div>
        @endforeach
    </div>
   
</div>
