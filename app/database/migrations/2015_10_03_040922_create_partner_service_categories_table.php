<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerServiceCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partner_service_categories', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('partner_id')->unsigned();
			$table->foreign('partner_id', 'partner_foregin')->references('id')->on('partners');
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
		Schema::drop('partner_service_categories');
	}

}
