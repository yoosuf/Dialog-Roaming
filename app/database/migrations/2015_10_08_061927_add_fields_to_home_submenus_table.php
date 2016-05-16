<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToHomeSubmenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('home_submenus', function(Blueprint $table)
		{

			$table->string('partner_service_id');
			$table->string('service_provider_api_id');


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('home_submenus', function(Blueprint $table)
		{
			$table->dropColumn('partner_service_id');
			$table->dropColumn('service_provider_api_id');
		});
	}

}
