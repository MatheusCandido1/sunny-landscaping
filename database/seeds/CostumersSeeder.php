<?php

use Illuminate\Database\Seeder;
use App\Costumer;

class CostumersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Costumer::insert([
            ['name' => 'Matheus Cândido', 'address' => 'Rua Epaminondas de Moura e Silva, 345', 'gate_code' => '30452', 'cellphone' => '+5531998722520', 'phone' => '+5531998722520', 'email' => 'matheus@gmail.com' ],
            ['name' => 'Paula Soares', 'address' => 'Rua das Gaivotas, 11', 'gate_code' => '12345', 'cellphone' => '+5531998722520', 'phone' => '+5531998722520', 'email' => 'paula@gmail.com' ],
            ['name' => 'Rodolfo Silva', 'address' => 'Rua das Flores, 4353', 'gate_code' => '45333', 'cellphone' => '+5531998722520', 'phone' => '+5531998722520', 'email' => 'rodolfo@gmail.com' ]
        ]);
    }
}
