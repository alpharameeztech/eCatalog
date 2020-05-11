<?php

namespace App\Repositories\Interfaces;

use App\Blog;

interface BlogRepositoryInterface
{
    public function all();

    public function viewed(Blog $blog);

}