@extends('layouts.app')

@section('content')
    <style>
        /* Styling untuk container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0e6f4; /* Warna ungu pastel untuk latar belakang */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #6c5ce7; /* Warna ungu untuk judul */
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        .form-group label {
            color: #6c5ce7; /* Warna ungu untuk label */
            margin-right: 10px;
        }

        .form-control {
            width: 200px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-primary {
            background-color: #9d7ad6; /* Warna ungu untuk tombol utama */
            border-color: #9d7ad6;
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #7c5f9b; /* Warna ungu tua untuk hover tombol utama */
            border-color: #7c5f9b;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: #fff; /* Warna latar belakang putih untuk setiap item */
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        li p {
            margin: 5px 0;
        }

        strong {
            color: #6c5ce7; /* Warna ungu untuk teks yang tebal */
        }
    </style>

    <div class="container">
        <h1>Hasil Pencarian Pengeluaran</h1>

        <form action="{{ route('expenses.search') }}" method="GET" class="form-inline mb-3">
            <div class="form-group mr-2">
                <label for="start_date">Tanggal Mulai:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="form-group mr-2">
                <label for="end_date">Tanggal Akhir:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <ul>
            @forelse ($expenses as $expense)
            <li>
                <p><strong>Judul:</strong> {{ $expense->title }}</p>
                <p><strong>Deskripsi:</strong> {{ $expense->description }}</p>
                <p><strong>Jumlah:</strong> {{ $expense->amount }}</p>
                <p><strong>Tanggal:</strong> {{ $expense->date }}</p>
            </li>
            @empty
            <li>Tidak ada catatan pengeluaran yang cocok dengan kriteria pencarian.</li>
            @endforelse
        </ul>

        <a href="{{ route('expenses.index') }}" class="btn btn-primary">Kembali ke Daftar Pengeluaran</a>
    </div>
@endsection
