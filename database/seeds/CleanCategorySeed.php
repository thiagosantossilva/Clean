<?php

use Illuminate\Database\Seeder;

class CleanCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Avulsa',],
            ['id' => 2, 'title' => 'Quinzenal',],
            ['id' => 3, 'title' => 'Semanal',],
            ['id' => 4, 'title' => 'Múltipla',],

        ];

        foreach ($items as $item) {
            \App\CleanCategory::create($item);
        }
    }
}
