<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

trait GuzzleClientRequest
{
    /**
     * @param $method
     * @param $url
     * @param array $body
     * @param array $headers
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function clientRequest($method, $url, array $body = [], array $headers = []): array
    {
        $client = new Client();

        if (!empty($headers)) {
            $body = array_merge($body, $headers);
        }

        try {
            $response = $client->request($method, $url, $body);
            $responseBody = $response->getBody()->getContents();

            return [
                'status_code' => $response->getStatusCode(),
                'body'        => $responseBody,
            ];
        } catch (ClientException $exception) {
            $responseBody = $exception->getResponse()->getBody(true)->getContents();

            return [
                'status_code' => $exception->getCode(),
                'body'        => $responseBody,
            ];
        }
    }
}
