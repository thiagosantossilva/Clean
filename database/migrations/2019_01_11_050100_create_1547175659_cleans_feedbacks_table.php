<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1547175659CleansFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('cleans_feedbacks')) {
            Schema::create('cleans_feedbacks', function (Blueprint $table) {
                $table->increments('id');
                $table->text('text')->nullable();
                
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
        Schema::dropIfExists('cleans_feedbacks');
    }
}
