<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Gufron',
            'email' => 'admin@admin.com',
            'alamat' => 'Bandung',
            'password' => bcrypt('password'),
        ]);
    }
}
