<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Blog;
use App\Support\Collection;

class BlogRepository implements BlogRepositoryInterface
{

    public function all($order = 'desc'){

        $blogs = Blog::where('status',1)->orderBy('created_at', $order)->paginate(2);
        return $blogs;
    }

    /**
     * The blog just got viewed
     * by somebody
     * so increment the total_views
     */
    public function viewed(Blog $blog)
    {
        $blog->total_views = ++$blog->total_views;

        $blog->save();
    }
}