<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $data_transaksi=Transaksi::all();
        return $data_transaksi;
        //return view('/transaksi', $data);
    }
}
