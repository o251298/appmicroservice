@extends('layouts.master')
@section('title', 'AJAX')
@section('content')
    <div class="row justify-content-md-center">

        <div class="alert alert-success" id="success" style="display: none" role="alert">
            Your token: <strong id="token"></strong>
        </div>
        <div class="alert alert-danger" id="errors" style="display: none" role="alert">
            <ul id="error-list"></ul>
        </div>

        <div class="col col-lg-6">
            <h2>Register</h2>
            <form class="auth" method="post" action="{{route('api_register')}}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3">
                    <label for="password_repeat" class="form-label">Password Repeat</label>
                    <input type="password" name="password_repeat" class="form-control" id="password_repeat">
                </div>
                <div class="mb-3">
                    <p>Already have <a href="{{route('login_page')}}">account?</a></p>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
        <div class="col col-lg-6">
            <h2>Login</h2>
            <form class="auth" action="{{route('api_login')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">email</label>
                    <input type="text" name="email" class="form-control" id="name" aria-describedby="nameHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3">
                    <p>Don't have <a href="{{route('register_page')}}">account?</a></p>
                </div>
                <div class="mb-3">
                    <p>Don't remember your <a href="{{route('reset_password_page')}}">password?</a></p>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>

        <div class="col col-lg-6">
            <h2>Companies</h2>
            <div class="card" style="width: 18rem; display: none" id="companies">
                <ul class="list-group list-group-flush" id="companies-list">

                </ul>
            </div>
            <form action="{{route('client_companies')}}" method="get" id="form_company">
                @csrf
                <label for="api_token">Token</label>
                <input type="text" name="api_token" id="api_token">
                <button type="submit" class="btn btn-primary">Check company</button>
            </form>
        </div>

        <div class="col col-lg-6">
            <h2>Create company</h2>
            <a href=""></a>
        </div>

        <div class="col col-lg-6">
            <h2>Logout</h2>
            <a href=""></a>
        </div>

        <div class="col col-lg-6">
            <h2>Logout</h2>
            <a href=""></a>
        </div>
    </div>
@endsection
