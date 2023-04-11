<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['produks'] = Produk::all();
        return view('produk', [
            'produks' => Produk::all(),
            'kategoris' => Kategori::all(),
            'carts' => Cart::where('user_id', 'like', Auth::user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['produks'] = produk::all();

        return view('produks/add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'nama' => 'required',
            'gambar' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required',
            'kategori_id' => 'required|numeric',
            'diskon' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);
        $namaGambar = $validated['gambar']->store('produk-gambar', 'public');
        $validated['gambar'] = $namaGambar;
        //===============

        Produk::create([
            'nama' => $validated['nama'],
            'gambar' => $validated['gambar'],
            'deskripsi' => $validated['deskripsi'],
            'stok' => $validated['stok'],
            'kategori_id' => $validated['kategori_id'],
            'diskon' => $validated['diskon'],
            'harga' => $validated['harga'],
        ]);

        $Kategori = Kategori::find($validated['kategori_id']);

        $Kategori->update(['jumlah_produk' => $Kategori->jumlah_produk + 1]);


        return redirect('/produk')->with('toast_success', $validated['nama'].' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['produks'] = Produk::find($id);

        return view('/produks/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $validated = $request->validate([
            'nama' => 'required',
            'gambar' => 'nullable',
            'deskripsi' => 'required',
            'kategori_id' => 'required|numeric',
            'stok' => 'required',
            'diskon' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);
        // dd($validated);
        $product = Produk::find($id);

        if ($request->file('gambar')) {
            $namaGambar = $validated['gambar']->store('produk-gambar', 'public');
            $validated['gambar'] = $namaGambar;
            File::delete('storage/' . $product->gambar);
        } else {
            $validated['gambar'] = $product->gambar;
        }

        $product->update([
            'nama' => $validated['nama'],
            'gambar' => $validated['gambar'],
            'kategori_id' => $validated['kategori_id'],
            'deskripsi' => $validated['deskripsi'],
            'stok' => $validated['stok'],
            'diskon' => $validated['diskon'],
            'harga' => $validated['harga'],
        ]);

        return redirect('/produk')->with('toast_success', $validated['nama'].' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapusProduk = Produk::find($id);
        File::delete('storage/' . $hapusProduk->gambar);
        $hapusProduk->delete();
        return redirect('/produk')->with('toast_success', 'Produk berhasil dimusnahkan');
    }
}
