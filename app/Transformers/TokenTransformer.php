<?php

namespace App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use Laravel\Sanctum\NewAccessToken;

class TokenTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @return array
     */
    public function transform(NewAccessToken $token)
    {
        return [
            'access_token' => $token->plainTextToken,
            'expired_at' => $token->accessToken->expired_at,
        ];
    }
}
