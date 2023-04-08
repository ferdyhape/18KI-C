<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $item_order = DB::table('item_orders')
            ->join('carts', 'item_orders.cart_id', '=', 'carts.id')
            ->join('produks', 'item_orders.produk_id', '=', 'produks.id')
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->where('users.id', '=', auth()->user()->id)
            ->select(
                'carts.id',
                'produks.nama',
                'produks.deskripsi',
                'produks.gambar',
                'produks.harga',
                'item_orders.jumlah_barang as jumlah_barang',
                'item_orders.sub_total as sub_total',
            )
            ->orderBy('produks.kategori_id', 'ASC')
            ->get();
        // dd($item_order);
        $totalHarga = 0;
        $cartId = 0;
        $userCart = DB::table('carts')
                ->where('user_id', '=', auth()->user()->id)
                ->offset(0)
                ->limit(1)
                ->first();
        
        if ($item_order->isEmpty()) {
            $item_order = null;
        } else {
            foreach ($item_order as $cart) {
                $totalHarga += $cart->sub_total;
                $cartId = $cart->id;
            }
            $editData = [
                'user_id' => $userCart->user_id,
                'total_harga' => $totalHarga,
            ];
            $updatedCart = Cart::find($userCart->id);
            $updatedCart->update($editData);
            // dd($userCart);
        }
        return view('cart.index', [
            'item_orders' => $item_order,
            'user_cart' => $userCart,
        ]);
    }

    // public function tambah(Request $request){
    //     $cart = Cart::create([
    //         'user_id' = Auth::user()->id
    //     ])
        
    //     $produk = Item_order::find($request->product_id);

    //     Item_order::create([
    //         'cart_id' = $cart->id,
    //         'produk_id' = $produk->id,
    //         'jumlah_barang' = $request->jumlah_barang,
    //         'sub_total' = ((( 100 -  $produk->diskon) / 100 ) * ( $request->jumlah_barang * $produk->harga ))
    //     ]);

    //     Cart::update([
            
    //     ])

    // }
}