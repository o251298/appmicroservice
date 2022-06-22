<?php

namespace App\Http\Controllers\AuthService;

use App\Http\Controllers\Controller;
use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class APIAuthenticationController extends Controller
{

    public function login(Request $request)
    {
        $data = ['email' => $request['email'], 'password' => $request['password']];
        Log::channel('http_request')->info($data);
        if (Auth::attempt($data)) return ['status' => 'success', 'info' => ['user' => Auth::user(), 'api_token' => Auth::user()->getToken()], 'http_status' => Response::HTTP_OK];
        return ['status' => 'error', 'info' => 'Invalid password or email', 'http_status' => Response::HTTP_BAD_REQUEST];
    }

    public function register(Request $request)
    {
        Log::channel('http_request')->info($request);
        User::create([
            'name' => (string) $request['name'],
            'email' => (string) $request['email'],
            'password' => Hash::make($request['password']),
            'api_token' => hash('sha256', $request['password']),
        ]);
        $credentials = ['email' => $request['email'], 'password' => $request['password']];
        if (Auth::attempt($credentials)) return ['status' => 'success', 'info' => ['user' => Auth::user(), 'api_token' => Auth::user()->getToken()], 'http_status'=> Response::HTTP_CREATED];
    }


    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        if(!$user) return ['status' => 'error', 'info' => "Email {$request['email']} not found",'http_status' => Response::HTTP_BAD_REQUEST];
        $password = Str::random();
        $user->setPassword($password);
        $token = $user->setApiToken($password);
        $user->save();
        Log::channel('auth_reset_password')->info(["user" => $user, 'new_password' => $password, 'new_token' => $token]);
        Mail::to($request->email)->send(new AuthMail(['password' => $password, 'token' => $token]));
        return ['status' => 'success', 'info' => $user, 'http_status' => Response::HTTP_OK];
    }
}
