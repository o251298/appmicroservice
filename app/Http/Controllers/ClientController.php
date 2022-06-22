<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHttpException;
use App\Exceptions\AuthException;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\HttpClient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    public function registration(UserRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) return response()->json(['status' => 'error', 'info' => $validator->messages()], Response::HTTP_BAD_REQUEST);
        if ($request->password !== $request->password_repeat) return response()->json(['status' => 'error', 'info' => 'password and password_repeat must have equales'], Response::HTTP_BAD_REQUEST);
        try {
            $client = new HttpClient(new Http());
            $response = $client->post('auth/register', ['name' => $request->name, 'email' => $request->email, 'password' => $request->password]);
            return \response()->json($response, $response['http_status']);
        } catch (ApiHttpException $exception)
        {
            return \response()->json($exception->getInfo(), $exception->status());
        }
    }


    public function login(UserRequest $request)
    {
        try {
            $client = new HttpClient(new Http());
            $response = $client->post('auth/login', ['email' => $request->email, 'password' => $request->password]);
            return \response()->json($response, $response['http_status']);
        } catch (ApiHttpException $exception)
        {
            return \response()->json($exception->getInfo(), $exception->status());
        }
    }


    public function recoveryPassword(Request $request)
    {
        if (empty($request->email)) return response()->json(['status' => 'error', 'info' => "Email is empty"], Response::HTTP_BAD_REQUEST);
        try {
            $client = new HttpClient(new Http());
            $response = $client->post('auth/reset_password', ['email' => $request->email]);
            return \response()->json($response, $response['http_status']);
        } catch (ApiHttpException $exception)
        {
            return \response()->json($exception->getInfo(), $exception->status());
        }
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
