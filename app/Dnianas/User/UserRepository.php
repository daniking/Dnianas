<?php
namespace Dnianas\User;

use \User;

class UserRepository implements UserRepositoryInterface
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

    public function getAbout(\User $user)
    {
        return $user->about()->first();
    }

}

