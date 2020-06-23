<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::insert([
            ['name' => 'Pavestone', 'value' => '7.00'],
            ['name' => 'Belgard', 'value' => '8.50'],
            ['name' => 'Las Vegas Paver', 'value' => '7.00'],
            ['name' => 'Travertine', 'value' => '12.00'],
        ]);
    }
}
