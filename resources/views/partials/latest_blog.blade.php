<div class="latestBlog">
    <h2 class="d-none d-sm-block @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.the_latest_blog_posts') }}</h2>
    <h2 class="d-block d-sm-none textAlignCenter @if(session('locale') == 'ar') textAlignRight @endif">{{ trans('index.the_latest_blog_posts') }}</h2>
    <div class="container">
        @foreach ($latest_blog as $blog)
        <div class="row">
            <div class="col-sm-6">
                <img src="https://ecatalog.s3-ap-southeast-1.amazonaws.com/{{$blog->image}}" />
            </div>
            <div class="col-sm-6">
                <h2 class="d-none d-sm-block @if(session('locale') == 'ar') textAlignRight @endif"> {{$blog->title}}</h2>
                <h2 class="d-block d-sm-none textAlignCenter @if(session('locale') == 'ar') textAlignRight @endif"> {{$blog->title}}</h2>

               <div class="@if(session('locale') == 'ar') richTextBody @endif">
                   <p class="@if(session('locale') == 'ar') textAlignRight @endif">
                        {!! Illuminate\Support\Str::limit($blog->body, 400) !!}
                   </p>
               </div>

                <!--  only for other than extra small -->
                <div class="d-none d-sm-flex row latestBlogContent">
                    <div class="col-sm-6"><p>{{ \Carbon\Carbon::parse($blog->created_at)->day }} {{ \Carbon\Carbon::parse($blog->created_at)->subMonth()->format('F') }}</p></div>
                    <div class="col-sm-6 more"><a class="more" href="/blog/{{$blog->slug}}">Learn more</a></div>
                </div>
                <!--  only for other than extra small end-->

                <!--  only for extra small -->
                <div class="d-flex d-sm-none row ">
                    <div class="col-6"><p>{{ \Carbon\Carbon::parse($blog->created_at)->day }} {{ \Carbon\Carbon::parse($blog->created_at)->subMonth()->format('F') }}</p></div>
                    <div class="col-6 more textAlignRight"><a class="more" href="/blog/{{$blog->slug}}">Learn more</a></div>
                </div>
                <!--  only for extra small end -->

            </div>
        </div>
        @endforeach
    </div>

</div>
