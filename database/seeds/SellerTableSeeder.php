<?php

use Illuminate\Database\Seeder;
use App\Seller;

class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::insert([
            ['name' => 'Glaucia'],
            ['name' => 'Ray'],
            ['name' => 'Helio']
        ]);
    }
}
