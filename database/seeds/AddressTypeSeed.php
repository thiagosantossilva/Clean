<?php

use Illuminate\Database\Seeder;

class AddressTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Apartamento',],
            ['id' => 2, 'title' => 'Casa / Sobrado',],
            ['id' => 3, 'title' => 'Triplex',],

        ];

        foreach ($items as $item) {
            \App\AddressType::create($item);
        }
    }
}
