<?php

namespace App\Repositories\Interfaces;

use App\Blog;

interface BlogRepositoryInterface
{
    public function all($order = 'desc');

    public function viewed(Blog $blog);

}