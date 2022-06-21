@extends('layouts.master')
@section('title', 'Test')
@section('content')
    <h2>Success {{\Illuminate\Support\Facades\Auth::id()}}</h2>
@endsection
