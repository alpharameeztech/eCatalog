<div class="about">
    <h2 class="d-none d-sm-block @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.about') }}</h2>
    <h2 class="d-block d-sm-none textAlignCenter @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.about') }}</h2>

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
                <img src="/img/main-page/about.png" />
            </div>

        </div>
        @endforeach
    </div>

</div>
