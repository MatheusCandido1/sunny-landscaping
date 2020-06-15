<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::insert([
            ['description' => 'Plaza Stone Rec. & Sq., Sierra Blend', 'unit_cost' => '7.00', 'type' => 'sq.ft', 'type_per' => 'per sq.ft'],
            ['description' => 'Plaza Stone Rec., Charcoal', 'unit_cost' => '7.00', 'type' => 'sq.ft', 'type_per' => 'per sq.ft'],
            ['description' => 'Cambridge Rec. & Sq., Bella Blend', 'unit_cost' => '8.50', 'type' => 'sq.ft', 'type_per' => 'per sq.ft']
        ]);
    }
}
