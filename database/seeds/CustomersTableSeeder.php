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
            ['name' => 'Frank Castle', 'gender' => 'Mr','address' => '3025, Via Della Amore', 'cross_street1' => 'Meridiana','cross_street2' => 'Suzana','gate_code' => '435', 'state' => 'Nevada', 'zipcode' => '89052', 'parcel_number' => '32432', 'phone' => '(702) 435-5430','cellphone' => '1', 'email' => 'frank.castle@email.com','referral_id' => '1','city_id' => '1','seller_id'=>'1']
        ]);
    }
}
