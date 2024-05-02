{{-- resources/views/users/get.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pengguna</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $user->name }}</h5>
            <p class="card-text">Username: {{ $user->username }}</p>
            <a href="{{ route('Users.index') }}" class="btn btn-primary">Back to list</a>
        </div>
    </div>
</div>
@endsection
