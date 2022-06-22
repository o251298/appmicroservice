<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class APIAuthenticationController extends Controller
{
    public function login(UserRequest $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($credentials)) return response()->json(['status' => 'success', 'info' => ['user' => Auth::user(), 'api_token' => Auth::user()->getToken()]], Response::HTTP_OK);
        return response()->json(['status' => 'error', 'info' => 'Invalid password or email'], Response::HTTP_BAD_REQUEST);
    }

    public function register(UserRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) return response()->json(['status' => 'error', 'info' => $validator->messages()], Response::HTTP_BAD_REQUEST);
        User::create([
            'name' => (string) $request->name,
            'email' => (string) $request->email,
            'password' => Hash::make($request->password),
            'api_token' => hash('sha256', $request->password),
        ]);
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($credentials)) return response()->json(['status' => 'success', 'info' => ['user' => Auth::user(), 'api_token' => Auth::user()->getToken()]], Response::HTTP_OK);
    }

    public function resetPassword(Request $request)
    {
        if (empty($request->email)) return response()->json(['status' => 'error', 'info' => "Email is empty"], Response::HTTP_BAD_REQUEST);
        $user = User::where('email', $request->email)->first();
        if(!$user) return response()->json(['status' => 'error', 'info' => "Email {$request->email} not found"], Response::HTTP_BAD_REQUEST);
        // update password
        $password = Str::random();
        $user->setPassword($password);
        // update token
        $token = $user->setApiToken($password);
        $user->save();
        Log::channel('auth_reset_password')->info(["user" => $user, 'new_password' => $password, 'new_token' => $token]);
        Mail::to($request->email)->send(new AuthMail(['password' => $password, 'token' => $token]));
        return response()->json(['status' => 'success', 'info' => $user], Response::HTTP_OK);
    }
}
