<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'id' => Uuid::uuid4(),
            'user_id' => '1',
            'total_harga' => 20000,
            'tunai' => 100000,
            'kembali' => 80000,
        ]);
    }
}
