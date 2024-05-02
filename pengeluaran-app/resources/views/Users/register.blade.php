@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;"> <!-- Menerapkan flexbox -->
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f0e6ff; /* Warna ungu pastel */
            width: 10cm; /* Lebar kotak */
            height: auto; /* Tinggi kotak menyesuaikan konten */
            max-width: 100%; /* Maksimum lebar kotak */
            margin-top: -60px; /* Mengurangi margin atas */
            padding: 20px; /* Menambah padding */
        }

        .btn-primary {
            background-color: #6c5ce7; /* Warna ungu tua */
            border-color: #6c5ce7; /* Warna ungu tua */
        }

        .btn-primary:hover {
            background-color: #5340de; /* Warna ungu tua (hover) */
            border-color: #5340de; /* Warna ungu tua (hover) */
        }

        .btn-secondary {
            background-color: #7f8c8d; /* Warna abu-abu */
            border-color: #7f8c8d; /* Warna abu-abu */
        }

        .btn-secondary:hover {
            background-color: #95a5a6; /* Warna abu-abu (hover) */
            border-color: #95a5a6; /* Warna abu-abu (hover) */
        }

        .register-title {
            text-align: center;
            color: #6c5ce7; /* Warna ungu untuk judul */
            margin-bottom: 20px;
        }
    </style>
    <div class="card">
        <h1 class="register-title mb-4">Register</h1>
        <form action="{{ route('Users.register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <div class="mt-3 text-center">
            Already have an account? <a href="{{ route('Users.loginForm') }}" class="btn btn-secondary">Login</a>
        </div>
    </div>
</div>
@endsection
