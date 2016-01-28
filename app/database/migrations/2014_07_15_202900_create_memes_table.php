<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('memes', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');
	        $t->string('name');
	        $t->string('img');
	       
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
		Schema::drop('memes');
	}

}
