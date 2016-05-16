<?php

class ServiceProviderApi extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'service_provider_apis';


	protected $guarded = [];

	public static $rules = [
		'service_provider_id' => 'required',
		'mobile_api_id' => 'required'
	];





	public function mobileApi() {

		return $this->belongsTo('MobileApi');

	}


	public function serviceProvider() {

		return $this->belongsTo('ServiceProvider');

	}


}
