<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/** 
	* The fillable fields to prevent mass assignment
	*
	* @var array
	*/
	protected $fillable = [
        'first_name', 'last_name', 'email', 'username', 'password', 'birthday', 'gender'
    ];

   

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
	protected $hidden = array('password', 'remember_token', 'code', 'id', 'active', 'updated_at', 'created_at');

	public function posts()
	{
		return $this->hasMany('Post');
	}

	public function about()
	{
		return $this->hasOne('About');
	}

}
