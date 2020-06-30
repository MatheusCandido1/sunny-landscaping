<?php

use Illuminate\Database\Seeder;
use App\City;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert([
            ['name' => 'Las Vegas'],
            ['name' => 'North Las Vegas'],
            ['name' => 'Henderson'],
            ['name' => 'Boulder City']
        ]);
    }
}
