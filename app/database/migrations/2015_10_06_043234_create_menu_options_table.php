<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_options', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('route_name');
			$table->string('menu_icon');
			$table->boolean('is_parent')->default(0);
			$table->string('show_below');
			$table->boolean('is_hidden')->default(0);
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
		Schema::drop('menu_options');
	}

}
