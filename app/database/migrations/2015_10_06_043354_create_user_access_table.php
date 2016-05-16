<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_access', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('menu_option_id')->unsigned();
			$table->foreign('menu_option_id')->references('id')->on('menu_options');
			$table->text('parameters');
			$table->integer('menu_display_ord');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_access');
	}

}
