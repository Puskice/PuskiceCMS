<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('files', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');
	        $t->integer('news_id');
	        $t->string('title');
	        $t->string('url');
	        $t->text('description')->nullable();
	        $t->integer('published')->default(0);
	        $t->integer('thumbs_up')->default(0);
	        $t->integer('thumbs_down')->default(0);
	        $t->integer('user_id');
	        $t->integer('download_count')->default(0);

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
		Schema::drop('files');
	}

}
