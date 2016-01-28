<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('points', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');
	        $t->integer('user_id');
	        $t->integer('points');
	        $t->text('description')->nullable();
	        $t->datetime('deleted_at')->nullable();
	        // created_at, updated_at DATETIME
	        $t->timestamps();
     	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('points');
	}

}
