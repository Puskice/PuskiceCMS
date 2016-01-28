<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('poll_votes', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');
	        $t->integer('poll_id');
	        $t->integer('option_id');
	        $t->string('ip_address');
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
		Schema::drop('poll_votes');
	}

}
