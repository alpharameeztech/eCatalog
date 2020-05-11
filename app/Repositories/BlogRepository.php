<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Blog;
use App\Support\Collection;

class BlogRepository implements BlogRepositoryInterface
{

    public function all(){

        $blogs = Blog::where('status',1)->paginate(2);
        return $blogs;
    }
}