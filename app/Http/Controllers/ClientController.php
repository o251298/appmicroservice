<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHttpException;
use App\Exceptions\AuthException;
use App\Models\User;
use App\Services\HttpClient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
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

    public function createCompany(Request $request)
    {
        try {
            $user = User::isAuthByTokenForApi(request()->bearerToken());
            $client = new HttpClient(new Http());
            $company = $client->post('service/companies/create', array_merge($request->all(), array('user' => $user->id)));
            return \response()->json($company, Response::HTTP_CREATED);
        } catch (AuthException $exception)
        {
            return \response()->json($exception->getInfo(), $exception->status());
        } catch (ApiHttpException $exception) {
            return \response()->json($exception->getInfo(), $exception->status());
        }
    }
}
