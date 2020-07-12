<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::insert([
            ['name' => 'Scheduled Visit'],
            ['name' => 'Project Approved'],
            ['name' => 'Working!'],
            ['name' => 'Project Concluded'],
            ['name' => 'Project Declined'],
        ]);
    }
}
