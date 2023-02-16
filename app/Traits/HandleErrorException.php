<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait HandleErrorException
{
    /**
     * @param \Illuminate\Validation\ValidationException $exception
     *
     * @return JsonResponse
     */
    public function renderApiValidationResponse(ValidationException $exception): JsonResponse
    {
        return response()->json([
            'code'    => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => __('api.msg_err_422'),
            'errors'  => $this->convertApiErrors($exception->errors()),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @param $errors
     *
     * @return array
     */
    private function convertApiErrors($errors): array
    {
        $result = [];
        foreach ($errors as $k => $error) {
            $result[] = [
                'field'   => $k,
                'message' => $error,
            ];
        }

        return $result;
    }

    public function renderApiNotFoundResponse(NotFoundHttpException $exception): JsonResponse
    {
        return response()->json([
            'code'    => Response::HTTP_NOT_FOUND,
            'message' => __('api.msg_err_404'),
            'errors'  => $exception->getMessage(),
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param \Tymon\JWTAuth\Exceptions\TokenExpiredException $exception
     *
     * @return JsonResponse
     */
    public function renderExpiredException(TokenExpiredException $exception): JsonResponse
    {
        return response()->json([
            'code'    => Response::HTTP_REQUEST_TIMEOUT,
            'message' => __('status.time_expired'),
            'errors'  => __('api.expired'),
        ], Response::HTTP_REQUEST_TIMEOUT);
    }

    /**
     * @return JsonResponse
     */
    public function renderNotLoginException(): JsonResponse
    {
        return response()->json([
            'code'    => Response::HTTP_NOT_FOUND,
            'message' => __('api.msg_err_404'),
            'errors' => __('api.msg_err_404'),
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param \Symfony\Component\HttpKernel\Exception\BadRequestHttpException $exception
     *
     * @return JsonResponse
     */
    public function renderApiBadRequestResponse(BadRequestHttpException $exception): JsonResponse
    {
        return response()->json([
            'code'    => Response::HTTP_BAD_REQUEST,
            'message' => __('api.msg_err_404'),
            'errors'  => $exception->getMessage(),
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Response server error exception.
     *
     * @param $exception
     *
     * @return JsonResponse
     */
    public function renderServerErrorException($exception): JsonResponse
    {
        return response()->json([
            'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => __('api.msg_err_500'),
            'errors'  => $exception->getMessage(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param $exception
     *
     * @return JsonResponse
     */
    public function renderForbiddenException($exception): JsonResponse
    {
        return response()->json([
            'code'    => Response::HTTP_FORBIDDEN,
            'message' => __('api.msg_err_403'),
            'error' => $exception->getMessage(),
        ], Response::HTTP_FORBIDDEN);
    }

    /**
     * Response unauthenticated.
     *
     * @param $exception
     *
     * @return JsonResponse
     */
    public function renderUnauthenticatedException($exception): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_UNAUTHORIZED,
            'message' =>  __('api.msg_err_401'),
            'errors' => 'unauthenticated',
        ], Response::HTTP_UNAUTHORIZED);
    }
}
