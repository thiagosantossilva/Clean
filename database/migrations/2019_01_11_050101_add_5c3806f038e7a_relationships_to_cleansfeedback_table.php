<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c3806f038e7aRelationshipsToCleansFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cleans_feedbacks', function(Blueprint $table) {
            if (!Schema::hasColumn('cleans_feedbacks', 'clean_id')) {
                $table->integer('clean_id')->unsigned()->nullable();
                $table->foreign('clean_id', '251753_5c3806ee0e778')->references('id')->on('cleans')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cleans_feedbacks', function(Blueprint $table) {
            
        });
    }
}
