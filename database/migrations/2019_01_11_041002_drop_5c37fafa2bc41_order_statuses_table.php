<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5c37fafa2bc41OrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('order_statuses');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('order_statuses')) {
            Schema::create('order_statuses', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                
                $table->timestamps();
                
            });
        }
    }
}
