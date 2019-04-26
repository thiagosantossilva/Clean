<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1548778052CleansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cleans', function (Blueprint $table) {
            
if (!Schema::hasColumn('cleans', 'qt_employees')) {
                $table->integer('qt_employees')->nullable()->unsigned();
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
            $table->dropColumn('qt_employees');
            
        });

    }
}
