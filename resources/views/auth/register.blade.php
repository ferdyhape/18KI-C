@extends('layouts.app')
@section('title', 'Register')
@section('content')
    <div class="my-5">
        <div class="h3 text-center my-3">Login</div>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid"
                    alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="/register" method="POST">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-2">
                        <input type="text" id="form3Example3" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama" name="nama" />
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-outline mb-2">
                        <input type="text" id="form3Example3" class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="Masukan alamat" name="alamat" />
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-outline mb-2">
                        <input type="email" id="form3Example3" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukkan email" name="email" />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-2">
                        <input type="password" id="form3Example4"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password"
                            name="password" />
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- <div class="form-outline">
                        <input type="file"
                            class="form-control form-control-sm form-control @error('avatar') is-invalid @enderror"
                            id="formFileSm" name="avatar">
                        @error('avatar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}

                    <div class="text-center text-lg-start pt-2 btn-sm">
                        <button type="submit" class="btn btn-primary "
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Sudah punya akun? <a href="{{ url('/login') }}"
                                class="link-danger">Login</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
