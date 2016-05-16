<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovedPartnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('approved_partners', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('partner_id')->unsigned();
			$table->foreign('partner_id')->references('id')->on('partners');


			$table->integer('service_provider_id')->unsigned();
			$table->foreign('service_provider_id')->references('id')->on('service_providers');

			$table->boolean('is_active')->default(0);

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
		Schema::drop('approved_partners');
	}

}
