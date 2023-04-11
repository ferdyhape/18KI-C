@extends('layouts.app')
@section('title', 'Produk')
@section('content')

    <div class="card shadow-sm my-4 border-0">
        <div class="card-header">
            <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#tambahproduk">Tambah
                Produk</button>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover my-0">
                <thead class="table-secondary">
                    <tr class="align-middle">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Diskon</th>
                        <th scope="col" class="text-center" style="width:10%">Gambar</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }} </td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->kategori->nama }}</td>
                            <td>{{ $produk->deskripsi }}</td>
                            <td>{{ $produk->harga }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td class="text-center">{{ $produk->diskon }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $produk->gambar) }}" class="img-thumbnail border-0"
                                    alt="gambar-produk">
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editproduct{{ $produk['id'] }}"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a class="btn btn-danger" href="/produk/{{ $produk['id'] }}/delete"><i
                                            class="bi bi-trash3-fill"></i></a>
                                </div>

                                {{-- modal untuk edit --}}
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
                                                    <div class="form-group">
                                                        <input class="form-control my-3 @error('nama') is-invalid @enderror"
                                                            type="text" value="{{ $produk['nama'] }}" name="nama">
                                                        @error('nama')
                                                            <div class="form-text">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <input
                                                            class="form-control my-3 @error('deskripsi') is-invalid @enderror"
                                                            type="text" value="{{ $produk['deskripsi'] }}"
                                                            name="deskripsi">
                                                        @error('deskripsi')
                                                            <div class="form-text">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <select
                                                            class="form-control @error('kategori_id') is-invalid @enderror"
                                                            name="kategori_id" required>
                                                            @foreach ($kategoris as $kategori)
                                                                <option value="{{ $kategori->id }}"
                                                                    {{ $kategori->id == $produk->kategori_id ? 'selected' : '' }}>
                                                                    {{ $kategori->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('kategori_id')
                                                            <div class="form-text">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control my-3 @error('stok') is-invalid @enderror"
                                                            type="number" value="{{ $produk['stok'] }}" name="stok">
                                                        @error('stok')
                                                            <div class="form-text">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <input
                                                            class="form-control my-3 @error('diskon') is-invalid @enderror"
                                                            type="number" value="{{ $produk['diskon'] }}" name="diskon">
                                                        @error('diskon')
                                                            <div class="form-text">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <input
                                                            class="form-control my-3 @error('harga') is-invalid @enderror"
                                                            type="number" value="{{ $produk['harga'] }}" name="harga">
                                                        @error('harga')
                                                            <div class="form-text">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group">
                                                        <label class="input-group-text" for="gambar">Gambar</label>
                                                        <input type="file"
                                                            class="form-control @error('gambar') is-invalid @enderror"
                                                            id="gambar" name="gambar">
                                                        @error('gambar')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- modal untuk membuat --}}
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
                        <div class="form-group">
                            <input class="form-control my-3 @error('nama') is-invalid @enderror" type="text"
                                name="nama" placeholder="Nama Produk">
                            @error('nama')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="form-control my-3 @error('deskripsi') is-invalid @enderror" type="text"
                                name="deskripsi" placeholder="Deskripsi">
                            @error('deskripsi')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id"
                                name="kategori_id" required>
                                <option value="0" disabled selected>Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="form-control my-3 @error('stok') is-invalid @enderror" type="number"
                                name="stok" placeholder="Stok">
                            @error('stok')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="form-control my-3 @error('diskon') is-invalid @enderror" type="number"
                                name="diskon" placeholder="Diskon">
                            @error('diskon')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="form-control my-3 @error('harga') is-invalid @enderror" type="number"
                                name="harga" placeholder="Harga">
                            @error('harga')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label class="input-group-text" for="gambar">Gambar</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                id="gambar" name="gambar">
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
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
