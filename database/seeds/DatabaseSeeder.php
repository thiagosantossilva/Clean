<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(AddressTypeSeed::class);
        $this->call(CleanCategorySeed::class);
        $this->call(CleaningStatusSeed::class);
        $this->call(CleaningTypeSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);

    }
}
