<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCategoriesMmTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news_categories_mm', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');
	        $t->integer('news_id');
	        $t->integer('category_id');
	        $t->datetime('deleted_at')->nullable();
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
		Schema::drop('news_categories_mm');
	}

}
