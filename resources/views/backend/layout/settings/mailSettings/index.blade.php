@extends('backend.app') <!-- Extends the backend layout -->
@section('tittle','Mail Settings')
@section('content')
    <!-- Content section -->
    <div class="h-100 d-flex justify-content-center align-items-center">
        <div class="col-md-12 d-flex justify-content-center grid-margin stretch-card">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- Form for mail settings -->
                        <h4 class="card-title"> Mail Settings</h4>
                        <form class="forms-sample" action="{{ route('mail-settings.update')}}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- We are passing our id to the request  --}}
                            <input type="text" name="id"
                            value="{{ isset($mail_settings->id) ? $mail_settings->id : '' }}" hidden>
                            <!-- Input field for mail mailer -->
                            <div class="form-group row">
                                <label for="mailmailer" class="col-sm-3 col-form-label">Mail Mailer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('mail_transport') is-invalid @enderror"
                                        id="mail_transport" placeholder="Mail Mailer" name="mail_transport"
                                        value="{{ old('mail_transport', env('MAIL_MAILER')) }}">
                                    @error('mail_transport')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input field for mail host -->
                            <div class="form-group row">
                                <label for="mailhost" class="col-sm-3 col-form-label">Mail Host</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('mail_host') is-invalid @enderror"
                                        id="mail_host" placeholder="Mail Host" name="mail_host"
                                        value="{{ old('mail_host', env('MAIL_HOST')) }}">
                                    @error('mail_host')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input field for mail port -->
                            <div class="form-group row">
                                <label for="mailport" class="col-sm-3 col-form-label">Mail Port</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('mail_port') is-invalid @enderror"
                                        id="mail_port" placeholder="Mail Port" name="mail_port"
                                        value="{{ old('mail_port', env('MAIL_PORT')) }}">
                                    @error('mail_port')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input field for mail username -->
                            <div class="form-group row">
                                <label for="mailusername" class="col-sm-3 col-form-label">Mail Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('mail_username') is-invalid @enderror"
                                        id="mail_username" placeholder="Mail Username" name="mail_username"
                                        value="{{ old('mail_username', env('MAIL_USERNAME')) }}">
                                    @error('mail_username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input field for mail password -->
                            <div class="form-group row">
                                <label for="mailpassword" class="col-sm-3 col-form-label">Mail Password</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('mail_password') is-invalid @enderror"
                                        id="mail_password" placeholder="Mail Password" name="mail_password"
                                        value="">
                                    @error('mail_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input field for mail encryption -->
                            <div class="form-group row">
                                <label for="mailencryption" class="col-sm-3 col-form-label">Mail Encryption</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control @error('mail_encryption') is-invalid @enderror"
                                        id="mail_encryption" placeholder="Mail Encryption" name="mail_encryption"
                                        value="{{ old('mail_encryption', env('MAIL_ENCRYPTION')) }}">
                                    @error('mail_encryption')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input field for mail from address -->
                            <div class="form-group row">
                                <label for="mailfrom" class="col-sm-3 col-form-label">Mail From Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('mail_from') is-invalid @enderror"
                                        id="mail_from" placeholder="Mail From" name="mail_from"
                                        value="{{ old('mail_from', env('MAIL_FROM_ADDRESS')) }}">
                                    @error('mail_from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Buttons for update and cancel -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-inverse-success btn-fw mr-2 ">Update</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-inverse-danger ">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
