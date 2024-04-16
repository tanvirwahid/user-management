@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-light text-left">
                    <div class="card-title text-center mt-3">
                        <h5 class="d-inline-block border border-dark p-2">User Profile</h5>
                    </div>
                    <div class="card-body ml-2">
                        
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>First Name:</strong></p>
                            </div>
                            <div class="col">
                                <p>{{$profile->first_name}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Last Name:</strong></p>
                            </div>
                            <div class="col">
                                <p>{{$profile->last_name}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Address:</strong></p>
                            </div>
                            <div class="col">
                                <p>{{$profile->address}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Phone:</strong></p>
                            </div>
                            <div class="col">
                                <p>{{$profile->phone}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Email:</strong></p>
                            </div>
                            <div class="col">
                                <p>{{$profile->email}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Birthdate:</strong></p>
                            </div>
                            <div class="col">
                                <p>{{$profile->date_of_birth}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Id Verification:</strong></p>
                            </div>
                            <div class="col">
                                <a href="{{route('profile.download')}}">
                                    <i class="bi bi-filetype-pdf fs-4"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection