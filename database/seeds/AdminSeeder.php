<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'administrator',
            'email' => 'admin@a.com',
            'password' => bcrypt('secret'),
            'role' => 'administrator'
        ]);
    }
}
