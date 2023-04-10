<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'nama' => 'Makanan',
            'deskripsi' => 'Ini adalah deskripsi makanan',
            'jumlah_produk' => 2
        ]);
        Kategori::create([
            'nama' => 'Minuman',
            'deskripsi' => 'Ini adalah deskripsi minuman',
            'jumlah_produk' => 2
        ]);
    }
}
