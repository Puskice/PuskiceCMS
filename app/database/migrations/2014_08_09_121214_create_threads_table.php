<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('threads', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');

	        $t->integer('user_id');
	        $t->string('title');
	        $t->integer('user_level_required');
	        $t->integer('status')->default(0);
	        
			$t->softDeletes();
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
		Schema::drop('threads');
	}

}
