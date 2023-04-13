@extends('layouts.app')
@section('title', 'Transaksi')
@section('content')
    <div class="d-flex justify-content-center gap-3 my-4">
        <div class="col-7" id="kasir-tabel">
            <div class="card shadow shadow-sm border-0">
                <div class="card-header">
                    <p>Produk Detail</p>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemtransaksis as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->jumlah_barang }} </td>
                                    <td>@toRP($item->harga)</td>
                                    <td>{{ $item->diskon }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4" id="kasir-kalkulasi">
            <div class="card shadow shadow-sm p-3 border-0">
                <div class="d-flex justify-content-between">
                    <p>Tanggal</p>
                    <p>{{ $transaksis->created_at->format('m/d/Y') }}
                    </p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Jam</p>
                    <p>{{ $transaksis->created_at->format('d:m:Y') }}
                    </p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Kasir</p>
                    <p>{{ Auth::user()->nama }}
                    </p>
                </div>
                <hr>
                @foreach ($itemtransaksis as $item)
                    <div class="d-flex justify-content-between">
                        <p>{{ $item->nama_produk }} * {{ $item->jumlah_barang }}</p>
                        <p>@toRP($item->sub_total)
                        </p>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between">
                    <p class="fw-semibold">Total</p>
                    <p class="fw-semibold">@toRP($transaksis->total_harga)
                    </p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="fw-semibold">Bayar</p>
                    <p class="fw-semibold">@toRP($transaksis->tunai)
                    </p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="fw-semibold">Kembali</p>
                    <p class="fw-semibold">@toRP($transaksis->kembali)
                    </p>
                </div>
            </div>
            <div class="d-grid">
                <a class="btn btn-sm btn-success mt-2" href="{{ url("print/$transaksis->id") }}">
                    Download
                </a>
                <a class="btn btn-sm btn-primary mt-2" href="{{ url()->previous() }}">
                    Kembali
                </a>
            </div>
        </div>
    </div>

@endsection
