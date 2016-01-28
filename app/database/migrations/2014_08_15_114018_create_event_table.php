<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');

	        $t->string('title');
	        $t->string('permalink');
	        $t->text('short_content');
	        $t->text('long_content');
	        $t->string('featured_image')->nullable();
	        $t->string('image_caption')->nullable();
	        $t->boolean('featured')->default(0);
	        $t->integer('published')->default(0);
	        $t->integer('view_count')->default(0);
	        $t->integer('published_by');
	        $t->integer('last_modified_by');
	        $t->string('added_css')->nullable();
	        $t->string('added_js')->nullable();
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
		Schema::drop('product_category');
	}

}
