<?php

use Illuminate\Database\Seeder;
use App\Visit;
class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visit::insert([
            ['date' => '2020-07-11 15:00:00','call_customer_in' => '25', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '1','status_id' => '1'],
            ['date' => '2020-08-11 08:00:00','call_customer_in' => '5', 'hoa' => '1', 'water_smart_rebate' => '0', 'customer_id' => '2','status_id' => '2'],
            ['date' => '2020-09-11 15:30:00','call_customer_in' => '20', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '3','status_id' => '3'],
            ['date' => '2020-11-11 09:45:00','call_customer_in' => '15', 'hoa' => '1', 'water_smart_rebate' => '0', 'customer_id' => '4','status_id' => '4'],
            ['date' => '2020-12-11 11:00:00','call_customer_in' => '10', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '5','status_id' => '5'],
            ['date' => '2020-07-11 15:00:00','call_customer_in' => '25', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '1','status_id' => '6'],
            ['date' => '2020-08-11 08:00:00','call_customer_in' => '5', 'hoa' => '1', 'water_smart_rebate' => '0', 'customer_id' => '2','status_id' => '7'],
            ['date' => '2020-09-11 15:30:00','call_customer_in' => '20', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '3','status_id' => '1'],
            ['date' => '2020-11-11 09:45:00','call_customer_in' => '15', 'hoa' => '1', 'water_smart_rebate' => '0', 'customer_id' => '4','status_id' => '2'],
            ['date' => '2020-12-11 11:00:00','call_customer_in' => '10', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '5','status_id' => '2'],
            ['date' => '2020-07-11 15:00:00','call_customer_in' => '25', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '1','status_id' => '3'],
            ['date' => '2020-08-11 08:00:00','call_customer_in' => '5', 'hoa' => '1', 'water_smart_rebate' => '0', 'customer_id' => '2','status_id' => '4'],
            ['date' => '2020-09-11 15:30:00','call_customer_in' => '20', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '3','status_id' => '5'],
            ['date' => '2020-11-11 09:45:00','call_customer_in' => '15', 'hoa' => '1', 'water_smart_rebate' => '0', 'customer_id' => '4','status_id' => '7'],
            ['date' => '2020-12-11 11:00:00','call_customer_in' => '10', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '5','status_id' => '4'],
            ['date' => '2020-07-11 15:00:00','call_customer_in' => '25', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '1','status_id' => '4'],
            ['date' => '2020-08-11 08:00:00','call_customer_in' => '5', 'hoa' => '1', 'water_smart_rebate' => '0', 'customer_id' => '2','status_id' => '5'],
            ['date' => '2020-09-11 15:30:00','call_customer_in' => '20', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '3','status_id' => '6'],
            ['date' => '2020-11-11 09:45:00','call_customer_in' => '15', 'hoa' => '1', 'water_smart_rebate' => '0', 'customer_id' => '4','status_id' => '7'],
            ['date' => '2020-12-11 11:00:00','call_customer_in' => '10', 'hoa' => '1', 'water_smart_rebate' => '1', 'customer_id' => '5','status_id' => '2'],
        ]);
    }
}
