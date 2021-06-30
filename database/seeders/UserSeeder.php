<?php

namespace Database\Seeders;

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
        \App\Models\User::insert([
            'name' => 'admin',
            'email' => 'admin@ijc.com',
            'password' => bcrypt('adminpass'),
        ]);
    }
}
