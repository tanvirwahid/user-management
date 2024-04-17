@extends('layouts.layout')

@section('content')
    <div class="w-100">
        <div class="d-flex flex-row justify-content-between m-3">
            <h5>User List</h5>
            <form action="{{ route('admin.users') }}">

                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="input-group-text" type="submit" id="search-button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <input class="form-control form-control-sm" placeholder="Search here...."
                        aria-label="search" id="search" name="search" aria-describedby="search-button">
                </div>

            </form>
        </div>
    </div>

    <div class="border-top">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Id Verification</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->date_of_birth }}</td>
                        <td>
                            <a href="{{ route('admin.download', ['user' => $user->id]) }}">
                                <i class="bi bi-filetype-pdf fs-4"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
        {{ $users->links() }}
    </div>
@endsection
