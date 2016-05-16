<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToPartnerServiceSubcategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('partner_service_subcategories', function(Blueprint $table)
		{
			$table->string('description');
			$table->string('website_url');
			$table->string('contact_number');
			$table->string('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('partner_service_subcategories', function(Blueprint $table)
		{
			$table->dropColumn('description');
			$table->dropColumn('website_url');
			$table->dropColumn('contact_number');
			$table->dropColumn('email');
		});
	}

}
