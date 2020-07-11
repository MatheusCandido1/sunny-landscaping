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
            ['name' => 'Frank Castle', 'gender' => 'Mr','address' => '3025, Via Della Amore', 'cross_street1' => 'Meridiana','cross_street2' => 'Suzana','gate_code' => '435', 'state' => 'Nevada', 'zipcode' => '89052', 'parcel_number' => '32432', 'phone' => '(702) 435-5430','cellphone' => '1', 'email' => 'frank.castle@email.com', 'company' => '0', 'referral_id' => '1','city_id' => '3','seller_id'=>'1'],
            ['name' => 'Jacob Manson', 'gender' => 'Mr','address' => '653, Via Suzan', 'cross_street1' => 'Meridiana','cross_street2' => 'Suzana','gate_code' => '435', 'state' => 'Nevada', 'zipcode' => '89052', 'parcel_number' => '32432', 'phone' => '(702) 435-5430','cellphone' => '1', 'email' => 'jacob.manson@email.com', 'company' => '0', 'referral_id' => '3','city_id' => '2','seller_id'=>'2'],
            ['name' => 'Ella Aiden', 'gender' => 'Mrs','address' => '54, Via Meridiana', 'cross_street1' => 'Meridiana','cross_street2' => 'Suzana','gate_code' => '435', 'state' => 'Nevada', 'zipcode' => '89052', 'parcel_number' => '32432', 'phone' => '(702) 435-5430','cellphone' => '1', 'email' => 'ella.maiden@email.com', 'company' => '0', 'referral_id' => '5','city_id' => '3','seller_id'=>'3'],
            ['name' => 'Isabella Noah', 'gender' => 'Mrs','address' => '8766, Via Venitian', 'cross_street1' => 'Meridiana','cross_street2' => 'Suzana','gate_code' => '435', 'state' => 'Nevada', 'zipcode' => '89052', 'parcel_number' => '32432', 'phone' => '(702) 435-5430','cellphone' => '1', 'email' => 'isabella.noah@email.com', 'company' => '0', 'referral_id' => '7','city_id' => '1','seller_id'=>'1'],
            ['name' => 'James David', 'gender' => 'Mr','address' => '546, Via Cruz', 'cross_street1' => 'Meridiana','cross_street2' => 'Suzana','gate_code' => '435', 'state' => 'Nevada', 'zipcode' => '89052', 'parcel_number' => '32432', 'phone' => '(702) 435-5430','cellphone' => '1', 'email' => 'james.david@email.com', 'company' => '0', 'referral_id' => '2','city_id' => '1','seller_id'=>'2']
        ]);
    }
}
