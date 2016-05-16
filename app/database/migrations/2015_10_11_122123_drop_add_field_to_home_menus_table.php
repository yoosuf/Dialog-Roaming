<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAddFieldToHomeMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('home_menus', function(Blueprint $table)
		{
			$table->enum('menu_type',['explore', 'deals', 'dine', 'stay', 'transport', 'flights']);
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
			$table->dropColumn('menu_type');
		});
	}

}
