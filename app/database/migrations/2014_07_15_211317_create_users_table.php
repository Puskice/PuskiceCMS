<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');

	        $t->string('username');
	        $t->string('email');
	        $t->string('first_name');
	        $t->string('last_name');
	        $t->integer('published')->default(0);
	        $t->string('password');
	        $t->datetime('last_login')->nullable();
	        $t->string('last_login_ip')->nullable();
	        $t->integer('thumbs_up')->default(0);
	        $t->integer('thumbs_down')->default(0);
	        $t->string('avatar')->nullable();
	        $t->integer('user_level');
	        $t->string('hash')->nullable();
	        $t->integer('points')->default(0);
	        $t->integer('department')->default(0);
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
		Schema::drop('users');
	}

}
