@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <div class="my-5">
        <div class="h3 text-center my-3">Login</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-9 col-lg-6 col-xl-4">
                <div class="my-5">
                    <img src="https://cdni.iconscout.com/illustration/free/thumb/signing-terms-of-services-2112511-1785593.png"
                        class="img-fluid" alt="Sample image">
                </div>
                <form action="/login" method="POST">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-2">
                        <input type="email" id="form3Example3" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter a valid email address" name="email" />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-2">
                        <input type="password" id="form3Example4"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Enter password"
                            name="password" />
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary ">Login</button>
                        <p class="small fw-semibold text-center">Belum punya akun? <a href="{{ url('/register') }}"
                                class="link-danger">Register</a></p>
                    </div>
            </div>

            </form>

        </div>
    </div>
    </div>
@endsection
