<?php

use Illuminate\Database\Seeder;

class CleaningTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Faxina Comercial', 'external_id' => null,],
            ['id' => 2, 'title' => 'Faxina Residencial', 'external_id' => null,],

        ];

        foreach ($items as $item) {
            \App\CleaningType::create($item);
        }
    }
}
