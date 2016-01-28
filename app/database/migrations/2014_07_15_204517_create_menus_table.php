<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');

	        $t->string('menu_title');
	        $t->string('menu_class')->nullable();
	        $t->string('menu_id')->nullable();

     	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu');
	}

}
