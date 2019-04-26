<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1547147178OrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('order_statuses')) {
            Schema::create('order_statuses', function (Blueprint $table) {
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
        Schema::dropIfExists('order_statuses');
    }
}
