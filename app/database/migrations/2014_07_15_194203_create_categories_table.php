<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');

	        $t->string('title');
	        $t->string('permalink');
	        $t->integer('parent_id')->nullable();
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
		Schema::drop('categories');
	}

}
