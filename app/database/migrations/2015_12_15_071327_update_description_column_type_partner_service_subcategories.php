<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDescriptionColumnTypePartnerServiceSubcategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			DB::statement("ALTER TABLE partner_service_subcategories CHANGE description description TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
