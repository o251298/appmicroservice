<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHttpException;
use App\Exceptions\AuthException;
use App\Models\User;
use App\Services\HttpClient;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function register()
    {

    }
    public function auth()
    {
        dd("auth");
    }
    public function resetPassword()
    {

    }
    public function getCompany()
    {
        try {
            User::isAuthByTokenForApi(request()->bearerToken());
            $client = new HttpClient(new Http());
            return \response()->json($client->get('service/companies'), Response::HTTP_OK);
        } catch (AuthException $exception)
        {
            return \response()->json($exception->getInfo(), $exception->status());
        } catch (ApiHttpException $exception) {
            return \response()->json($exception->getInfo(), $exception->status());
        }
    }

    public function createCompany()
    {
        try {
            User::isAuthByTokenForApi(request()->bearerToken());
            $client = new HttpClient(new Http());
        } catch (AuthException $exception)
        {
            return \response()->json($exception->getInfo(), $exception->status());
        }
    }
}
