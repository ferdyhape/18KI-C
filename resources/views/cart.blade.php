@extends('layouts.app')
@section('title', 'Cart')
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td data-bs-toggle="modal" data-bs-target="#editJumlah{{ $item['id'] }}">
                                        <p class="border border-1 text-center rounded">
                                            {{ $item->jumlah_barang }}
                                        </p>
                                    </td>
                                    <td>@toRP($item->produk->harga)</td>
                                    <td>{{ $item->produk->diskon }}%</td>
                                    <td>
                                        <form action="{{ url('cart/' . $cart->id . '/delete' . '/' . $item['id']) }}"
                                            method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger" onclick="return confirm('beneran mau hapus?')"><i
                                                    class="bi bi-trash3-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editJumlah{{ $item['id'] }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit jumlah
                                                    {{ $item->produk->nama }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="/item/update/{{ $item->id }}">
                                                <div class="modal-body">
                                                    <div class="form-group mt-2">
                                                        <input
                                                            class="form-control mb-3 @error('jumlah_barang') is-invalid @enderror"
                                                            type="number" name="jumlah_barang"
                                                            value="{{ $item->jumlah_barang }}">
                                                        @error('jumlah_barang')
                                                            jumlah_barang
                                                            <div class="form-text">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                    <p>{{ date('d-m-y') }}
                    </p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Kasir</p>
                    <p>{{ Auth::user()->nama }}
                    </p>
                </div>
                <hr>
                @if (count($orders) == 0)
                    <p class="text-center text-muted">!!! Produk belum ditambahkan !!!</p>
                @else
                    @foreach ($orders as $item)
                        <div class="d-flex justify-content-between">
                            <p>{{ $item->produk->nama }} * {{ $item->jumlah_barang }}</p>
                            <p>@toRP($item->sub_total)
                            </p>
                        </div>
                    @endforeach
                @endif
                <hr>
                <div class="d-flex justify-content-between">
                    <p class="fw-semibold">Total</p>
                    <p class="fw-semibold">@toRP($cart->total_harga)
                    </p>
                </div>
                <hr class="mb-1">
                <div class="d-grid mt-2 gap-2">
                    @if (count($orders) != 0)
                        <form action="{{ url('bayar/' . $cart->id) }}" id="formTunai" class="d-grid gap-2" method="POST">
                            @csrf
                            <div class="form-group">
                                <input class="form-control @error('tunai') is-invalid @enderror" type="number"
                                    name="tunai" placeholder="Tunai">
                                @error('tunai')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-success d-block">Bayar</button>
                        </form>
                    @endif
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Tambah Produk
                    </button>

                    <!-- Modal tambah produk -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/item/add/{{ $cart->id }}">
                                    <div class="modal-body">
                                        <div class="form-group mt-2">
                                            <select class="form-control" id="kategori_dipilih">
                                                <option value="0" disabled selected>Kategori</option>
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mt-2">
                                            <select class="form-control @error('produk_id') is-invalid @enderror"
                                                id="select_produk" name="produk_id" required>
                                                <option value="0" disabled selected>Pilih Produk</option>

                                            </select>
                                            @error('produk_id')
                                                <div class="form-text">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <input class="form-control mb-3 @error('jumlah_barang') is-invalid @enderror"
                                                type="number" name="jumlah_barang" placeholder="Jumlah">
                                            @error('jumlah_barang')
                                                jumlah_barang
                                                <div class="form-text">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit">Tambahkan</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const select = document.getElementById('kategori_dipilih');

        $("#kategori_dipilih").on('change', function() {
            var kategori_id = $(this).val();
            if (kategori_id) {
                $.ajax({
                    url: '/produk/getProduksByKategori/' + kategori_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var select = $('#select_produk');
                        select.empty();
                        select.append('<option value="0" disabled selected>Pilih Produk</option>');
                        $.each(data.produks, function(key, value) {
                            select.append('<option value="' + value.id + '">' + value.nama +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#select_produk').empty();
            }
        });
    </script>
@endsection
