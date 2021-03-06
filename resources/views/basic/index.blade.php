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
            <form class="auth" method="post" action="{{route('user_register')}}">
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
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
        <div class="col col-lg-6">
            <h2>Login</h2>
            <form class="auth" action="{{route('user_login')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">email</label>
                    <input type="text" name="email" class="form-control" id="name" aria-describedby="nameHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div class="col col-lg-6">
            <h2>Reset password</h2>
            <form class="auth" action="{{route('user_recover_password')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>
                <button type="submit" class="btn btn-primary">Reset password</button>
            </form>
        </div>
        <div class="col col-lg-6">
            <h2>Companies</h2>
            <div class="card" style="width: 18rem; display: none" id="companies">
                <ul class="list-group list-group-flush" id="companies-list">

                </ul>
            </div>
            <form action="{{route('user_companies')}}" method="get" id="form_company">
                @csrf
                <label for="api_token">Token</label>
                <input type="text" name="api_token" id="api_token">
                <button type="submit" class="btn btn-primary">Check company</button>
            </form>
        </div>

        <div class="col col-lg-6">
            <h2>Create company</h2>
            <form class="create-company" action="{{route('user_companies_create')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="token" class="form-label">Token for send*</label>
                    <input type="text" name="token" class="form-control" id="token_test" aria-describedby="nameHelp">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title_create" aria-describedby="nameHelp">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" id="description_create">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">phone</label>
                    <input type="text" name="phone" class="form-control" id="phone_create">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>

        <div class="col col-lg-6">
        </div>
    </div>
@endsection
