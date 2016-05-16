<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Rhumsaa\Uuid\Uuid;
class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $fillable = ['username','email' , 'password', 'is_active', 'role_id', 'creator_id'];

	public static $rules = [
			'username' => 'required|unique:users',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
			'password_confirmation' => 'required',
			'role_id' => 'required'
	];


	/**
	 * Hash the password attribute
	 *
	 * @param $value
	 */
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}


	/**
	 * @return mixed
     */
	public function role() {
		return $this->belongsTo('Role');
	}




	public function serviceProvider() {

		return $this->hasOne('ServiceProvider');

	}







	public function partner() {

		return $this->hasOne('Partner');

	}






	public static function boot()
	{
		parent::boot();

		static::creating(function ($user) {

			$user->invitation_code = (string) Str::random(60);

		});
	}

}
