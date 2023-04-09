<?php

namespace Database\Seeders;

use App\Models\Itemtransaksi;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $randomTransaksi = Transaksi::inRandomOrder()->first();
        Itemtransaksi::create([
            'transaksi_id' => $randomTransaksi['id'],
            'nama_produk' => 'Nasi Goreng',
            'jumlah_barang' => 2,
            'sub_total' => 20000,
            'diskon' => 0,
            'harga' => 10000,
        ]);
    }
}
