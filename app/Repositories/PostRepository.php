<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Models\Post;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
}
