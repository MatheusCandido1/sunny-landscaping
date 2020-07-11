<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      /*  $this->call(SuppliersTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(ReferralTableSeeder::class);
        $this->call(SellerTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(CustomersTableSeeder::class);*/
        $this->call(VisitsTableSeeder::class);

    }
}
