<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c5099afa21b8RelationshipsToCleanSlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clean_slots', function(Blueprint $table) {
            if (!Schema::hasColumn('clean_slots', 'clean_id')) {
                $table->integer('clean_id')->unsigned()->nullable();
                $table->foreign('clean_id', '259793_5c5099acb8875')->references('id')->on('cleans')->onDelete('cascade');
                }
                if (!Schema::hasColumn('clean_slots', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '259793_5c5099accf3b3')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('clean_slots', function(Blueprint $table) {
            
        });
    }
}
