<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToPartnerServiceCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('partner_service_categories', function(Blueprint $table)
		{

			$table->integer('country_id')->unsigned();
			$table->foreign('country_id')->references('id')->on('countries');
			$table->integer('list_order');


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('partner_service_categories', function(Blueprint $table)
		{
			$table->dropColumn('country_id');
			$table->dropColumn('list_order');
		});
	}

}
