<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'nama' => 'Azzura Lazuardy (Admin)',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'level' => 'admin',
        ]);

        User::create([
            'nama' => 'Said Aghil (Gudang)',
            'email' => 'gudang@gmail.com',
            'password' => Hash::make('gudang'),
            'level' => 'gudang',
        ]);
    }
}
