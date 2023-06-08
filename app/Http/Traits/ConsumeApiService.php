<?php

namespace App\Http\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;

trait ConsumeApiService
{
    /**
     * Send a request to any service
     * @return string
     */
    public function performRequest($method, $requestUrl, $data = [], $headers = [])
    {
        try {
            $client = new Client([
                'base_uri' => env('API_ITA_URL'),
            ]);

            $response = $client->request($method, $requestUrl, ['json' => $data, 'headers' => $headers]);

            foreach ($response->getHeaders() as $name => $values) {
                $data['header'][$name] = $values[0];
            }
            $data['body'] = json_decode($response->getBody()->getContents());
            $data['code'] = $response->getStatusCode();
            $data['header'] = $response->getHeader('content-type')[0];
            return $data;
        } catch (ClientException $e) {
            $code = $e->getCode();
            $message = $e->getMessage();
            $data['body'] = json_decode($e->getResponse()->getBody(true));
            $data['code'] = $e->getCode();
            return $data;
        }
    }

    public function performRequestFormParams($method, $requestUrl, $data = [], $headers = [], $options = [])
    {
        try {
            $client = new Client([
                'base_uri' => env('API_ITA_URL'),
            ]);

            $response = $client->request($method, $requestUrl, ['form_params' => $data, 'headers' => $headers, $options]);

            foreach ($response->getHeaders() as $name => $values) {
                $data['header'][$name] = $values[0];
            }
            $data['body'] = json_decode($response->getBody()->getContents());
            $data['code'] = $response->getStatusCode();
            $data['header'] = $response->getHeader('content-type')[0];
            return $data;
        } catch (ClientException $e) {
            $code = $e->getCode();
            $message = $e->getMessage();
            $data['body'] = json_decode($e->getResponse()->getBody(true));
            $data['code'] = $e->getCode();
            return $data;
        }
    }

    public function performRequestMutliPart($method, $requestUrl, $data = [], $headers = [])
    {
        try {
            $client = new Client([
                'base_uri' => env('API_ITA_URL'),
            ]);

            $response = $client->request($method, $requestUrl, ['multipart' => $data, 'headers' => $headers]);

            foreach ($response->getHeaders() as $name => $values) {
                $data['header'][$name] = $values[0];
            }
            $data['body'] = json_decode($response->getBody()->getContents());
            $data['code'] = $response->getStatusCode();
            $data['header'] = $response->getHeader('content-type')[0];
            return $data;
        } catch (ClientException $e) {
            $code = $e->getCode();
            $message = $e->getMessage();
            $data['body'] = json_decode($e->getResponse()->getBody(true));
            $data['code'] = $e->getCode();
            return $data;
        }
    }
}
