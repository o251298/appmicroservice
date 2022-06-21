<?php

namespace App\Services;

use App\Exceptions\ApiHttpException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HttpClient
{
    protected $source;
    private static $host = 'http://localhost/api/';

    public function __construct(Http $source)
    {
        $this->source = $source;
    }

    public function get(string $url)
    {
        $response = $this->source::get(static::$host . $url)->json();
        if (!$response) throw new ApiHttpException("Connection fail! Address: ".static::$host . $url . " \nResponse: " . json_encode($response));
        return $response;
    }

    public function post($url, array $data)
    {
        Log::channel('http_request')->info($data);
        $response = $this->source::post(static::$host . $url, $data);
        if (empty($response->json())) {
            throw new ApiHttpException("Connection fail! Address: ".static::$host . $url . " \nResponse: " . "Validation error");
        }
        Log::channel('http_response')->info($response->json());
        return $response->json();
    }
}
