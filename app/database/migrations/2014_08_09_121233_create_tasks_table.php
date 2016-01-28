<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');

	        $t->integer('user_id');
	        $t->integer('assigned_to');
	        $t->integer('thread_id');
	        $t->string('title');
	        $t->text('description')->nullable();
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
		Schema::drop('tasks');
	}

}
