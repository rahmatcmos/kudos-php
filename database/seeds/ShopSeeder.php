<?php

use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            'en' => ['name' => 'default'],
            'default' => ['name' => 'default'],
            'root' => '',
            'url' => '',
            'code' => 'default'
        ]);
    }
}
