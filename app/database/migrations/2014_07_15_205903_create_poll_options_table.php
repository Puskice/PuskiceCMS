<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('poll_options', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');
	        $t->integer('poll_id');
	        $t->string('title');
	        $t->integer('vote_count')->default(0);
     	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('poll_options');
	}

}
