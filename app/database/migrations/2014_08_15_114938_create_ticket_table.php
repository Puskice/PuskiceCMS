<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function($t) {
        	// auto increment id (primary key)
	        $t->increments('id');

	        $t->string('title');
	        $t->string('permalink');
	        $t->integer('product_id');
	        $t->integer('event_id');
	        $t->integer('published')->default(0);
	        $t->integer('enumerated')->default(0);
	        $t->integer('starting_entrance')->nullable();
	        $t->integer('ending_entrance')->nullable();
	        $t->integer('starting_row')->nullable();
	        $t->integer('ending_row')->nullable();
	        $t->integer('starting_seat')->nullable();
	        $t->integer('ending_seat')->nullable();
	        $t->integer('stock')->default(0);
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
		Schema::drop('tickets');
	}

}
