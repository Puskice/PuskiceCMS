<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marks', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');
	        $t->integer('user_id');
	        $t->integer('people_id');
	        $t->integer('lecture_quality');
	        $t->integer('student_relations');
	        $t->integer('total_impression');
	        $t->text('note')->nullable();
	        $t->datetime('deleted_at')->nullable();
	        // created_at, updated_at DATETIME
	        $t->timestamps();
	        $t->boolean('published');
     	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('marks');
	}

}
