<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ItemOrder;
use App\Models\Produk;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
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
        $produk = Produk::find($request->produk_id);
        $request->validate([
            'jumlah_barang' => 'required|integer|min:0|max:' . $produk->stok,
        ]);
        $tambahHarga = (((100 - $produk->diskon) / 100) * ($request->jumlah_barang * $produk->harga));
        $productAdd = ItemOrder::where('cart_id', $id)->where('produk_id', $request->produk_id)->first();
        if (is_null($productAdd)) {
            $productAdd = ItemOrder::create([
                'cart_id' => $id,
                'produk_id' => $produk->id,
                'jumlah_barang' => $request->jumlah_barang,
                'sub_total' => $tambahHarga
            ]);
        } else {
            $productAdd->update([
                'jumlah_barang' => $productAdd->jumlah_barang + $request->jumlah_barang,
                'sub_total' => $productAdd->sub_total + $tambahHarga
            ]);
        }
        $productAdd->cart->total_harga = $productAdd->cart->total_harga + $tambahHarga;
        $productAdd->cart->save();
        $productAdd->produk->update(['stok' => $produk->stok - $request->jumlah_barang]);
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

    public function updateItem(Request $request, $id){
        $productAdd = ItemOrder::find($id)->with('produk', 'cart')->first();

        $request->validate([
            'jumlah_barang' => 'required|integer|min:0|max:' . $productAdd->produk->stok,
        ]);

        $kurangHarga = (((100 - $productAdd->produk->diskon) / 100) * ($productAdd->jumlah_barang * $productAdd->produk->harga));

        $productAdd->update([
            'jumlah_barang' => $request->jumlah_barang,
            'sub_total' => (((100 - $productAdd->produk->diskon) / 100) * ($request->jumlah_barang * $productAdd->produk->harga))
        ]);
        $productAdd->cart->update([
            'total_harga' => $productAdd->cart->total_harga - $kurangHarga + $productAdd->sub_total
        ]);
        return redirect("cart/$productAdd->cart_id");
    }
}