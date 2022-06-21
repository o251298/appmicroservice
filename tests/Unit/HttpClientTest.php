<?php

namespace Tests\Unit;

use App\Exceptions\ApiHttpException;
use App\Services\HttpClient;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class HttpClientTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_api_work_url()
    {
        $source = new Http();
        $client = new HttpClient($source);
        $expected = Http::get('http://localhost/api/service/companies')->json();
        $actual = $client->get('service/companies');
        $this->assertEquals($expected ?? null, $actual);
    }
    public function test_get_api_not_work_url()
    {
        try {
            $source = new Http();
            $client = new HttpClient($source);
            $expected = Http::get('http://localhost/api/service/companies')->json();
            $actual = $client->get('uasdasd');
        } catch (ApiHttpException $exception)
        {
            $this->assertInstanceOf(ApiHttpException::class, $exception);
        }
    }
}
