<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'gambar',
        'deskripsi',
        'stok',
        'diskon',
        'harga',
    ];

    public function itemOrder()
    {
        return $this->hasMany(Cart::class);
    }
}
