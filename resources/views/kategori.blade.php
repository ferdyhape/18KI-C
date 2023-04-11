@extends('layouts.app')
@section('title', 'Kategori')
@section('content')
    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahKategori">Tambah
        Kategori</button>
    <table class="table table-striped table-hover mt-3">
        <thead class="table-secondary">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Deskripsi</th>
                <th scope="col" class="text-center">Jumlah Produk</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategoris as $kategori)
                <tr class="align-middle">
                    <td class="text-center">{{ $loop->iteration }} </td>
                    <td>{{ $kategori['nama'] }}</td>
                    <td>{{ $kategori['deskripsi'] }}</td>
                    <td class="text-center">{{ $kategori['jumlah_produk'] }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editCategory{{ $kategori['id'] }}">
                                <i class="bi bi-pencil-square"></i></a>
                            <a class="btn btn-danger" href="/kategori/delete/{{ $kategori['id'] }}">
                                <i class="bi bi-trash3-fill"></i></a>
                        </div>
                        {{-- modal untuk edit --}}
                        <div class="modal fade" id="editCategory{{ $kategori['id'] }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="/kategori/edit/{{ $kategori['id'] }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <table style="width: 100%;">
                                                <div class="form-group">
                                                    <input class="form-control my-3 @error('nama') is-invalid @enderror"
                                                        type="text" value="{{ $kategori['nama'] }}" name="nama">
                                                    @error('nama')
                                                        <div class="form-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control my-3 @error('deskripsi') is-invalid @enderror" type="text" name="deskripsi">{{ $kategori['deskripsi'] }}</textarea>
                                                    @error('deskripsi')
                                                        <div class="form-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
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
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- modal untuk tambah kategori --}}
    <div class="modal fade" id="tambahKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/kategori/add">
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <input class="form-control mb-3 @error('nama') is-invalid @enderror" type="text"
                                    name="nama" placeholder="Nama">
                                @error('nama')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea class="form-control mt-3 @error('deskripsi') is-invalid @enderror" type="text" name="deskripsi"
                                    placeholder="Deskripsi"></textarea>
                                @error('deskripsi')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
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
