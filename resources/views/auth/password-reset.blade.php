@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-6">
                <div class="d-flex justify-content-center">
                    <h5 class="d-inline-block border border-dark p-2">Reset Password</h5>
                </div>
                <div class="card border-white text-left">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @php
                            Session::put('error', null);
                            Session::put('success', null);
                        @endphp

                        <form action="{{ route('password-reset.update') }}" method="POST" id="passwordResetForm">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="old_password">Old Password</label>
                                    </div>
                                    <div class="col">
                                        <input type="password" class="form-control form-control-sm" id="old_password"
                                            name="old_password" required>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group mt-3">

                                <div class="row">

                                    <div class="col-md-4">
                                        <label for="new_password">New Password</label>
                                    </div>

                                    <div class="col">
                                        <input type="password" class="form-control form-control-sm" id="new_password"
                                            name="new_password" required>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group mt-3">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="new_password">Confirm Password</label>
                                    </div>
                                    <div class="col">
                                        <input type="password" class="form-control form-control-sm"
                                            id="new_password_confirmation" name="new_password_confirmation" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-dark btn-sm">Update</button>
                                <button type="button" id="clearButton"
                                    class="btn btn-outline-dark btn-sm mx-2">Clear</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clearButton').click(function() {
                $('#passwordResetForm')[0].reset();
            });
        });
    </script>
@endsection
