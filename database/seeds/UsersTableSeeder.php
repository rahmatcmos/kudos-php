<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'admin',
            'last_name' => '',
            'email' => 'admin@kudos',
            'password' => bcrypt('password'),
            'admin' => 1
        ]);
    }
}
