<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPartnerIdToPartnerServiceSubcategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('partner_service_subcategories', function(Blueprint $table)
		{
			$table->integer('partner_id')->unsigned();
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
			$table->dropColumn('partner_id');
		});
	}

}
