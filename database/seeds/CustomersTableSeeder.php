<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::insert([
            ['name' => 'Frank Castle', 'address' => '3025, Via Della Amore', 'cross_street1' => 'Meridiana','cross_street2' => 'Suzana','gate_code' => '435','city' => 'Henderson', 'state' => 'Nevada', 'zipcode' => '89052', 'phone' => '(702) 435-5430','cellphone' => '1', 'email' => 'frank.castle@email.com', 'referred' => 'Craigslist']
        ]);
    }
}
