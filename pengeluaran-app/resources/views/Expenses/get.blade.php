@extends('layouts.app')

@section('content')
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0e6f4; /* Warna ungu pastel untuk latar belakang */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #6c5ce7; /* Warna ungu untuk judul */
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        strong {
            color: #6c5ce7; /* Warna ungu untuk teks yang tebal */
        }

        .btn-secondary {
            background-color: #9d7ad6; /* Warna ungu untuk tombol sekunder */
            border-color: #9d7ad6;
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #7c5f9b; /* Warna ungu tua untuk hover tombol sekunder */
            border-color: #7c5f9b;
        }
    </style>

    <div class="container">
        <h2>Expense Record Detail</h2>
        <p><strong>Title:</strong> {{ $expense->title }}</p>
        <p><strong>Description:</strong> {{ $expense->description }}</p>
        <p><strong>Amount:</strong> {{ $expense->amount }}</p>
        <p><strong>Date:</strong> {{ $expense->date }}</p>
        <a href="{{ route('Expenses.index') }}" class="btn btn-secondary">Back to Expense List</a>
    </div>
@endsection
