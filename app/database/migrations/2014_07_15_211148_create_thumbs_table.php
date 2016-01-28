<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThumbsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('thumbs', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');

	        $t->string('ip');
	        $t->integer('object_id');
	        $t->integer('object_type');
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
		Schema::drop('thumbs');
	}

}
