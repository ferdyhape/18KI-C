@extends('layouts.app')
@section('title', 'Register')
@section('content')
    <div class="my-5">
        <div class="h3 text-center my-3">Register</div>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid"
                    alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="/register" method="POST" autocomplete="off">
                    @csrf

                    <div class="form-outline mb-2">
                        <input type="text" id="form3Example3" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Nama" name="nama" autofocus />
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-outline mb-2">
                        <input type="text" id="form3Example3" class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="Alamat" name="alamat" />
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-outline mb-2">
                        <input type="email" id="form3Example3" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email" name="email" autocomplete="false" />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-outline mb-2">
                        <input type="password" id="form3Example4"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            name="password" autocomplete="false" />
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <p class="small fw-bold ">Sudah punya akun? <a href="{{ url('/login') }}"
                                class="link-danger">Login</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
