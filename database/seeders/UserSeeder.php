<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => "test",
            "email" => "a@b.com",
            "password" => Hash::make("1111")
        ]);
        \App\Models\User::create([
            'name' => "test1",
            "email" => "a@b1.com",
            "password" => Hash::make("1111")
        ]);
        \App\Models\User::create([
            'name' => "test2",
            "email" => "a@b2.com",
            "password" => Hash::make("1111")
        ]);
    }
}
