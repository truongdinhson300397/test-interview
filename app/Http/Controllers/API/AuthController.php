<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Traits\HasTransformer;
use App\Transformers\TokenTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HasTransformer;
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $input = $request->validated();
        $user = $this->repository->query()->where('email', $input['email'])->first();

        if (empty($user) || !Hash::check($input['password'], $user->password)) {
            return $this->httpUnauthorized();
        }

        $token = $user->createToken('SPA Login');

        return $this->httpOK($token, TokenTransformer::class);
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        auth('user')->user()->currentAccessToken()->delete();

        return $this->httpNoContent();
    }
}
