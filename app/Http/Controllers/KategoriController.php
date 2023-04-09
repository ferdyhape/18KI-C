<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kategoris'] = Kategori::all();
        $data['carts'] = Cart::where('user_id', 'like', Auth::user()->id)->get();
        return view('kategori', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required', 'string', 'max:50',
        //     'deskripsi' => 'string', 'max:255'
        // ]);
        // Kategori::create([
        //     'nama' => $request->nama,
        //     'deskripsi' => $request->deskripsi
        // ]);
        // return redirect('/kategori');


        $request->validate([
            'nama' => ['required',  'string', 'max:50'],
            'deskripsi' => ['max:255']
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('/kategori');
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
        $kategori = Kategori::find($id);

        if($request->nama){
            $kategori->nama = $request->nama;
        }
        if($request->deskripsi){
            $kategori->deskripsi = $request->deskripsi;
        }
        
        $kategori->save();
        return redirect('/kategori');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kategori::destroy($id);
        return redirect('kategori');
    }
}
