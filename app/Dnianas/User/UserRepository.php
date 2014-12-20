<?php
namespace Dnianas\User;

use \User;

class UserRepository
{

    /**
     * Returns all of the users in the database
     * @return mixed
     */
    public function getAll()
    {
        return User::all()->toArray();
    }


    /**
     * Returns the user by their id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return User::find($id)->firstOrFail();
    }

    /**
     * Get the user by their username
     * @param  string $username the user's username
     * @return  the user object
     */
    public function getByUsername($username)
    {
        return User::where('username', '=', $username)->get()->toArray();
    }

    /**
     * Get information about the provided user object
     * @param  \User  $user     The user object 
     * @return object           Collection containing info about the user
     */
    public function getAbout(\User $user)
    {
        return $user->about()->first();
    }

    /**
     * Follow a user
     * @param  integer  $userIdToFollow     The user id that you're trying to follow
     * @param  object   $user               The current logged in user
     * @return object                 
     */
    public function follow($userIdToFollow, $user)
    {
        
    }

}

