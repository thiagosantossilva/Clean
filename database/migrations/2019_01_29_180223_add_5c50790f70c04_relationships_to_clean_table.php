<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c50790f70c04RelationshipsToCleanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cleans', function(Blueprint $table) {
            if (!Schema::hasColumn('cleans', 'address_type_id')) {
                $table->integer('address_type_id')->unsigned()->nullable();
                $table->foreign('address_type_id', '251657_5c37a6642da79')->references('id')->on('address_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('cleans', 'clean_type_id')) {
                $table->integer('clean_type_id')->unsigned()->nullable();
                $table->foreign('clean_type_id', '251657_5c37a6644a0e3')->references('id')->on('cleaning_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('cleans', 'clean_category_id')) {
                $table->integer('clean_category_id')->unsigned()->nullable();
                $table->foreign('clean_category_id', '251657_5c37a66462052')->references('id')->on('clean_categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('cleans', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '251657_5c37a2e66b625')->references('id')->on('clients')->onDelete('cascade');
                }
                if (!Schema::hasColumn('cleans', 'status_id')) {
                $table->integer('status_id')->unsigned()->nullable();
                $table->foreign('status_id', '251657_5c37a2e683efe')->references('id')->on('cleaning_statuses')->onDelete('cascade');
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
        Schema::table('cleans', function(Blueprint $table) {
            
        });
    }
}
