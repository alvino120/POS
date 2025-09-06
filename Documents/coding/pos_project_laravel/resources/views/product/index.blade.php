@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Daftar Produk</h3>
    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr> 
                <td>{{ $p->nama }}</td>
                <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                <td>{{ $p->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
