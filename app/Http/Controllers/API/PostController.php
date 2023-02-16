<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\PostService;
use App\Traits\HasTransformer;
use App\Transformers\TokenTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    use HasTransformer;

    private PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }
}
