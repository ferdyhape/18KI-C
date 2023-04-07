<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'produk_id',
        'jumlah_barang',
        'sub_total',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

}
