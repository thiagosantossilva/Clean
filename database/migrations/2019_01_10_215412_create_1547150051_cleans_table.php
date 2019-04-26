<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1547150051CleansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('cleans')) {
            Schema::create('cleans', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('external_id')->nullable()->unsigned();
                $table->integer('payment_id')->nullable()->unsigned();
                $table->integer('qt_bedrooms')->nullable()->unsigned();
                $table->integer('qt_bathrooms')->nullable()->unsigned();
                $table->string('additionals')->nullable();
                $table->string('total_time')->nullable();
                $table->tinyInteger('products_included')->nullable()->default('1');
                $table->decimal('value', 15, 2)->nullable();
                $table->datetime('start_time')->nullable();
                $table->datetime('end_time')->nullable();
                $table->tinyInteger('pet')->nullable()->default('0');
                $table->text('pet_cautions')->nullable();
                
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
        Schema::dropIfExists('cleans');
    }
}
