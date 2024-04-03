@extends('auth.layouts.app')

@section('content')
    <div class="card col-lg-4 mx-auto">
        <div class="card-body px-5 py-5">
            <h3 class="card-title text-left mb-3">Login</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label>Username or email </label>
                    <input type="email"
                        class="form-control p_input @error('email')
                    is-invalid
                @enderror"
                        name="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password </label>
                    <input type="password"
                        class="form-control p_input @error('email')
                    is-invalid
                @enderror"
                        name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                </div>
                {{-- <p class="sign-up">Don't have an Account?<a href="{{ route('register') }}"> Sign Up</a></p> --}}
            </form>
        </div>
    </div>
@endsection
