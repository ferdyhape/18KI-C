<?php

namespace Database\Seeders;

use App\Models\ItemOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemOrder::create([
            'cart_id' => '1',
            'produk_id' => 1,
            'jumlah_barang' => 2,
            'sub_total' => 20000,
        ]);
    }
}
