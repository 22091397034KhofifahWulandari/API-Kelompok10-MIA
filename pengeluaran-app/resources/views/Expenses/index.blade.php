@extends('layouts.app')

@section('content')
    <style>
        .container {
            padding: 20px;
            background-color: #f0e6f4; /* Warna ungu pastel untuk latar belakang */
            border-radius: 10px; /* Sudut bulat */
        }

        .alert {
            border-radius: 10px;
            background-color: #8cd78f; /* Warna ungu muda untuk latar belakang alert sukses */
            color: #000000; /* Warna teks untuk alert sukses */
        }

        .form-inline .form-control {
            margin-right: 10px;
        }

        .table {
            background-color: #ffffff; /* Latar belakang putih untuk tabel */
            border-radius: 10px; /* Sudut bulat */
        }

        .btn-primary {
            background-color: #9d7ad6; /* Warna ungu untuk tombol primer */
            border-color: #9d7ad6;
        }

        .btn-primary:hover {
            background-color: #7c5f9b; /* Warna ungu tua untuk hover tombol primer */
            border-color: #7c5f9b;
        }

        .btn-danger {
            background-color: #de6a6a; /* Warna merah muda untuk tombol danger */
            border-color: #de6a6a;
        }

        .btn-danger:hover {
            background-color: #b95454; /* Warna merah tua untuk hover tombol danger */
            border-color: #b95454;
        }

        .btn-success {
            background-color: #81c784; /* Warna hijau muda untuk tombol success */
            border-color: #81c784;
        }

        .btn-success:hover {
            background-color: #5a9f5c; /* Warna hijau tua untuk hover tombol success */
            border-color: #5a9f5c;
        }
    </style>

    <div class="container">
        <h1 style="color: #673ab7;">Expense Records</h1> <!-- Warna ungu tua untuk judul -->

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @php
            $totalPengeluaran = 0;
        @endphp

        <div class="row mb-4">
            <div class="col-md-6">
                <form action="{{ route('Expenses.index') }}" method="GET" class="form-inline">
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('Expenses.createForm') }}" class="btn btn-primary">Add Expense Record</a>
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                        <tr>
                            <td>{{ $expense->title }}</td>
                            <td>{{ $expense->description }}</td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('Expenses.updateForm', ['expense' => $expense->id]) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form action="{{ route('Expenses.delete', ['expense' => $expense->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this expense record?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $totalPengeluaran += $expense->amount;
                        @endphp
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12 text-right">
                    <h5>Total Pengeluaran: {{ $totalPengeluaran }}</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
