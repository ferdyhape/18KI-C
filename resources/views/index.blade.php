@extends('layouts.app')
@section('title', '18KI-C')
@section('content')
    ini adalah halaman home
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn btn-info">
            <span class="nav_name">Logout</span>
        </button>
    </form>
@endsection
