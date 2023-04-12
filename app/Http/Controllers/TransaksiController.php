<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Itemtransaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('transaksi', [
            'transaksis' => Transaksi::all(),
        ]);
    }
    public function show($id)
    {
        $itemTransaksi = Itemtransaksi::where('transaksi_id', '=', $id)->get();
        $transaksi = Transaksi::find($id);
        return view('transaksi-detail', [
            'transaksis' => $transaksi,
            'itemtransaksis' => $itemTransaksi,
        ]);
    }
    public function store(Request $request, $id)
    {
        $cart = Cart::find($id);

        $request->validate(
            [
                'tunai' => 'required|numeric|between:' . $cart->total_harga . ',9999999999999999999999999999999',
            ],
            [
                'tunai.required' => 'kolom tunai harus diisi',
                'tunai.between' => "Tunai harus diatas atau sama dengan total harga"
            ]
        );

        $dataTransaksi = [
            'user_id' => $cart->id,
            'total_harga' => $cart->total_harga,
            'tunai' => $request->tunai,
            'kembali' => $request->tunai - $cart->total_harga,
        ];
        $newTransaksi = Transaksi::create($dataTransaksi);


        foreach ($cart->itemOrder as $item) {
            Itemtransaksi::create([
                'transaksi_id' => $newTransaksi->id->toString(),
                'nama_produk' => $item->produk->nama,
                'jumlah_barang' => $item->jumlah_barang,
                'diskon' => $item->produk->diskon,
                'harga' => $item->produk->harga,
                'sub_total' => $item->sub_total,
            ]);
        }

        DB::table('item_orders')->where('cart_id', '=', $id)->delete();
        $cart->total_harga = 0;
        $cart->save();

        return redirect("/cart/$id");
    }
}