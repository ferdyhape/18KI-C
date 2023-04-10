<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ItemOrder;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // public function index()
    // {
    //     $item_order = DB::table('item_orders')
    //         ->join('carts', 'item_orders.cart_id', '=', 'carts.id')
    //         ->join('produks', 'item_orders.produk_id', '=', 'produks.id')
    //         ->join('users', 'carts.user_id', '=', 'users.id')
    //         ->where('users.id', '=', auth()->user()->id)
    //         ->select(
    //             'carts.id',
    //             'produks.nama',
    //             'produks.deskripsi',
    //             'produks.gambar',
    //             'produks.harga',
    //             'item_orders.jumlah_barang as jumlah_barang',
    //             'item_orders.sub_total as sub_total',
    //         )
    //         ->orderBy('produks.kategori_id', 'ASC')
    //         ->get();
    //     // dd($item_order);
    //     $totalHarga = 0;
    //     $cartId = 0;
    //     $userCart = DB::table('carts')
    //             ->where('user_id', '=', auth()->user()->id)
    //             ->offset(0)
    //             ->limit(1)
    //             ->first();

    //     if ($item_order->isEmpty()) {
    //         $item_order = null;
    //     } else {
    //         foreach ($item_order as $cart) {
    //             $totalHarga += $cart->sub_total;
    //             $cartId = $cart->id;
    //         }
    //         $editData = [
    //             'user_id' => $userCart->user_id,
    //             'total_harga' => $totalHarga,
    //         ];
    //         $updatedCart = Cart::find($userCart->id);
    //         $updatedCart->update($editData);
    //         // dd($userCart);
    //     }
    //     return view('cart.index', [
    //         'item_orders' => $item_order,
    //         'user_cart' => $userCart,
    //     ]);
    // }

    //INI CARAKU, NTar kalo ngejalanin tinggal di unkomen aja.............

    public function index($id)
    {
        $data['orders'] = ItemOrder::where('cart_id', 'like', $id)->get();
        $data['cart'] = Cart::find($id);
        $data['produks'] = Produk::all();
        $data['carts'] = Cart::where('user_id', 'like', Auth::user()->id)->get();
        return view('cart.coba', $data);
    }

    public function tambahCart()
    {
        $cart = Cart::create([
            'user_id' => Auth::user()->id
        ]);
        return redirect("/cart/$cart->id");
    }

    public function tambahItem(Request $request, $id)
    {
        $productAdd = ItemOrder::where('produk_id', $request->produk_id)->where('cart_id', $id)->first();
        $produk = Produk::find($request->produk_id);

        $request->validate([
            'jumlah_barang' => 'required|integer|min:0|max:' . $produk->stok,
        ]);

        $item_order['cart_id'] = null;
        $item_order['produk_id'] = null;
        $item_order['jumlah_barang'] = null;
        $item_order['sub_total'] = null;
        $tambahHarga = 0;

        if (is_null($productAdd)) {
            $productAdd = ItemOrder::where('cart_id', $id)->with(['produk', 'cart'])->get()->first();
            $productAdd = ItemOrder::create([
                'cart_id' => $id,
                'produk_id' => $produk->id,
                'jumlah_barang' => $request->jumlah_barang,
                'sub_total' => (((100 -  $produk->diskon) / 100) * ($request->jumlah_barang * $produk->harga))
            ]);
            $productAdd->cart->total_harga = $productAdd->cart->total_harga + $productAdd->sub_total;
        } else {
            $tambahHarga = (((100 - $productAdd->produk->diskon) / 100) * ($request->jumlah_barang * $productAdd->produk->harga));

            $productAdd->update([
                'jumlah_barang' => $productAdd->jumlah_barang + $request->jumlah_barang,
                'sub_total' => $productAdd->sub_total + $tambahHarga
            ]);
            $productAdd->cart->total_harga = $productAdd->cart->total_harga + $tambahHarga;
        }
        $productAdd->cart->save();
        $produk->update(['stok' => $produk->stok - $request->jumlah_barang]);
        return redirect("/cart/$id");
    }

    public function hapusItem($cart_id, $item_id)
    {
        $cart = Cart::find($cart_id);
        $item = ItemOrder::find($item_id);
        $produk = Produk::find($item->produk_id);
        $cart->update(['total_harga' => $cart->total_harga - $item->sub_total]);
        $produk->update(['stok' => $produk->stok + $item->jumlah_barang]);
        $item->delete();

        return redirect("cart/$cart_id");
    }

    // public function updateItem($id){
    //     $item = ItemOrder::find($id);
    //     $produk = Produk::find($item->produk_id);
    //     $item->update([]);
    // }
}
