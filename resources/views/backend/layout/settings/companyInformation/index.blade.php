@extends('backend.app') <!-- Extends the backend layout -->

<!-- Dropify styles -->
@push('css')

    <style>
        .dropify-wrapper {
            background-color: #2A3038 !important;
            color: #fff !important;
            border-color: #2A3038;
        }
    </style>
@endpush
@section('tittle')
Company Information
@endsection
@section('content')
    <!-- Content section -->
    <div class="h-100 col-md-12 d-flex justify-content-center align-items-center grid-margin stretch-card">
        <div class="col-md-10 d-flex justify-content-center grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- Form for company information -->
                    <h4 class="card-title">Company Information</h4>
                    <form class="forms-sample" action="{{ route('company-information.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="id"
                            value="{{ isset($companyInformation->id) ? $companyInformation->id : '' }}" hidden>
                        <!-- Input field for company name -->
                        <div class="form-group row">
                            <label for="companyname" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                    id="company_name" placeholder="Please enter your company name" name="company_name"
                                    value="{{ isset($companyInformation->company_name) ? $companyInformation->company_name : '' }}">
                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Input field for company phone number -->
                        <div class="form-group row">
                            <label for="companyphonenumber" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="number"
                                    class="form-control @error('company_phone_number') is-invalid @enderror"
                                    id="company_phone_number" placeholder="Please enter your company phone number" name="company_phone_number"
                                    value="{{ isset($companyInformation->company_phone_number) ? $companyInformation->company_phone_number : '' }}">
                                @error('company_phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Input field for company email -->
                        <div class="form-group row">
                            <label for="companyemail" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control @error('company_email') is-invalid @enderror"
                                    id="company_email" placeholder="Please enter your company email" name="company_email"
                                    value="{{ isset($companyInformation->company_email) ? $companyInformation->company_email : '' }}">
                                @error('company_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Textarea for company address -->
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Please enter your company address"
                                    name="address">{{ isset($companyInformation->address) ? $companyInformation->address : '' }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Textarea for company description -->
                        <div class="form-group row">
                            <label for="companydescription" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('company_description') is-invalid @enderror" id="company_description"
                                    placeholder="Please enter your company description" name="company_description">{{ isset($companyInformation->company_description) ? $companyInformation->company_description : '' }}</textarea>
                                @error('company_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- File input for favicon -->
                        <div class="form-group row">
                            <label for="favicon" class="col-sm-3 col-form-label">Favicon</label>
                            <div class="col-sm-9">
                                <input type="file" class="dropify @error('favicon') is-invalid @enderror" name="favicon"
                                    id="favicon" data-allowed-file-extensions="png jpg jpeg"
                                    data-default-file="{{ isset($companyInformation->favicon) ? $companyInformation->favicon : '' }}" />
                                @error('favicon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- File input for logo -->
                        <div class="form-group row">
                            <label for="mailfrom" class="col-sm-3 col-form-label">Logo</label>
                            <div class="col-sm-9">
                                <input type="file" class="dropify" name="logo" id="logo"
                                    data-allowed-file-extensions="png jpg jpeg"
                                    data-default-file="{{ isset($companyInformation->logo) ? $companyInformation->logo : '' }}" />
                            </div>
                        </div>
                        <!-- Buttons for update and cancel -->
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-inverse-success btn-fw mr-2 ">Update</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-inverse-danger ">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize dropify on document ready
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
    {{-- Script for CKeditor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#company_description'))
            .then(editor => {})
            .catch(error => {

            });

        ClassicEditor
            .create(document.querySelector('#address'))
            .then(editor => {

            })
            .catch(error => {

            });
    </script>
@endpush
