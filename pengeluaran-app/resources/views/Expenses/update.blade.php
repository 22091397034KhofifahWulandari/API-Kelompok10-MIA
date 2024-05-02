@extends('layouts.app')

@section('content')
    <style>
        /* Styling untuk form */
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0e6f4; /* Warna ungu pastel untuk latar belakang form */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #9d7ad6; /* Warna ungu untuk tombol submit */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #7c5f9b; /* Warna ungu tua untuk hover tombol submit */
        }

        /* Alert styling */
        .alert {
            border-radius: 5px;
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 20px;
        }

        ul {
            margin: 0;
            padding-left: 20px;
        }

        /* Error message styling */
        .error-message {
            color: #721c24;
        }

        h2 {
            text-align: center;
            color: #6c5ce7; /* Warna ungu untuk judul */
            margin-bottom: 20px;
        }
    </style>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li class="error-message">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('Expenses.update', $expense->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h2>Edit Expense Record</h2>
        <input type="text" name="title" placeholder="Title" value="{{ $expense->title }}"><br>
        <input type="text" name="description" placeholder="Description" value="{{ $expense->description }}"><br>
        <input type="number" name="amount" placeholder="Amount" value="{{ $expense->amount }}"><br>
        <input type="date" name="date" placeholder="Date" value="{{ $expense->date }}"><br>
        <button type="submit">Update Data</button>
    </form>
@endsection
