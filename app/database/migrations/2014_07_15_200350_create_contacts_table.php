<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');
	        $t->string('title');
	        $t->string('first_name');
	        $t->string('last_name');
	        $t->string('image');
	        $t->text('description');
	        $t->string('email')->nullable();
	        $t->string('phone')->nullable();
	        $t->string('address')->nullable();
	        $t->string('webpage')->nullable();
	        $t->integer('published')->default(0);
	        $t->integer('priority')->default(0);
	        $t->float('student_relations')->nullable();
	        $t->float('lecture_quality')->nullable();
	        $t->float('total_impression')->nullable();
	        $t->integer('mark_count')->nullable();
	        //legacy support
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
		Schema::drop('contacts');
	}

}
