<?php

class Permission extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	protected $guarded = [];

	public static $rules = [
		'user_role' => 'required',
		'menu_option_id' => 'required',
		'parameters' => 'required',
		'menu_disp_order' => 'required'
	];
}
