<?php

use Illuminate\Database\Seeder;
use App\Referral;

class ReferralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Referral::insert([
            ['name' => 'Craigslist'],
            ['name' => 'Friend'],
            ['name' => 'From Advertisement'],
            ['name' => 'Google'],
            ['name' => 'Home Advertisement'],
            ['name' => 'Neightbor'],
            ['name' => 'Yelp'],
            ['name' => 'Past Costumer'],
        ]);
    }
}
