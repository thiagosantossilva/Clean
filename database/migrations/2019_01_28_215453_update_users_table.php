<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
		Schema::table('users', function (Blueprint $table) {
            $table->integer('external_id')->nullable()->unsigned();
			$table->string('cpf')->nullable();
			$table->date('birthdate')->nullable();
			$table->string('gender')->nullable();
			$table->string('phone')->nullable();
			$table->string('celphone')->nullable();
			$table->string('location_address')->nullable();
			$table->double('location_latitude')->nullable();
			$table->double('location_longitude')->nullable();
			$table->string('street')->nullable();
			$table->integer('number')->nullable()->unsigned();
			$table->string('zip')->nullable();
			$table->string('neighborhood')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('complement')->nullable();
        });
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
