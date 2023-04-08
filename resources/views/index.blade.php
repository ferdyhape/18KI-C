@extends('layouts.app')
@section('title', 'Login Page')
@section('content')
    ini adalah halaman home
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn btn-info">
            <span class="nav_name">Logout</span>
        </button>
    </form>
@endsection
