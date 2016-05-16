<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToServiceProvidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('service_providers', function(Blueprint $table)
		{
			$table->text('about_description')->nullable();
			$table->string('about_banner_img')->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('service_providers', function(Blueprint $table)
		{
			$table->dropColumn('about_description');
			$table->dropColumn('about_banner_img');

		});
	}

}
