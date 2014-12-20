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

	/**
	 * The users posts
	 * @return object
	 */
	public function posts()
	{
		return $this->hasMany('Post');
	}

	/**
	 * User information
	 * @return object
	 */
	public function about()
	{
		return $this->hasOne('About');
	}

	/**
	 * The user's followers
	 * @return object
	 */
	public function followers()
	{
		/*
		 * follower_id is a person who is following the user
		 * followed_id is a person who is being followed
		 */
		return $this->belongsToMany('User', 'follows', 'followed_id', 'follower_id');
	}


	public function following()
	{
		return $this->belongsToMany('User', 'follows', 'follower_id', 'followed_id');
	}
}
