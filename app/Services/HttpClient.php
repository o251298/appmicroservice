<?php

namespace App\Services;

use App\Exceptions\ApiHttpException;
use Illuminate\Support\Facades\Http;

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
}
