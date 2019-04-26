<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1548777738CleansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cleans', function (Blueprint $table) {
            if(Schema::hasColumn('cleans', 'assigned_to_id')) {
                $table->dropForeign('251657_5c37a2e6c2464');
                $table->dropIndex('251657_5c37a2e6c2464');
                $table->dropColumn('assigned_to_id');
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
