@extends('layouts.master')
@section('title', 'Register')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col col-lg-6">
            <div class="auth_header">
                <h2>Register</h2>
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
            <form action="{{route('register')}}" method="post">
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
    </div>
@endsection
