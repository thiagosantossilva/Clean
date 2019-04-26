<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1547251503SubscriptionStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('subscription_statuses')) {
            Schema::create('subscription_statuses', function (Blueprint $table) {
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
        Schema::dropIfExists('subscription_statuses');
    }
}
