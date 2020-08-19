<div class="about">
    <h2>About</h2>
    <div class="container">
        @foreach ($latest_blog as $blog)
        <div class="row">

            <div class="col-sm-6 aboutContent">

                @foreach($about as $content)
                    <div>

                        <p>
                            {!! Str::limit($content->body, '200') !!}
                        </p>

                    </div>
                @endforeach

            </div>
            <div class="col-sm-6">
                <img src="/img/main-page/about.png" />
            </div>

        </div>
        @endforeach
    </div>

</div>
