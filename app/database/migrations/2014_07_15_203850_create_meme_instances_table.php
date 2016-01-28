<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemeInstancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meme_instances', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');
	        $t->integer('meme_id');
	        $t->integer('user_id');
	        $t->string('permalink');
	        $t->string('first_line');
	        $t->string('second_line');
	        $t->boolean('published')->default(1);
	        $t->integer('view_count')->default(0);
	        $t->integer('thumbs_up')->default(0);
	        $t->integer('thumbs_down')->default(0);
	        
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
		Schema::drop('meme_instances');
	}

}
