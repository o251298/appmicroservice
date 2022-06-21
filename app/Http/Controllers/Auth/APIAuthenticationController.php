<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class APIAuthenticationController extends Controller
{
    public function login(UserRequest $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($credentials)) return response()->json(['status' => 'success', 'info' => Auth::user()], Response::HTTP_OK);
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
        if (Auth::attempt($credentials)) return response()->json(['status' => 'success', 'info' => Auth::user()], Response::HTTP_OK);
    }


}
