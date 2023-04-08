@extends('layouts.app')
@section('title', 'Template') 
@section('content')
<div class="container py-4">
    <div class="container py-4">
        @if (is_null($item_orders))
            <div class="text-muted" style="min-height: 400px">
                You have no item_order in cart, go to <a href="{{ url('/') }}" class="text-decoration-none">home</a> to
                add item to cart
            </div>
        @else
            <div class="row justify-content-center" style="min-height: 400px">
                @foreach ($item_orders as $item_order)
                    <div class="col-3 my-3">
                        <div class="card shadow border-0 text-black">
                            <img src="{{ asset('storage/' . $item_order->gambar) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="text-start">
                                    <h5 class="card-title">{{ $item_order->nama }}</h5>
                                </div>
                                <div>

                                    <div class="d-flex justify-content-between" style="height: 50px">
                                        <span>{{ $item_order->deskripsi }}</span>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between font-weight-bold mt-4">
                                    <span>@toRP($item_order->harga)</span>
                                </div>
                                <div class="d-flex justify-content-between font-weight-bold mt-3 text-primary">
                                    {{--  <span class="text-muted border px-2 rounded">{{ $item_order->qty }}</span>  --}}
                                    {{-- <form action="toCart/{{ $item_order->id }}" class="d-flex justify-content-between"
                                        method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="input-group input-group-sm " style="width:25%">
                                            <input type="number" class="form-control rounded"
                                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                                name="qty" value="{{ $item_order->qty }}">
                                            <input type="hidden" name="id" value="{{ $item_order->cart_details_id }}">
                                        </div>

                                    </form> --}}
                                    {{-- <button class="badge m-0 p-0 bg-transparent border-0 delete-confirm"
                                        data-id="{{ $item_order->id }}" data-name="{{ $item_order->nama }}"><i
                                            class="fas fa-fw fa-trash text-danger fs-4"
                                            style="font-size: 18px;"></i></button>
                                    <form action="/toCart/{{ $item_order->cart_details_id }}"
                                        id="form-delete-{{ $item_order->id }}" method="POST" style="display: none">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="submit">
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- <div class="card border-0 mt-3 py-3 px-2">
                @foreach ($item_orders as $item_order)
                    @php
                        $subtotal = $item_order->price * $item_order->qty;
                    @endphp

                    <div class="card-body d-flex justify-content-between my-0 py-0">
                        <span class="p-0">{{ $item_order->name }} x {{ $item_order->qty }}</span>
                        <span class="fw-semibold p-0">@toRP($subtotal)</span>
                    </div>
                @endforeach
                <hr class="px-5">
                <div class="card-body d-flex justify-content-between py-0">
                    <span class="fw-semibold p-0">Total:</span>
                    <span class="fw-bold p-0">@toRP($totalPrice)</span>
                </div>
            </div> --}}
        @endif
    </div>
@endsection
