<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1547172586CleansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cleans', function (Blueprint $table) {
            if(Schema::hasColumn('cleans', 'payment_status_id')) {
                $table->dropForeign('251657_5c37a2e69eba0');
                $table->dropIndex('251657_5c37a2e69eba0');
                $table->dropColumn('payment_status_id');
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
        Schema::table('cleans', function (Blueprint $table) {
                        
        });

    }
}
