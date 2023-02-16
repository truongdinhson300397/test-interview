<?php

namespace App\Services;

use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Transformers\PostTransformer;

class PostService extends BaseService
{
    public function __construct(PostRepositoryInterface $repository, PostTransformer $transformer)
    {
        parent::__construct($repository, $transformer);
    }
}
