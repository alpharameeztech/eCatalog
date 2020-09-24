<div class="about">
    <h2 class="d-none d-sm-block @if(session('locale') == 'ar') textAlignRight @endif">
        <a href="/{{ session('locale') }}/about-us" style="color:#000">
            {{ trans('index.about') }}
        </a>
    </h2>
    <h2 class="d-block d-sm-none textAlignCenter @if(session('locale') == 'ar') textAlignRight @endif">
        <a href="/{{ session('locale') }}/about-us" style="color:#000">
            {{ trans('index.about') }}
        </a>
    </h2>

    <div class="container">
        @foreach ($latest_blog as $blog)
        <div class="row">

            <div class="col-sm-6 aboutContent">

                @foreach($about as $content)
                    <div class="@if(session('locale') == 'ar') richTextBody @endif">

                        <p>
                            {!! Str::limit($content->body, '200') !!}
                        </p>

                    </div>
                @endforeach

            </div>
            <div class="col-sm-5">
            <a href="/{{ session('locale') }}/about-us" style="color:#000">
                <img src="/img/main-page/about.png" />
            </a>
            </div>

        </div>
        @endforeach
    </div>

</div>
