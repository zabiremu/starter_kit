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
@section('tittle','General Settings')
@section('content')
    <!-- Content section -->
    <div class="h-100 col-md-12 d-flex justify-content-center align-items-center grid-margin stretch-card">
        <div class="col-md-10 d-flex justify-content-center grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- Form for company information -->
                    <h4 class="card-title">General Information</h4>
                    <form class="forms-sample" action="{{ route('admin.general-information.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="id"
                            value="{{ isset($generalInformation->id) ? $generalInformation->id : '' }}" hidden>
                        <!-- Input field for app name -->
                        <div class="form-group row">
                            <label for="app_title" class="col-sm-3 col-form-label">App Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('app_title') is-invalid @enderror"
                                    id="app_title" placeholder="Please enter your app name" name="app_title"
                                    value="{{ isset($generalInformation->app_title) ? $generalInformation->app_title : '' }}">
                                @error('app_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Input field for author name -->
                        <div class="form-group row">
                            <label for="author_name" class="col-sm-3 col-form-label">Author name</label>
                            <div class="col-sm-9">
                                <input type="text"
                                    class="form-control @error('author_name') is-invalid @enderror"
                                    id="author_name" placeholder="Please enter your author name" name="author_name"
                                    value="{{ isset($generalInformation->author_name) ? $generalInformation->author_name : '' }}">
                                @error('author_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Textarea for company address -->
                        <div class="form-group row">
                            <label for="meta_keywords" class="col-sm-3 col-form-label">Meta Keywords</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror"
                                id="meta_keywords" placeholder="Please enter your meta keywords" name="meta_keywords"
                                value="{{ isset($generalInformation->meta_keywords) ? $generalInformation->meta_keywords : '' }}">
                                @error('meta_keywords')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Textarea for meta description -->
                        <div class="form-group row">
                            <label for="meta_description" class="col-sm-3 col-form-label">Meta Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                    placeholder="Please enter your meta description" name="meta_description">{{ isset($generalInformation->meta_description) ? $generalInformation->meta_description : '' }}</textarea>
                                @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <!-- Input field for copyright -->
                         <div class="form-group row">
                            <label for="copyright" class="col-sm-3 col-form-label">Copyright</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('copyright') is-invalid @enderror"
                                    id="copyright" placeholder="Please enter your copyright" name="copyright"
                                    value="{{ isset($generalInformation->copyright) ? $generalInformation->copyright : '' }}">
                                @error('copyright')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> <!-- Input field for copyright -->

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
            .create(document.querySelector('#meta_description'))
            .then(editor => {})
            .catch(error => {

            });
            $('#meta_keywords').selectize({
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            })
    </script>
@endpush
