@extends('layouts.app')
@section('title', '18KI-C')
@section('content')
    <div class="container">
        <div class="row justify-conten-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Transaksi Bayar</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>id</th>
                                <th>user_id</th>
                                <th>total_harga</th>
                                <th>tunai</th>
                                <th>kembali</th>
                            </tr>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->user_id}}</td>
                                    <td>{{$item->total_harga}}</td>
                                    <td>{{$item->tunai}}</td>
                                    <td>{{$item->kembali}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
