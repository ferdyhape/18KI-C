<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaksi::create([
            'transaksi_id' => 'RUIWEOWE',
            'user_id' => '1',
            'total_harga' => 20000,
            'tunai' => 100000,
            'kembali' => 80000,
        ]);
    }
}
