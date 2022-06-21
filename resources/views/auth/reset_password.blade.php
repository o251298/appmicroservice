@extends('layouts.master')
@section('title', 'Reset password')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col col-lg-6">
            <div class="auth_header">
                <h2>Reset password</h2>
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
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>
                <button type="submit" class="btn btn-primary">Reset</button>
            </form>
        </div>
    </div>
@endsection
