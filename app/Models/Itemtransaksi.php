<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemtransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'nama_produk',
        'jumlah_barang',
        'diskon',
        'harga',
        'sub_total',
    ];

    public function transaksi() 
    {
        return $this->belongsTo(Transaksi::class);
    }
}
