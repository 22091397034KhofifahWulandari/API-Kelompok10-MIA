@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pengguna</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>

                <td>
                    <a href="{{ route('Users.get', $user->id) }}">Get User</a>
                    <a href="{{ route('Users.edit', $user->id) }}">Update User</a>
                    <!-- Logout button -->
                    <form action="{{ route('logout') }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Log Out</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Logout button or login/register links -->
    @if(Auth::check())
        <!-- If user is logged in, show logout button -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    @else
        <!-- If user is not logged in, show login and register links -->
        <a href="{{ route('Users.loginForm') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('Users.registerForm') }}" class="btn btn-success">Register</a>
    @endif
</div>
@endsection
