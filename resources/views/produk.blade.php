@extends('layouts.app')
@section('title', 'Produk')
@section('content')
    <div class="p-3" id="product">
        <h1 class="text-center fw-bold">Daftar Produk</h1>
        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahproduk">Tambah
            Produk</button>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Kode Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Deskripsi Produk</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Diskon</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produks as $produk)
                    <tr>
                        <td>{{ $produk->id }}</td>
                        <td>{{ $produk->nama }}</td>
                        <td>{{ $produk->deskripsi }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $produk->gambar) }}" class="img-thumbnail" alt="gambar-produk">
                        </td>
                        <td>{{ $produk->diskon }}</td>
                        <td>{{ $produk->harga }}</td>
                        <td>{{ $produk->kategori->nama }}</td>

                        <td><a class="btn btn-outline-secondary" data-bs-toggle="modal"
                                data-bs-target="#editproduct{{ $produk['id'] }}">ubah</a>
                            <div class="modal fade" id="editproduct{{ $produk['id'] }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit produk</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="/produk/{{ $produk['id'] }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td><input
                                                                class="form-control my-3 @error('produk') is-invalid @enderror"
                                                                type="text" value="{{ $produk['nama'] }}"
                                                                name="nama">
                                                            @error('produk')
                                                                <div class="form-text">{{ $message }}</div>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kategori</td>
                                                        <td>
                                                            <select
                                                                class="form-control @error('kategori_id') is-invalid @enderror"
                                                                name="kategori_id" required>
                                                                @foreach ($kategoris as $kategori)
                                                                    <option value="{{ $kategori->id }}"
                                                                        {{ $kategori->id == $produk->kategori_id ? 'selected' : '' }}>
                                                                        {{ $kategori->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('produk')
                                                                <div class="form-text">{{ $message }}</div>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Deskripsi</td>
                                                        <td><input
                                                                class="form-control my-3 @error('produk') is-invalid @enderror"
                                                                type="text" value="{{ $produk['deskripsi'] }}"
                                                                name="deskripsi">
                                                            @error('produk')
                                                                <div class="form-text">{{ $message }}</div>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga</td>
                                                        <td><input
                                                                class="form-control my-3 @error('produk') is-invalid @enderror"
                                                                type="number" value="{{ $produk['harga'] }}"
                                                                name="harga">
                                                            @error('produk')
                                                                <div class="form-text">{{ $message }}</div>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Stok</td>
                                                        <td><input
                                                                class="form-control my-3 @error('produk') is-invalid @enderror"
                                                                type="number" value="{{ $produk['stok'] }}"
                                                                name="stok">
                                                            @error('produk')
                                                                <div class="form-text">{{ $message }}</div>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Diskon</td>
                                                        <td><input
                                                                class="form-control my-3 @error('produk') is-invalid @enderror"
                                                                type="number" value="{{ $produk['diskon'] }}"
                                                                name="diskon">
                                                            @error('produk')
                                                                <div class="form-text">{{ $message }}</div>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gambar</td>
                                                        <td>
                                                            <input
                                                                class="form-control my-3 @error('produk') is-invalid @enderror"
                                                                type="file" name="gambar">
                                                            @error('produk')
                                                                <div class="form-text">{{ $message }}</div>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Ubah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><a class="btn btn-danger" href="/produk/{{ $produk['id'] }}/delete">hapus</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="tambahproduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/produk" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <table style="width: 100%;">
                            <tr>
                                <td>Nama</td>
                                <td><input class="form-control my-3 @error('produk') is-invalid @enderror" type="text"
                                        placeholder="Masukkan nama produk.." name="nama">
                                    @error('produk')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>
                                    <select class="form-control @error('kategori_id') is-invalid @enderror"
                                        id="kategori_id" name="kategori_id" required>
                                        <option value="0">Pilih Kategori</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('produk')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td><input class="form-control my-3 @error('produk') is-invalid @enderror" type="text"
                                        placeholder="Masukkan deskripsi produk.." name="deskripsi">
                                    @error('produk')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td><input class="form-control my-3 @error('produk') is-invalid @enderror" type="number"
                                        placeholder="Masukkan harga produk" name="harga">
                                    @error('produk')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <td><input class="form-control my-3 @error('produk') is-invalid @enderror" type="number"
                                        placeholder="Masukkan stok produk" name="stok">
                                    @error('produk')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Diskon</td>
                                <td><input class="form-control my-3 @error('produk') is-invalid @enderror" type="number"
                                        placeholder="Masukkan diskon produk" name="diskon">
                                    @error('produk')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Gambar</td>
                                <td><input class="form-control my-3 @error('produk') is-invalid @enderror" type="file"
                                        placeholder="Masukkan gambar produk" name="gambar">
                                    @error('produk')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
