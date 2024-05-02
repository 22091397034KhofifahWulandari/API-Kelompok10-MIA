@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Pengguna, Kontak, dan Alamat</h1>
    <h2>Pengguna</h2>
    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Username:</strong> {{ $user->username }}</p>
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    
    <h2>Kontak</h2>
    @if ($user->contacts->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->contacts as $contact)
                    <tr>
                        <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada kontak tersedia untuk pengguna ini.</p>
    @endif
    
    <h2>Alamat</h2>
    @if ($user->addresses->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Street</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Country</th>
                    <th>Postal Code</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->addresses as $address)
                    <tr>
                        <td>{{ $address->street }}</td>
                        <td>{{ $address->city }}</td>
                        <td>{{ $address->province }}</td>
                        <td>{{ $address->country }}</td>
                        <td>{{ $address->postal_code }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada alamat tersedia untuk pengguna ini.</p>
    @endif
</div>
@endsection
