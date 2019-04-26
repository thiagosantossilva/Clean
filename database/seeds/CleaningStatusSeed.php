<?php

use Illuminate\Database\Seeder;

class CleaningStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Aguardando Pagamento',],
            ['id' => 2, 'title' => 'Aberta',],
            ['id' => 3, 'title' => 'Aguardando',],
            ['id' => 4, 'title' => 'Finalizada',],

        ];

        foreach ($items as $item) {
            \App\CleaningStatus::create($item);
        }
    }
}
