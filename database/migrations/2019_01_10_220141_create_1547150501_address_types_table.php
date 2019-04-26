<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1547150501AddressTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('address_types')) {
            Schema::create('address_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                
                $table->timestamps();
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_types');
    }
}
