<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAddListOrderFieldToHomeMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('home_menus', function(Blueprint $table)
		{
			$table->integer('list_order')->unsigned();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('home_menus', function(Blueprint $table)
		{
			$table->dropColumn('list_order');

		});
	}

}
