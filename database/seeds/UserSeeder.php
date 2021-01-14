<?php

use App\User;
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
            'name' => 'Ward june',
            'username' => 'WardJune',
            'email' => 'junawar183@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
