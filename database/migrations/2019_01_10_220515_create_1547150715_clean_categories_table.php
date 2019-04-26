<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1547150715CleanCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('clean_categories')) {
            Schema::create('clean_categories', function (Blueprint $table) {
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
        Schema::dropIfExists('clean_categories');
    }
}
