<?php

class Role extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';


	protected $guarded = [];

	public static $rules = [
		'name' => 'required',
	];




	public function users() {

		return $this->belongsTo('users');
	}
}
