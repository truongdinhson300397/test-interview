<?php

namespace App\Exceptions;

use App\Traits\HandleErrorException;
use Flugg\Responder\Exceptions\ConvertsExceptions;
use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use  ConvertsExceptions, HandleErrorException;

    public function render($request, Throwable $e)
    {
        switch (true) {
            case $e instanceof HttpException:
                return $this->renderResponse($e);
            case $e instanceof ValidationException:
                return $this->renderApiValidationResponse($e);
            case $e instanceof NotFoundHttpException:
                return $this->renderApiNotFoundResponse($e);
            case $e instanceof ModelNotFoundException:
                return $this->renderApiModelNotFoundResponse($e);
            case $e instanceof BadRequestHttpException:
                return $this->renderApiBadRequestResponse($e);
            case $e instanceof MissingAbilityException:
            case $e instanceof AuthorizationException:
                return $this->renderForbiddenException($e);
            case $e instanceof AuthenticationException:
                return $this->renderUnauthenticatedException($e);
            default:
                return $this->renderServerErrorException($e);
        }
    }

    protected function renderApiModelNotFoundResponse(ModelNotFoundException $exception): JsonResponse
    {
        return response()->json([
            'code'    => Response::HTTP_NOT_FOUND,
            'message' => __('api.msg_err_404'),
            'errors'  => $exception->getMessage(),
        ], Response::HTTP_NOT_FOUND);
    }
}
