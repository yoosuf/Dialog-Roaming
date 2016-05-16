<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerServiceSubcategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partner_service_subcategories', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('partner_service_category_id')->unsigned();
			$table->foreign('partner_service_category_id', 'partner_service_category')->references('id')->on('partner_service_categories');


			$table->string('service_name');

			$table->string('banner_img');

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
		Schema::drop('partner_service_subcategories');
	}

}
