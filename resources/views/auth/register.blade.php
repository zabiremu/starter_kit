@extends('auth.layouts.app')

@section('content')
    <div class="card col-lg-4 mx-auto">
        <div class="card-body px-5 py-5">
            <h3 class="card-title text-left mb-3">Register</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text"
                        class="form-control p_input @error('name')
                    is-invalid
                @enderror"
                        name="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
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
                    <label>Password</label>
                    <input type="password"
                        class="form-control p_input  @error('password')
                    is-invalid
                @enderror"
                        name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password"
                        class="form-control p_input @error('ConfirmPassword')
                    is-invalid
                @enderror"
                        name="ConfirmPassword">
                    @error('ConfirmPassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Register</button>
                </div>

                <p class="sign-up text-center">Already have an Account?<a href="{{ route('login') }}"> Sign In</a></p>
                <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
            </form>
        </div>
    </div>
@endsection
