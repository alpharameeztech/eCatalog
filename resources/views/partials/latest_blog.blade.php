<div class="latestBlog">
    <h2 class="@if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.the_latest_blog_posts') }}</h2>
    <div class="container">
        @foreach ($latest_blog as $blog)
        <div class="row">
            <div class="col-sm-6">
                <img src="/img/main-page/banner-2.png" />
            </div>
            <div class="col-sm-6">
                <h2 class="@if(session('locale') == 'ar') textAlignRight @endif"> {{$blog->title}}</h2>

               <div class="@if(session('locale') == 'ar') richTextBody @endif">
                   <p class="@if(session('locale') == 'ar') textAlignRight @endif">
                        {!! Illuminate\Support\Str::limit($blog->body, 400) !!}
                   </p>
               </div>

                <div class="row latestBlogContent">
                    <div class="col-sm-6"><p>{{ \Carbon\Carbon::parse($blog->created_at)->day }} {{ \Carbon\Carbon::parse($blog->created_at)->subMonth()->format('F') }}</p></div>
                    <div class="col-sm-6 more"><a class="more" href="/blog/{{$blog->slug}}">Learn more</a></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
