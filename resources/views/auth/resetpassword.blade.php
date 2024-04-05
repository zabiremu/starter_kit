@extends('auth.layouts.app')

@section('content')
    {{-- reset password --}}
    <div class="card col-lg-4 mx-auto">
        <div class="card-body">
            <h3 class="card-title text-left">Reset Password</h3>
            <p>Please enter your registered email address, and we'll send you a link.</p>
            <form>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control p_input">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Reset Password</button>
                </div>
                <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p>
            </form>
        </div>
    </div>
@endsection
