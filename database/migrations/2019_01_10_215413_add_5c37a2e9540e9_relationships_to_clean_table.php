<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c37a2e9540e9RelationshipsToCleanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cleans', function(Blueprint $table) {
            if (!Schema::hasColumn('cleans', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '251657_5c37a2e66b625')->references('id')->on('clients')->onDelete('cascade');
                }
                if (!Schema::hasColumn('cleans', 'status_id')) {
                $table->integer('status_id')->unsigned()->nullable();
                $table->foreign('status_id', '251657_5c37a2e683efe')->references('id')->on('cleaning_statuses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('cleans', 'payment_status_id')) {
                $table->integer('payment_status_id')->unsigned()->nullable();
                $table->foreign('payment_status_id', '251657_5c37a2e69eba0')->references('id')->on('order_statuses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('cleans', 'assigned_to_id')) {
                $table->integer('assigned_to_id')->unsigned()->nullable();
                $table->foreign('assigned_to_id', '251657_5c37a2e6c2464')->references('id')->on('users')->onDelete('cascade');
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
