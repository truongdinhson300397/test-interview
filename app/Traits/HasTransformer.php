<?php

namespace App\Traits;

use Flugg\Responder\Http\MakesResponses;
use Flugg\Responder\Serializers\SuccessSerializer;
use Flugg\Responder\Transformers\Transformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait HasTransformer
{
    use MakesResponses;

    /**
     * @var mixed
     */
    protected $serializer = SuccessSerializer::class;

    /**
     * Build a HTTP_OK response.
     *
     * @param mixed                            $data
     * @param callable|string|Transformer|null $transformer
     * @param null|string                      $resourceKey
     *
     * @return JsonResponse
     */
    public function httpOK($data = null, $transformer = null, string $resourceKey = null): JsonResponse
    {
        return $this->success($data, $transformer, $resourceKey)
                    ->serializer($this->getSerializer())
                    ->respond(Response::HTTP_OK);
    }

    /**
     * @return mixed
     */
    protected function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @param mixed $serializer
     *
     * @return $this
     */
    protected function setSerializer($serializer)
    {
        $this->serializer = $serializer;

        return $this;
    }

    /**
     * Build a HTTP_CREATED response.
     *
     * @param mixed                            $data
     * @param callable|string|Transformer|null $transformer
     * @param null|string                      $resourceKey
     *
     * @return JsonResponse
     */
    public function httpCreated($data = null, $transformer = null, string $resourceKey = null): JsonResponse
    {
        return $this->success($data, $transformer, $resourceKey)
                    ->serializer($this->getSerializer())
                    ->respond(Response::HTTP_CREATED);
    }

    /**
     * Build a HTTP_NO_CONTENT response.
     *
     * @return JsonResponse
     */
    public function httpNoContent(): JsonResponse
    {
        return $this->success()
                    ->serializer($this->getSerializer())
                    ->respond(Response::HTTP_NO_CONTENT);
    }

    /**
     * @param string|null $message
     * @param array       $errors
     *
     * @return JsonResponse
     */
    public function httpBadRequest(string $message = null, array $errors = []): JsonResponse
    {
        return $this->error(Response::HTTP_BAD_REQUEST, $message)
                    ->data($errors)
                    ->respond(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param array       $errors
     * @param             $errorCode
     * @param string|null $message
     *
     * @return JsonResponse
     */
    public function httpNotFound(array $errors = [], $errorCode = null, string $message = null): JsonResponse
    {
        return $this->error($errorCode, $message)
                    ->data($errors)
                    ->respond(Response::HTTP_NOT_FOUND);
    }

    /**
     * Build a HTTP_Unauthorized response.
     *
     * @return JsonResponse
     */
    public function httpUnauthorized($message = null): JsonResponse
    {
        return $this->error('unauthenticated', $message ?? __('auth.failed'))
            ->respond(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Build a HTTP_Conflict response.
     *
     * @return JsonResponse
     */
    public function httpConflict(): JsonResponse
    {
        return $this->error('conflict')->respond(Response::HTTP_CONFLICT);
    }

    /**
     * @return JsonResponse
     */
    public function httpForbidden(): JsonResponse
    {
        return $this->error('unauthorized')->respond(Response::HTTP_FORBIDDEN);
    }

    /**
     * @param string|null $message
     * @param array       $errors
     *
     * @return JsonResponse
     */
    public function httpUnprocessable(string $message = null, array $errors = []): JsonResponse
    {
        return $this->error(null, $message)
                    ->data($errors)
                    ->respond(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Unvalidated Import.
     * @param string|null $message
     * @param array $errors
     * @return JsonResponse
     */
    public function httpUnvalidated(string $message = null, array $errors = []): JsonResponse
    {
        return response()->json([
            'code'    => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'errors'  => $errors,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
