<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function registerPage()
    {
        return view('auth.register');
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function resetPasswordPage()
    {
        return view('auth.reset_password');
    }

    public function register(UserRequest $request)
    {
        if ($request->password !== $request->password_repeat) return redirect()->back();
        $user = User::create([
            'name' => (string) $request->name,
            'email' => (string) $request->email,
            'email_verified_at' => '2022-06-20 11:29:35',
            'password' => Hash::make($request->password),
            'token' => '1212'
        ]);
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }
        return redirect("login_page")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login_page');
    }
}
