<div class="latestBlog">
    <h2>The latest blog posts</h2>
    <div class="container">
        @foreach ($latest_blog as $blog)
        <div class="row">
            <div class="col-sm-6">
                <img src="/img/main-page/banner-2.png" />
            </div>
            <div class="col-sm-6">
                <h2> {{$blog->title}}</h2>
                <p>
                    {!! Illuminate\Support\Str::limit($blog->body, 400) !!}
                </p>

                <div class="row latestBlogContent">
                    <div class="col-sm-6"><p>{{$blog->created_at}}</p></div>
                    <div class="col-sm-6 more"><a class="more" href="/blog/{{$blog->slug}}">Learn more</a></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
   
</div>
