@extends('layouts.app')
@section('title', 'Transaksi')
@section('content')
    @if (count($transaksis) == 0)
        <p class="my-4">
            Transaksi masih kosong, pergi ke <a href="{{ url('cart/1') }}" class="fw-semibold text-primary">cart</a> untuk
            menambahkan
            transaksi baru
        </p>
    @else
        <div class="card shadow-sm my-4 border-0" id="transaksi-card">
            <div class="card-header">
                <p>List Transaksi</p>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover my-0">
                    <thead class="table-secondary">
                        <tr class="align-middle">
                            <th scope="col">No</th>
                            <th scope="col">ID</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Bayar</th>
                            <th scope="col">Kembali</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $transaksi)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }} </td>
                                <td>{{ $transaksi->id }}</td>
                                <td>{{ $transaksi->created_at }}</td>
                                <td>{{ $transaksi->tunai }}</td>
                                <td>{{ $transaksi->kembali }}</td>
                                <td>
                                    <a class="btn btn-warning show" href="{{ url('transaksi/' . $transaksi->id) }}"><i
                                            class="bi bi-eye-fill"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
