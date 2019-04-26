<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1547150261CleaningTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('cleaning_types')) {
            Schema::create('cleaning_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->integer('external_id')->nullable()->unsigned();
                
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
        Schema::dropIfExists('cleaning_types');
    }
}
