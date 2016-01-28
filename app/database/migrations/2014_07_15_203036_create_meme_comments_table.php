<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemeCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meme_comments', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');
	        $t->integer('news_id');
	        $t->integer('user_id')->default(-1);
	        $t->string('email');
	        $t->string('username');
	        $t->text('comment_content');
	        $t->integer('thumbs_up')->default(0);
	        $t->integer('thumbs_down')->default(0);
	        //legacy support
	        $t->integer('published')->default(0);
	        $t->integer('parent_id')->default(0);
	        $t->datetime('deleted_at')->nullable();
	        // created_at, updated_at DATETIME
	        $t->timestamps();
	        $t->string('ip_address');
     	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('meme_comments');
	}

}
