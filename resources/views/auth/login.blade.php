@extends('layouts.master')
@section('title', 'Register')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col col-lg-6">
            <div class="auth_header">
                <h2>Login</h2>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('login')}}" method="post">
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
    </div>
@endsection
