<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produk::create([
            'nama' => 'Nasi Goreng',
            'gambar' => 'gambar-produk/gambarkosong.jpg',
            'deskripsi' => 'Ini adalah deskripsi Nasi Goreng',
            'stok' => 929,
            'harga' => '10000',
            'kategori_id' => 1,
        ]);
        Produk::create([
            'nama' => 'Nasi Tidak Goreng',
            'gambar' => 'gambar-produk/gambarkosong.jpg',
            'deskripsi' => 'Ini adalah deskripsi Nasi Tidak Goreng',
            'stok' => 969,
            'harga' => '12000',
            'kategori_id' => 1,
        ]);
        Produk::create([
            'nama' => 'Es Teh',
            'gambar' => 'gambar-produk/gambarkosong.jpg',
            'deskripsi' => 'Ini adalah deskripsi Es Teh',
            'stok' => 939,
            'harga' => '12000',
            'kategori_id' => 2,
        ]);
        Produk::create([
            'nama' => 'Es bukan teh',
            'gambar' => 'gambar-produk/gambarkosong.jpg',
            'deskripsi' => 'Ini adalah deskripsi Es bukan teh',
            'stok' => 991,
            'harga' => '12000',
            'kategori_id' => 2,
        ]);
    }
}
